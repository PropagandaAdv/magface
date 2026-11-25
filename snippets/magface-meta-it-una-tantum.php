<?php
/**
 * MagFace – Meta SEO italiane (title e description) – snippet "una tantum"
 * Preparato il 25/11/2026 per Code Snippets. NON ATTIVO finché non lo incolli.
 *
 * COSA FA
 *   Scrive title e description italiani delle 14 pagine nei campi reali di All in One SEO (tabella aioseo_posts),
 *   gli stessi che si vedono nel pannello AIOSEO di ogni pagina. I testi sono copiati dalle tabelle dell'audit del
 *   cliente (estratti via codice, nessuna modifica). Usa Post::savePost() di AIOSEO 5.0.4.
 *   NON tocca: la description della Home (invariata per la tabella) e quella di Prestazioni e vantaggi
 *   (DA CONFERMARE: «Fino al 70%»). Per queste due pagine scrive solo il title.
 *   Non tocca le traduzioni: EN/FR/DE/ES restano in Weglot (prima l'italiano, poi le traduzioni).
 *
 * COME SI USA (richiede un amministratore)
 *   1. Code Snippets > Aggiungi nuovo > incolla tutto questo codice (senza il tag <?php iniziale se l'editor lo ha già)
 *      > "Esegui lo snippet solo nell'area di amministrazione" > Salva e attiva.
 *   2. Apri  /wp-admin/?mf_meta_it=check   -> tabella con valore attuale e nuovo. NON scrive nulla.
 *   3. Dalla pagina di controllo clicca "Applica": scrive, rilegge ogni campo e confronta carattere per carattere.
 *   4. Svuota la cache (lo snippet prova a farlo da solo con WP Rocket) e controlla <title> e meta description nel sorgente.
 *   5. Se serve tornare indietro: pagina di controllo > "Ripristina valori originali" (ripristina quelli salvati al 1° applica).
 *   6. A lavoro finito disattiva ed elimina lo snippet.
 *
 * Note: AIOSEO Lite 5.0.4 (verificato nel codice). Se AIOSEO viene aggiornato, ripetere "check" prima di "Applica".
 */
if ( ! defined( 'ABSPATH' ) ) { return; }

