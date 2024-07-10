<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0
 */

if ( chardonnay_sidebar_present() ) {
	
	$chardonnay_sidebar_type = chardonnay_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $chardonnay_sidebar_type && ! chardonnay_is_layouts_available() ) {
		$chardonnay_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $chardonnay_sidebar_type ) {
		// Default sidebar with widgets
		$chardonnay_sidebar_name = chardonnay_get_theme_option( 'sidebar_widgets' );
		chardonnay_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $chardonnay_sidebar_name ) ) {
			dynamic_sidebar( $chardonnay_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$chardonnay_sidebar_id = chardonnay_get_custom_sidebar_id();
		do_action( 'chardonnay_action_show_layout', $chardonnay_sidebar_id );
	}
	$chardonnay_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $chardonnay_out ) ) {
		$chardonnay_sidebar_position    = chardonnay_get_theme_option( 'sidebar_position' );
		$chardonnay_sidebar_position_ss = chardonnay_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $chardonnay_sidebar_position );
			echo ' sidebar_' . esc_attr( $chardonnay_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $chardonnay_sidebar_type );

			$chardonnay_sidebar_scheme = apply_filters( 'chardonnay_filter_sidebar_scheme', chardonnay_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $chardonnay_sidebar_scheme ) && ! chardonnay_is_inherit( $chardonnay_sidebar_scheme ) && 'custom' != $chardonnay_sidebar_type ) {
				echo ' scheme_' . esc_attr( $chardonnay_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="chardonnay_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'chardonnay_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $chardonnay_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$chardonnay_title = apply_filters( 'chardonnay_filter_sidebar_control_title', 'float' == $chardonnay_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'chardonnay' ) : '' );
				$chardonnay_text  = apply_filters( 'chardonnay_filter_sidebar_control_text', 'above' == $chardonnay_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'chardonnay' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $chardonnay_title ); ?>"><?php echo esc_html( $chardonnay_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'chardonnay_action_before_sidebar', 'sidebar' );
				chardonnay_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $chardonnay_out ) );
				do_action( 'chardonnay_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'chardonnay_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
