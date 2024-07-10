<?php
/**
 * The template to display default site header
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0
 */

$chardonnay_header_css   = '';
$chardonnay_header_image = get_header_image();
$chardonnay_header_video = chardonnay_get_header_video();
if ( ! empty( $chardonnay_header_image ) && chardonnay_trx_addons_featured_image_override( is_singular() || chardonnay_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$chardonnay_header_image = chardonnay_get_current_mode_image( $chardonnay_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $chardonnay_header_image ) || ! empty( $chardonnay_header_video ) ? ' with_bg_image' : ' without_bg_image';
	if ( '' != $chardonnay_header_video ) {
		echo ' with_bg_video';
	}
	if ( '' != $chardonnay_header_image ) {
		echo ' ' . esc_attr( chardonnay_add_inline_css_class( 'background-image: url(' . esc_url( $chardonnay_header_image ) . ');' ) );
	}
	if ( is_single() && has_post_thumbnail() ) {
		echo ' with_featured_image';
	}
	if ( chardonnay_is_on( chardonnay_get_theme_option( 'header_fullheight' ) ) ) {
		echo ' header_fullheight chardonnay-full-height';
	}
	$chardonnay_header_scheme = chardonnay_get_theme_option( 'header_scheme' );
	if ( ! empty( $chardonnay_header_scheme ) && ! chardonnay_is_inherit( $chardonnay_header_scheme  ) ) {
		echo ' scheme_' . esc_attr( $chardonnay_header_scheme );
	}
	?>
">
	<?php

	// Background video
	if ( ! empty( $chardonnay_header_video ) ) {
		get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/header-navi' ) );

	// Mobile header
	if ( chardonnay_is_on( chardonnay_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	if ( ! is_single() ) {
		get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/header-title' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
