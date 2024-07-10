<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0.50
 */

$chardonnay_template_args = get_query_var( 'chardonnay_template_args' );
if ( is_array( $chardonnay_template_args ) ) {
	$chardonnay_columns    = empty( $chardonnay_template_args['columns'] ) ? 2 : max( 1, $chardonnay_template_args['columns'] );
	$chardonnay_blog_style = array( $chardonnay_template_args['type'], $chardonnay_columns );
} else {
	$chardonnay_template_args = array();
	$chardonnay_blog_style = explode( '_', chardonnay_get_theme_option( 'blog_style' ) );
	$chardonnay_columns    = empty( $chardonnay_blog_style[1] ) ? 2 : max( 1, $chardonnay_blog_style[1] );
}
$chardonnay_blog_id       = chardonnay_get_custom_blog_id( join( '_', $chardonnay_blog_style ) );
$chardonnay_blog_style[0] = str_replace( 'blog-custom-', '', $chardonnay_blog_style[0] );
$chardonnay_expanded      = ! chardonnay_sidebar_present() && chardonnay_get_theme_option( 'expand_content' ) == 'expand';
$chardonnay_components    = ! empty( $chardonnay_template_args['meta_parts'] )
							? ( is_array( $chardonnay_template_args['meta_parts'] )
								? join( ',', $chardonnay_template_args['meta_parts'] )
								: $chardonnay_template_args['meta_parts']
								)
							: chardonnay_array_get_keys_by_value( chardonnay_get_theme_option( 'meta_parts' ) );
$chardonnay_post_format   = get_post_format();
$chardonnay_post_format   = empty( $chardonnay_post_format ) ? 'standard' : str_replace( 'post-format-', '', $chardonnay_post_format );

$chardonnay_blog_meta     = chardonnay_get_custom_layout_meta( $chardonnay_blog_id );
$chardonnay_custom_style  = ! empty( $chardonnay_blog_meta['scripts_required'] ) ? $chardonnay_blog_meta['scripts_required'] : 'none';

if ( ! empty( $chardonnay_template_args['slider'] ) || $chardonnay_columns > 1 || ! chardonnay_is_off( $chardonnay_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $chardonnay_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( chardonnay_is_off( $chardonnay_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $chardonnay_custom_style ) ) . "-1_{$chardonnay_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $chardonnay_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $chardonnay_columns )
					. ' post_layout_' . esc_attr( $chardonnay_blog_style[0] )
					. ' post_layout_' . esc_attr( $chardonnay_blog_style[0] ) . '_' . esc_attr( $chardonnay_columns )
					. ( ! chardonnay_is_off( $chardonnay_custom_style )
						? ' post_layout_' . esc_attr( $chardonnay_custom_style )
							. ' post_layout_' . esc_attr( $chardonnay_custom_style ) . '_' . esc_attr( $chardonnay_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'chardonnay_action_show_layout', $chardonnay_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $chardonnay_template_args['slider'] ) || $chardonnay_columns > 1 || ! chardonnay_is_off( $chardonnay_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
