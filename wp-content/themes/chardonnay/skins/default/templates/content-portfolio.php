<?php
/**
 * The Portfolio template to display the content
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

$chardonnay_post_format = get_post_format();
$chardonnay_post_format = empty( $chardonnay_post_format ) ? 'standard' : str_replace( 'post-format-', '', $chardonnay_post_format );

?><div class="
<?php
if ( ! empty( $chardonnay_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( chardonnay_is_blog_style_use_masonry( $chardonnay_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $chardonnay_columns ) : esc_attr( $chardonnay_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $chardonnay_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $chardonnay_columns )
		. ( 'portfolio' != $chardonnay_blog_style[0] ? ' ' . esc_attr( $chardonnay_blog_style[0] )  . '_' . esc_attr( $chardonnay_columns ) : '' )
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

	$chardonnay_hover   = ! empty( $chardonnay_template_args['hover'] ) && ! chardonnay_is_inherit( $chardonnay_template_args['hover'] )
								? $chardonnay_template_args['hover']
								: chardonnay_get_theme_option( 'image_hover' );

	if ( 'dots' == $chardonnay_hover ) {
		$chardonnay_post_link = empty( $chardonnay_template_args['no_links'] )
								? ( ! empty( $chardonnay_template_args['link'] )
									? $chardonnay_template_args['link']
									: get_permalink()
									)
								: '';
		$chardonnay_target    = ! empty( $chardonnay_post_link ) && false === strpos( $chardonnay_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$chardonnay_components = ! empty( $chardonnay_template_args['meta_parts'] )
							? ( is_array( $chardonnay_template_args['meta_parts'] )
								? $chardonnay_template_args['meta_parts']
								: explode( ',', $chardonnay_template_args['meta_parts'] )
								)
							: chardonnay_array_get_keys_by_value( chardonnay_get_theme_option( 'meta_parts' ) );

	// Featured image
	chardonnay_show_post_featured( apply_filters( 'chardonnay_filter_args_featured',
		array(
			'hover'         => $chardonnay_hover,
			'no_links'      => ! empty( $chardonnay_template_args['no_links'] ),
			'thumb_size'    => ! empty( $chardonnay_template_args['thumb_size'] )
								? $chardonnay_template_args['thumb_size']
								: chardonnay_get_thumb_size(
									chardonnay_is_blog_style_use_masonry( $chardonnay_blog_style[0] )
										? (	strpos( chardonnay_get_theme_option( 'body_style' ), 'full' ) !== false || $chardonnay_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( chardonnay_get_theme_option( 'body_style' ), 'full' ) !== false || $chardonnay_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => chardonnay_is_blog_style_use_masonry( $chardonnay_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $chardonnay_components,
			'class'         => 'dots' == $chardonnay_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $chardonnay_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $chardonnay_post_link )
												? '<a href="' . esc_url( $chardonnay_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $chardonnay_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $chardonnay_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $chardonnay_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!