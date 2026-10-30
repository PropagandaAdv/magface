<?php
/**
 * 301: /<news>/?e-filter-7dfa4d3-category=<valore> -> pagina categoria della stessa lingua (o News).
 * Da incollare in Code Snippets (esegui ovunque / solo front-end). Generato da dati reali del sito (30/10/2026).
 * Un solo salto: nessuna catena di redirect.
 */
add_action( 'template_redirect', function () {
	if ( ! isset( $_GET['e-filter-7dfa4d3-category'] ) ) {
		return;
	}
	$uri  = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';
	$lang = 'it';
	if ( preg_match( '#^/(en|es|fr|de)(/|$)#', $uri, $m ) ) {
		$lang = $m[1];
	}
	$news = ["it" => "/news/", "en" => "/en/news/", "fr" => "/fr/nouvelles/", "de" => "/de/nachricht/", "es" => "/es/noticias/"];
	$cat  = [
 "it" => [
  "certificazioni" => "/category/certificazioni/",
  "collaborazioni" => "/category/collaborazioni/",
  "corporate" => "/category/corporate/",
  "eventi" => "/category/eventi/",
  "premi" => "/category/premi/",
  "progetti" => "/category/progetti/",
  "ricerca-e-innovazione" => "/category/ricerca-e-innovazione/",
  "sostenibilita" => "/category/sostenibilita/",
  "stampa" => "/category/stampa/"
 ],
 "en" => [
  "certificazioni" => "/en/category/certifications/",
  "collaborazioni" => "/en/category/collaborations/",
  "corporate" => "/en/category/corporate/",
  "eventi" => "/en/category/events/",
  "premi" => "/en/category/awards/",
  "progetti" => "/en/category/projects/",
  "ricerca-e-innovazione" => "/en/category/research-and-innovation/",
  "sostenibilita" => "/en/category/sustainability/",
  "stampa" => "/en/category/press/"
 ],
 "fr" => [
  "certificazioni" => "/fr/categorie/certifications/",
  "collaborazioni" => "/fr/categorie/collaborations/",
  "corporate" => "/fr/categorie/entreprise/",
  "eventi" => "/fr/categorie/evenements/",
  "premi" => "/fr/categorie/recompenses/",
  "progetti" => "/fr/categorie/projets/",
  "ricerca-e-innovazione" => "/fr/categorie/recherche-et-innovation/",
  "sostenibilita" => "/fr/categorie/durabilite/",
  "stampa" => "/fr/categorie/presse/"
 ],
 "de" => [
  "certificazioni" => "/de/kategorie/zertifizierungen/",
  "collaborazioni" => "/de/kategorie/kooperationen/",
  "corporate" => "/de/kategorie/corporate/",
  "eventi" => "/de/kategorie/veranstaltungen/",
  "premi" => "/de/kategorie/auszeichnungen/",
  "progetti" => "/de/kategorie/projekte/",
  "ricerca-e-innovazione" => "/de/kategorie/forschung-und-innovation/",
  "sostenibilita" => "/de/kategorie/nachhaltigkeit/",
  "stampa" => "/de/kategorie/drucken/"
 ],
 "es" => [
  "certificazioni" => "/es/categoria/certificaciones/",
  "collaborazioni" => "/es/categoria/colaboraciones/",
  "corporate" => "/es/categoria/corporativo/",
  "eventi" => "/es/categoria/eventos/",
  "premi" => "/es/categoria/premios/",
  "progetti" => "/es/categoria/proyectos/",
  "ricerca-e-innovazione" => "/es/categoria/investigacion-e-innovacion/",
  "sostenibilita" => "/es/categoria/sostenibilidad/",
  "stampa" => "/es/categoria/prensa/"
 ]
];
	$map  = [
 "certificazioni" => "certificazioni",
 "collaborazioni" => "collaborazioni",
 "corporate" => "corporate",
 "eventi" => "eventi",
 "premi" => "premi",
 "progetti" => "progetti",
 "ricerca-e-innovazione" => "ricerca-e-innovazione",
 "ricerca e innovazione" => "ricerca-e-innovazione",
 "sostenibilita" => "sostenibilita",
 "sostenibilità" => "sostenibilita",
 "stampa" => "stampa",
 "certifications" => "certificazioni",
 "collaborations" => "collaborazioni",
 "events" => "eventi",
 "awards" => "premi",
 "projects" => "progetti",
 "research-and-innovation" => "ricerca-e-innovazione",
 "research and innovation" => "ricerca-e-innovazione",
 "sustainability" => "sostenibilita",
 "press" => "stampa",
 "entreprise" => "corporate",
 "événements" => "eventi",
 "récompenses" => "premi",
 "prix" => "premi",
 "projets" => "progetti",
 "recherche et innovation" => "ricerca-e-innovazione",
 "durabilité" => "sostenibilita",
 "presse" => "stampa",
 "zertifizierungen" => "certificazioni",
 "kooperationen" => "collaborazioni",
 "unternehmen" => "corporate",
 "veranstaltungen" => "eventi",
 "auszeichnungen" => "premi",
 "projekte" => "progetti",
 "forschung und innovation" => "ricerca-e-innovazione",
 "nachhaltigkeit" => "sostenibilita",
 "drücken" => "stampa",
 "certificaciones" => "certificazioni",
 "colaboraciones" => "collaborazioni",
 "corporativo" => "corporate",
 "eventos" => "eventi",
 "premios" => "premi",
 "proyectos" => "progetti",
 "investigación e innovación" => "ricerca-e-innovazione",
 "sostenibilidad" => "sostenibilita",
 "prensa" => "stampa"
];
	$all  = ["__all", "__alle", "__todo", "__tous", "tutti"];
	$raw = rawurldecode( (string) wp_unslash( $_GET['e-filter-7dfa4d3-category'] ) );
	$val = mb_strtolower( trim( str_replace( '+', ' ', $raw ) ) );
	$path = $news[ $lang ];
	if ( ! in_array( $val, $all, true ) && isset( $map[ $val ] ) ) {
		$path = $cat[ $lang ][ $map[ $val ] ];
	}
	wp_redirect( home_url( $path ), 301 );
	exit;
}, 0 );
