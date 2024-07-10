<?php
/**
 * The template 'Style 5' to displaying related posts
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0.54
 */

$chardonnay_link        = get_permalink();
$chardonnay_post_format = get_post_format();
$chardonnay_post_format = empty( $chardonnay_post_format ) ? 'standard' : str_replace( 'post-format-', '', $chardonnay_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item post_format_' . esc_attr( $chardonnay_post_format ) ); ?> data-post-id="<?php the_ID(); ?>">
	<?php
	chardonnay_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'chardonnay_filter_related_thumb_size', chardonnay_get_thumb_size( (int) chardonnay_get_theme_option( 'related_posts' ) == 1 ? 'big' : 'med' ) ),
		)
	);
	?>
	<div class="post_header entry-header">
		<h6 class="post_title entry-title"><a href="<?php echo esc_url( $chardonnay_link ); ?>"><?php
			if ( '' == get_the_title() ) {
				esc_html_e( '- No title -', 'chardonnay' );
			} else {
				the_title();
			}
		?></a></h6>
		<?php
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			?>
			<div class="post_meta">
				<a href="<?php echo esc_url( $chardonnay_link ); ?>" class="post_meta_item post_date"><?php echo wp_kses_data( chardonnay_get_date() ); ?></a>
			</div>
			<?php
		}
		?>
	</div>
</div>
