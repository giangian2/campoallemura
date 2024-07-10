<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$chardonnay_copyright_scheme = chardonnay_get_theme_option( 'copyright_scheme' );
if ( ! empty( $chardonnay_copyright_scheme ) && ! chardonnay_is_inherit( $chardonnay_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $chardonnay_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$chardonnay_copyright = chardonnay_get_theme_option( 'copyright' );
			if ( ! empty( $chardonnay_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$chardonnay_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $chardonnay_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$chardonnay_copyright = chardonnay_prepare_macros( $chardonnay_copyright );
				// Display copyright
				echo wp_kses( nl2br( $chardonnay_copyright ), 'chardonnay_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
