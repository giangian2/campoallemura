<?php
// Add plugin-specific fonts to the custom CSS
if ( ! function_exists( 'chardonnay_elm_get_css' ) ) {
    add_filter( 'chardonnay_filter_get_css', 'chardonnay_elm_get_css', 10, 2 );
    function chardonnay_elm_get_css( $css, $args ) {

        if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
            $fonts         = $args['fonts'];
            $css['fonts'] .= <<<CSS
.elementor-widget-progress .elementor-title,
.elementor-widget-progress .elementor-progress-percentage,
.elementor-widget-toggle .elementor-toggle-title,
.elementor-widget-toggle .elementor-toggle-title,       
.elementor-widget-counter .elementor-counter-number-wrapper {
	{$fonts['h5_font-family']}
}
.elementor-widget-tabs .elementor-tab-title,
.elementor-widget-icon-box .elementor-widget-container .elementor-icon-box-title small {
    {$fonts['p_font-family']}
}
.custom_icon_btn.elementor-widget-button .elementor-button .elementor-button-text {
	{$fonts['button_font-family']}
}

CSS;
        }

        return $css;
    }
}


// Add theme-specific CSS-animations
if ( ! function_exists( 'chardonnay_elm_add_theme_animations' ) ) {
	add_filter( 'elementor/controls/animations/additional_animations', 'chardonnay_elm_add_theme_animations' );
	function chardonnay_elm_add_theme_animations( $animations ) {
		/* To add a theme-specific animations to the list:
			1) Merge to the array 'animations': array(
													esc_html__( 'Theme Specific', 'chardonnay' ) => array(
														'ta_custom_1' => esc_html__( 'Custom 1', 'chardonnay' )
													)
												)
			2) Add a CSS rules for the class '.ta_custom_1' to create a custom entrance animation
		*/
		$animations = array_merge(
						$animations,
						array(
							esc_html__( 'Theme Specific', 'chardonnay' ) => array(
									'ta_under_strips' => esc_html__( 'Under the strips', 'chardonnay' ),
									'chardonnay-fadeinup' => esc_html__( 'Chardonnay - Fade In Up', 'chardonnay' ),
									'chardonnay-fadeinright' => esc_html__( 'Chardonnay - Fade In Right', 'chardonnay' ),
									'chardonnay-fadeinleft' => esc_html__( 'Chardonnay - Fade In Left', 'chardonnay' ),
									'chardonnay-fadeindown' => esc_html__( 'Chardonnay - Fade In Down', 'chardonnay' ),
									'chardonnay-fadein' => esc_html__( 'Chardonnay - Fade In', 'chardonnay' ),
									'chardonnay-infinite-rotate' => esc_html__( 'Chardonnay - Infinite Rotate', 'chardonnay' ),
								)
							)
						);

		return $animations;
	}
}
