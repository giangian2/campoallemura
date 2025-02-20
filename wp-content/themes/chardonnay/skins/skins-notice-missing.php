<?php
/**
 * The template to display Admin notices
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.98.0
 */

$chardonnay_skins_url   = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$chardonnay_active_skin = chardonnay_skins_get_active_skin_name();
?>
<div class="chardonnay_admin_notice chardonnay_skins_notice notice notice-error">
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
		<?php esc_html_e( 'Active skin is missing!', 'chardonnay' ); ?>
	</h3>
	<div class="chardonnay_notice_text">
		<p>
			<?php
			// Translators: Add a current skin name to the message
			echo wp_kses_data( sprintf( __( "Your active skin <b>'%s'</b> is missing. Usually this happens when the theme is updated directly through the server or FTP.", 'chardonnay' ), ucfirst( $chardonnay_active_skin ) ) );
			?>
		</p>
		<p>
			<?php
			echo wp_kses_data( __( "Please use only <b>'ThemeREX Updater v.1.6.0+'</b> plugin for your future updates.", 'chardonnay' ) );
			?>
		</p>
		<p>
			<?php
			echo wp_kses_data( __( "But no worries! You can re-download the skin via 'Skins Manager' ( Theme Panel - Theme Dashboard - Skins ).", 'chardonnay' ) );
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
