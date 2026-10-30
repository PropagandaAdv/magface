# Report intervento – News multilingua, categorie, SEO (MagFace)

Data: 30/10/2026. Sito: www.magface.it (produzione). Strumenti: connettore MCP `Magface_it` (Royal MCP), curl, Playwright. WP-CLI e DB diretto non disponibili.

**Stato in una riga:** la causa è identificata e documentata; sul sito è stato modificato poco (descrizioni categorie + due template inattivi). **Il filtro non è ancora riparato per i visitatori**: servono i passaggi manuali in `azioni-manuali.md` (attivazione Archivio → barra link in News → redirect).

## 1. Backup

| Cosa | ID | Contenuto |
|---|---|---|
| UpdraftPlus (principale) | **`e0a34b080fc9`** | DB, plugin, temi, uploads, altri – 30/10/2026 (completato, verificato) |
| UpdraftPlus (duplicato) | `5eee748abd2c` | identico, creato da un mio retry dopo un timeout del tool |
| Copia locale `_elementor_data` pagina 864 | `backups/elementor-864-20261030-090903.json` (+ `.raw-meta-value.json`) | salvata prima di qualsiasi modifica alla pagina (poi **non modificata**) |

Attenzione: la retention UpdraftPlus è 2 set; il backup del 29/10 (`241d3a00723a`) può venire eliminato.

## 2. Modifiche eseguite sul sito

| # | Cosa | Dove / ID | Prima → dopo | Come annullare |
|---|---|---|---|---|
| 1 | Descrizione categoria (IT) | Termini `category` 7, 18, 17, 24, 25, 23, 20, 19, 21 | `""` → testo 143–158 car. (vedi `meta-traduzioni.md`) | Svuotare "Descrizione" del termine (o `mcp_undo_last_operation` con i token: 7 `e2ff5319…`, 18 `722e8078…`, 17 `02f6f1ca…`, 24 `6ed2c9b6…`, 25 `6d9d6f10…`, 23 `3cff6a76…`, 20 `29bc5d0f…`, 19 `4628508a…`, 21 `2633d89c…`; scadono 02/11 ~09:45 UTC) |
| 2 | Nuovo template sezione "Barra categorie News (link)" | `elementor_library` **1664** (tipo `section`) | non esisteva → 10 pulsanti (Tutti + 9 categorie), link assoluti IT, stile come i pulsanti attuali, stato attivo via classi body | Eliminare il template 1664 (token `71c63344…`) |
| 3 | Nuovo template "Archivio categorie News" | `elementor_library` **1665** (tipo `archive`) | non esisteva → hero + titolo/descrizione dinamici + barra (1664) + Loop Grid template 889, Current Query, 4 col., altezza uguale, paginazione numerica, Inter. **Non attivo**: nessuna condizione | Eliminare il template 1665 (token `81eb5110…`) |

Modifiche provate e **annullate** (nessun residuo): condizione `include/archive/category` su 1665 (impostata, verificata non applicata, riportata a `[]`); salvataggio neutro di 1665; scrittura titolo+description meta del post 864 (nessun effetto in HTML, annullata con undo).

**Non modificato:** pagina News 864, WP Rocket, Asset CleanUp, Weglot, opzioni AIOSEO, permalink, plugin attivi, post/categorie.

## 3. Fasi del prompt – esito

| Fase | Esito |
|---|---|
| 1 Diagnosi | **Completata** – `report-diagnosi.md` |
| 2 Ripristino velocizzazione | **Saltata**: nessuna regola WP Rocket/Asset CleanUp responsabile (verificato) |
| 3.1 Template archivio | **Creato ma non attivo** (cache condizioni Theme Builder non aggiornabile da qui) → manuale |
| 3.2 Pagina News: barra di link | **Non applicata** (porterebbe a categorie non stilizzate). JSON pronto: `elementor/page-864-after.json` |
| 3.3 Redirect 301 | **Non attivi**: Redirection non installato. Snippet pronto e collaudato in locale: `snippets/redirect-e-filter.php` |
| 3.4 Link interni a `e-filter-…` | Nessuno trovato nella ricerca su post_content/pagine; **non controllati i menu, i widget né `_elementor_data` di altre pagine/template** (solo 864 verificata): da fare a mano |
| 3.5 Paginazione | Archivi: `/page/2/` esiste in tutte le lingue ma è `noindex, nofollow` (vedi §4). News `?e-page-7dfa4d3=2`: **non verificata** (risposta con gli stessi elementi della pagina 1) |
| 4 SEO | Descrizioni IT categorie **applicate**; titoli categoria, meta News, robots paginazione, x-default, sitemap Angie/tag → **manuali** |
| 5 Dominio provvisorio | Cercato: **0** occorrenze in post/pagine/media pubblici; presente nelle opzioni AIOSEO e nell'`og:image` della News (e nel JSON-LD). File `og:image` **esiste** su magface.it. Sostituzione → manuale (opzioni non scrivibili) |
| 6 Verifica finale | Eseguita sullo **stato attuale** (vedi §4) |

