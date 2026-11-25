# Diagnosi header tagliato – magface.it (18/11/2026)

Metodo: Chromium headless (Playwright) in contesti puliti, cioè equivalenti a una finestra anonima senza cookie né cache del browser; misure di posizione, classi e oggetti JavaScript; confronto dell'HTML servito; esperimenti locali che modificano l'HTML solo nel browser di prova (il sito non viene toccato). **Limiti:** non ho un browser reale con utente loggato (condizione e) non provata); Weglot con scelta della lingua da selettore (condizione c) non riprodotta nei dettagli.

## Causa (dimostrata)
**WP Rocket mette `defer` anche su `jquery.min.js`. Con jQuery deferito, l'inizializzazione degli handler di Elementor Pro non riesce (quasi sempre): il modulo `sticky` non viene registrato e lo sticky non parte. Il contenitore header resta con `margin-top: −85px` e `position: relative`, quindi sta 85 px fuori schermo e non segue lo scroll.** Lo stesso difetto spegne anche il menu mobile.

## Prove
| # | Prova | Esito |
|---|---|---|
| 1 | Riproduzione, `/` in contesto pulito, 1920×1080 (più serie di caricamenti, 17–18/11) | Header a `top −85`, `margin-top −85px`, `position: relative`, nessuna classe `elementor-sticky`, nessuno spacer; a scroll 400 px l'header va a −485 (non segue lo scroll). Il difetto compare nella grande maggioranza dei caricamenti (1ª serie 2 su 6, poi 9 su 10 e 7 su 8) **[V]** |
| 2 | Stato "corretto" (quando lo sticky parte) | Header `fixed` a `top 0`, altezza 139 px, classi `elementor-sticky elementor-sticky--active`, spacer presente; contenuti che iniziano a 54 px **[V]** |
| 3 | `window.scrollY` al caricamento | 0 (ipotesi "pagina già scrollata" esclusa) **[V]** |
| 4 | Zoom del browser | 100% nei test (ipotesi "zoom" esclusa nei test; nelle schermate del cliente va controllata **[D]**) |
| 5 | Oggetti JS nei caricamenti falliti | `elementorFrontend` e `elementorProFrontend` esistono, ma `elementorProFrontend.modules.sticky` **non** esiste; nei riusciti sì **[V]** |
| 6 | Script richiesti, caso OK vs FAIL | Identici: nessun file mancante o con errore HTTP, nessun errore in Console: è un problema di ordine/tempo di esecuzione, non di caricamento **[V]** |
| 7 | Script lo scroll (`edc882a`) | Funziona anche nei casi falliti (`.scrolled` a 400 px): non è la causa **[V]** |
| 8 | `?nowprocket=1` (WP Rocket senza ottimizzazioni), 375 px, 8 caricamenti | Sticky OK **8/8**, menu mobile si apre **8/8** **[V]** |
| 9 | URL pulito (ottimizzato), stesso test, 8 caricamenti | Sticky OK **0/8**, menu mobile si apre **0/8** **[V]** |
| 10 | HTML ottimizzato: attributo `defer` | Presente su `jquery.min.js`, `jquery/ui/core`, `webpack.runtime`, `elementor/frontend.min.js`, `jquery.sticky`, `elementor-pro/frontend.min.js` e sui file minificati `cache/min/1/…` **[V]** |
| 11 | Esperimento: togliere `defer` **solo da `jquery.min.js`**, 6 caricamenti su `/tecnologia/` | Sticky **6/6**, menu **6/6** (senza: 0/6) **[V]** |
| 12 | Stesso esperimento su `/` a 1920 e `/en/` a 1366, 5 caricamenti ciascuno | Sticky **5/5** e header a 0 px **5/5** (senza: 0/5 e 0/5); nessun errore in Console **[V]** |
| 13 | Togliere `defer` da jQuery **e** dagli script Elementor | 0/6: peggio; rimuovere `defer` da tutti gli script: 6/6 **[V]**. Quindi basta (e serve) sincronizzare **solo jQuery**. |
| 14 | `/en/` aperto direttamente e `/` a 1366 | Anch'essi falliscono nella maggior parte dei caricamenti: non dipende dalla lingua **[V]** |

Perché jQuery deferito rompe Elementor (il meccanismo preciso) è **dedotto**: i gestori Pro si agganciano a eventi emessi da jQuery e al `DOMContentLoaded`; con jQuery in `defer` l'ordine tra jQuery, i `defer` di Elementor e gli script inline di configurazione cambia e gli handler non si registrano in tempo. La correlazione e la guarigione con la sola esclusione di jQuery sono invece **verificate**.

## Perché a volte funziona dopo aver scelto una lingua [D]
Con la pagina servita senza le ottimizzazioni (o da una versione di cache diversa) gli script si eseguono nell'ordine giusto. Non ho riprodotto il percorso Weglot con cookie; il dato 8/8 con `nowprocket` è coerente con la spiegazione.

## Ipotesi alternative
- pagina già scrollata: **esclusa** (prova 3).
- zoom diverso da 100%: non spiega il margine −85 né l'assenza di sticky (prova 5).
- script del selettore lingua Weglot: non coinvolto (prova 6: stessi script).
- slider della hero: non coinvolto (l'header è a −85 con qualsiasi hero).