if ( ! function_exists( 'mf_meta_it_data' ) ) {

	/** Testi dell'audit del cliente (title e description italiani). null = non scrivere. */
	function mf_meta_it_data() {
		return array(
		137 => array( 'pagina' => 'Home', 'title' => 'MagFace® | Posa magnetica a secco: pavimenti e rivestimenti', 'description' => null, 'nota' => 'description invariata (come da tabella del cliente; contiene il dato «-70%»: da confermare)' ),
		181 => array( 'pagina' => 'Tecnologia', 'title' => 'Tecnologia di posa magnetica a secco brevettata | MagFace®', 'description' => 'Uno strato magnetico di 1 mm sul retro di ogni lastra: gres porcellanato e pietra si posano senza colla, si rimuovono e si riutilizzano. Brevettato.', 'nota' => '' ),
		202 => array( 'pagina' => 'Superfici magnetiche', 'title' => 'Superfici magnetiche per pavimenti e rivestimenti | MagFace®', 'description' => 'Gres porcellanato, pietra naturale e superfici decorative con base magnetica MagFace®: lastre fino a 160×320 cm, pronte per la posa a secco.', 'nota' => '' ),
		213 => array( 'pagina' => 'Applicazioni', 'title' => 'Applicazioni: retail, uffici, hospitality, casa | MagFace®', 'description' => 'Negozi, showroom, uffici, hotel, fiere e abitazioni: con la posa magnetica a secco MagFace® le superfici cambiano in poche ore, senza demolizioni né fermi.', 'nota' => '' ),
		175 => array( 'pagina' => 'Prestazioni e vantaggi', 'title' => 'Prestazioni e vantaggi della posa magnetica | MagFace®', 'description' => null, 'nota' => 'description DA CONFERMARE («Fino al 70%»): non pubblicata' ),
		251 => array( 'pagina' => 'Licensing', 'title' => 'Licenze per produttori ceramici | MagFace®', 'description' => 'Integrate la tecnologia magnetica brevettata MagFace® nelle vostre lastre. Tre livelli, Bronze, Silver e Gold, per produttori di ceramica e pietra.', 'nota' => '' ),
		228 => array( 'pagina' => 'MagFace Academy', 'title' => 'MagFace Academy | Formazione sulla posa magnetica a secco', 'description' => 'Corsi pratici per posatori, rivenditori e progettisti: posa magnetica a secco, taglio e foratura delle lastre, finitura dei giunti con MagFiller®.', 'nota' => '' ),
		257 => array( 'pagina' => 'Partner tecnici', 'title' => 'Partner tecnici della posa magnetica a secco | MagFace®', 'description' => 'Produttori, fornitori e aziende tecniche che lavorano con MagFace® per la posa magnetica a secco di gres porcellanato, pietra e superfici decorative.', 'nota' => '' ),
		161 => array( 'pagina' => 'Certificazioni', 'title' => 'Certificazioni: ASTM C627, EN 13501-1, UL 94 | MagFace®', 'description' => 'Heavy Duty al Robinson Test ASTM C627-10, reazione al fuoco EN 13501-1, autoestinguenza UL 94: i report di prova del sistema MagFace®, da scaricare.', 'nota' => '' ),
		200 => array( 'pagina' => 'MagFace Concept House', 'title' => 'MagFace Concept House | 110 m², 24 ore, zero demolizioni', 'description' => 'Il progetto MagFace® Concept House in numeri: 110 m², 24 ore, zero demolizioni. Posa magnetica a secco a pavimento e parete, con video e interviste.', 'nota' => '' ),
		262 => array( 'pagina' => 'Chi siamo', 'title' => 'Chi siamo | Bassi Group International dal 2002 | MagFace®', 'description' => 'MagFace® nasce da Bassi Group International, specialista di sistemi magnetici dal 2002. Fondatore e inventore: Andrea Bassi. Brevetto internazionale 2015.', 'nota' => '' ),
		864 => array( 'pagina' => 'News', 'title' => 'News, fiere ed eventi sulla posa magnetica | MagFace®', 'description' => 'News ed eventi MagFace®: fiere, progetti realizzati, partnership e novità sulla posa magnetica a secco brevettata per pavimenti e rivestimenti.', 'nota' => '' ),
		321 => array( 'pagina' => 'FAQ', 'title' => 'Domande frequenti sulla posa magnetica a secco | MagFace®', 'description' => '51 risposte sulla posa magnetica a secco MagFace®: supporti, formati, carichi, bagni e docce, rimozione, sicurezza magnetica, certificazioni e licenze.', 'nota' => '' ),
		270 => array( 'pagina' => 'Contatti', 'title' => 'Contatti | MagFace®, Castelnovo di Sotto (Reggio Emilia)', 'description' => 'Contattate MagFace® per progetti, licenze e formazione. Bassi Group International Srl, Piazzale degli Alberi 7, 42024 Castelnovo di Sotto (RE), Italia.', 'nota' => '' )
		);
	}

	function mf_meta_it_ready() {
		return function_exists( 'aioseo' ) && class_exists( '\AIOSEO\Plugin\Common\Models\Post' );
	}

	/** Valori attuali dal modello AIOSEO. */
	function mf_meta_it_current( $id ) {
		$p = \AIOSEO\Plugin\Common\Models\Post::getPost( $id );
		return array( 'title' => isset( $p->title ) ? (string) $p->title : '', 'description' => isset( $p->description ) ? (string) $p->description : '' );
	}

	function mf_meta_it_render( $rows, $titolo, $azioni = '' ) {
		$h  = '<div style="font:14px/1.5 system-ui,sans-serif;max-width:1200px"><h1>' . esc_html( $titolo ) . '</h1>' . $azioni;
		$h .= '<table style="border-collapse:collapse;width:100%"><thead><tr>';
		foreach ( array( 'ID', 'Pagina', 'Stato', 'Title (attuale → nuovo)', 'Description (attuale → nuova)' ) as $c ) {
			$h .= '<th style="text-align:left;border:1px solid #ccc;padding:6px;background:#f3f3f3">' . esc_html( $c ) . '</th>';
		}
		$h .= '</tr></thead><tbody>';
		foreach ( $rows as $r ) {
			$h .= '<tr><td style="border:1px solid #ccc;padding:6px">' . (int) $r['id'] . '</td><td style="border:1px solid #ccc;padding:6px">' . esc_html( $r['pagina'] ) . '</td>';
			$h .= '<td style="border:1px solid #ccc;padding:6px"><strong>' . esc_html( $r['stato'] ) . '</strong>' . ( $r['nota'] ? '<br><small>' . esc_html( $r['nota'] ) . '</small>' : '' ) . '</td>';
			$h .= '<td style="border:1px solid #ccc;padding:6px"><del>' . esc_html( $r['t_old'] ) . '</del><br>' . esc_html( $r['t_new'] ) . ' <small>(' . mb_strlen( (string) $r['t_new'] ) . ' car.)</small></td>';
			$h .= '<td style="border:1px solid #ccc;padding:6px"><del>' . esc_html( $r['d_old'] ) . '</del><br>' . esc_html( (string) $r['d_new'] ) . ( null !== $r['d_new'] ? ' <small>(' . mb_strlen( (string) $r['d_new'] ) . ' car.)</small>' : '' ) . '</td></tr>';
		}
		return $h . '</tbody></table></div>';
	}

	function mf_meta_it_run() {
		if ( ! is_admin() || ! current_user_can( 'manage_options' ) || empty( $_GET['mf_meta_it'] ) ) { return; }
		$mode = sanitize_key( wp_unslash( $_GET['mf_meta_it'] ) );
		if ( ! in_array( $mode, array( 'check', 'apply', 'rollback' ), true ) ) { return; }
		if ( ! mf_meta_it_ready() ) { wp_die( 'All in One SEO non è attivo o la sua classe Post non è disponibile: nessuna modifica fatta.' ); }
		if ( 'check' !== $mode ) { check_admin_referer( 'mf_meta_it_' . $mode ); }

		$data   = mf_meta_it_data();
		$backup = get_option( 'mf_meta_it_backup', array() );
		$rows   = array();
		$errors = 0;

		foreach ( $data as $id => $d ) {
			$post = get_post( $id );
			if ( ! $post || 'page' !== $post->post_type ) {
				$rows[] = array( 'id' => $id, 'pagina' => $d['pagina'], 'stato' => 'PAGINA NON TROVATA: saltata', 'nota' => '', 't_old' => '', 't_new' => $d['title'], 'd_old' => '', 'd_new' => $d['description'] );
				$errors++;
				continue;
			}
			$cur   = mf_meta_it_current( $id );
			$write = array( 'title' => $d['title'] );
			if ( null !== $d['description'] ) { $write['description'] = $d['description']; }

			if ( 'rollback' === $mode ) {
				if ( ! isset( $backup[ $id ] ) ) {
					$rows[] = array( 'id' => $id, 'pagina' => $d['pagina'], 'stato' => 'nessun valore salvato: non toccata', 'nota' => '', 't_old' => $cur['title'], 't_new' => $cur['title'], 'd_old' => $cur['description'], 'd_new' => $cur['description'] );
					continue;
				}
				$restore = array( 'title' => $backup[ $id ]['title'] );
				if ( array_key_exists( 'description', $write ) ) { $restore['description'] = $backup[ $id ]['description']; }
				\AIOSEO\Plugin\Common\Models\Post::savePost( $id, $restore );
				$after = mf_meta_it_current( $id );
				$ok    = ( $after['title'] === (string) $backup[ $id ]['title'] ) && ( ! array_key_exists( 'description', $restore ) || $after['description'] === (string) $backup[ $id ]['description'] );
				if ( ! $ok ) { $errors++; }
				$rows[] = array( 'id' => $id, 'pagina' => $d['pagina'], 'stato' => $ok ? 'ripristinata' : 'ERRORE nel ripristino', 'nota' => '', 't_old' => $cur['title'], 't_new' => $after['title'], 'd_old' => $cur['description'], 'd_new' => $after['description'] );
				continue;
			}

			$same = ( $cur['title'] === $d['title'] ) && ( null === $d['description'] || $cur['description'] === $d['description'] );

			if ( 'apply' === $mode && ! $same ) {
				if ( ! isset( $backup[ $id ] ) ) { $backup[ $id ] = $cur; }   // salva l'originale solo la prima volta
				\AIOSEO\Plugin\Common\Models\Post::savePost( $id, $write );
				$after = mf_meta_it_current( $id );
				$ok    = ( $after['title'] === $d['title'] ) && ( null === $d['description'] || $after['description'] === $d['description'] );
				if ( ! $ok ) { $errors++; }
				$stato = $ok ? 'scritta e verificata' : 'ERRORE: il valore riletto è diverso';
				$rows[] = array( 'id' => $id, 'pagina' => $d['pagina'], 'stato' => $stato, 'nota' => $d['nota'], 't_old' => $cur['title'], 't_new' => $after['title'], 'd_old' => $cur['description'], 'd_new' => null === $d['description'] ? null : $after['description'] );
				continue;
			}

			$stato  = $same ? 'già corretta' : ( null === $d['description'] ? 'da scrivere (solo title)' : 'da scrivere' );
			$rows[] = array( 'id' => $id, 'pagina' => $d['pagina'], 'stato' => $stato, 'nota' => $d['nota'], 't_old' => $cur['title'], 't_new' => $d['title'], 'd_old' => $cur['description'], 'd_new' => $d['description'] );
		}

		if ( 'apply' === $mode ) {
			update_option( 'mf_meta_it_backup', $backup, false );
			update_option( 'mf_meta_it_log', array( 'quando' => current_time( 'mysql' ), 'modo' => $mode, 'errori' => $errors ), false );
			if ( function_exists( 'rocket_clean_domain' ) ) { rocket_clean_domain(); }
		}

		$base   = admin_url( 'index.php' );
		$azioni = '';
		if ( 'check' === $mode ) {
			$azioni  = '<p>Controllo: <strong>nessuna scrittura effettuata</strong>. Verifica la tabella, poi:</p>';
			$azioni .= '<p><a class="button button-primary" href="' . esc_url( wp_nonce_url( add_query_arg( 'mf_meta_it', 'apply', $base ), 'mf_meta_it_apply' ) ) . '">Applica i testi italiani</a> ';
			$azioni .= '<a class="button" href="' . esc_url( wp_nonce_url( add_query_arg( 'mf_meta_it', 'rollback', $base ), 'mf_meta_it_rollback' ) ) . '">Ripristina valori originali</a></p>';
		} else {
			$azioni = '<p>' . ( $errors ? '<strong style="color:#b32d2e">' . (int) $errors . ' errore/i: controlla le righe segnate ERRORE.</strong>' : '<strong style="color:#1a7f37">Operazione completata senza errori.</strong>' ) . ' Svuota la cache e controlla il sorgente delle pagine. <a href="' . esc_url( add_query_arg( 'mf_meta_it', 'check', $base ) ) . '">Torna al controllo</a></p>';
		}
		wp_die( mf_meta_it_render( $rows, 'MagFace – Meta SEO italiane (' . $mode . ')', $azioni ), 'MagFace – Meta SEO italiane', array( 'response' => 200 ) );
	}
	add_action( 'admin_init', 'mf_meta_it_run' );
}
