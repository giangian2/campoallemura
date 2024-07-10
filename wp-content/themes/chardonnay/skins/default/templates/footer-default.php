<?php
/**
 * The template to display default site footer
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$chardonnay_footer_scheme = chardonnay_get_theme_option( 'footer_scheme' );
if ( ! empty( $chardonnay_footer_scheme ) && ! chardonnay_is_inherit( $chardonnay_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $chardonnay_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
