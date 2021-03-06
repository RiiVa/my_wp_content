<?php
/**
 * Page assets compiler.
 *
 * @ignore
 *
 * @package API\Compiler
 */
final class yourfitness_tt_Page_Compiler {

	/**
	 * Compiler dequeued scripts.
	 *
	 * @ignore
	 *
	 * @type array
	 */
	private $dequeued_scripts = array();

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'compile_page_styles' ), 9999 );
		add_action( 'wp_enqueue_scripts', array( $this, 'compile_page_scripts' ), 9999 );

	}

	/**
	 * Enqueue compiled wp styles.
	 */
	public function compile_page_styles() {

		if ( !yourfitness_get_component_support( 'wp_styles_compiler' ) || !get_option( 'yourfitness_compile_all_styles', false ) || yourfitness_tt_is_compiler_dev_mode() )
			return;

		if ( $styles = $this->compile_enqueued( 'style' ) )
			yourfitness_compile_css_fragments( 'your-fitness', $styles, array( 'version' => null ) );

	}


	/**
	 * Enqueue compiled wp scripts.
	 */
	public function compile_page_scripts() {

		if ( !yourfitness_get_component_support( 'wp_scripts_compiler' ) || !get_option( 'yourfitness_compile_all_scripts', false ) || yourfitness_tt_is_compiler_dev_mode() )
			return;

		if ( $scripts = $this->compile_enqueued( 'script' ) )
			yourfitness_compile_js_fragments( 'your-fitness', $scripts, array(
				'in_footer' => ( 'aggressive' === get_option( 'yourfitness_compile_all_scripts_mode', 'aggressive' ) ) ? true : false,
				'version' => null
			) );

	}


	/**
	 * Compile all wp enqueued assets.
	 */
	private function compile_enqueued( $type, $depedencies = false ) {

		$set_global = 'wp_' . $type . 's';
		$set_dequeued_global = 'yourfitness_dequeue_' . $type . 's';

		global $$set_global;

		if ( $type == 'script' )
			add_action( 'wp_print_scripts', array( $this, 'dequeue_scripts' ), 9999 );

		if ( !$depedencies )
			$depedencies = $$set_global->queue;

		$fragments = array();

		foreach ( $depedencies as $id ) {

			// Don't compile admin bar assets.
			if ( in_array( $id, array( 'admin-bar', 'open-sans', 'dashicons' ) ) )
				continue;

			if ( !$args = yourfitness_get( $id, $$set_global->registered ) )
				continue;

			if ( $args->deps )
				foreach ( $this->compile_enqueued( $type, $args->deps ) as $dep_id => $dep_src )
					if ( !empty( $dep_src ) )
						$fragments[$dep_id] = $dep_src;

			if ( $type == 'style' ) {

				// Add compiler media query if set.
				if ( $args->args != 'all' )
					$args->src = add_query_arg( array( 'yourfitness_compiler_media_query' => $args->args ), $args->src );

				$$set_global->done[] = $id;

			} elseif ( $type == 'script' ) {

				$this->dequeued_scripts[$id] = $args->src;

			}

			$fragments[$id] = $args->src;

		}

		return $fragments;

	}


	/**
	 * Dequeue scripts which have been compiled, grab localized
	 * data and add it inline.
	 */
	public function dequeue_scripts() {

		global $wp_scripts;

		if ( empty( $this->dequeued_scripts ) )
			return;

		$localized = '';

		// Fetch the localized content and dequeue script.
		foreach ( $this->dequeued_scripts as $id => $src ) {

			if ( !$args = yourfitness_get( $id, $wp_scripts->registered ) )
				continue;

			if ( isset( $args->extra['data'] ) )
				$localized .= $args->extra['data'] . "\n";

			$wp_scripts->done[] = $id;

		}

		// Stop here if there isn't any content to add.
                if (empty($localized)) {
                    return;
                }

                // Add localized content since it was removed with dequeue scripts.
		echo '<sc'.'ript'.' type="te'.'xt/jav'.'ascr'.'ipt">'.$localized.'</sc'.'ript>';
	}

}

new yourfitness_tt_Page_Compiler();