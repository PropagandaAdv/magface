# Report caricamento iniziale – magface.it
17/11/2026 · Per Giovanni · Nulla inviato al cliente · Collegato all'azione 12 (e 9) del piano SEO/GEO.

## 1. Sintesi
- **Causa principale (verificata):** il titolo della hero della home è `elementor-invisible` e compare solo quando parte il JavaScript di Elementor; su mobile il *ritardo di rendering* dell'LCP era 14,6–18,3 s. La seconda causa (verificata) è lo sfondo a slideshow, creato dal JS: l'immagine si richiede solo dopo.
- **Fatto:** una modifica sola, reversibile: due regole CSS nel CSS personalizzato della pagina Home (Elementor) che rendono visibile subito il contenuto della hero e disattivano l'animazione d'ingresso solo nelle slide. Aspetto invariato (screenshot).
- **Effetto misurato:** titolo visibile a ~3,7–4,4 s (prima 8–19 s); Speed Index mobile 14,2 → 8,3 s; LCP mobile 20,8 → 15,8 s; punteggio mobile 38 → 40. **L'obiettivo non è raggiunto**: ora l'LCP è l'immagine dello slideshow (ritardo di caricamento 6,9 s).
- **Effetto collaterale positivo (visto a mano, IT mobile):** la sovrapposizione titolo/sottotitolo dell'azione 9 non compare più nello screenshot (`screenshots/home-mobile-dopo-css.png`). Da riverificare in DE.

## 2. Prima / dopo (Lighthouse locale 12.8.2, home IT; ambiente emulato, non confrontabile con PSI)
| | Mobile prima | Mobile dopo | Desktop prima | Desktop dopo |
|---|---|---|---|---|
| Punteggio | 38 | 40 | 66 | 68 |
| FCP | 3,3 s | 3,3 s | 1,4 s | 1,0 s |
| LCP | 20,8 s | 15,8 s | 4,2 s | 4,0 s |
| TBT | 900 ms | 960 ms | 90 ms | 90 ms |
| CLS | 0 | 0 | 0,001 | 0,002 |
| Speed Index | 14,2 s | 8,3 s | 3,6 s | 5,5 s |
| Richieste / peso | 91 / 3,7 MB | non estratto | 97 / 3,85 MB | non estratto |

Il desktop ha oscillazioni dovute alla rete (SI 3,6 → 5,5 s non è attribuibile alla modifica: TTFB variabile 2,5–11 s). Hero visibile (esperimento Playwright, CPU 4×, Fast 4G): prima 8,0–19,1 s, dopo 3,7–4,4 s.

## 3. Modifica eseguita
| Dove | Cosa | Perché | Misura | Come annullarla |
|---|---|---|---|---|
| Pagina Home (137), meta `_elementor_page_settings` › `custom_css` (CSS personalizzato di pagina Elementor Pro) | Aggiunte 2 regole: `.elementor-137 .hero-slide .elementor-invisible{visibility:visible!important}` e `.elementor-137 .hero-slide .animated{animation:none!important}` | Il titolo non deve attendere il JS | titolo visibile ~4 s invece di 8–19 s | token `71489b04f7df108d4362e303a0a08273` (valido fino al 20/11 ~14:39 UTC) oppure togliere le 2 righe in Elementor › Impostazioni pagina › CSS personalizzato |
| Pagina Home | Salvataggio di Elementor con sostituzione identica («Scopri MagFace» → «Scopri MagFace») per rigenerare il CSS | `_elementor_css` è protetto, non cancellabile dal connettore | CSS rigenerato (ver. 1794926508), regole presenti e regole preesistenti (`hero-shrink-img`) intatte | token `085fe0b29731d086f86308834b116c4d` (nessun contenuto cambiato) |

Backup di riferimento: UpdraftPlus **`60b7e05416f9`** (17/11/2026 14:10 UTC, completato).

