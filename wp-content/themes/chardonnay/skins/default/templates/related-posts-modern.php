<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0
 */

$chardonnay_link        = get_permalink();
$chardonnay_post_format = get_post_format();
$chardonnay_post_format = empty( $chardonnay_post_format ) ? 'standard' : str_replace( 'post-format-', '', $chardonnay_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item post_format_' . esc_attr( $chardonnay_post_format ) ); ?> data-post-id="<?php the_ID(); ?>">
	<?php
	chardonnay_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'chardonnay_filter_related_thumb_size', chardonnay_get_thumb_size( (int) chardonnay_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'big' ) ),
			'post_info'     => '<div class="post_header entry-header">'
									. '<div class="post_categories">' . wp_kses( chardonnay_get_post_categories( '' ), 'chardonnay_kses_content' ) . '</div>'
									. '<h6 class="post_title entry-title"><a href="' . esc_url( $chardonnay_link ) . '">'
										. wp_kses_data( '' == get_the_title() ? esc_html__( '- No title -', 'chardonnay' ) : get_the_title() )
									. '</a></h6>'
									. ( in_array( get_post_type(), array( 'post', 'attachment' ) )
											? '<div class="post_meta"><a href="' . esc_url( $chardonnay_link ) . '" class="post_meta_item post_date">' . wp_kses_data( chardonnay_get_date() ) . '</a></div>'
											: '' )
								. '</div>',
		)
	);
	?>
</div>
