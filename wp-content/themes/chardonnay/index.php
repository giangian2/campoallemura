<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0
 */

$chardonnay_template = apply_filters( 'chardonnay_filter_get_template_part', chardonnay_blog_archive_get_template() );

if ( ! empty( $chardonnay_template ) && 'index' != $chardonnay_template ) {

	get_template_part( $chardonnay_template );

} else {

	chardonnay_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$chardonnay_stickies   = is_home()
								|| ( in_array( chardonnay_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) chardonnay_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$chardonnay_post_type  = chardonnay_get_theme_option( 'post_type' );
		$chardonnay_args       = array(
								'blog_style'     => chardonnay_get_theme_option( 'blog_style' ),
								'post_type'      => $chardonnay_post_type,
								'taxonomy'       => chardonnay_get_post_type_taxonomy( $chardonnay_post_type ),
								'parent_cat'     => chardonnay_get_theme_option( 'parent_cat' ),
								'posts_per_page' => chardonnay_get_theme_option( 'posts_per_page' ),
								'sticky'         => chardonnay_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $chardonnay_stickies )
															&& count( $chardonnay_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		chardonnay_blog_archive_start();

		do_action( 'chardonnay_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'chardonnay_action_before_page_author' );
			get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'chardonnay_action_after_page_author' );
		}

		if ( chardonnay_get_theme_option( 'show_filters' ) ) {
			do_action( 'chardonnay_action_before_page_filters' );
			chardonnay_show_filters( $chardonnay_args );
			do_action( 'chardonnay_action_after_page_filters' );
		} else {
			do_action( 'chardonnay_action_before_page_posts' );
			chardonnay_show_posts( array_merge( $chardonnay_args, array( 'cat' => $chardonnay_args['parent_cat'] ) ) );
			do_action( 'chardonnay_action_after_page_posts' );
		}

		do_action( 'chardonnay_action_blog_archive_end' );

		chardonnay_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
