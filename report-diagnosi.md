# Report diagnosi – filtro categorie News (MagFace)

Data analisi: 30/10/2026. Fase 1 eseguita in **sola lettura** (nessuna scrittura sul sito).
Strumenti: connettore MCP `Magface_it` (Royal MCP, sito www.magface.it), `curl`, Playwright (Chromium headless).
WP-CLI e accesso diretto al DB **non disponibili** in questo ambiente.

Legenda: **[V]** verificato direttamente · **[D]** dedotto (non provato).

## 1. Causa

**Weglot traduce l'attributo `data-filter` dei pulsanti del widget Taxonomy Filter.**
Il widget Elementor costruisce l'URL/richiesta con il valore di `data-filter`. Nelle lingue ≠ IT quel valore non è più lo slug della categoria, quindi non trova nessun termine e il filtro non fa nulla.

Evidenza **[V]** (HTML consegnato al browser, `/news/` vs `/fr/nouvelles/`):

| Lingua | Pulsante | `data-filter` | Slug reale |
|---|---|---|---|
| IT | Ricerca e Innovazione | `ricerca-e-innovazione` | `ricerca-e-innovazione` ✔ |
| EN | Research and Innovation | `research-and-innovation` | ✘ |
| FR | Recherche et innovation | `recherche et innovation` | ✘ |
| DE | Forschung und Innovation | `Forschung und Innovation` | ✘ |
| ES | Investigación e innovación | `investigación e innovación` | ✘ |

Test Playwright **[V]** (clic su "Ricerca e Innovazione", `playwright-click-test.json` in `work/`):

| Lingua | Richieste dopo il clic | Elementi griglia prima → dopo |
|---|---|---|
| IT | `POST /wp-json/elementor-pro/v1/refresh-loop` → 200 | 12 → 2 (filtra) |
| EN | nessuna | 12 → 12 |
| FR | nessuna | 12 → 12 |
| DE | solo GA4 `collect` | 12 → 12 |
| ES | solo GA4 `collect` | 12 → 12 |

Anche il caricamento diretto di `/fr/nouvelles/?e-filter-7dfa4d3-category=recherche+et+innovation` mostra tutti gli articoli (valore tradotto, categoria inesistente) **[V]**.

## 2. Ipotesi verificate

1. **REST non tradotto da Weglot** – *parzialmente vero ma non è la causa.* In IT il filtro usa davvero `POST /wp-json/elementor-pro/v1/refresh-loop` **[V]**; ma nelle altre lingue la richiesta REST **non parte nemmeno** **[V]**. Il rischio che la risposta REST resti in italiano resta teorico **[D]** e sparisce con la soluzione di Fase 3 (nessun filtro AJAX).
2. **Velocizzazione (WP Rocket / Asset CleanUp)** – *non è la causa.*
   - WP Rocket 3.9.4 **[V]**: `delay_js = 0` (disattivo), `minify_concatenate_js/css = 0`, `defer_all_js = 1`, `minify_js = 1`, `remove_unused_css = 1`, `async_css = 1`, `cache_query_strings = []`, `cache_reject_uri = []`. Esclusioni delay residue: `elementor-frontend`, `elementor/assets/lib/swiper`, `swiper` (inerti: delay disattivo).
   - Asset CleanUp 1.4.0.6 **[V]**: unload globale solo `wp-block-library` (CSS) e `jquery-migrate` (JS); nessuna regola su Elementor Pro/Weglot; sulla pagina 864 non esistono meta `_wpassetcleanup_*`. Combine/minify CSS+JS impostati "guests", ma l'HTML servito a un ospite contiene gli script come file separati (nessun file combinato) **[V]**.
   - Lo stesso stack JS in IT funziona e nelle altre lingue no, con gli stessi (soli) warning in console (`Canvas2D getImageData`, innocuo) **[V]** → non è un problema di caricamento script.

**Conclusione: la Fase 2 (ripristino regola di velocizzazione) viene saltata: nessuna regola responsabile.**

