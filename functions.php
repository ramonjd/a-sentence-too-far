<?php
/**
 * Aa_sentence_too_far functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package a_sentence_too_far
 * @since a_sentence_too_far 1.0
 */

if ( ! function_exists( 'a_sentence_too_far_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	function a_sentence_too_far_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'a_sentence_too_far', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
//		add_theme_support( 'post-thumbnails' );
//		set_post_thumbnail_size( 1568, 9999 );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for editor styles.
        add_theme_support( 'editor-styles' );
//
//		// Add support for responsive embedded content.
//		add_theme_support( 'responsive-embeds' );
//
//
//		// Add support for custom units.
//		add_theme_support( 'custom-units' );

// Enqueue editor styles.
		add_editor_style( 'style.css' );
	}
}
add_action( 'after_setup_theme', 'a_sentence_too_far_setup' );

if ( ! function_exists( 'a_sentence_too_far_styles' ) ) {

	/**
	 * Enqueue styles.
	 *
	 * @since a_sentence_too_far 1.0
	 *
	 * @return void
	 */
	function a_sentence_too_far_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'a-sentence-too-far-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Add styles inline.
		wp_add_inline_style( 'a-sentence-too-far-style', a_sentence_too_far_get_font_face_styles() );

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'a-sentence-too-far-style' );

	}
}


add_action( 'wp_enqueue_scripts', 'a_sentence_too_far_styles' );

if ( ! function_exists( 'a_sentence_too_far_editor_styles' ) ) {
	/**
	 * Enqueue editor styles in admin.
	 *
	 * @since a_sentence_too_far 1.0
	 *
	 * @return void
	 */
	function a_sentence_too_far_editor_styles() {

		// Add styles inline.
		wp_add_inline_style( 'wp-block-library', a_sentence_too_far_get_font_face_styles() );

	}
}

add_action( 'admin_init', 'a_sentence_too_far_editor_styles' );

if ( ! function_exists( 'a_sentence_too_far_get_font_face_styles' ) ) {
	/**
	 * Get font face styles.
	 * Called by functions a_sentence_too_far_styles() and a_sentence_too_far_editor_styles() above.
	 *
	 * @since a_sentence_too_far 1.0
	 *
	 * @return string
	 */
	function a_sentence_too_far_get_font_face_styles() {
		return "
		@font-face{
			font-family: 'Rasa';
			font-weight: 300;
			font-style: italic;
			src: url('" . get_theme_file_uri( 'assets/fonts/rasa-v11-latin-300italic.woff2' ) . "') format('woff2');
		}
		@font-face{
			font-family: 'Rasa';
			font-weight: 400;
			font-style: normal;
			src: url('" . get_theme_file_uri( 'assets/fonts/rasa-v11-latin-regular.woff2' ) . "') format('woff2');
		}
		";
	}
}

if ( ! function_exists( 'a_sentence_too_far_preload_webfonts' ) ) {
	/**
	 * Preloads the main web font to improve performance.
	 *
	 * Only the main web font (font-style: normal) is preloaded here since that font is always relevant (it is used
	 * on every heading, for example). The other font is only needed if there is any applicable content in italic style,
	 * and therefore preloading it would in most cases regress performance when that font would otherwise not be loaded
	 * at all.
	 *
	 * @since a_sentence_too_far 1.0
	 *
	 * @return void
	 */
	function a_sentence_too_far_preload_webfonts() {
		?>
		<link rel="preload" href="<?php echo esc_url( get_theme_file_uri( 'assets/fonts/rasa-v11-latin-regular.woff2' ) ); ?>" as="font" type="font/woff2" crossorigin />
		<?php
	}
}

add_action( 'wp_head', 'a_sentence_too_far_preload_webfonts' );

