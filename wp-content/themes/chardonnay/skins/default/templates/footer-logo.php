<?php
/**
 * The template to display the site logo in the footer
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0.10
 */

// Logo
if ( chardonnay_is_on( chardonnay_get_theme_option( 'logo_in_footer' ) ) ) {
	$chardonnay_logo_image = chardonnay_get_logo_image( 'footer' );
	$chardonnay_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $chardonnay_logo_image['logo'] ) || ! empty( $chardonnay_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $chardonnay_logo_image['logo'] ) ) {
					$chardonnay_attr = chardonnay_getimagesize( $chardonnay_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $chardonnay_logo_image['logo'] ) . '"'
								. ( ! empty( $chardonnay_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $chardonnay_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'chardonnay' ) . '"'
								. ( ! empty( $chardonnay_attr[3] ) ? ' ' . wp_kses_data( $chardonnay_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $chardonnay_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $chardonnay_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
