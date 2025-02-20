<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'chardonnay_advanced_popups_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'chardonnay_advanced_popups_theme_setup9', 9 );
    function chardonnay_advanced_popups_theme_setup9() {
        if ( is_admin() ) {
            add_filter( 'chardonnay_filter_tgmpa_required_plugins', 'chardonnay_advanced_popups_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'chardonnay_advanced_popups_tgmpa_required_plugins' ) ) {    
    function chardonnay_advanced_popups_tgmpa_required_plugins( $list = array() ) {
        if ( chardonnay_storage_isset( 'required_plugins', 'advanced-popups' ) && chardonnay_storage_get_array( 'required_plugins', 'advanced-popups', 'install' ) !== false ) {
            $list[] = array(
                'name'     => chardonnay_storage_get_array( 'required_plugins', 'advanced-popups', 'title' ),
                'slug'     => 'advanced-popups',
                'required' => false,
            );
        }
        return $list;
    }
}

// Check if plugin installed and activated
if ( ! function_exists( 'chardonnay_exists_advanced_popups' ) ) {
    function chardonnay_exists_advanced_popups() {
        return function_exists('adp_init');
    }
}
