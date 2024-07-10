<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0.10
 */

// Footer sidebar
$chardonnay_footer_name    = chardonnay_get_theme_option( 'footer_widgets' );
$chardonnay_footer_present = ! chardonnay_is_off( $chardonnay_footer_name ) && is_active_sidebar( $chardonnay_footer_name );
if ( $chardonnay_footer_present ) {
	chardonnay_storage_set( 'current_sidebar', 'footer' );
	$chardonnay_footer_wide = chardonnay_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $chardonnay_footer_name ) ) {
		dynamic_sidebar( $chardonnay_footer_name );
	}
	$chardonnay_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $chardonnay_out ) ) {
		$chardonnay_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $chardonnay_out );
		$chardonnay_need_columns = true;   //or check: strpos($chardonnay_out, 'columns_wrap')===false;
		if ( $chardonnay_need_columns ) {
			$chardonnay_columns = max( 0, (int) chardonnay_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $chardonnay_columns ) {
				$chardonnay_columns = min( 4, max( 1, chardonnay_tags_count( $chardonnay_out, 'aside' ) ) );
			}
			if ( $chardonnay_columns > 1 ) {
				$chardonnay_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $chardonnay_columns ) . ' widget', $chardonnay_out );
			} else {
				$chardonnay_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $chardonnay_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'chardonnay_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $chardonnay_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $chardonnay_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'chardonnay_action_before_sidebar', 'footer' );
				chardonnay_show_layout( $chardonnay_out );
				do_action( 'chardonnay_action_after_sidebar', 'footer' );
				if ( $chardonnay_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $chardonnay_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'chardonnay_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
