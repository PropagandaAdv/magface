# Report header tagliato – magface.it
18/11/2026 · Per Giovanni · Nulla inviato al cliente.
**[V]** verificato · **[D]** dedotto. Dettaglio delle prove: `diagnosi-header.md`.

## 1. Sintesi
- **Causa (verificata):** WP Rocket aggiunge `defer` a `jquery.min.js`; così gli handler di Elementor Pro non si inizializzano e lo sticky dell'header non parte. L'header resta spostato di −85 px e non segue lo scroll. **Lo stesso difetto spegne anche il menu mobile** (0/8 caricamenti col menu funzionante). Senza le ottimizzazioni di WP Rocket 8/8 funziona; togliendo il `defer` solo a jQuery 5/5–6/6 funziona.
- **Soluzione di fondo (richiede wp-admin, non l'ho potuta applicare):** in WP Rocket › Ottimizzazione file › «Carica JavaScript in modalità differita» escludere `/wp-includes/js/jquery/jquery.min.js`, poi svuotare la cache. Dimostrata in locale con 100% di riuscite su 3 pagine/viewport.
- **Correzione di sicurezza preparata e tollerata dal layout:** CSS che porta l'header in alto dal primo disegno anche se lo sticky JS non parte (non risolve il menu mobile). Salvata nel CSS personalizzato del template header, **ma non ancora attiva**: il connettore non riesce a far rigenerare il CSS del template. Si attiva con un clic: Elementor › Strumenti › Rigenera CSS e dati (poi svuotare la cache WP Rocket).
- **Stato del sito oggi: invariato per i visitatori** (verificato: `post-22.css` non contiene le nuove regole).

## 2. Modifica eseguita (non ancora visibile)
| Dove | Cosa | Perché | Come annullarla |
|---|---|---|---|
| Template header ID 22, meta `_elementor_page_settings` › `custom_css` | Aggiunto in coda un blocco CSS (file `header/fix-header.css`): `location` sticky, `top:85px` relativo ai due contenitori quando non sono `elementor-sticky`, `z-index` 999999 sotto 1365 px, compensazione barra admin. **Nessun margine −85 toccato.** Ho anche sostituito il selettore preesistente `.elementor-location-header > .elementor-element` con `.elementor-location-header .custom-scroll-header, … .magface-mobile-header`, perché il connettore trasforma `>` in `&gt;` e avrebbe reso il selettore non valido. I figli diretti della location sono solo quei due contenitori (outline verificato). | La posizione non deve dipendere da JavaScript | Due token in sequenza: `ccbe0b3cdcd56016bd82cb4d801da826` (torna alla versione intermedia) e poi `624f6fc0c0010f98afce4686e392ccc9` (torna al CSS originale). Oppure cancellare dal CSS personalizzato il blocco «Header: posizione corretta…» e rimettere `>` nel selettore. |
| Template 22, dati | Widget di prova aggiunti e **rimossi** con undo (3 volte) per tentare la rigenerazione del CSS; i dati sono tornati identici (outline verificato: 2 contenitori, stessi widget). | Tentativo di far rigenerare il CSS; non ha funzionato | Già annullati. Il widget di prova (testo) è stato visibile sul sito per pochi secondi. |

Backup di riferimento: UpdraftPlus **`b6474222af69`** (18/11/2026, completato **[V]**; il tool è andato in timeout ma il backup è partito). Il backup `60b7e05416f9` del 17/11 precede il lavoro sulla home.

## 3. Collaudo della correzione CSS (solo in locale, iniettando il CSS nel browser; il sito non è stato modificato)
Posizione di partenza dei contenuti (`prima` → `dopo`) e header a scroll 600–700 px, per 10 larghezze:

| Larghezza | Pagina | Contenuti iniziano a (prima→dopo) | Header a scroll (prima→dopo) | Esito |
|---|---|---|---|---|
| 1920 | home | 54 → 54 | −785 → 0 | OK |
| 1366 | home | 28 → 28 | −785 → 0 | OK |
| 1365 | Tecnologia | 28 → 28 | −785 → 0 | OK |
| 1280 | home | 24 → 24 | −785 → 0 | OK |
| 1024 | Tecnologia | 0 → 0 | −785 → 0 | OK |
| 820 | home | 0 → 0 | −785 → 0 | OK |
| 768 | Contatti | 0 → 0 | −785 → 0 | OK |
| 767 | home | 79 → 79 | −785 → 0 | OK |
| 414 | Tecnologia | 34 → 34 | −785 → 0 | OK |
| 360 | home | −8 → −8 | −785 → 0 | OK |

Inoltre a 1920 e 1024 (4 pagine: home, Tecnologia, Contatti, un articolo): stessa posizione dei contenuti, nessuno scroll orizzontale, `.scrolled` si attiva allo scroll e si disattiva tornando in cima **[V]**. Nei casi in cui lo sticky JS parte lo stato è quello originale **[V]**.

**Non verificato:** menu mobile aperto dopo la correzione CSS (il toggle non funziona nei caricamenti falliti, quindi il CSS da solo non lo ripara); tendina «Ecosistema» desktop sopra la hero; utente loggato con barra admin; Weglot con scelta della lingua; transizione quando lo sticky JS parte in ritardo (nessun salto atteso: gli stati coincidono). Per questo la soluzione di fondo (esclusione di jQuery) è preferibile e rende il CSS superfluo; si possono tenere entrambi.

## 4. Prima / dopo (screenshot)
- Prima: `header/prima/a-anonimo-1920.png` (header tagliato), `header/mob-senza.png`, `header/menu-375-senza.png`.
- Dopo (CSS iniettato in locale): `header/dopo-css-1920-cima.png` (corrisponde a «Cattura1»: barra nera di 139 px, logo bianco, menu centrato, «IT ∨»), `header/dopo-css-1920.png` (dopo scroll: bianco con logo scuro), `header/menu-375-con.png`.
- Verifica del test su prova viva: `header/prima/test-matrice.txt`, `test-matrice2.txt`.

## 5. Richiesta di permesso finale
1. **Modifica WP Rocket (wp-admin):** escludere `/wp-includes/js/jquery/jquery.min.js` da «Carica JavaScript in modalità differita». Beneficio atteso (dimostrato in locale): header corretto e **menu mobile funzionante** nel 100% dei caricamenti provati. Rischio: basso; svuotare la cache e rimisurare PageSpeed (jQuery sincrono può costare qualche punto sul mobile). Alternativa: solo il CSS (non ripara il menu).
2. **Rigenerare i CSS di Elementor** (Strumenti › Rigenera CSS e dati) per attivare la correzione CSS già salvata. Beneficio: header sempre corretto anche senza il punto 1. Rischio: basso (collaudata su 10 larghezze).
3. **Aggiornamento di WP Rocket** (3.9.4 del 2021): non è provato che il difetto sia noto della versione; **[D]** potrebbe rientrare tra i fix recenti. Rischio: medio, richiede verifica della licenza.
4. **Verifica con un browser reale** (finestra anonima, utente loggato, Weglot): non eseguita da me.

**Posso procedere con i punti 1–4? Rispondi con i numeri che approvi.**

---

## 6. Aggiornamento 18/11/2026 – punti 1–4 approvati, esito
L'approvazione non mi dà accesso a wp-admin; il connettore non può eseguire i punti. Dati verificati:
- `wp_rocket_settings` è leggibile e `exclude_defer_js` è **vuoto** (`defer_all_js: 1`, `delay_js: 0`, versione 3.9.4).
- Scrittura via connettore **bloccata**: «Option writes are disabled» (toggle «Allow AI to write WordPress options» spento). **Non va comunque usata** per questa opzione: l'aggiornamento è una sovrascrittura completa e la lettura oscura `consumer_key`, `secret_key`, `minify_css_key`, `minify_js_key`; riscriverla corromperebbe licenza e chiavi.
- Licenza WP Rocket: l'email del licenziatario è `subs@tinderpoint.com` (non MagFace né Propaganda ADV) **[V]**. Da chiarire prima di aggiornare.

### Passaggi manuali (≈5 minuti, nell'ordine)
1. **WP Rocket › Ottimizzazione file › JavaScript › «Carica JavaScript in modalità differita» › «File JavaScript esclusi»:** aggiungere `/wp-includes/js/jquery/jquery.min.js` → Salva.
2. **Elementor › Strumenti › Rigenera CSS e dati** (attiva anche il CSS di sicurezza già salvato nel template 22).
3. **WP Rocket › Svuota cache.**
4. **Aggiornamento di WP Rocket (3.9.4):** solo dopo aver chiarito la licenza; facoltativo, non è provato che serva. Fare prima un backup (ultimo: `b6474222af69`).
5. **Verifica con browser reale:** finestra anonima su `/`, `/en/`, `/de/` a 1920 e 375 px: header intero al primo caricamento, menu mobile che si apre, scroll bianco e ritorno nero; poi da loggato (barra admin sopra l'header).

Quando i passi 1–3 sono fatti, ripeto io le prove automatiche (sticky e menu su 8 caricamenti, matrice di 10 larghezze) e rimisuro PageSpeed per quantificare l'eventuale costo sul mobile.

---

## 7. Esito dopo i passi 1–3 (verificato sul sito live il 18/11/2026)
Eseguiti da te: esclusione di `jquery.min.js` dal `defer`, rigenerazione CSS Elementor, svuotamento cache.

**Controlli sull'HTML servito** **[V]**
- `jquery.min.js` non ha più `defer` (gli altri 20 script sì); pagina in cache ricostruita (`Debug: cached@…`).
- `post-22.css` rigenerato: contiene le regole nuove (`top:85px`, `z-index` 999999 sotto 1365 px, selettore sostituito) e **nessun `&gt;`**.

**Affidabilità dell'inizializzazione, URL pulito, browser pulito** **[V]**
| Prova | Prima | Dopo |
|---|---|---|
| Mobile 375, `/tecnologia/`: sticky JS + menu che si apre | 0/8 + 0/8 | **8/8 + 8/8** |
| Desktop 1920, `/`: sticky JS e header a 0 px | 0/10 circa | **6/6** |
| Desktop 1366, `/en/` | 0/5 | **5/5** |
| Desktop 1920, `/de/` | – | **4/4** |

**Matrice su 10 larghezze** (`header/prima/test-live-matrice.txt`) **[V]**: header a 0 px sia al caricamento sia dopo scroll di 700 px; contenuti che iniziano esattamente dove prima (54, 28, 28, 24, 0, 0, 0, 79, 34, −8 px per 1920 … 360); su desktop effetto allo scroll corretto (bianco, poi di nuovo nero in cima); nessuno scroll orizzontale.

**Menu e tendine** (screenshot `header/live-menu-375.png`, `live-menu-1024.png`, `live-ecosistema-click-1920.png`) **[V]**: il menu mobile si apre su 375 e 1024 px (barra nera, tendina bianca, voci centrate, voce corrente evidenziata, selettore lingua); la tendina «Ecosistema» su desktop si apre **al clic** (non al passaggio del mouse, solo sottolineatura) sopra la hero con 5 voci. Il test automatico "coperto" sul menu mobile era un falso allarme (leggeva un contenitore nascosto), smentito dagli screenshot.

**Prestazioni (Lighthouse locale 12.8.2, home IT, URL pulito)** **[V]** – effetto collaterale positivo, perché Elementor ora si inizializza subito e lo slideshow della hero parte prima:
| | Prima (17/11, dopo CSS hero) | Dopo (jQuery non deferito) |
|---|---|---|
| Mobile punteggio / LCP / TBT / Speed Index | 40 / 15,8 s / 960 ms / 8,3 s | **67 / 3,9 s / 460 ms / 4,5 s** |
| Desktop punteggio / LCP / TBT / Speed Index | 68 / 4,0 s / 90 ms / 5,5 s | **87 / 1,4 s / 20 ms / 2,1 s** |
Obiettivo dell'azione 12: LCP mobile < 4 s **raggiunto (3,9 s)**; punteggio mobile > 70 **non ancora (67)**. La rete di test è variabile: valori indicativi, da rimisurare con PageSpeed Insights. File: `header/lighthouse/`.

### Cosa resta aperto
- Punto 4 (aggiornamento WP Rocket) **non eseguito**: non necessario per questo difetto; la licenza è intestata a `subs@tinderpoint.com`.
- **Verifica con browser reale** non fatta da me: utente loggato (barra admin sopra l'header), Weglot con scelta della lingua dal selettore, Safari/iOS. Il CSS di sicurezza è ora attivo, ma non è stato provato con la barra admin.
- Il CSS di sicurezza e l'esclusione di jQuery sono entrambi attivi: se in futuro si toglie l'esclusione, il CSS mantiene l'header al suo posto ma il menu mobile si romperebbe di nuovo.
