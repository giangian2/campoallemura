<?php
/**
 * Required plugins
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$chardonnay_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'chardonnay' ),
	'page_builders' => esc_html__( 'Page Builders', 'chardonnay' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'chardonnay' ),
	'socials'       => esc_html__( 'Socials and Communities', 'chardonnay' ),
	'events'        => esc_html__( 'Events and Appointments', 'chardonnay' ),
	'content'       => esc_html__( 'Content', 'chardonnay' ),
	'other'         => esc_html__( 'Other', 'chardonnay' ),
);
$chardonnay_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'chardonnay' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'chardonnay' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $chardonnay_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'chardonnay' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'chardonnay' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $chardonnay_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'chardonnay' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'chardonnay' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $chardonnay_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'chardonnay' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'chardonnay' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $chardonnay_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'chardonnay' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'chardonnay' ),
		'required'    => false,
		'logo'        => 'woocommerce.png',
		'group'       => $chardonnay_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'chardonnay' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'chardonnay' ),
		'required'    => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $chardonnay_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'chardonnay' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'chardonnay' ),
		'required'    => false,
		'logo'        => 'instagram-feed.png',
		'group'       => $chardonnay_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'chardonnay' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'chardonnay' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $chardonnay_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'chardonnay' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'booked.png',
		'group'       => $chardonnay_theme_required_plugins_groups['events'],
	),
	'quickcal'                     => array(
		'title'       => esc_html__( 'QuickCal', 'chardonnay' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'quickcal.png',
		'group'       => $chardonnay_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'chardonnay' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'the-events-calendar.png',
		'group'       => $chardonnay_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'chardonnay' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'chardonnay' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $chardonnay_theme_required_plugins_groups['content'],
	),

	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'chardonnay' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => chardonnay_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $chardonnay_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'chardonnay' ),
		'description' => '',
		'required'    => false,
		'logo'        => chardonnay_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $chardonnay_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'chardonnay' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => chardonnay_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $chardonnay_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'chardonnay' ),
		'description' => '',
		'required'    => false,
		'logo'        => chardonnay_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $chardonnay_theme_required_plugins_groups['ecommerce'],
	),
	'woo-smart-quick-view'                  => array(
		'title'       => esc_html__( 'WPC Smart Quick View for WooCommerce', 'chardonnay' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => chardonnay_get_file_url( 'plugins/woo-smart-quick-view/woo-smart-quick-view.png' ),
		'group'       => $chardonnay_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'chardonnay' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => chardonnay_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $chardonnay_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'chardonnay' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'essential-grid.png',
		'group'       => $chardonnay_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'chardonnay' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'revslider.png',
		'group'       => $chardonnay_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'chardonnay' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'chardonnay' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $chardonnay_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'chardonnay' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'chardonnay' ),
		'required'    => false,
		'install'     => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $chardonnay_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'chardonnay' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'chardonnay' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $chardonnay_theme_required_plugins_groups['other'],
	),
);

if ( CHARDONNAY_THEME_FREE ) {
	unset( $chardonnay_theme_required_plugins['js_composer'] );
	unset( $chardonnay_theme_required_plugins['booked'] );
	unset( $chardonnay_theme_required_plugins['quickcal'] );
	unset( $chardonnay_theme_required_plugins['the-events-calendar'] );
	unset( $chardonnay_theme_required_plugins['calculated-fields-form'] );
	unset( $chardonnay_theme_required_plugins['essential-grid'] );
	unset( $chardonnay_theme_required_plugins['revslider'] );
	unset( $chardonnay_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $chardonnay_theme_required_plugins['trx_updater'] );
	unset( $chardonnay_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
chardonnay_storage_set( 'required_plugins', $chardonnay_theme_required_plugins );
