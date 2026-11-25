# Bozza mail al supporto Weglot – traduzione delle meta description (da inviare a cura di Giovanni)

**A:** support@weglot.com
**Oggetto:** How are meta descriptions translated, and can we provide approved translations in bulk? (www.magface.it, IT → EN/FR/DE/ES)

---

Hello Weglot team,

We manage www.magface.it (WordPress, Weglot plugin 6.4.3). The source language is Italian and the target languages are English, French, German and Spanish. SEO titles and meta descriptions are set by All in One SEO Lite 5.0.4 in Italian only. We would like to understand exactly how Weglot translates the meta descriptions and whether there is a method, through the plugin, to provide our own approved translations.

From the plugin code we see that the parser handles `meta[name="description"]`, `og:description`, `og:site_name` and `twitter:description` (class `MetaContent`), and `og:title` and `twitter:title` (class `MetaTitleContent`). Could you please confirm and answer the following?

**1. How the translation works**
- Is each meta description sent as one single string in the translation list, or is it split into several segments? Is there a length limit?
- Can the list be filtered to show only meta strings (title and description) for a language pair?
- Does Weglot read the final text printed in the page by our SEO plugin (after its filters), so that any text produced by AIOSEO is translated as it is?

**2. A way to provide our own translations**
We already have approved translations for 14 pages in 4 languages. Pasting them one by one in the dashboard is slow and error-prone. Is there a supported method to load them in bulk or programmatically, for example CSV/PO import and export in the Translations section, the API, WP-CLI, or a plugin filter? If it depends on the plan, which plan is needed?

**3. When the source text changes**
If we edit an Italian meta description after a translation was corrected by hand, the manual translation is no longer shown and a new automatic one is created. Is there a way to keep it, for example with Translation Memory or by editing the source without creating a new string? What is the recommended order of work (Italian first, then translations)?

**4. Glossary and instructions**
Do the glossary rules ("Never translate" and "Always translate") and the AI instructions apply to meta descriptions in the same way as to page text? If a rule contains a multi-word expression and a single word that is part of it, which one has priority?

**5. A sentence split in our home meta description**
The translated description of our home page starts with "MagFace® It is the first…" in English, "MagFace® Il s'agit de…" in French and "MagFace® Es handelt sich um…" in German. We suspect that an HTML exclusion on an element containing only the brand name splits the sentence into two strings. Can you confirm this, and is a glossary "Never translate" rule the better way to protect a brand name inside a sentence?

**6. The twitter:card value is translated**
The plugin class `Meta_Twitter` sends `twitter:card`, `twitter:site` and `twitter:creator` for translation, and on our German, French and Spanish pages the value of `twitter:card` is translated (for example "Zusammenfassung (großes Bild)"), which makes it invalid. How can we exclude these values? Is removing that class with the `weglot_get_dom_checkers` filter the recommended way, or is there an option in the dashboard? Is this a known issue?

Thank you very much. A short answer to each point, with links to the relevant documentation, would be perfect.

Best regards,
Giovanni Bertoni
Propaganda ADV
info@giovannibertoni.com

*Nota interna: aggiungere prima dell'invio l'email dell'account Weglot e il nome del progetto, se il supporto li chiede. I nomi delle classi e dei selettori sono letti dal codice del plugin 6.4.3.*
