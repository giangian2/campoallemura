<?php
/**
 * The template to display the user's avatar, bio and socials on the Author page
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.71.0
 */
?>

<div class="author_page author vcard" itemprop="author" itemscope="itemscope" itemtype="<?php echo esc_attr( chardonnay_get_protocol( true ) ); ?>//schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php
		$chardonnay_mult = chardonnay_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 120 * $chardonnay_mult );
		?>
	</div><!-- .author_avatar -->

	<h4 class="author_title" itemprop="name"><span class="fn"><?php the_author(); ?></span></h4>

	<?php
	$chardonnay_author_description = get_the_author_meta( 'description' );
	if ( ! empty( $chardonnay_author_description ) ) {
		?>
		<div class="author_bio" itemprop="description"><?php echo wp_kses( wpautop( $chardonnay_author_description ), 'chardonnay_kses_content' ); ?></div>
		<?php
	}
	?>

	<div class="author_details">
		<span class="author_posts_total">
			<?php
			$chardonnay_posts_total = count_user_posts( get_the_author_meta('ID'), 'post' );
			if ( $chardonnay_posts_total > 0 ) {
				// Translators: Add the author's posts number to the message
				echo wp_kses( sprintf( _n( '%s article published', '%s articles published', $chardonnay_posts_total, 'chardonnay' ),
										'<span class="author_posts_total_value">' . number_format_i18n( $chardonnay_posts_total ) . '</span>'
								 		),
							'chardonnay_kses_content'
							);
			} else {
				esc_html_e( 'No posts published.', 'chardonnay' );
			}
			?>
		</span><?php
			ob_start();
			do_action( 'chardonnay_action_user_meta', 'author-page' );
			$chardonnay_socials = ob_get_contents();
			ob_end_clean();
			chardonnay_show_layout( $chardonnay_socials,
				'<span class="author_socials"><span class="author_socials_caption">' . esc_html__( 'Follow:', 'chardonnay' ) . '</span>',
				'</span>'
			);
		?>
	</div><!-- .author_details -->

</div><!-- .author_page -->
