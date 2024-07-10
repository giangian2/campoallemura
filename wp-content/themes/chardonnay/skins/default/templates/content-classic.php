<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0
 */

$chardonnay_template_args = get_query_var( 'chardonnay_template_args' );

if ( is_array( $chardonnay_template_args ) ) {
	$chardonnay_columns    = empty( $chardonnay_template_args['columns'] ) ? 2 : max( 1, $chardonnay_template_args['columns'] );
	$chardonnay_blog_style = array( $chardonnay_template_args['type'], $chardonnay_columns );
    $chardonnay_columns_class = chardonnay_get_column_class( 1, $chardonnay_columns, ! empty( $chardonnay_template_args['columns_tablet']) ? $chardonnay_template_args['columns_tablet'] : '', ! empty($chardonnay_template_args['columns_mobile']) ? $chardonnay_template_args['columns_mobile'] : '' );
} else {
	$chardonnay_template_args = array();
	$chardonnay_blog_style = explode( '_', chardonnay_get_theme_option( 'blog_style' ) );
	$chardonnay_columns    = empty( $chardonnay_blog_style[1] ) ? 2 : max( 1, $chardonnay_blog_style[1] );
    $chardonnay_columns_class = chardonnay_get_column_class( 1, $chardonnay_columns );
}
$chardonnay_expanded   = ! chardonnay_sidebar_present() && chardonnay_get_theme_option( 'expand_content' ) == 'expand';

$chardonnay_post_format = get_post_format();
$chardonnay_post_format = empty( $chardonnay_post_format ) ? 'standard' : str_replace( 'post-format-', '', $chardonnay_post_format );

?><div class="<?php
	if ( ! empty( $chardonnay_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( chardonnay_is_blog_style_use_masonry( $chardonnay_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $chardonnay_columns ) : esc_attr( $chardonnay_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $chardonnay_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $chardonnay_columns )
				. ' post_layout_' . esc_attr( $chardonnay_blog_style[0] )
				. ' post_layout_' . esc_attr( $chardonnay_blog_style[0] ) . '_' . esc_attr( $chardonnay_columns )
	);
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
								: explode( ',', $chardonnay_template_args['meta_parts'] )
								)
							: chardonnay_array_get_keys_by_value( chardonnay_get_theme_option( 'meta_parts' ) );

	chardonnay_show_post_featured( apply_filters( 'chardonnay_filter_args_featured',
		array(
			'thumb_size' => ! empty( $chardonnay_template_args['thumb_size'] )
				? $chardonnay_template_args['thumb_size']
				: chardonnay_get_thumb_size(
				'classic' == $chardonnay_blog_style[0]
						? ( strpos( chardonnay_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $chardonnay_columns > 2 ? 'big' : 'huge' )
								: ( $chardonnay_columns > 2
									? ( $chardonnay_expanded ? 'square' : 'square' )
									: ($chardonnay_columns > 1 ? 'square' : ( $chardonnay_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( chardonnay_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $chardonnay_columns > 2 ? 'masonry-big' : 'full' )
								: ($chardonnay_columns === 1 ? ( $chardonnay_expanded ? 'huge' : 'big' ) : ( $chardonnay_columns <= 2 && $chardonnay_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $chardonnay_hover,
			'meta_parts' => $chardonnay_components,
			'no_links'   => ! empty( $chardonnay_template_args['no_links'] ),
        ),
        'content-classic',
        $chardonnay_template_args
    ) );

	// Title and post meta
	$chardonnay_show_title = get_the_title() != '';
	$chardonnay_show_meta  = count( $chardonnay_components ) > 0 && ! in_array( $chardonnay_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $chardonnay_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			// Post meta
			if ( apply_filters( 'chardonnay_filter_show_blog_meta', $chardonnay_show_meta, $chardonnay_components, 'classic' ) ) {
				if ( count( $chardonnay_components ) > 0 ) {
					do_action( 'chardonnay_action_before_post_meta' );
					chardonnay_show_post_meta(
						apply_filters(
							'chardonnay_filter_post_meta_args', array(
							'components' => join( ',', $chardonnay_components ),
							'seo'        => false,
							'echo'       => true,
						), $chardonnay_blog_style[0], $chardonnay_columns
						)
					);
					do_action( 'chardonnay_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'chardonnay_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'chardonnay_action_before_post_title' );
				if ( empty( $chardonnay_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'chardonnay_action_after_post_title' );
			}

			if( !in_array( $chardonnay_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'chardonnay_filter_show_blog_readmore', ! $chardonnay_show_title || ! empty( $chardonnay_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $chardonnay_template_args['no_links'] ) ) {
						do_action( 'chardonnay_action_before_post_readmore' );
						chardonnay_show_post_more_link( $chardonnay_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'chardonnay_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $chardonnay_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('chardonnay_filter_show_blog_excerpt', empty($chardonnay_template_args['hide_excerpt']) && chardonnay_get_theme_option('excerpt_length') > 0, 'classic')) {
			chardonnay_show_post_content($chardonnay_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $chardonnay_template_args['more_button'] )) {
			if ( empty( $chardonnay_template_args['no_links'] ) ) {
				do_action( 'chardonnay_action_before_post_readmore' );
				chardonnay_show_post_more_link( $chardonnay_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'chardonnay_action_after_post_readmore' );
			}
		}
		$chardonnay_content = ob_get_contents();
		ob_end_clean();
		chardonnay_show_layout($chardonnay_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
