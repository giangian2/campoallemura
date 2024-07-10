<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0
 */

$chardonnay_template_args = get_query_var( 'chardonnay_template_args' );
$chardonnay_columns = 1;
if ( is_array( $chardonnay_template_args ) ) {
	$chardonnay_columns    = empty( $chardonnay_template_args['columns'] ) ? 1 : max( 1, $chardonnay_template_args['columns'] );
	$chardonnay_blog_style = array( $chardonnay_template_args['type'], $chardonnay_columns );
	if ( ! empty( $chardonnay_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $chardonnay_columns > 1 ) {
	    $chardonnay_columns_class = chardonnay_get_column_class( 1, $chardonnay_columns, ! empty( $chardonnay_template_args['columns_tablet']) ? $chardonnay_template_args['columns_tablet'] : '', ! empty($chardonnay_template_args['columns_mobile']) ? $chardonnay_template_args['columns_mobile'] : '' );
		?>
		<div class="<?php echo esc_attr( $chardonnay_columns_class ); ?>">
		<?php
	}
} else {
	$chardonnay_template_args = array();
}
$chardonnay_expanded    = ! chardonnay_sidebar_present() && chardonnay_get_theme_option( 'expand_content' ) == 'expand';
$chardonnay_post_format = get_post_format();
$chardonnay_post_format = empty( $chardonnay_post_format ) ? 'standard' : str_replace( 'post-format-', '', $chardonnay_post_format );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_excerpt post_format_' . esc_attr( $chardonnay_post_format ) );
	chardonnay_add_blog_animation( $chardonnay_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$chardonnay_hover      = ! empty( $chardonnay_template_args['hover'] ) && ! chardonnay_is_inherit( $chardonnay_template_args['hover'] )
							? $chardonnay_template_args['hover']
							: chardonnay_get_theme_option( 'image_hover' );
	$chardonnay_components = ! empty( $chardonnay_template_args['meta_parts'] )
							? ( is_array( $chardonnay_template_args['meta_parts'] )
								? $chardonnay_template_args['meta_parts']
								: array_map( 'trim', explode( ',', $chardonnay_template_args['meta_parts'] ) )
								)
							: chardonnay_array_get_keys_by_value( chardonnay_get_theme_option( 'meta_parts' ) );
	chardonnay_show_post_featured( apply_filters( 'chardonnay_filter_args_featured',
		array(
			'no_links'   => ! empty( $chardonnay_template_args['no_links'] ),
			'hover'      => $chardonnay_hover,
			'meta_parts' => $chardonnay_components,
			'thumb_size' => ! empty( $chardonnay_template_args['thumb_size'] )
							? $chardonnay_template_args['thumb_size']
							: chardonnay_get_thumb_size( strpos( chardonnay_get_theme_option( 'body_style' ), 'full' ) !== false
								? 'full'
								: ( $chardonnay_expanded 
									? 'huge' 
									: 'big' 
									)
								),
		),
		'content-excerpt',
		$chardonnay_template_args
	) );

	// Title and post meta
	$chardonnay_show_title = get_the_title() != '';
	$chardonnay_show_meta  = count( $chardonnay_components ) > 0 && ! in_array( $chardonnay_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $chardonnay_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if ( apply_filters( 'chardonnay_filter_show_blog_title', true, 'excerpt' ) ) {
				do_action( 'chardonnay_action_before_post_title' );
				if ( empty( $chardonnay_template_args['no_links'] ) ) {
					the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				} else {
					the_title( '<h3 class="post_title entry-title">', '</h3>' );
				}
				do_action( 'chardonnay_action_after_post_title' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	if ( apply_filters( 'chardonnay_filter_show_blog_excerpt', empty( $chardonnay_template_args['hide_excerpt'] ) && chardonnay_get_theme_option( 'excerpt_length' ) > 0, 'excerpt' ) ) {
		?>
		<div class="post_content entry-content">
			<?php

			// Post meta
			if ( apply_filters( 'chardonnay_filter_show_blog_meta', $chardonnay_show_meta, $chardonnay_components, 'excerpt' ) ) {
				if ( count( $chardonnay_components ) > 0 ) {
					do_action( 'chardonnay_action_before_post_meta' );
					chardonnay_show_post_meta(
						apply_filters(
							'chardonnay_filter_post_meta_args', array(
								'components' => join( ',', $chardonnay_components ),
								'seo'        => false,
								'echo'       => true,
							), 'excerpt', 1
						)
					);
					do_action( 'chardonnay_action_after_post_meta' );
				}
			}

			if ( chardonnay_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'chardonnay_action_before_full_post_content' );
					the_content( '' );
					do_action( 'chardonnay_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'chardonnay' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'chardonnay' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				chardonnay_show_post_content( $chardonnay_template_args, '<div class="post_content_inner">', '</div>' );
			}

			// More button
			if ( apply_filters( 'chardonnay_filter_show_blog_readmore',  ! isset( $chardonnay_template_args['more_button'] ) || ! empty( $chardonnay_template_args['more_button'] ), 'excerpt' ) ) {
				if ( empty( $chardonnay_template_args['no_links'] ) ) {
					do_action( 'chardonnay_action_before_post_readmore' );
					if ( chardonnay_get_theme_option( 'blog_content' ) != 'fullpost' ) {
						chardonnay_show_post_more_link( $chardonnay_template_args, '<p>', '</p>' );
					} else {
						chardonnay_show_post_comments_link( $chardonnay_template_args, '<p>', '</p>' );
					}
					do_action( 'chardonnay_action_after_post_readmore' );
				}
			}

			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
</article>
<?php

if ( is_array( $chardonnay_template_args ) ) {
	if ( ! empty( $chardonnay_template_args['slider'] ) || $chardonnay_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
