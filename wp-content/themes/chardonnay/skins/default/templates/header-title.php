<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0
 */

// Page (category, tag, archive, author) title

if ( chardonnay_need_page_title() ) {
	chardonnay_sc_layouts_showed( 'title', true );
	chardonnay_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								chardonnay_show_post_meta(
									apply_filters(
										'chardonnay_filter_post_meta_args', array(
											'components' => join( ',', chardonnay_array_get_keys_by_value( chardonnay_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', chardonnay_array_get_keys_by_value( chardonnay_get_theme_option( 'counters' ) ) ),
											'seo'        => chardonnay_is_on( chardonnay_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$chardonnay_blog_title           = chardonnay_get_blog_title();
							$chardonnay_blog_title_text      = '';
							$chardonnay_blog_title_class     = '';
							$chardonnay_blog_title_link      = '';
							$chardonnay_blog_title_link_text = '';
							if ( is_array( $chardonnay_blog_title ) ) {
								$chardonnay_blog_title_text      = $chardonnay_blog_title['text'];
								$chardonnay_blog_title_class     = ! empty( $chardonnay_blog_title['class'] ) ? ' ' . $chardonnay_blog_title['class'] : '';
								$chardonnay_blog_title_link      = ! empty( $chardonnay_blog_title['link'] ) ? $chardonnay_blog_title['link'] : '';
								$chardonnay_blog_title_link_text = ! empty( $chardonnay_blog_title['link_text'] ) ? $chardonnay_blog_title['link_text'] : '';
							} else {
								$chardonnay_blog_title_text = $chardonnay_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $chardonnay_blog_title_class ); ?>">
								<?php
								$chardonnay_top_icon = chardonnay_get_term_image_small();
								if ( ! empty( $chardonnay_top_icon ) ) {
									$chardonnay_attr = chardonnay_getimagesize( $chardonnay_top_icon );
									?>
									<img src="<?php echo esc_url( $chardonnay_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'chardonnay' ); ?>"
										<?php
										if ( ! empty( $chardonnay_attr[3] ) ) {
											chardonnay_show_layout( $chardonnay_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $chardonnay_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $chardonnay_blog_title_link ) && ! empty( $chardonnay_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $chardonnay_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $chardonnay_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'chardonnay_action_breadcrumbs' );
						$chardonnay_breadcrumbs = ob_get_contents();
						ob_end_clean();
						chardonnay_show_layout( $chardonnay_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
