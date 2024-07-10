<?php
/**
 * The template to display the socials in the footer
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0.10
 */


// Socials
if ( chardonnay_is_on( chardonnay_get_theme_option( 'socials_in_footer' ) ) ) {
	$chardonnay_output = chardonnay_get_socials_links();
	if ( '' != $chardonnay_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php chardonnay_show_layout( $chardonnay_output ); ?>
			</div>
		</div>
		<?php
	}
}
