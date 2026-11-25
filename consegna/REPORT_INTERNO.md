# Report interno – magface.it · Piano d'azione SEO/GEO + Weglot Rev. 02
Data: 09/11/2026 · Per: Giovanni · **Nulla è stato inviato al cliente.**

## 0. In una riga
Fatte in sicurezza solo le correzioni di testo italiano e la riga statica dei contatori. Il resto è **bloccato da limiti degli strumenti** (nessun browser autenticato per Weglot/wp-admin; il connettore non scrive le impostazioni AIOSEO né i settaggi dei widget). Per ogni blocco ho preparato il materiale pronto. Elenco permessi in fondo (§6).

**Stato: verificato** = letto/visto sul sito; **dedotto** = ipotesi.

## 1. Backup e ripristino
| Cosa | ID | Note |
|---|---|---|
| UpdraftPlus completo (db, plugin, temi, uploads, altri) | **`aaf7b17584c3`** | 09/11/2026 ~17:37, stato *completed* (verificato) |
| UpdraftPlus duplicato | `e8004d7f0631` | creato dal mio secondo tentativo dopo un timeout del tool; **stato non verificato** |

Undo token (validi 72 h, fino al 12/11/2026 ~16:50 UTC), uno per modifica:
| Modifica | Post | Token |
|---|---|---|
| autoestingenza → autoestinguenza | 161 | `0fe2ce98a505fbfabdefea3641f766f8` |
| Mag Face → MagFace® (footer) | 33 | `1b840754a9ce45dae3fe5535c40c1729` |
| PURPOSE & AMBITION → Visione e obiettivi | 262 | `ef5250cf207d97bd0a62a811fff3eaa3` |
| CEO & Inventor of MagFace® → CEO e inventore di MagFace® | 262 | `6e8636841bb6e319e7bbe4ca48774521` |
| superfici magnetiche ready-to-use → pronte all'uso | 257 | `e1c9b1108760e76c186308e954050de1` |
| prodotti premium ready-to-use → pronti all'uso | 257 | `f0c7f9a2a69e5faf9fc78085d9113ad3` |
| Riga statica contatori (widget 7ac1a774) | 200 | `4dd6a64fd44a0f0ae0f7d676a946b996` |

Prova su Contatti (title/description AIOSEO) **annullata** (token usato). Nessun residuo.

