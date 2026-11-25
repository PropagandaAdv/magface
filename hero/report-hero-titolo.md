# Hero home – titolo spostato in alto (25/11/2026)

**[V]** verificato · **[D]** dedotto.

## Problema (riprodotto)
Nella slide 2 («Perché demolire una superficie ancora perfetta?») la seconda riga del titolo finisce sopra il bottone «Perché scegliere MagFace» e sopra il sottotitolo. Screenshot: `prima-1080-1920-slide2.png` (identico al tuo).

## Causa **[V]**
Titolo e riga «sottotitolo + bottone» hanno entrambi l'effetto di movimento allo scroll (translateY di Elementor), ma con valori diversi: la riga sale da sola (−23…−44 px già a 150 px di scroll) mentre il titolo no, e lo spazio si chiude. In più, a scroll 0 lo spazio **diminuisce al crescere dell'altezza dello schermo**: sovrapposizione di 27 px a 1920×1080 e 49 px a 2560×1300 (per questo non si vede sul tuo portatile con finestra bassa). Riguarda anche i tablet (fino a 55 px in verticale) e tutte le 4 slide. Il difetto è indipendente dal font (Fraunces si carica anche nei miei test).

## Correzione
CSS nel CSS personalizzato della pagina Home (Elementor › impostazioni pagina), file `hero/fix-hero-titolo.css`: `margin-bottom` sui 4 titoli (ID `1f07eb1`, `edc8002`, `d5547b0`, `35fcce3`), proporzionale all'altezza della finestra: desktop `max(0, 11,25vh − 80px)`, tablet `7,5vh`, mobile `max(10px, 5vh − 12px)`. Le regole precedenti del blocco (hero-shrink-img, hero visibile subito) sono rimaste intatte.

## Collaudo (solo in locale, CSS iniettato nel browser; spazio minimo titolo→sottotitolo/bottone su tutte e 4 le slide e 10 posizioni di scroll 0–800 px)
| Finestra | Prima | Dopo |
|---|---|---|
| 2560×1300 | −49 px | 34 |
| 1920×1080 | −27 | 27 |
| 1440×900 | −4 (slide 3) | 25 |
| 1353×720 | 26 | 27 |
| 1024×768 | −24 | 60 |
| 820×1180 | −55 | 60 |
| 768×1024 | −41 | 62 |
| 414×896 | −2 | 44 (versione precedente della regola) |
| 375×812 | 22 | 59 |
(negativo = sovrapposizione). Su desktop bassi il titolo della slide 4 era già parzialmente fuori dall'alto (−11 px a 1353×720) e resta uguale (−12). File: `misure-prima-sweep*.txt`, `misure-dopo-css-*.txt`. Nota: a 414×896 e 1804/1366 l'ultima versione della regola non è stata rieseguita in toto (versione precedente equivalente: ≥ 44 px).

## Stato
- **Salvato sul sito, non ancora attivo.** Il CSS di pagina non si rigenera dal connettore (`_elementor_css` invariato, verificato). Per attivarlo: Elementor › Strumenti › Rigenera CSS e dati, poi svuotare la cache di WP Rocket.
- Backup `c60d13f9f56a` (completato). Undo: token `fab9839a31a673d56affac985015ea4f` (ripristina il CSS di pagina precedente; scade il 28/11) oppure cancellare dal CSS di pagina il blocco «Hero home: titolo spostato in alto».
- Non verificato dal vivo (la regola non è ancora attiva): resa reale con Safari/iOS e con Weglot nelle altre lingue (titoli più lunghi in DE/FR/ES: lo spazio extra è fisso, non dipende dal testo).

---

## Aggiornamento 25/11/2026 – attivo e verificato sul sito live
Dopo la rigenerazione dei CSS di Elementor e lo svuotamento della cache (fatti dal cliente):
- **CSS servito ai visitatori [V]:** la pagina ottimizzata carica `cache/min/1/…/post-137.css?ver=1795600044`, che contiene le tre regole (desktop, tablet, mobile), con i `calc()` intatti dopo la minificazione WP Rocket e senza `&gt;`; regole precedenti (hero-shrink-img, hero visibile subito) presenti.
- **Misura sul sito vero, senza iniezioni [V]** (stesso metodo della baseline: spazio minimo titolo → sottotitolo/bottone, 4 slide, 10 posizioni di scroll 0–800 px). File `misure-live-A.txt`, `misure-live-B.txt`:

| Finestra | Prima | Live adesso |
|---|---|---|
| 2560×1300 | −49 | 34 |
| 1920×1080 | −27 | 27 |
| 1804×1080 | −27 | 27 |
| 1440×900 | −4 (slide 3) | 25 |
| 1366×768 | 17 (slide 3) | 26 |
| 1353×720 | 26 | 27 |
| 1280×720 | 26 | 28 |
| 1024×768 | −24 | 60 |
| 820×1180 | −55 | 60 |
| 768×1024 | −41 | 62 |
| 414×896 | −2 | 44 |
| 375×812 | 22 | 59 |
| 360×740 | 30 | 55 |
(negativo = sovrapposizione.) Risultati identici al collaudo locale.
- **Non-regressione [V]:** la rotazione delle slide continua (slide 1, 2, 3, 4 viste in 21 s), sticky dell'header attivo e a 0 px, nessun errore JavaScript. Il titolo della slide 4 sui desktop bassi resta come prima (−12 px a 1353×720 contro −11 px prima).
- Screenshot: `live-dopo-1920x1080-slide2.png` (l'immagine più chiara sovrapposta è la dissolvenza tra slide, causata dal mio test che forza la slide attiva).
- **Non verificato:** Safari/iOS e titoli più lunghi in DE/FR/ES con Weglot.
