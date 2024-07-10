<?php
/**
 * The template to display default site footer
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0.10
 */

$chardonnay_footer_id = chardonnay_get_custom_footer_id();
$chardonnay_footer_meta = get_post_meta( $chardonnay_footer_id, 'trx_addons_options', true );
if ( ! empty( $chardonnay_footer_meta['margin'] ) ) {
	chardonnay_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( chardonnay_prepare_css_value( $chardonnay_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $chardonnay_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $chardonnay_footer_id ) ) ); ?>
						<?php
						$chardonnay_footer_scheme = chardonnay_get_theme_option( 'footer_scheme' );
						if ( ! empty( $chardonnay_footer_scheme ) && ! chardonnay_is_inherit( $chardonnay_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $chardonnay_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'chardonnay_action_show_layout', $chardonnay_footer_id );
	?>
</footer><!-- /.footer_wrap -->
