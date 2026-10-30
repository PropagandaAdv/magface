# Azioni manuali residue – News multilingua, categorie, SEO

Ordine consigliato: **1 → 2 → 3** vanno fatti in sequenza (la barra di link nella News porta alle categorie, che devono prima avere il template). Il resto è indipendente.
Backup di riferimento prima di toccare qualunque cosa: UpdraftPlus **`e0a34b080fc9`** (30/10/2026).

## Aggiornamento 30/10/2026 (sera) – stato dopo i passaggi eseguiti dal cliente

Verificato sul sito live:
- **Fatto:** Archivio 1665 attivo con condizione **Archivi → Categorie** (solo categorie; `/tag/…` è tornato al layout precedente). Header 22 esteso con **Includi → Archivi → Categorie** (oltre a *Singolare*): header presente su categorie e home in tutte le 5 lingue.
- **Fatto:** Filtro tassonomia sostituito nella News con la barra di link (widget *Template* → "Barra categorie News (link)", ID 1664). Link tradotti correttamente in EN/ES/FR/DE.
- **Fatto:** CSS dello stato attivo con `!important` incollato nell'Archivio: il pulsante della categoria corrente è nero in IT/EN/FR/DE/ES.
- **Ancora da fare:** incollare lo **stesso CSS con `!important` nel template 1664** (Barra categorie News): senza, su `/news/` il pulsante "Tutti" non risulta nero (verificato). Il CSS è oggi solo nell'Archivio.
- I punti **1 e 2** qui sotto sono quindi chiusi (tranne il CSS nel template 1664). Restano i punti 3–7 (redirect, AIOSEO, Weglot, Search Console, altro).

## 1. Attivare il template "Archivio categorie News" (Theme Builder)

Perché a mano: ho creato il template (ID **1665**) e impostato la condizione, ma la cache delle condizioni di Elementor Pro non si aggiorna se non si salva dall'editor, quindi non si attivava (verificato). Ho riportato la condizione a vuoto per non farlo andare live senza che sia stato visto.

