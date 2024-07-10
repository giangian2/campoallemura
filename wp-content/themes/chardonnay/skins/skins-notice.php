<?php
/**
 * The template to display Admin notices
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0.64
 */

$chardonnay_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$chardonnay_skins_args = get_query_var( 'chardonnay_skins_notice_args' );
?>
<div class="chardonnay_admin_notice chardonnay_skins_notice notice notice-info is-dismissible" data-notice="skins">
	<?php
	// Theme image
	$chardonnay_theme_img = chardonnay_get_file_url( 'screenshot.jpg' );
	if ( '' != $chardonnay_theme_img ) {
		?>
		<div class="chardonnay_notice_image"><img src="<?php echo esc_url( $chardonnay_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'chardonnay' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="chardonnay_notice_title">
		<?php esc_html_e( 'New skins are available', 'chardonnay' ); ?>
	</h3>
	<?php

	// Description
	$chardonnay_total      = $chardonnay_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$chardonnay_skins_msg  = $chardonnay_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $chardonnay_total, 'chardonnay' ), $chardonnay_total ) . '</strong>'
							: '';
	$chardonnay_total      = $chardonnay_skins_args['free'];
	$chardonnay_skins_msg .= $chardonnay_total > 0
							? ( ! empty( $chardonnay_skins_msg ) ? ' ' . esc_html__( 'and', 'chardonnay' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $chardonnay_total, 'chardonnay' ), $chardonnay_total ) . '</strong>'
							: '';
	$chardonnay_total      = $chardonnay_skins_args['pay'];
	$chardonnay_skins_msg .= $chardonnay_skins_args['pay'] > 0
							? ( ! empty( $chardonnay_skins_msg ) ? ' ' . esc_html__( 'and', 'chardonnay' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $chardonnay_total, 'chardonnay' ), $chardonnay_total ) . '</strong>'
							: '';
	?>
	<div class="chardonnay_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'chardonnay' ), $chardonnay_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="chardonnay_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $chardonnay_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'chardonnay' );
			?>
		</a>
	</div>
</div>
