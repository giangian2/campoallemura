<?php
/**
 * The template to display single post
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0
 */

// Full post loading
$full_post_loading          = chardonnay_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = chardonnay_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = chardonnay_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$chardonnay_related_position   = chardonnay_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$chardonnay_posts_navigation   = chardonnay_get_theme_option( 'posts_navigation' );
$chardonnay_prev_post          = false;
$chardonnay_prev_post_same_cat = chardonnay_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( chardonnay_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	chardonnay_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'chardonnay_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $chardonnay_posts_navigation ) {
		$chardonnay_prev_post = get_previous_post( $chardonnay_prev_post_same_cat );  // Get post from same category
		if ( ! $chardonnay_prev_post && $chardonnay_prev_post_same_cat ) {
			$chardonnay_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $chardonnay_prev_post ) {
			$chardonnay_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $chardonnay_prev_post ) ) {
		chardonnay_sc_layouts_showed( 'featured', false );
		chardonnay_sc_layouts_showed( 'title', false );
		chardonnay_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $chardonnay_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/content', 'single-' . chardonnay_get_theme_option( 'single_style' ) ), 'single-' . chardonnay_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $chardonnay_related_position, 'inside' ) === 0 ) {
		$chardonnay_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'chardonnay_action_related_posts' );
		$chardonnay_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $chardonnay_related_content ) ) {
			$chardonnay_related_position_inside = max( 0, min( 9, chardonnay_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $chardonnay_related_position_inside ) {
				$chardonnay_related_position_inside = mt_rand( 1, 9 );
			}

			$chardonnay_p_number         = 0;
			$chardonnay_related_inserted = false;
			$chardonnay_in_block         = false;
			$chardonnay_content_start    = strpos( $chardonnay_content, '<div class="post_content' );
			$chardonnay_content_end      = strrpos( $chardonnay_content, '</div>' );

			for ( $i = max( 0, $chardonnay_content_start ); $i < min( strlen( $chardonnay_content ) - 3, $chardonnay_content_end ); $i++ ) {
				if ( $chardonnay_content[ $i ] != '<' ) {
					continue;
				}
				if ( $chardonnay_in_block ) {
					if ( strtolower( substr( $chardonnay_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$chardonnay_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $chardonnay_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $chardonnay_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$chardonnay_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $chardonnay_content[ $i + 1 ] && in_array( $chardonnay_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$chardonnay_p_number++;
					if ( $chardonnay_related_position_inside == $chardonnay_p_number ) {
						$chardonnay_related_inserted = true;
						$chardonnay_content = ( $i > 0 ? substr( $chardonnay_content, 0, $i ) : '' )
											. $chardonnay_related_content
											. substr( $chardonnay_content, $i );
					}
				}
			}
			if ( ! $chardonnay_related_inserted ) {
				if ( $chardonnay_content_end > 0 ) {
					$chardonnay_content = substr( $chardonnay_content, 0, $chardonnay_content_end ) . $chardonnay_related_content . substr( $chardonnay_content, $chardonnay_content_end );
				} else {
					$chardonnay_content .= $chardonnay_related_content;
				}
			}
		}

		chardonnay_show_layout( $chardonnay_content );
	}

	// Comments
	do_action( 'chardonnay_action_before_comments' );
	comments_template();
	do_action( 'chardonnay_action_after_comments' );

	// Related posts
	if ( 'below_content' == $chardonnay_related_position
		&& ( 'scroll' != $chardonnay_posts_navigation || chardonnay_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || chardonnay_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'chardonnay_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $chardonnay_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $chardonnay_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $chardonnay_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $chardonnay_prev_post ) ); ?>"
			<?php do_action( 'chardonnay_action_nav_links_single_scroll_data', $chardonnay_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
