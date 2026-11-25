# Anteprima – meta italiane che lo snippet scrive

Fonte: tabella «Italiano» dell'audit del cliente (estratta via codice, copiata senza modifiche). Il conteggio caratteri coincide con quello scritto nell'audit per tutte le righe.

| ID | Pagina | Title (car.) | Description (car.) |
|---|---|---|---|
| 137 | Home | MagFace® \| Posa magnetica a secco: pavimenti e rivestimenti (59) | *non toccata* (invariata per la tabella; l'attuale contiene il dato «-70%», da confermare) |
| 181 | Tecnologia | Tecnologia di posa magnetica a secco brevettata \| MagFace® (58) | Uno strato magnetico di 1 mm sul retro di ogni lastra: gres porcellanato e pietra si posano senza colla, si rimuovono e si riutilizzano. Brevettato. (148) |
| 202 | Superfici magnetiche | Superfici magnetiche per pavimenti e rivestimenti \| MagFace® (60) | Gres porcellanato, pietra naturale e superfici decorative con base magnetica MagFace®: lastre fino a 160×320 cm, pronte per la posa a secco. (140) |
| 213 | Applicazioni | Applicazioni: retail, uffici, hospitality, casa \| MagFace® (58) | Negozi, showroom, uffici, hotel, fiere e abitazioni: con la posa magnetica a secco MagFace® le superfici cambiano in poche ore, senza demolizioni né fermi. (155) |
| 175 | Prestazioni e vantaggi | Prestazioni e vantaggi della posa magnetica \| MagFace® (54) | *non toccata* — DA CONFERMARE («Fino al 70%») |
| 251 | Licensing | Licenze per produttori ceramici \| MagFace® (42) | Integrate la tecnologia magnetica brevettata MagFace® nelle vostre lastre. Tre livelli, Bronze, Silver e Gold, per produttori di ceramica e pietra. (147) |
| 228 | MagFace Academy | MagFace Academy \| Formazione sulla posa magnetica a secco (57) | Corsi pratici per posatori, rivenditori e progettisti: posa magnetica a secco, taglio e foratura delle lastre, finitura dei giunti con MagFiller®. (146) |
| 257 | Partner tecnici | Partner tecnici della posa magnetica a secco \| MagFace® (55) | Produttori, fornitori e aziende tecniche che lavorano con MagFace® per la posa magnetica a secco di gres porcellanato, pietra e superfici decorative. (149) |
| 161 | Certificazioni | Certificazioni: ASTM C627, EN 13501-1, UL 94 \| MagFace® (55) | Heavy Duty al Robinson Test ASTM C627-10, reazione al fuoco EN 13501-1, autoestinguenza UL 94: i report di prova del sistema MagFace®, da scaricare. (148) |
| 200 | MagFace Concept House | MagFace Concept House \| 110 m², 24 ore, zero demolizioni (56) | Il progetto MagFace® Concept House in numeri: 110 m², 24 ore, zero demolizioni. Posa magnetica a secco a pavimento e parete, con video e interviste. (148) |
| 262 | Chi siamo | Chi siamo \| Bassi Group International dal 2002 \| MagFace® (57) | MagFace® nasce da Bassi Group International, specialista di sistemi magnetici dal 2002. Fondatore e inventore: Andrea Bassi. Brevetto internazionale 2015. (154) |
| 864 | News | News, fiere ed eventi sulla posa magnetica \| MagFace® (53) | News ed eventi MagFace®: fiere, progetti realizzati, partnership e novità sulla posa magnetica a secco brevettata per pavimenti e rivestimenti. (143) |
| 321 | FAQ | Domande frequenti sulla posa magnetica a secco \| MagFace® (57) | 51 risposte sulla posa magnetica a secco MagFace®: supporti, formati, carichi, bagni e docce, rimozione, sicurezza magnetica, certificazioni e licenze. (151) |
| 270 | Contatti | Contatti \| MagFace®, Castelnovo di Sotto (Reggio Emilia) (56) | Contattate MagFace® per progetti, licenze e formazione. Bassi Group International Srl, Piazzale degli Alberi 7, 42024 Castelnovo di Sotto (RE), Italia. (151) |

## Come si usa
1. Code Snippets › Aggiungi nuovo › incolla `snippets/magface-meta-it-una-tantum.php` › «Esegui solo nell'area di amministrazione» › Salva e attiva.
2. Apri `/wp-admin/?mf_meta_it=check`: tabella con valore attuale e nuovo, **nessuna scrittura**.
3. «Applica i testi italiani»: scrive, rilegge ogni campo e confronta carattere per carattere (segnala ERRORE se un valore salvato è diverso).
4. Controlla `<title>` e meta description nel sorgente delle pagine (cache svuotata da WP Rocket).
5. «Ripristina valori originali» riporta i valori salvati al primo «Applica».
6. A lavoro finito disattiva ed elimina lo snippet.

## Cosa NON fa
- Non tocca le traduzioni EN/FR/DE/ES (restano in Weglot: prima l'italiano, poi le traduzioni).
- Non scrive la description di Home e Prestazioni e vantaggi (vedi sopra).
- Non modifica H1, noindex, sitemap, schema, x-default (restano nello snippet `magface-seo-pack.php`, blocchi B–E).

## Collaudo (simulato, 25/11/2026)
WordPress e AIOSEO simulati: non-admin → nessun output; controllo → 0 scritture; applica senza nonce → bloccato; applica → 14/14 scritte e verificate, 0 errori; confronto esatto con l'audit → 0 differenze (Home e Prestazioni: description intatta); ricontrollo → 14/14 già corrette; applica ripetuto → 0 scritture; ripristino → 14/14 tornate ai valori originali.
**Non provato sul sito reale**: la lettura/scrittura vera di AIOSEO (per questo esiste il controllo prima e la verifica dopo ogni scrittura).