1. Apri `https://www.magface.it/wp-admin/post.php?post=1665&action=elementor`.
2. Controlla l'aspetto (hero nero con titolo categoria + descrizione, barra di link, griglia a 4 colonne con template loop 889, paginazione numerica). **Non l'ho potuto vedere renderizzato** (l'anteprima via token non supporta i template): ritoccare dimensioni/spaziature se serve.
3. In basso a sinistra: freccia accanto a **Pubblica / Aggiorna → Condizioni di visualizzazione → Aggiungi condizione → Includi → Archivi → Categorie** (tutte). Salva.
4. Verifica: `/category/stampa/`, `/fr/categorie/presse/` (titolo, barra con "Stampa" attivo in nero, 10 articoli per pagina).
5. Poi svuota la cache: WP Rocket → *Svuota cache*; Elementor → Strumenti → *Rigenera CSS e dati*.

Annullare: eliminare il template 1665 (o togliere la condizione); il sito torna al fallback del tema.

## 2. Sostituire il filtro nella pagina News (ID 864)

Solo dopo il punto 1. Elementor → pagina **News** → elimina il widget *Filtro tassonomia* (`e5119e7`) e al suo posto aggiungi il widget **Modello** → scegli **"Barra categorie News (link)"** (ID 1664) → Aggiorna. Il Loop Grid `7dfa4d3` resta senza filtro. Alternativa equivalente: struttura già pronta in `elementor/page-864-after.json` (copia di `_elementor_data` con quel solo cambio).
Copia originale per tornare indietro: `backups/elementor-864-20261030-090903.json` (e la cronologia revisioni di Elementor).
Verifica nelle 5 lingue: i pulsanti portano a `/category/<slug>/` tradotto (Weglot riscrive i link), "Tutti" porta alla News.

## 3. Redirect 301 dei vecchi URL `?e-filter-7dfa4d3-category=…`

Il plugin **Redirection non è installato** (e non ho accesso a `.htaccess`). Usa **Code Snippets** (attivo): nuovo snippet PHP, esegui "ovunque", incolla `snippets/redirect-e-filter.php`, attiva.
Collaudato in locale (stub WordPress) su 9 casi reali: IT slug, FR `recherche+et+innovation`, DE `Forschung und Innovation`, ES con accenti, valori "tutti" tradotti e valore ignoto → categoria della stessa lingua o News della stessa lingua, **un solo salto**. Non testato sul sito live (non l'ho attivato). Dopo l'attivazione prova:
`/fr/nouvelles/?e-filter-7dfa4d3-category=recherche+et+innovation` → `/fr/categorie/recherche-et-innovation/`.

## 4. All in One SEO

Dal pannello AIOSEO (le opzioni AIOSEO non sono scrivibili da qui: "Allow AI to write WordPress options" è disattivo in Royal MCP; potete attivarlo se volete che le faccia io, ma toccherebbero tutte le opzioni del plugin).

- **Paginazione indicizzabile**: Search Appearance → Advanced → *Global Robots Meta*: disattiva **Noindex Paginated Pages** e **Nofollow Paginated Pages** (oggi `/category/stampa/page/2/` esce `noindex, nofollow`, verificato).
- **Titolo per ogni categoria** (non scrivibile da qui): Articoli → Categorie → modifica → riquadro *AIOSEO Settings*: titolo da `meta-traduzioni.md`. La descrizione l'ho già applicata (campo Descrizione della categoria).
- **Pagina News (864)**: nel riquadro AIOSEO della pagina inserisci titolo e description da `meta-traduzioni.md`. Oggi il meta è l'elenco dei filtri. Il campo che ho provato a scrivere dal connettore non è quello letto da AIOSEO 5 (nessun effetto in HTML, scrittura annullata).
- **Dominio provvisorio** (verificato nelle opzioni AIOSEO): sostituisci `https://plump-nickel-porpoise.15-235-62-182.cpanel.site/wp-content/uploads/2026/03/0fce4a581ef51004c726397632d8008af35bfa82.jpg` con `https://www.magface.it/wp-content/uploads/2026/03/0fce4a581ef51004c726397632d8008af35bfa82.jpg` (il file **esiste** su magface.it, HTTP 200) in: Social Networks → Facebook → *Default Post Image*; Social Networks → Twitter → *Default Post Image*; Search Appearance → Global Settings → Knowledge Graph → *Organization Logo* (`…/cropped-0fce4a58….jpg`, esiste anch'esso). Il profilo Search Console collegato ad AIOSEO (Search Statistics) punta ancora al dominio provvisorio: ricollegarlo alla proprietà `www.magface.it`.
- **Sitemap**: le 9 categorie con articoli ci sono già e non ci sono URL con parametri (verificato). Da sistemare: Sitemaps → Post Types: togli **Angie Snippet** (`angie_snippet-sitemap.xml`) e valuta Allegati e Tag (`post_tag-sitemap.xml`); le categorie hanno `lastmod` 1970-01-01.

## 5. Weglot (pannello esterno)

- Correggi: *Stampa* (categoria) DE "Drücken" → **"Presse"**; *Tutti* EN "Everyone" → **"All"**, FR "Tout le monde" → **"Tous"**.
- Inserisci/verifica le meta description tradotte (tabella in `meta-traduzioni.md`): quelle automatiche delle categorie differiscono dalle proposte.
- **x-default**: Weglot emette hreflang it/en/es/fr/de ma **non `x-default`** (verificato su home, News, categorie). Verificare nelle impostazioni Weglot se esiste l'opzione; altrimenti chiedere al supporto Weglot (non ho trovato un controllo certo da qui).
- Dopo lo switch alla barra di link, i nomi categoria nei pulsanti sono tradotti normalmente: nessuna regola speciale.

## 6. Google Search Console

Per `https://www.magface.it` (proprietà di dominio o prefisso, una verifica per ciascun URL localizzato): ispezione URL + **Richiedi indicizzazione** per News e per le 9 categorie in IT, EN, ES, FR, DE (`/en/…`, `/es/…`, `/fr/…`, `/de/…`); poi controllare *Pagine → Duplicata/Canonical* sui vecchi URL `?e-filter-…`. Rinviare `sitemap.xml`.

## 7. Altro emerso

- **UpdraftPlus**: retention impostata a 2 set (file e DB); i backup nuovi possono far eliminare `241d3a00723a` (29/10). Se vi serve, scaricate prima o alzate la retention. Ho creato **due** backup identici (`e0a34b080fc9`, `5eee748abd2c`): il secondo è un duplicato da retry dopo un timeout del tool.
- **Elementor 4.3.5 vs Elementor Pro 4.3.2**: versioni non allineate; controllare gli aggiornamenti di Pro.
- **WP Rocket / Asset CleanUp**: nessuna modifica fatta, nessuna era la causa. Ricordare comunque *Svuota cache* dopo ogni passaggio sopra.