## 4. Verifica Playwright – stato attuale del sito (30/10/2026)

Per lingua: News, News `?e-page-7dfa4d3=2`, 9 categorie, `/page/2/` di Stampa (12 URL × desktop+mobile). Screenshot in `screenshots/<lingua>/`. Dati grezzi non versionati (`work/`).

| Controllo | IT | EN | ES | FR | DE |
|---|---|---|---|---|---|
| HTTP 200 (12 URL) | 12/12 | 12/12 | 12/12 (Progetti: un 502 transitorio, 200 al ricontrollo) | 12/12 | 12/12 |
| Canonical su se stessa | sì | sì | sì | sì | sì |
| Hreflang it/en/es/fr/de | sì (5) | sì (5) | sì (5) | sì (5) | sì (5) |
| **x-default** | **no** | no | no | no | no |
| Robots categorie e News | `index` (solo max-image-preview) | idem | idem | idem | idem |
| Robots `/page/2/` Stampa | **noindex, nofollow** | idem | idem | idem | idem |
| Meta description News | **ancora l'elenco dei filtri** | idem (tradotto) | idem | idem | idem |
| Meta description categorie | testo nuovo (applicato) | traduzione auto Weglot | idem | idem | idem |
| `<title>` categorie | `Stampa - MagFace` (default, non personalizzato) | default tradotto | idem | idem | idem |
| `og:image` News → dominio provvisorio | **sì (da correggere)** | sì | sì | sì | sì |
| Dominio provvisorio altrove nell'HTML | sì (JSON-LD, tutte le pagine) | sì | sì | sì | sì |
| Errori JS in console | su Stampa, Eventi, Progetti: `__dangerousOptInToUnstableAPIsOnlyForCoreModules is not a function`, `Cannot read properties of undefined (reading 'use')` | idem | idem | idem | idem |
| Filtro categorie nella News | funziona (verificato in Fase 1) | **non funziona** | **non funziona** | **non funziona** | **non funziona** |
| Vecchi URL `?e-filter-…` | 200 (nessun 301 attivo) | idem | idem | idem | idem |

Note di lettura:
- "Testo italiano su pagine non IT": l'euristica (parole italiane comuni) dà 1–2 occorrenze per pagina, probabilmente il banner cookie (Iubenda, italiano); **non verificato a mano**, da controllare.
- Il conteggio "articoli per categoria" non è stato validato oltre: la griglia fallback del tema mostra 10 articoli su Stampa p.1 (13 totali) e 3 sulla p.2.
- Gli errori JS compaiono solo sugli archivi con più articoli, sulle pagine fallback del tema; **non ne ho indagato la causa** (non mi risulta collegata alle modifiche: non ho attivato nulla di nuovo).
- Il sito è ora **nello stesso stato funzionale di prima** per i visitatori, salvo le descrizioni categoria. Questa tabella non certifica il risultato finale: va ripetuta dopo i passaggi manuali.

## 5. Cosa serve per chiudere (vedi `azioni-manuali.md`)
1 attivare Archivio 1665 → 2 barra link in News → 3 snippet redirect → 4 AIOSEO (paginazione, titoli, og:image, sitemap) → 5 Weglot (traduzioni, x-default) → 6 Search Console. Poi ripetere la verifica Playwright.

## 6. Aggiornamento 30/10/2026 – modifiche fatte dal cliente nell'editor (verificate dopo)

| Cosa | Esito verificato |
|---|---|
| Condizione Archivio 1665 → Archivi → Categorie | Attiva su categorie in 5 lingue; `/tag/in-evidenza/` torna al fallback del tema |
| Header 22: aggiunta condizione Archivi → Categorie (Singolare invariato) | Header su categorie e home (5 lingue) |
| Pagina News 864: Filtro tassonomia sostituito dal widget Template (1664) | Barra con 10 link tradotti; filtro assente |
| CSS stato attivo con `!important` (nell'Archivio) | Pulsante categoria corrente nero su IT/EN/FR/DE/ES; **su `/news/` "Tutti" non nero** (CSS ancora da incollare nel template 1664) |

Causa dell'errore iniziale sullo stile attivo: il CSS salvato nella pagina News vale solo lì; l'Archivio carica il proprio CSS e il template 1664 ha il suo file (`post-1664.css`). Lo stile base dei pulsanti Elementor ha specificità maggiore, quindi serve `!important`.
Resta aperta la parte descritta in `azioni-manuali.md` (redirect, AIOSEO, Weglot, Search Console).