## 4. Provato e non fatto
- Cambiare il tipo di sfondo delle 4 slide (slideshow → classico), togliere blur/motion effects/PNG ID 144/video YouTube, riscrivere lo script dello slider: richiede di riscrivere `_elementor_data` (grande) via connettore. Non lo faccio così: rischio alto in produzione (il tool passa una stringa; i meta Elementor protetti non sono modificabili). Va fatto dall'editor Elementor o con il tuo ok esplicito.
- Cancellare/modificare `_elementor_css`: negato dal connettore (chiave protetta).
- Impostazioni WP Rocket, Asset CleanUp, Elementor › Features, Code Snippets (preload hero): nessun accesso a wp-admin da questa sessione.
- Misure DevTools Coverage, altre pagine (Tecnologia, FAQ, Concept House), `/en/`: non fatte.
- Non ho ripetuto la verifica in lingua estera (DE) né testato slider/menu/moduli/login dopo la modifica: il CSS tocca solo `.hero-slide`, ma **da verificare a vista**.

## 5. Differenze visive
Nessuna evidente a 375×812 (IT). L'unica: il titolo e il testo compaiono subito invece di entrare con dissolvenza (richiesto per la velocità).

## 6. Richiesta di permesso finale
1. **Accesso a wp-admin (browser loggato)** per: WP Rocket (escludere dal lazy-load l'immagine hero, safelist per Remove Unused CSS, valutare di disattivare CSS asincrono senza CSS critico, Delay JS solo per tracciamento), Asset CleanUp (evitare doppioni di minificazione), Elementor › Features. Beneficio atteso: Speed Index mobile e peso (verificato che WP Rocket peggiora il mobile). Rischio: medio, una impostazione alla volta con misura.
2. **Via libera a riscrivere `_elementor_data` della home** (solo le 4 slide e il widget HTML `df7e540`), oppure farlo tu dall'editor: slideshow → sfondo classico, niente blur/motion effects/PNG e YouTube residui. Beneficio atteso: elimina il ritardo di caricamento 6,9 s dell'LCP. Rischio: alto senza editor; backup `60b7e05416f9`.
3. **Snippet Code Snippets** (solo home): `<link rel="preload" as="image" fetchpriority="high">` per la prima slide. Beneficio: riduce il ritardo di caricamento dell'immagine LCP.
4. **Conversione/ridimensionamento immagini in WebP/AVIF** (plugin dedicato): stima Lighthouse 1.050 KiB risparmiabili e 946 KiB di immagini fuori schermo; alcune PNG da ~500 KB.
5. **Tracciamento**: GTM-5VVRWG4W, gtag GT-K4TP3ZPG e G-BMZ7D06DHS, Meta Pixel, banner Iubenda: possibile duplicazione (*dedotta*); da concordare col cliente prima di toccare.
6. **WP Rocket 3.9.4** (2021): aggiornamento e verifica licenza (l'email del licenziatario non l'ho potuta verificare da qui).
7. **Plugin non usati** sulle pagine pubbliche (Angie, SureCart inattivo, ecc.): da valutare.
8. **`WP_DEBUG_LOG` temporaneo**: solo se servono log PHP.

**Posso procedere con i punti 1–8? Rispondi con i numeri che approvi.**

---

## 7. Aggiornamento 18/11/2026 – effetto dell'esclusione di jQuery dal `defer` (fatta dal cliente, vedi `header/report-header-magface.md` §7)
Con jQuery fuori dal `defer`, Elementor si inizializza subito (header e menu funzionanti) e lo slideshow della hero parte prima. Lighthouse locale, home IT, URL pulito **[V]**: mobile **40 → 67**, LCP **15,8 → 3,9 s**, Speed Index 8,3 → 4,5 s, TBT 960 → 460 ms; desktop **68 → 87**, LCP 4,0 → 1,4 s. Questo cambia la lettura della causa (3) della diagnosi: il difetto principale delle ottimizzazioni WP Rocket era il `defer` su jQuery. Restano da fare: sfondo slideshow → classico (richiede riscrittura dati), WebP/AVIF, tracciamenti, ecc. (punti 2–8 sopra).