## 3. Quando è comparso

**Non determinabile con i dati disponibili.** Cronologia **[V]** (UTC) per contesto, non come prova:

| Data | Evento |
|---|---|
| 14/10 17:28 | Ultima revisione pagina 864 (News) |
| 19/10 13:54 | Ultima modifica loop template 1611 (grid "in evidenza") |
| 27/10 07:06 | Backup UpdraftPlus `152b18f2eb80` |
| 27/10 07:25 | Migrazione AIOSEO 5.0.4 |
| 27/10 09:32 | Modifica Kit predefinito (id 5) |
| 28/10 07:31 | **Prima attivazione d'uso di Asset CleanUp** (`wpassetcleanup_first_usage`) |
| 29/10 07:00 | Backup UpdraftPlus `241d3a00723a` |

**[D]** Il problema dipende da un comportamento di Weglot (traduzione degli attributi `data-*` con i nomi categoria nel dizionario), non da una modifica ai file del sito: la pagina 864 non è stata toccata dopo il 14/10 e Asset CleanUp/WP Rocket non influiscono. Può essersi manifestato quando Weglot ha tradotto (anche automaticamente) i nomi categoria o dopo un aggiornamento Elementor/Elementor Pro (pagina salvata con Elementor 4.3.5 mentre Pro è 4.3.2: versioni disallineate). Per datarlo con certezza servirebbe confrontare il front-end con un ripristino del backup del 27/10 su staging (non eseguito: non si ripristina su produzione) o la cronologia traduzioni nel pannello Weglot.

## 4. Altre evidenze rilevanti **[V]** per le fasi successive

- **Categorie già esistenti come pagine** in tutte le lingue (es. `/category/stampa/`, `/en/category/press/`, `/fr/categorie/presse/`, `/de/kategorie/drucken/`, `/es/categoria/prensa/`): HTTP 200, canonical su se stesse, hreflang Weglot reciproci.
- **Nessun template Archivio** nel Theme Builder (template presenti: Kit 5, Header 22, Footer 33, Articolo singolo 694, Loop 889 e 1611). Le categorie usano il fallback del tema Hello Elementor.
- **Paginazione archivi `noindex, nofollow`** (`/category/stampa/page/2/`): causata da `noindexPaginated`/`nofollowPaginated = true` nelle impostazioni globali AIOSEO. Contrasta con l'obiettivo "paginazione indicizzabile".
- **Meta description News**: nell'HTML è l'elenco dei nomi dei filtri ("News e Eventi Notizia in evidenza Certificazioni …"), identica in og/twitter. Il meta `_aioseo_description` del post 864 contiene invece un testo corretto, ma AIOSEO 5 non lo usa (legge dalla propria tabella): da ricontrollare dopo ogni scrittura.
- **og:image / twitter:image** puntano a `plump-nickel-porpoise.15-235-62-182.cpanel.site`. Il dominio provvisorio compare nelle opzioni AIOSEO: immagine predefinita Facebook e Twitter, logo organizzazione, dati del wizard e profilo Search Console (`searchStatistics.profile`).
- **Sitemap**: `category-sitemap.xml` contiene già solo le 9 categorie con articoli (empty escluse). Nessuna URL con parametri. Presenti però `angie_snippet-sitemap.xml` e `post_tag-sitemap.xml` nell'indice; `lastmod` delle categorie = 1970-01-01.
- **Hreflang**: Weglot emette it/en/fr/de/es reciproci; **manca `x-default`** (home, News, categorie). Nessun doppio hreflang.
- **Redirection non è installato** (anche se esistono i tool `redirection_*` nel connettore). Plugin attivi rilevanti: Code Snippets 3.10.2, WP Rocket, Asset CleanUp, Weglot, AIOSEO.
- Backup UpdraftPlus disponibili: `152b18f2eb80` (27/10 07:06 UTC), `241d3a00723a` (29/10 07:00 UTC). Nessuno è di oggi: ne serve uno nuovo prima di scrivere.
