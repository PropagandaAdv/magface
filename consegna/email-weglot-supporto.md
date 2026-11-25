# Bozza mail al supporto Weglot (da inviare a cura di Giovanni)

**A:** support@weglot.com
**Oggetto:** How are SEO titles and meta descriptions handled? (www.magface.it, IT → EN/FR/DE/ES)

---

Hello Weglot team,

I manage the website www.magface.it (WordPress, Weglot plugin 6.4.3, SEO plugin All in One SEO Lite 5.0.4). Source language is Italian; target languages are English, French, German and Spanish. We are reviewing the translations and have a few questions about SEO titles and meta descriptions.

**1. Where do they live in Weglot?**
Are the `<title>`, `<meta name="description">`, `og:title`, `og:description` and `twitter:*` values handled as separate strings in Translations › Languages? If so, is there a way to filter the list to show only these meta strings, so we can review them quickly?

**2. Manual edits vs. source changes**
We will replace our Italian titles and descriptions first, then paste the approved translation for each language in the Translations list. If we later edit the Italian source text, the manual translation is no longer shown (a new automatic one is generated). Is there a way to keep the existing manual translation, for example with the Translation Memory or by editing the source without creating a new string? And does the order we follow (Italian first, then translations) match your recommendation?

**3. Strings that get split**
On the homepage, the translated meta description starts with "MagFace® It is the first…" (EN), "MagFace® Il s'agit de…" (FR) and "MagFace® Es handelt sich um…" (DE). Our guess is that an excluded HTML block around the brand name splits the sentence in two strings, so the second part is translated without a subject. Can you confirm that an exclusion on an element containing only the brand name can split sentences like this? Is a glossary "Never translate" rule the better way to protect a brand name?

**4. Glossary and meta tags**
Do glossary rules (both "Never translate" and "Always translate") apply to meta title and meta description strings, as they do to page text? For multi-word terms (for example "posa magnetica a secco"), is there a priority between a long expression and a single word contained in it ("posa")?

**5. Technical meta values**
On our German, French and Spanish pages the value of `<meta name="twitter:card">` is translated (for example "Zusammenfassung (großes Bild)"), which makes it invalid. How can we exclude this value from translation? Is a CSS selector exclusion possible for a meta tag, or should we use another method?

**6. hreflang x-default**
We checked plugin version 6.4.3 and see that only `alternate` hreflang tags are generated, with no `x-default`. Is there an official option to add `x-default` pointing to the English version? Otherwise, is hooking the `weglot_href_lang` filter supported, and is a native setting planned?

**7. Translated URLs**
When we correct a translated slug in the dashboard (for example `/de/magnetische-oberflachen/` to `/de/magnetische-oberflaechen/`), does Weglot automatically create a 301 redirect from the old slug to the new one? If not, what do you recommend?

**8. Plan**
Does our current plan include custom AI instructions (the brand/prompt field) and media translation (replacing video or image URLs per language)?

Thank you very much. A short answer to each point, with links to the relevant documentation, would be perfect.

Best regards,
Giovanni Bertoni
Propaganda ADV
info@giovannibertoni.com

*Nota interna: aggiungere prima di inviare l'email dell'account Weglot e il nome del progetto, se il supporto li chiede.*
