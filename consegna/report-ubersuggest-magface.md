# Report Ubersuggest – magface.it
17/11/2026 · Per Giovanni · Nulla inviato al cliente.
Etichette: **[V]** verificato (dato letto da Ubersuggest, dal sito o dal sorgente HTML) · **[D]** dedotto.

## 0. Sintesi
- **Progetto creato** su Ubersuggest (ID `4761ab0003f498afa07818305840517f316e40c91975351f8fafd3d44df08bc3`): 5 località, 19 parole chiave, brand «MagFace» con 15 prompt AI nelle 5 lingue. **[V]**
- **Site audit: avviato ma non concluso** (22 pagine su ~177 al momento della consegna, ~2 pagine/minuto). I risultati si leggono dopo, vedi §2.
- **SEO:** il dominio è quasi invisibile: 13 parole chiave posizionate, ~119 visite organiche/mese stimate, DA 12. **[V, stime di Ubersuggest]**
- **GEO:** MagFace compare nel 40% delle risposte AI testate, ma le AI riportano **dati non presenti nei documenti del cliente** (garanzia 10 anni, «VOC-free», «fino all'80%», «5×») e Gemini lo confonde in parte con un omonimo tecnologico. **[V]**
- **Meta:** **nessuna** delle meta del cliente è oggi applicata (69 title su 70 diversi; solo il title della home EN coincide). **Non ho potuto applicarle**: AIOSEO non accetta la scrittura dal connettore e Weglot richiede il Dashboard. **[V]**
- **Plugin Ubersuggest SEO Tools:** risulta **già attivo** (diverso dal prompt, che lo dava inattivo); non risulta collegato all'account e non posso farlo senza wp-admin. **[V attivo / D collegamento]**

## 1. Progetto Ubersuggest
**Impostazioni scelte** (limiti letti con `user_limits`, piano tier3: 300 keyword/progetto, 15 concorrenti, 20 prompt AI per brand; usate 19 keyword, 0 concorrenti, 15 prompt; 4 operazioni brand su 100):
- Località (ID verificati con `location_suggest`): Italia 2380 (principale), Francia 2250, Germania 2276, Spagna 2724, Stati Uniti 2840. **[V]**
- Business summary solo con dati dei documenti del cliente; **nessuna percentuale di risparmio**.
- Gli altri progetti (noyfar.it, propagandaadv.com, gruppoirideacque.com) non sono stati toccati.

**Parole chiave** (volume mensile e difficoltà SD da `keyword_overview`/`match_keywords`; 0 = nessun dato di ricerca in Ubersuggest):
| Mercato | Parola chiave | Volume | SD | Nota |
|---|---|---|---|---|
| IT | posa magnetica a secco | 0 | 4 | termine del cliente, tenuto |
| IT | pavimenti magnetici | 90 | 34 | |
| IT | rivestimenti magnetici | 0 | 17 | termine del cliente |
| IT | posa a secco gres porcellanato | 20 | 9 | |
| IT | piastrelle magnetiche | 90 | 14 | **ambigua**: in gran parte giocattoli [D] |
| IT | magface | 90 | 32 | brand |
| FR | pose magnétique à sec / pose à sec carrelage / grès cérame pose à sec | 0 / 0 / 0 | 4 | termini del cliente (senza dati) |
| DE | magnetische Trockenverlegung / Trockenverlegung Feinsteinzeug | 0 / 0 | 17 | termini del cliente |
| DE | magnetische Fliesen | 110 | 19 | trovata, aggiunta |
| DE | Fliesen ohne Kleber | 210 | 14 | trovata, aggiunta |
| ES | colocación magnética en seco | nessun dato | – | tenuta |
| ES | colocación en seco gres porcelánico | 0 | 4 | termine del cliente |
| US | dry magnetic installation / porcelain tile dry installation | 0 / 0 | 12 / 4 | termini del cliente |
| US | magnetic tile installation | 10 | 13 | |
| US | magnetic flooring | 590 | 15 | trovata, aggiunta |

**Scelta:** ho tenuto i termini indicati dal cliente anche con volume 0 (servono a monitorare le posizioni; «volume 0» in Ubersuggest significa nessun dato, non assenza di domanda **[D]**) e aggiunto solo varianti con volume reale. Scartate: «posa a secco» e derivate in IT (riguardano la posa **esterna su ghiaia**, non pertinente), «magnetic tile …» in EN (giocattoli).

**Concorrenti:** `competitors` non restituisce nulla per magface.it (dominio troppo piccolo) **[V]**. **Non ne ho inseriti**: non inventati e, come da prompt, Fiandre / Casalgrande Padana / Agrob Buchtal non vanno inseriti senza permesso (Fiandre è anche licenziatario). Nelle risposte AI compaiono però Marazzi, Granitech, Planium, Novoceram, Fiandre, Leroy Merlin tra i brand citati **[V]**: sono candidati, da decidere (§7, punto 1).

## 2. Site audit tecnico
- Avviato con `site_audit` (crawl max 500 pagine; il crawler ha trovato ~177 URL). A fine report: **22 pagine analizzate, non concluso** **[V]**. Il ritmo lento è probabilmente legato alla lentezza del sito (TTFB 2,5–11 s nelle mie misure) **[D]**.
- **Come riprenderlo:** `site_audit_status` (domain `www.magface.it`, crawlMaxPages 500) finché `done: true`, poi `site_audit_results` per ogni id issue e `site_audit_pages`. Dopo l'applicazione delle meta, ripetere con `recrawl: true`.
- **PageSpeed (Ubersuggest `pagespeed_audit`)**: misura solo il **dominio/home**: le 4 chiamate (home, /tecnologia/, /faq/, /en/) hanno restituito lo stesso report **[V]**. Mobile: LCP 18,7 s, FCP 2,6 s, Speed Index 14,3 s, TTI 19,3 s, TBT 144 ms, CLS 0; JavaScript inutilizzato 730 KB (≈3,1 s), **redirect 630 ms**. Desktop: LCP 0,68 s, Speed Index 6,0 s, TBT 329 ms. Coerente con le mie misure Lighthouse (vedi `caricamento/`). Il redirect da 630 ms è un dato **nuovo** (probabile http→https/non-www→www, **[D]**, da verificare).
- **Confronto con l'audit del cliente (6/11), verificato sul sorgente live il 17/11:** H1 assenti (ancora, **già noto**), title generici (ancora, già noto), description lunghe/segnaposto (ancora, già noto), og:image/logo su cpanel.site (già noto, non risolto), hreflang senza x-default (già noto), velocità mobile (già noto, peggio di quanto stimato). Pagine private in sitemap, URL tedeschi, link «#» e alt: non ricontrollati in questa sessione.
- Lingue: il crawl include gli URL /en/, /fr/, /de/, /es/ **[D, non confermato fino al termine]**. Ho comunque controllato le 14 pagine × 5 lingue via HTML (§5).

## 3. Audit SEO (posizionamento)
- **Dominio** (Ubersuggest, stime): 13 parole chiave organiche, ~119 visite/mese (ott. 2026), DA 12; storico: 0 visite a luglio-agosto, 115 a settembre. **[V]**
- **Paesi:** traffico stimato solo da USA (2) e Canada (4) in inglese; **nessun dato** per Italia/Francia/Germania/Spagna. **[V]** Questo conferma, con dati, che le pagine /fr/ /de/ /es/ non portano traffico.
- **Backlink:** 11.474 backlink da **160 domini** (11.442 follow, 32 nofollow), nessun .gov/.edu. Il rapporto è anomalo (≈72 link per dominio) → probabili link sitewide da pochi domini **[D]**. `linking_domains` (ultimi 60 giorni): nessun nuovo dominio **[V]**. Non ho potuto distinguere i domini da FR/DE/ES.
- **Posizioni** (rank tracking, prima rilevazione 17/11, aggiornamento settimanale; prossimo 24/11): «magface» IT = **posizione 7**, ma l'URL che posiziona è un **PDF** (`/wp-content/uploads/2026/08/MagFace_Concepto-Aplicativo_es.pdf`), non una pagina del sito **[V]**; «piastrelle magnetiche» non posizionata; le altre in attesa (pending/unstable). Le altre lingue: non ancora interrogate. **[V]**
- **Gap di contenuto vs concorrenti:** non calcolabile (nessun concorrente).
- **Priorità** (con marcatura rispetto al piano del cliente):
  1. Applicare title/description e H1 → **già nel piano (azioni 3, 4, 8)**.
  2. Far posizionare la home/pagina Tecnologia su «magface» al posto del PDF spagnolo → **nuovo**.
  3. Contenuti sui termini con domanda reale: «Fliesen ohne Kleber» (210), «magnetic flooring» (590), «pavimenti magnetici» (90) → **nuovo**.
  4. Link/menzioni da FR/DE/ES → **già nel piano (azione 21)**, ma con dati ora misurabili.
  5. Velocità mobile → **già nel piano (azione 12)**.

## 4. Audit GEO (visibilità nelle AI)
Dati **parziali**: il report del brand è ancora in calcolo (`pending_update`). 15 prompt, 40 risposte (ChatGPT, Gemini, Google AI Overviews). **[V]**
- **Visibilità 40%**, 16 menzioni, posizione media 1,56, quota di voce 15,7%; sentiment 72/100 (neutro-positivo). Per provider: ChatGPT 46,7%, Google AIO 40%, Gemini 33,3%.
- **Entità separate:** «Bassi Group International» (4 menzioni) e «Bassi Group International Srl» (2) compaiono come brand distinti da «MagFace» **[V]**; le AI non li fondono sempre in una sola entità.
- **Dati incoerenti o non nei documenti del cliente** citati dalle AI **[V]**: «riduce i tempi di cantiere fino all'**80%**» e «up to **5× faster**» (il cliente ha già segnalato 70% / 5 volte / 60–80%), «**10-year warranty**», «**VOC-free certification**», «110 kg/m²». Garanzia decennale e VOC-free **non compaiono** nei due documenti: da verificare con MagFace.
- **Ambiguità di nome:** tra le parole positive di Gemini compaiono «magnitudine», «dati rumorosi», «qualità immagini»: si riferiscono a un omonimo non pertinente (riconoscimento facciale) **[D]**. Il brand ha un'omonimia: servono contenuti che leghino sempre «MagFace®» a «posa magnetica a secco».
- **Citazioni e gap:** `brand_citations` e `brand_citation_gaps` ancora vuoti (in calcolo). Da ripetere tra qualche ora.
- **Concorrenti citati nelle risposte:** Marazzi, Granitech, Planium, Novoceram, Ceramiche Keope, Fiandre (rank 1,5), Cotto d'Este, Leroy Merlin e altri; 63 brand in totale **[V]**.

## 5. Plugin Ubersuggest SEO Tools
- Versione 1.2.2, **attivo** (verificato con l'elenco plugin; il prompt lo dava inattivo: qualcuno l'ha attivato dopo). PHP 8.3 compatibile. **[V]**
- **Collegamento:** non eseguibile da me: serve wp-admin autenticato nel browser. Nelle opzioni lette via connettore non risulta alcuna impostazione salvata, quindi **probabilmente non è collegato** **[D]** (il prefisso opzioni potrebbe differire).
- Sul front-end il plugin **non aggiunge** riferimenti (0 occorrenze di «ubersuggest» nell'HTML della home) **[V]**.
- **Importante:** quando lo colleghi, **disattiva «AI-generated fixes»** o equivalenti: cambierebbero title/description/alt contro la regola del cliente.
- Backup: l'ultimo UpdraftPlus è `60b7e05416f9` (17/11, completato, creato per l'altro lavoro). **[V]** Non ne ho fatto uno nuovo perché nessuna modifica è stata eseguita.

## 6. Stato delle meta
File: `consegna/tabella-meta-pagina-lingua.csv` (70 righe: pagina × lingua; prima, tabella del cliente, stato) e `consegna/meta-stato-live.json`.
- **Prima [V]:** title 69/70 diversi dalla tabella (solo Home EN coincide); description 64/65 diverse (Home IT: «invariata» per la tabella; Prestazioni ×5: «DA CONFERMARE»). Description oltre 155 caratteri in 40 pagine su 70 (es. Tecnologia 399–470, Superfici magnetiche 442–511, Home FR 175, Home ES 173).
- **Home IT:** title attuale «MagFace® | Posa magnetica a secco per pavimenti e rivestimenti» (diverso dalla tabella «…secco: pavimenti e rivestimenti»); la description attuale contiene il dato «-70%/fino a» (da confermare).
- **Dopo:** **invariato**. Motivo [V]: nel test del 9/11 la scrittura da connettore su Contatti è finita nel post meta `_aioseo_title`, che AIOSEO 5 non legge (front-end invariato anche senza cache); annullata. Le traduzioni richiedono il Weglot Dashboard. Pronti: `snippets/magface-seo-pack.php` (blocco A, solo IT) e `lavoro/titles_descriptions.json`.
- **DA CONFERMARE:** description di Prestazioni e vantaggi in 5 lingue («Fino al 70%») e description attuale della home.
- Conteggi caratteri: tutti i conteggi dell'AUDIT coincidono con quelli reali (nessuna correzione necessaria).
- **Proposte di Ubersuggest diverse dalle tabelle:** nessuna ricevuta in questa sessione.

## 7. Richiesta di permesso finale
1. **Concorrenti da monitorare.** Propongo di aggiungere (dopo tua conferma) Marazzi, Granitech, Planium, Novoceram e Cotto d'Este, comparsi nelle risposte AI; di **non** inserire Fiandre, Casalgrande Padana e Agrob Buchtal senza ok (Fiandre è licenziatario). Sblocca il gap di contenuto e le citazioni comparative. Alternativa: lasciare vuoto. Rischio: nessuno (costa 1 operazione brand se si cambiano i competitor del brand).
2. **Dati da confermare con MagFace:** «fino al 70%» (5 lingue e description attuale home); garanzia 10 anni e «VOC-free» citati dalle AI; 80% e «5×». Sblocca la pubblicazione delle description di Prestazioni e la correzione del GEO.
3. **Collegamento del plugin Ubersuggest** e applicazione delle meta: serve un browser autenticato su wp-admin e sul Weglot Dashboard (oppure l'ok a incollare lo snippet in Code Snippets). Alternativa: lo fai tu con i file pronti. Rischio: scrittura in produzione, backup `60b7e05416f9`.
4. **Limiti del piano:** nessuno raggiunto (keyword 19/300, prompt 15/20, operazioni brand 4/100). Il crawler è però lento: serve tempo (o ripetere il controllo) per concludere il site audit.
5. **Proposte Ubersuggest diverse dalle tabelle del cliente:** nessuna da girare ad Andrea Bassi.

**Posso procedere con i punti 1–5? Rispondi con i numeri che approvi.**
