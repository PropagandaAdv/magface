# Diagnosi caricamento iniziale – magface.it (17/11/2026)

Metodo: Lighthouse 12.8.2 locale (Chromium headless, throttling simulato mobile/desktop), esperimenti Playwright con CPU 4× e rete Fast 4G, analisi del sorgente HTML. **Limiti:** ambiente emulato e rete variabile (il TTFB oscilla tra 2,5 e 11 s, quindi i numeri assoluti sono indicativi; contano i confronti); non ho potuto usare DevTools Coverage né leggere le impostazioni WP Rocket/Asset CleanUp (nessun accesso a wp-admin da questa sessione).

## Cause in ordine di impatto

| # | Causa | Evidenza | Stato |
|---|---|---|---|
| 1 | **Il titolo della hero resta invisibile finché non parte il JavaScript di Elementor.** Nel sorgente ci sono 54 elementi `elementor-invisible`, 50 con `animated-slow`. | LCP mobile = `h2.elementor-heading-title` della hero; fasi LCP: caricamento 0 s, **ritardo di rendering 14,6 s** (nowprocket) e **18,3 s** (con WP Rocket). Esperimento: con una regola che rende subito visibile il titolo, il titolo compare a ~4,5 s invece di 8–19 s (2 ripetizioni per variante). | **Verificato** |
| 2 | **Lo sfondo delle slide è uno slideshow creato dal JavaScript.** Nel sorgente servito ci sono 0 elementi `swiper-slide` e 0 `elementor-background-slideshow`: l'immagine di sfondo viene richiesta solo dopo l'avvio del JS. | Dopo la correzione n. 1 l'elemento LCP diventa `.elementor-background-slideshow__slide__image`: **ritardo di caricamento 6,9 s**, ritardo di rendering 6,0 s (Lighthouse mobile). | **Verificato** |
| 3 | **Le ottimizzazioni WP Rocket peggiorano il mobile.** | Mobile, home: senza WP Rocket (`?nowprocket=1`) LCP 17,1 s, Speed Index 8,5 s, TBT 710 ms; con WP Rocket LCP 20,8 s, SI 14,2 s, TBT 900 ms. Desktop: differenza piccola (SI 3,6 s con, 5,1 s senza). Inoltre, nonostante CSS asincrono attivo, i CSS di Elementor risultano ancora *render-blocking* (≈250 ms). | **Verificato** (la causa precisa dentro WP Rocket è *dedotta*) |
| 4 | **Script di terze parti**: GTM (GTM-5VVRWG4W), gtag (GT-K4TP3ZPG e G-BMZ7D06DHS), Meta Pixel, banner cookie **Iubenda** (non citato nel prompt). Bloccano il thread principale per 840 ms (nowprocket) / 1.480 ms (con WP Rocket). Due ID gtag diversi + GTM: possibile doppio tracciamento (*dedotto*). | Lighthouse `third-party-summary`. | Verificato il peso; il doppione è **dedotto** |
| 5 | **Peso e formato delle immagini**: PNG da 511 KB e 494 KB (file «ChatGPT-Image…» e «Gemini_Generated…»), JPG fino a 292 KB; Lighthouse stima 1.050 KiB risparmiabili con formati moderni e **946 KiB di immagini fuori schermo** scaricate subito (lazy-load non efficace su queste). | Elenco richieste di Lighthouse. | **Verificato** |
| 6 | **JavaScript inutilizzato**: 457 KiB (senza WP Rocket) – 612 KiB (con). Bootup 2,3–3,1 s, 15–20 long task. | Lighthouse. | Verificato; quali file nello specifico non ho potuto dettagliarlo |
| 7 | Effetti pesanti sulle 4 slide (blur 8,2 px, motion effects, effetto mouse) | Letti nelle impostazioni del brief; non misurati singolarmente. | **Dedotto** |

## Confronto «WP Rocket sì/no» (richiesto al punto 3)
La hero è lenta **in entrambi i casi** (LCP 17,1 s vs 20,8 s mobile): il problema è soprattutto nella **costruzione della pagina** (cause 1 e 2); le impostazioni di WP Rocket lo aggravano (causa 3) ma non ne sono l'origine.

## Altre pagine
Non ho misurato Tecnologia, FAQ e Concept House (tempo). Nota: le pagine interne condividono lo stesso ID widget hero (`1f07eb1`) e header/footer; il metodo può essere riusato ma **non è verificato** altrove.
