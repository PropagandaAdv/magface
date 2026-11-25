<?php
/**
 * MagFace – pacchetto SEO (bozza, NON ATTIVATO)
 * Da incollare in Code Snippets (Esegui solo sul front-end). Preparato il 09/11/2026.
 * I filtri sono verificati nel codice di AIOSEO 5.0.4 e Weglot 6.4.3.
 * Ogni blocco è indipendente: si può incollare/attivare separatamente.
 */
if ( ! defined( 'ABSPATH' ) ) { return; }

/* ---------- A) Azione 4: title e description IT (alternativa all'inserimento a mano in AIOSEO) ----------
 * Testi copiati dal file lavoro/titles_descriptions.json (estratto dall'AUDIT via codice).
 * Home: description invariata. Prestazioni e vantaggi (175): solo title; description DA CONFERMARE ("Fino al 70%").
 * Solo lingua italiana: le traduzioni restano in Weglot (regola del cliente).
 */
function mf_seo_it_map() {
	return array(
	137 => array( 'title' => 'MagFace® | Posa magnetica a secco: pavimenti e rivestimenti', 'description' => null ), // Home,
	181 => array( 'title' => 'Tecnologia di posa magnetica a secco brevettata | MagFace®', 'description' => 'Uno strato magnetico di 1 mm sul retro di ogni lastra: gres porcellanato e pietra si posano senza colla, si rimuovono e si riutilizzano. Brevettato.' ), // Tecnologia,
	202 => array( 'title' => 'Superfici magnetiche per pavimenti e rivestimenti | MagFace®', 'description' => 'Gres porcellanato, pietra naturale e superfici decorative con base magnetica MagFace®: lastre fino a 160×320 cm, pronte per la posa a secco.' ), // Superfici magnetiche,
	213 => array( 'title' => 'Applicazioni: retail, uffici, hospitality, casa | MagFace®', 'description' => 'Negozi, showroom, uffici, hotel, fiere e abitazioni: con la posa magnetica a secco MagFace® le superfici cambiano in poche ore, senza demolizioni né fermi.' ), // Applicazioni,
	175 => array( 'title' => 'Prestazioni e vantaggi della posa magnetica | MagFace®', 'description' => null ), // Prestazioni e vantaggi,
	251 => array( 'title' => 'Licenze per produttori ceramici | MagFace®', 'description' => 'Integrate la tecnologia magnetica brevettata MagFace® nelle vostre lastre. Tre livelli, Bronze, Silver e Gold, per produttori di ceramica e pietra.' ), // Licensing,
	228 => array( 'title' => 'MagFace Academy | Formazione sulla posa magnetica a secco', 'description' => 'Corsi pratici per posatori, rivenditori e progettisti: posa magnetica a secco, taglio e foratura delle lastre, finitura dei giunti con MagFiller®.' ), // MagFace Academy,
	257 => array( 'title' => 'Partner tecnici della posa magnetica a secco | MagFace®', 'description' => 'Produttori, fornitori e aziende tecniche che lavorano con MagFace® per la posa magnetica a secco di gres porcellanato, pietra e superfici decorative.' ), // Partner tecnici,
	161 => array( 'title' => 'Certificazioni: ASTM C627, EN 13501-1, UL 94 | MagFace®', 'description' => 'Heavy Duty al Robinson Test ASTM C627-10, reazione al fuoco EN 13501-1, autoestinguenza UL 94: i report di prova del sistema MagFace®, da scaricare.' ), // Certificazioni,
	200 => array( 'title' => 'MagFace Concept House | 110 m², 24 ore, zero demolizioni', 'description' => 'Il progetto MagFace® Concept House in numeri: 110 m², 24 ore, zero demolizioni. Posa magnetica a secco a pavimento e parete, con video e interviste.' ), // MagFace Concept House,
	262 => array( 'title' => 'Chi siamo | Bassi Group International dal 2002 | MagFace®', 'description' => 'MagFace® nasce da Bassi Group International, specialista di sistemi magnetici dal 2002. Fondatore e inventore: Andrea Bassi. Brevetto internazionale 2015.' ), // Chi siamo,
	864 => array( 'title' => 'News, fiere ed eventi sulla posa magnetica | MagFace®', 'description' => 'News ed eventi MagFace®: fiere, progetti realizzati, partnership e novità sulla posa magnetica a secco brevettata per pavimenti e rivestimenti.' ), // News,
	321 => array( 'title' => 'Domande frequenti sulla posa magnetica a secco | MagFace®', 'description' => '51 risposte sulla posa magnetica a secco MagFace®: supporti, formati, carichi, bagni e docce, rimozione, sicurezza magnetica, certificazioni e licenze.' ), // FAQ,
	270 => array( 'title' => 'Contatti | MagFace®, Castelnovo di Sotto (Reggio Emilia)', 'description' => 'Contattate MagFace® per progetti, licenze e formazione. Bassi Group International Srl, Piazzale degli Alberi 7, 42024 Castelnovo di Sotto (RE), Italia.' ), // Contatti
	);
}
function mf_seo_is_it() {
	return ! function_exists( 'weglot_get_current_language' ) || 'it' === weglot_get_current_language();
}
add_filter( 'aioseo_title', function ( $title ) {
	if ( is_admin() || ! is_singular( 'page' ) || ! mf_seo_is_it() ) { return $title; }
	$m = mf_seo_it_map(); $id = get_queried_object_id();
	return isset( $m[ $id ]['title'] ) ? $m[ $id ]['title'] : $title;
} );
add_filter( 'aioseo_description', function ( $desc ) {
	if ( is_admin() || ! is_singular( 'page' ) || ! mf_seo_is_it() ) { return $desc; }
	$m = mf_seo_it_map(); $id = get_queried_object_id();
	return ( isset( $m[ $id ]['description'] ) && null !== $m[ $id ]['description'] ) ? $m[ $id ]['description'] : $desc;
} );

