<?php
/**
 * Enqueue scripts and style from parent theme
 *
 * @package euinsects
 */

/** Comment
 */
function twentytwenty_styles() {
	wp_enqueue_style(
		'parent',
		get_template_directory_uri() . '/style.css'
	);
}
add_action( 'wp_enqueue_scripts', 'twentytwenty_styles' );

/** Category list
 */
function get_category_titles( $cat, $showposts = 5 ) {
	$args = array(
		'cat' => $cat,
		'post_type' => 'post',
		'showposts' => $showposts,
	);
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		echo '<ul>';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			echo '<li>' . get_the_title() . '</li>';
		}
		echo '</ul>';
		wp_reset_postdata();
	}
}

/** Google fonts
 */
function euinsects_custom_fonts() {
	wp_enqueue_style(
		'my_custom_fonts',
		'https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:wght@400;700&display=swap'
	);
}
add_action( 'wp_enqueue_scripts', 'euinsects_custom_fonts' );

/** Custom colors */
function twentytwenty_accent_accessible_colors_fallback( $value ) {
	$accent_hue_active = get_theme_mod( 'accent_hue_active', 'default' );
	$background_color  = sanitize_hex_color_no_hash( get_theme_mod( 'background_color' ) );
	$value             = (array) $value;

	// if ( 'default' === $accent_hue_active && 'f5efe0' === $background_color ) {
		$value['content'] = array(
			'text'      => '#000000',
			'accent'    => '#549B35',
			'secondary' => '#6d6d6d',
			'borders'   => '#dcd7ca',
		);
	// }
	return $value;
}
add_filter( 'theme_mod_accent_accessible_colors', 'twentytwenty_accent_accessible_colors_fallback' );
