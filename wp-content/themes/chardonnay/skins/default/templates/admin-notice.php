<?php
/**
 * The template to display Admin notices
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0.1
 */

$chardonnay_theme_slug = get_option( 'template' );
$chardonnay_theme_obj  = wp_get_theme( $chardonnay_theme_slug );
?>
<div class="chardonnay_admin_notice chardonnay_welcome_notice notice notice-info is-dismissible" data-notice="admin">
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
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'chardonnay' ),
				$chardonnay_theme_obj->get( 'Name' ) . ( CHARDONNAY_THEME_FREE ? ' ' . __( 'Free', 'chardonnay' ) : '' ),
				$chardonnay_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="chardonnay_notice_text">
		<p class="chardonnay_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $chardonnay_theme_obj->description ) );
			?>
		</p>
		<p class="chardonnay_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'chardonnay' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="chardonnay_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=chardonnay_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'chardonnay' );
			?>
		</a>
	</div>
</div>