/* ---------- B) Azione 2: noindex + fuori sitemap per pagine private/tecniche ---------- */
function mf_private_ids() {
	return array( 1502, 1571, 1574, 1575, 1576, 1577, 1578, 1579, 1580, 1581, 1582, 1583, 1516, 1517, 1519, 1513, 1514, 512, 1096 );
}
add_filter( 'aioseo_robots_meta', function ( $robots ) {
	if ( is_singular( 'page' ) && in_array( get_queried_object_id(), mf_private_ids(), true ) ) {
		$robots['noindex'] = true; $robots['nofollow'] = true;
	}
	if ( is_singular( 'angie_snippet' ) ) { $robots['noindex'] = true; }
	return $robots;
} );
add_filter( 'aioseo_sitemap_posts', function ( $entries, $post_type ) {
	if ( ! is_array( $entries ) ) { return $entries; }
	$ids = mf_private_ids();
	return array_values( array_filter( $entries, function ( $e ) use ( $ids, $post_type ) {
		if ( 'angie_snippet' === $post_type ) { return false; }
		$loc = isset( $e['loc'] ) ? $e['loc'] : '';
		foreach ( $ids as $id ) { if ( untrailingslashit( get_permalink( $id ) ) === untrailingslashit( $loc ) ) { return false; } }
		return true;
	} ) );
}, 10, 2 );

/* ---------- C) Azione 14: dati strutturati Organization (Appendice A AUDIT) ----------
 * Aggiunge campi al nodo Organization esistente (@id .../#organization), senza crearne un secondo.
 * Brevetti/certificazioni NON inclusi (serve l'ok di MagFace).
 */
add_filter( 'aioseo_schema_output', function ( $graphs ) {
	if ( ! is_array( $graphs ) ) { return $graphs; }
	foreach ( $graphs as &$g ) {
		if ( isset( $g['@type'] ) && 'Organization' === $g['@type'] ) {
			$g['name']        = 'MagFace®';
			$g['legalName']   = 'Bassi Group International Srl';
			$g['vatID']       = 'IT02278260357';
			$g['foundingDate']= '2002';
			$g['founder']     = array( '@type' => 'Person', 'name' => 'Andrea Bassi', 'jobTitle' => 'CEO e inventore' );
			$g['address']     = array( '@type' => 'PostalAddress', 'streetAddress' => 'Piazzale degli Alberi 7', 'postalCode' => '42024', 'addressLocality' => 'Castelnovo di Sotto', 'addressRegion' => 'RE', 'addressCountry' => 'IT' );
		}
	}
	unset( $g );
	return $graphs;
} );

/* ---------- D) Azione 15: hreflang x-default -> /en/ ----------
 * Verificato in Weglot 6.4.3: generate_href_lang_tags() emette solo gli alternate, x-default NON esiste.
 * Il filtro weglot_href_lang riceve la stringa HTML dei <link>: si duplica l'alternate "en" come x-default.
 */
add_filter( 'weglot_href_lang', function ( $render ) {
	if ( is_string( $render ) && false === strpos( $render, 'x-default' )
		&& preg_match( '#<link rel="alternate" href="([^"]+)" hreflang="en"\s*/>#', $render, $m ) ) {
		$render .= '<link rel="alternate" href="' . $m[1] . '" hreflang="x-default"/>' . "\n";
	}
	return $render;
} );

/* ---------- E) Azione 3: un solo H1 (bozza, NON testata) ----------
 * Il primo widget heading della pagina diventa H1; gli altri restano H2 (default). Solo le 14 pagine.
 * Numeri tipo "-70%" in Prestazioni e vantaggi vanno comunque trasformati in paragrafo dall'editor.
 */
add_action( 'elementor/frontend/widget/before_render', function ( $widget ) {
	static $done = array();
	if ( 'heading' !== $widget->get_name() || is_admin() || ! is_singular( 'page' ) ) { return; }
	$pages = array( 137, 181, 202, 213, 175, 251, 228, 257, 161, 200, 262, 864, 321, 270 );
	$pid = get_queried_object_id();
	if ( ! in_array( $pid, $pages, true ) || isset( $done[ $pid ] ) ) { return; }
	$doc = \Elementor\Plugin::$instance->documents->get_current();
	if ( ! $doc || (int) $doc->get_main_id() !== (int) $pid || 'wp-page' !== $doc->get_name() ) { return; }
	$done[ $pid ] = true;
	$widget->set_settings( 'header_size', 'h1' );
}, 10, 1 );
