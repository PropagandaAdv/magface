#!/usr/bin/env python3
"""Genera i JSON Elementor per: barra categorie News (sezione salvata) e template Archivio categorie."""
import json, sys

CATS = [  # (slug, etichetta IT)
    ("tutti", "Tutti", "https://www.magface.it/news/"),
    ("certificazioni", "Certificazioni", None), ("collaborazioni", "Collaborazioni", None),
    ("corporate", "Corporate", None), ("eventi", "Eventi", None), ("premi", "Premi", None),
    ("progetti", "Progetti", None), ("ricerca-e-innovazione", "Ricerca e Innovazione", None),
    ("sostenibilita", "Sostenibilità", None), ("stampa", "Stampa", None),
]
def dims(t, r, b, l, linked=False, unit="px"):
    return {"unit": unit, "top": str(t), "right": str(r), "bottom": str(b), "left": str(l), "isLinked": linked}

def bar_css():
    act = ["body.page-id-864 .mf-cat-tutti .elementor-button"] + \
          [f"body.category-{s} .mf-cat-{s} .elementor-button" for s, _, u in CATS if u is None]
    return (".mf-cat-btn .elementor-button{transition:all .3s ease} "
            ".mf-cat-btn .elementor-button:hover{color:#000;box-shadow:0 2px 8px rgba(0,0,0,.15)} "
            + ", ".join(act) +
            " {background-image:linear-gradient(rgba(0,0,0,.98),#000);background-color:#000;color:#fff} "
            ".mf-cat-btn .elementor-button:focus-visible{outline:2px solid #000;outline-offset:2px}")

def button(i, slug, label, url):
    url = url or f"https://www.magface.it/category/{slug}/"
    return {"id": f"b{i:06x}", "elType": "widget", "widgetType": "button", "elements": [], "settings": {
        "text": label, "link": {"url": url, "is_external": "", "nofollow": "", "custom_attributes": ""},
        "_css_classes": f"mf-cat-btn mf-cat-{slug}", "_element_width": "auto",
        "_margin": dims(0, 5, 0, 5),
        "button_text_color": "#222222",
        "background_background": "gradient", "background_color": "#FFFFFF", "background_color_b": "#F2295B00",
        "border_radius": dims(11, 11, 11, 11, True),
        "text_padding": dims(8, 20, 8, 20),
        "typography_typography": "custom", "typography_font_family": "Inter",
        "typography_font_size": {"unit": "px", "size": 16, "sizes": []}, "typography_font_weight": "400"}}

def bar():
    return [{"id": "c0a7b01", "elType": "container", "isInner": False, "settings": {
        "content_width": "full", "flex_direction": "row", "flex_wrap": "wrap",
        "flex_justify_content": "flex-start", "flex_align_items": "center",
        "flex_gap": {"column": "20", "row": "20", "isLinked": True, "unit": "px", "size": 20},
        "padding": dims(10, 10, 10, 10, True), "custom_css": bar_css()},
        "elements": [button(i, *c) for i, c in enumerate(CATS, 1)]}]

def tag(i, name, settings="%7B%7D"):
    return f'[elementor-tag id="{i}" name="{name}" settings="{settings}"]'

def archive(bar_id):
    hero = {"id": "a0c0001", "elType": "container", "isInner": False, "settings": {
        "flex_direction": "column", "content_width": "full",
        "min_height": {"unit": "vh", "size": 40, "sizes": []}, "flex_justify_content": "flex-end",
        "background_background": "classic", "background_color": "#000000",
        "padding": dims(10, 20, 60, 20)}, "elements": [
        {"id": "a0c0002", "elType": "widget", "widgetType": "heading", "elements": [], "settings": {
            "title": "Categoria", "header_size": "h1",
            "__dynamic__": {"title": tag("a0d0001", "archive-title", "%7B%22include_context%22%3A%22%22%7D")},
            "typography_typography": "custom", "typography_font_family": "Fraunces",
            "typography_font_size": {"unit": "px", "size": 96, "sizes": []},
            "typography_font_size_tablet": {"unit": "px", "size": 56, "sizes": []},
            "typography_font_size_mobile": {"unit": "px", "size": 30, "sizes": []},
            "typography_font_weight": "300", "title_color": "#FFFFFF"}},
        {"id": "a0c0003", "elType": "widget", "widgetType": "text-editor", "elements": [], "settings": {
            "editor": "Descrizione categoria", "__dynamic__": {"editor": tag("a0d0002", "archive-description")},
            "text_color": "#FFFFFF", "typography_typography": "custom", "typography_font_family": "Inter",
            "typography_font_size": {"unit": "px", "size": 18, "sizes": []}, "typography_font_weight": "400"}}]}
    barc = {"id": "a0c0004", "elType": "container", "isInner": False, "settings": {"content_width": "full"}, "elements": [
        {"id": "a0c0005", "elType": "widget", "widgetType": "template", "elements": [], "settings": {"template_id": bar_id}}]}
    grid = {"id": "a0c0006", "elType": "container", "isInner": False, "settings": {"content_width": "full"}, "elements": [
        {"id": "a0c0007", "elType": "widget", "widgetType": "loop-grid", "elements": [], "settings": {
            "template_id": 889, "alternate_templates": [{"template_id": None, "_id": "a0c0008"}],
            "post_query_post_type": "current_query",
            "columns": 4, "equal_height": "yes", "pagination_type": "numbers", "pagination_page_limit": "10",
            "pagination_prev_label": "Precedente", "pagination_next_label": "Successivo", "text": "Carica altro",
            "load_more_no_posts_custom_message": "Non c&#039;è alcun articolo da mostrare",
            "nothing_found_message_text": "Sembra che quello che stai cercando non ci sia.",
            "pagination_typography_typography": "custom", "pagination_typography_font_family": "Inter",
            "pagination_typography_font_weight": "400", "pagination_spacing": {"unit": "px", "size": 11, "sizes": []},
            "pagination_color": "#000000"}}]}
    return [hero, barc, grid]

if __name__ == "__main__":
    what = sys.argv[1]
    data = bar() if what == "bar" else archive(int(sys.argv[2]))
    out = json.dumps(data, ensure_ascii=False, separators=(",", ":"))
    open(f"elementor/{what}.json", "w").write(out)
    print(out)
