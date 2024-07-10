<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0
 */

							do_action( 'chardonnay_action_page_content_end_text' );
							
							// Widgets area below the content
							chardonnay_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'chardonnay_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'chardonnay_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'chardonnay_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'chardonnay_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$chardonnay_body_style = chardonnay_get_theme_option( 'body_style' );
					$chardonnay_widgets_name = chardonnay_get_theme_option( 'widgets_below_page' );
					$chardonnay_show_widgets = ! chardonnay_is_off( $chardonnay_widgets_name ) && is_active_sidebar( $chardonnay_widgets_name );
					$chardonnay_show_related = chardonnay_is_single() && chardonnay_get_theme_option( 'related_position' ) == 'below_page';
					if ( $chardonnay_show_widgets || $chardonnay_show_related ) {
						if ( 'fullscreen' != $chardonnay_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $chardonnay_show_related ) {
							do_action( 'chardonnay_action_related_posts' );
						}

						// Widgets area below page content
						if ( $chardonnay_show_widgets ) {
							chardonnay_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $chardonnay_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'chardonnay_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'chardonnay_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! chardonnay_is_singular( 'post' ) && ! chardonnay_is_singular( 'attachment' ) ) || ! in_array ( chardonnay_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="chardonnay_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'chardonnay_action_before_footer' );

				// Footer
				$chardonnay_footer_type = chardonnay_get_theme_option( 'footer_type' );
				if ( 'custom' == $chardonnay_footer_type && ! chardonnay_is_layouts_available() ) {
					$chardonnay_footer_type = 'default';
				}
				get_template_part( apply_filters( 'chardonnay_filter_get_template_part', "templates/footer-" . sanitize_file_name( $chardonnay_footer_type ) ) );

				do_action( 'chardonnay_action_after_footer' );

			}
			?>

			<?php do_action( 'chardonnay_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'chardonnay_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'chardonnay_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>