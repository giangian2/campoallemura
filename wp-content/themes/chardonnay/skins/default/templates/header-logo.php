<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0
 */

$chardonnay_args = get_query_var( 'chardonnay_logo_args' );

// Site logo
$chardonnay_logo_type   = isset( $chardonnay_args['type'] ) ? $chardonnay_args['type'] : '';
$chardonnay_logo_image  = chardonnay_get_logo_image( $chardonnay_logo_type );
$chardonnay_logo_text   = chardonnay_is_on( chardonnay_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$chardonnay_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $chardonnay_logo_image['logo'] ) || ! empty( $chardonnay_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $chardonnay_logo_image['logo'] ) ) {
			if ( empty( $chardonnay_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric($chardonnay_logo_image['logo']) && (int) $chardonnay_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$chardonnay_attr = chardonnay_getimagesize( $chardonnay_logo_image['logo'] );
				echo '<img src="' . esc_url( $chardonnay_logo_image['logo'] ) . '"'
						. ( ! empty( $chardonnay_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $chardonnay_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $chardonnay_logo_text ) . '"'
						. ( ! empty( $chardonnay_attr[3] ) ? ' ' . wp_kses_data( $chardonnay_attr[3] ) : '' )
						. '>';
			}
		} else {
			chardonnay_show_layout( chardonnay_prepare_macros( $chardonnay_logo_text ), '<span class="logo_text">', '</span>' );
			chardonnay_show_layout( chardonnay_prepare_macros( $chardonnay_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