## 2. Stato per azione
| # | Stato | Evidenza / motivo |
|---|---|---|
| 1 Dominio staging | **Bloccata** | `aioseo_options` non scrivibile dal connettore (non in allowlist di scrittura). `cpanel.site` compare **4 volte per pagina** (verificato su 18 pagine). Da fare in AIOSEO › Social e Knowledge Graph. |
| 2 Sitemap pulita | **Bloccata** | Impostazioni sitemap AIOSEO non scrivibili. Noindex per pagina: vedi azione 4. Snippet pronto (blocco B), usa solo filtri verificati nel codice AIOSEO 5.0.4 (`aioseo_robots_meta`, `aioseo_sitemap_posts`). |
| 3 Un H1 | **Bloccata** | Stato prima: **0 H1 in tutte le 18 pagine** (verificato). Scrivere `_elementor_data` dal connettore: il tool passa una stringa (rischio perdita dei backslash JSON, avvertito dal tool stesso) e richiede di rimandare l'intero JSON; rischio alto su sito live. Pronto snippet (blocco E, **non testato**) oppure modifica a mano nell'editor. |
| 4 Title/description IT | **Bloccata** | **Verificato:** il connettore scrive nel post meta `_aioseo_title`, ma AIOSEO 5 legge dalla tabella `aioseo_posts`: dopo la scrittura su Contatti il front-end (URL senza cache, `Cache-Control: no-store`) è rimasto invariato. Annullata. Alternative: inserimento manuale (14 pagine) oppure snippet (blocco A, filtri `aioseo_title`/`aioseo_description`). |
| 5 Weglot config | **Bloccata** | Nessun browser autenticato, `dashboard.weglot.com` risponde 403 da questa sessione. Pronto: `lavoro/glossario_rev02.csv`; prompt AI da incollare = REV02 sez. 3. |
| 6 Testi IT | **Parziale** | Fatti: IT-1, IT-3, IT-4 (vedi §3). **Non fatto:** IT-2 (il refuso «superfice» sta nel titolo del contatore «superfice ristrutturata», widget 4fdd3c6 della pagina 200: `elementor_replace_text` non copre il campo; da correggere nell'editor), IT-5 opzione F (Weglot), IT-6 (con azione 4). |
| 7 Correzioni traduzioni | **Bloccata** | Weglot. Elenco righe in `lavoro/correzioni_rev02.json`. |
| 8 Title/desc EN/FR/DE/ES | **Bloccata** | Weglot + azione 4. Testi in `lavoro/titles_descriptions.json` (tutti i conteggi caratteri dell'AUDIT **coincidono** con quelli reali; 0 anomalie di spazi). |
| 9 Home mobile | **Bloccata (pronta)** | Sovrapposizione **verificata a vista** a 375×812 in IT e DE (`consegna/screenshots/home-mobile-{it,de}-prima.png`). Correzione solo mobile pronta ma non applicabile: «Allow AI to modify theme appearance» è spento in Royal MCP › Settings. CSS da aggiungere in Aspetto › CSS aggiuntivo (widget titolo = `1f07eb1` della pagina 137): `@media (max-width:767px){.elementor-137 .elementor-element-1f07eb1 .elementor-heading-title{line-height:1.2}.elementor-137 .elementor-element-1f07eb1{margin-bottom:28px}}` (da verificare a vista dopo l'inserimento). |
| 10 Link «#» footer | **Non fatta** | Il connettore non modifica i link dei widget. Footer = template 33: «Iscriviti» e «Italy» sono widget *button*. «Ecosistema» non compare nell'outline del footer (può stare nel menu header 22: **da verificare**) e va deciso da MagFace. |
| 11 Contatori Concept House | **Fatta** | Riga aggiunta e verificata nel sorgente («110 m²» e «Anno di realizzazione: 2018» presenti). Valori letti dai widget: 2018 · 110 **mq** · 24 ore · 0 (uso «m²», coerente con title/description dell'AUDIT). |
| 12 Velocità | **Bloccata** | WP Rocket/Asset CleanUp/Elementor Features non scrivibili dal connettore. «Prima» misurato in locale con Lighthouse 12.8.2 (home, **non confrontabile con PSI dell'AUDIT**: 47/71): mobile **40**, LCP 19,2 s, FCP 3,5 s, TBT 860 ms, CLS 0; desktop **64**, LCP 5,2 s, TBT 60 ms (`consegna/pagespeed/`). Nessuna ottimizzazione applicata, quindi nessun «dopo». |
| 13 Alt immagini | **Non fatta** | Richiede di guardare ogni immagine (112 in libreria: 36 JPEG, 66 PNG, 10 SVG da AUDIT). Non invento descrizioni. |
| 14 Organization | **Bloccata** | Code Snippets non raggiungibile. Filtro verificato: `aioseo_schema_output` (riceve `@graph`). Snippet pronto (blocco C), valori da Appendice A. |
| 15 x-default | **Bloccata** | **Correzione di premessa (verificata nel codice Weglot 6.4.3):** x-default oggi **non viene generato affatto** (`generate_href_lang_tags()` emette solo gli alternate); non va "cambiato" ma **aggiunto**. Filtro `weglot_href_lang`. Snippet pronto (blocco D). Confermato anche sul sito: nessun `hreflang="x-default"` nelle 18 pagine. |
| 16 Video per lingua | **In attesa MF** | File EN/ES e trascrizioni. |
| 17 Affermazioni con prova | **Non fatta** | Da fare con MagFace sui documenti (75 PDF in libreria da AUDIT/prompt). Segnalato: report tecnico 2018 e video «YTDown_YouTube…». |
| 18 llms.txt / ai-catalog | **Bozza** | `lavoro/llms.txt.bozza`, `lavoro/ai-catalog.json.bozza`. Solo dati dei due documenti, «since 2002», nessuna percentuale. Non pubblicato. |
| 19 Casi studio | **In attesa MF** | PDF. |
| 20 News per lingua | **Parziale** | Individuati 4 articoli con titolo non italiano: **1468** (DE, «Fliesen & Platten…»), **1445**, **1461**, **820** (ES). Nessuno spostato/cancellato. Schema Article: AIOSEO ha tipo Article/BlogPosting predefinito per i post (da opzioni, verificato), **non verificato nel sorgente di un articolo**. Titoli H4 → H2/H3: non fatto. |
| 21 Francia | **Bozza** | `lavoro/comunicato-fr.bozza.md`. |
| 22 Search Console | **Non fatta** | A lavori finiti. Dato AIOSEO: proprietà collegata `plump-nickel-porpoise…cpanel.site`, sitemap inviate su www.magface.it con 81 URL e 0 indicizzati (ultimo fetch 3/11). |
| 23 Consegna | **Parziale** | Registro compilato: `consegna/Audit_SEO_e_GEO_magface.it_06112026_rev1_compilato.docx` (solo celle Fatto/Data/Note; l'originale è intatto). |

## 3. Testi italiani scritti da noi (da far vedere al cliente – IT-4)
- «PURPOSE & AMBITION» → «Visione e obiettivi» (esempio indicato dal cliente) – Chi siamo.
- «CEO & Inventor of MagFace®» → «CEO e inventore di MagFace®» – Chi siamo (coerente con jobTitle dell'Appendice A).
- «superfici magnetiche ready-to-use» → «superfici magnetiche pronte all'uso»; «prodotti premium ready-to-use» → «prodotti premium pronti all'uso» – Partner tecnici.
- Altri testi inglesi nelle pagine IT **non toccati** (non nell'elenco IT-4): «Original MagFace®» (Chi siamo), «Patented Technology. Registered Trademark.» e «Italy» (footer/contatti), «News & Eventi».
- **Nota:** dopo queste modifiche, Weglot ritradurrà le frasi cambiate: le versioni EN/FR/DE/ES di quei punti vanno rivedute nella lista traduzioni.

## 4. DA CONFERMARE da Andrea Bassi (pronte da incollare in email)
1. **DE-3 «Überdachung»:** in quale frase italiana compare? Se significa «sovrapposizione/copertura» la correzione è «Überdeckung»; se è davvero una tettoia va lasciato.
2. **DE-5 footer:** le voci italiane sono **«Azienda»** e **«Utility»** (verificato nel template footer 33). Proposta DE: «Unternehmen» e «Service» (oppure «Nützliche Links»). Confermate?
3. **DE-1 / ES-3:** la frase italiana di origine è «La prima posa magnetica a secco brevettata a livello internazionale»? (non verificata: va cercata nella lista traduzioni Weglot). Se diversa, adattiamo la traduzione.
4. **«Fino al 70%»** (description Prestazioni e vantaggi, 5 lingue): confermate la percentuale? Segnalo che nei documenti compaiono anche «5 volte» e «60–80%».
5. **Footer «Ecosistema»:** a quale pagina deve puntare?
6. **llms.txt e ai-catalog.json:** approvate le bozze (`lavoro/`)? Nel llms.txt cito 2018/110 m²/24 ore dalla Concept House.
7. **Dati strutturati:** aggiungiamo brevetto internazionale 2015 e certificazioni (ASTM C627-10, EN 13501-1, UL 94) allo schema?
8. **Affermazioni «primo e unico al mondo», «sicuro per portatori di pacemaker», «certificato»:** quali documenti le provano?
9. **Testi IT-4** di cui sopra (e altri testi inglesi in IT: «Original MagFace®», «Patented Technology. Registered Trademark.»).
10. **Articoli News in ES/DE (1468, 1445, 1461, 820):** li escludiamo dalla traduzione o li pubblichiamo nella sezione della lingua giusta?
11. **Materiali da ricevere:** video Concept House EN/ES + trascrizioni (100–200 parole per lingua), PDF casi studio, comunicato FR approvato.
12. **Terminologia EN:** la REV02 dice «porcelain tile» nel glossario (5.2) ma elenca «porcelain stoneware» tra le rese da usare (5.3), mentre l'AUDIT dice «porcelain tile / porcelain slab». Quale vale?

## 5. Discrepanze AUDIT/REV02 ↔ sito reale
- **x-default:** l'AUDIT dice «manca» (corretto), ma l'azione 15 parla di «puntare» x-default alla EN: oggi non esiste proprio.
- **Description Tecnologia (ID 181):** già diversa da quella citata nell'AUDIT (401 car. nell'HTML), va comunque sostituita.
- **«superfice»:** sta nel titolo di un contatore, non in un testo normale.
- **«Mag Face»:** è un solo punto, il titolo newsletter nel footer (template 33), non «tutte le pagine» come singoli testi; in HTML compare in tutte perché il footer è condiviso.
- **twitter:card tradotto** (verificato): DE «Zusammenfassung (großes Bild)», FR «résumé_grande_image», ES «resumen_imagen_grande».
- **Twitter card nella home AIOSEO:** `cardType: summary` per la home, `summary_large_image` default altrove.
- **Plugin WebP:** nel cron compaiono hook `wpo_*` (residui di WP-Optimize) ma il plugin **non è installato** (elenco plugin verificato). Quindi nessuna conversione WebP attiva.
- **Pagine non coperte dall'AUDIT:** Approfondimenti (1537), La nostra storia (1531), Livelli (412), Proponi una collaborazione (1533), Academy Cersaie 2026 (1401).
- **Sicurezza:** la lettura delle impostazioni AIOSEO tramite `wp_get_plugin_settings` ha restituito in chiaro alcuni token AIOSEO (`aioseo_sensitive_options`); sono comparsi nel log di questa sessione. Non li ho usati; valutare la rigenerazione dei token AIOSEO.
- **Connettore:** il backup ha dato timeout a 60 s pur partendo (il trigger è asincrono).

## 6. Richiesta di permesso (una sola volta)
**Aggiornamento 10/11:** hai approvato tutto; l'approvazione non mi dà accessi che non ho. Esito: punto 9 (misura Lighthouse locale) e 10 (screenshot) eseguiti. Commit/push **ancora negati** dal classificatore (serve una regola di permesso Bash nelle impostazioni). Punti 1–8: mancano ancora l'accesso a Weglot/wp-admin e l'installazione plugin non è possibile dagli strumenti che ho. In più: attivare «Allow AI to modify theme appearance» (Royal MCP › Settings) sblocca l'azione 9.

1. **Accesso browser autenticato (o credenziali a un browser già loggato) a Weglot Dashboard e wp-admin** – sblocca azioni 1, 2, 4, 5, 6 (IT-2, IT-5), 7, 8, 10, 14, 15, 22. Alternativa: lo fai tu con i materiali pronti. Rischio: modifiche in produzione con backup `aaf7b17584c3`.
2. **Via libera a incollare lo snippet `snippets/magface-seo-pack.php` in Code Snippets** (blocchi A–E, attivabili uno a uno; solo front-end) – sblocca 2, 3, 4, 14, 15 senza toccare l'editor. Rischio: errore PHP → disattivabile da wp-admin; blocco E (H1) non testato.
3. **Plugin Redirection (gratuito) o AIOSEO Pro** – serve per DE-4 e DE-8 (slug tedeschi) se Weglot non crea il 301. Alternativa: non cambiare gli slug.
4. **Conversione immagini WebP/AVIF** (es. Imagify o Converter for Media) – azione 12. Rischio: carico su server durante la conversione.
5. **WP Rocket 3.9.4 (del 2021):** verifica licenza ed eventuale aggiornamento se le funzioni richieste non sono disponibili.
6. **Accesso file server (SFTP/cPanel)** o via libera allo snippet per `llms.txt` e `/.well-known/ai-catalog.json` (dopo approvazione MF).
7. **Piano Weglot:** verificare che includa traduzione dei media e prompt AI; eventuale richiesta al supporto per x-default se lo snippet non basta.
8. **Search Console:** allineare il collegamento AIOSEO da `cpanel.site` a www.magface.it.
9. **Chiave API PageSpeed** (o permesso di usare Lighthouse in locale) per misurare prima/dopo; la chiamata pubblica dà 429.
10. **Ok a rilanciare gli screenshot 375×812** della home (IT e DE) con il browser locale: la chiamata precedente è stata interrotta e non l'ho riprovata.

**Posso procedere con i punti 1–10? Rispondi con i numeri che approvi.**

## 7. File prodotti
- `lavoro/` titles_descriptions.json, correzioni_rev02.json, glossario_rev02.csv, piano_azione.json, prima.json (fotografia «prima»: title, description, H1, og:image, cpanel.site, x-default per 18 pagine; gli HTML grezzi restano solo in locale), llms.txt.bozza, ai-catalog.json.bozza, comunicato-fr.bozza.md
- `snippets/magface-seo-pack.php` (sintassi PHP verificata con `php -l`; non attivato)
- `consegna/Audit_SEO_e_GEO_magface.it_06112026_rev1_compilato.docx`, `consegna/REPORT_INTERNO.md`
