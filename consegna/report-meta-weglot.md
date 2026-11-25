# Report parziale – title/meta description magface.it (25/11/2026)

## Stato
- Preparazione: `meta.json` creato da codice (14 pagine × 5 lingue). Lunghezze dichiarate dall'audit = lunghezze calcolate (verificato, 139/140 campi; la description IT Home è «Invariata», non un testo).
- Backup UpdraftPlus `1db2d88f58fd` («Pre-meta-Weglot 2026-11-25»): completato, db+plugin+temi+uploads+others (verificato). L'export Weglot NON è stato fatto: nessun accesso al Dashboard da questa sessione.
- Fase A (IT in AIOSEO): scritta via `wp_update_seo_meta` su 13 pagine (Home solo title). Rilettura via `wp_get_seo_meta` conferma i nuovi valori (verificato su Tecnologia).
  - Non toccate: Prestazioni e vantaggi (title già uguale; description in attesa ok «fino al 70%») e description Home (contiene «-70%», da segnalare).
  - Valori precedenti: `valori-it-precedenti.json`. Undo Royal MCP valido 72 h (fino al 28/11/2026 ~08:34 UTC).
- **Verifica sorgente: NON superata.** Le pagine pubbliche (anche con query anti-cache e fetch lato server) mostrano ancora title «Tecnologia - MagFace» e description auto-generata dal contenuto. Cause possibili (dedotto, non verificato): cache WP Rocket attiva (nessuno strumento per svuotarla dal connettore) oppure AIOSEO legge da una tabella diversa da quella scritta dal connettore.
- Fasi B, C, 7: non avviate (richiedono Weglot Dashboard e il sorgente corretto).
