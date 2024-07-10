<?php
/**
 * The template to display the widgets area in the header
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0
 */

// Header sidebar
$chardonnay_header_name    = chardonnay_get_theme_option( 'header_widgets' );
$chardonnay_header_present = ! chardonnay_is_off( $chardonnay_header_name ) && is_active_sidebar( $chardonnay_header_name );
if ( $chardonnay_header_present ) {
	chardonnay_storage_set( 'current_sidebar', 'header' );
	$chardonnay_header_wide = chardonnay_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $chardonnay_header_name ) ) {
		dynamic_sidebar( $chardonnay_header_name );
	}
	$chardonnay_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $chardonnay_widgets_output ) ) {
		$chardonnay_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $chardonnay_widgets_output );
		$chardonnay_need_columns   = strpos( $chardonnay_widgets_output, 'columns_wrap' ) === false;
		if ( $chardonnay_need_columns ) {
			$chardonnay_columns = max( 0, (int) chardonnay_get_theme_option( 'header_columns' ) );
			if ( 0 == $chardonnay_columns ) {
				$chardonnay_columns = min( 6, max( 1, chardonnay_tags_count( $chardonnay_widgets_output, 'aside' ) ) );
			}
			if ( $chardonnay_columns > 1 ) {
				$chardonnay_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $chardonnay_columns ) . ' widget', $chardonnay_widgets_output );
			} else {
				$chardonnay_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $chardonnay_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'chardonnay_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $chardonnay_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $chardonnay_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'chardonnay_action_before_sidebar', 'header' );
				chardonnay_show_layout( $chardonnay_widgets_output );
				do_action( 'chardonnay_action_after_sidebar', 'header' );
				if ( $chardonnay_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $chardonnay_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'chardonnay_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
