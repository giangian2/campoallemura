<?php
/**
 * The Header: Logo and main menu
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( chardonnay_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'chardonnay_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'chardonnay_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('chardonnay_action_body_wrap_attributes'); ?>>

		<?php do_action( 'chardonnay_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'chardonnay_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('chardonnay_action_page_wrap_attributes'); ?>>

			<?php do_action( 'chardonnay_action_page_wrap_start' ); ?>

			<?php
			$chardonnay_full_post_loading = ( chardonnay_is_singular( 'post' ) || chardonnay_is_singular( 'attachment' ) ) && chardonnay_get_value_gp( 'action' ) == 'full_post_loading';
			$chardonnay_prev_post_loading = ( chardonnay_is_singular( 'post' ) || chardonnay_is_singular( 'attachment' ) ) && chardonnay_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $chardonnay_full_post_loading && ! $chardonnay_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="chardonnay_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'chardonnay_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to content", 'chardonnay' ); ?></a>
				<?php if ( chardonnay_sidebar_present() ) { ?>
				<a class="chardonnay_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'chardonnay_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to sidebar", 'chardonnay' ); ?></a>
				<?php } ?>
				<a class="chardonnay_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="<?php echo esc_attr( apply_filters( 'chardonnay_filter_skip_links_tabindex', 1 ) ); ?>"><?php esc_html_e( "Skip to footer", 'chardonnay' ); ?></a>

				<?php
				do_action( 'chardonnay_action_before_header' );

				// Header
				$chardonnay_header_type = chardonnay_get_theme_option( 'header_type' );
				if ( 'custom' == $chardonnay_header_type && ! chardonnay_is_layouts_available() ) {
					$chardonnay_header_type = 'default';
				}
				get_template_part( apply_filters( 'chardonnay_filter_get_template_part', "templates/header-" . sanitize_file_name( $chardonnay_header_type ) ) );

				// Side menu
				if ( in_array( chardonnay_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'chardonnay_action_after_header' );

			}
			?>

			<?php do_action( 'chardonnay_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( chardonnay_is_off( chardonnay_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $chardonnay_header_type ) ) {
						$chardonnay_header_type = chardonnay_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $chardonnay_header_type && chardonnay_is_layouts_available() ) {
						$chardonnay_header_id = chardonnay_get_custom_header_id();
						if ( $chardonnay_header_id > 0 ) {
							$chardonnay_header_meta = chardonnay_get_custom_layout_meta( $chardonnay_header_id );
							if ( ! empty( $chardonnay_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$chardonnay_footer_type = chardonnay_get_theme_option( 'footer_type' );
					if ( 'custom' == $chardonnay_footer_type && chardonnay_is_layouts_available() ) {
						$chardonnay_footer_id = chardonnay_get_custom_footer_id();
						if ( $chardonnay_footer_id ) {
							$chardonnay_footer_meta = chardonnay_get_custom_layout_meta( $chardonnay_footer_id );
							if ( ! empty( $chardonnay_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'chardonnay_action_page_content_wrap_class', $chardonnay_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'chardonnay_filter_is_prev_post_loading', $chardonnay_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( chardonnay_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'chardonnay_action_page_content_wrap_data', $chardonnay_prev_post_loading );
			?>>
				<?php
				do_action( 'chardonnay_action_page_content_wrap', $chardonnay_full_post_loading || $chardonnay_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'chardonnay_filter_single_post_header', chardonnay_is_singular( 'post' ) || chardonnay_is_singular( 'attachment' ) ) ) {
					if ( $chardonnay_prev_post_loading ) {
						if ( chardonnay_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'chardonnay_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$chardonnay_path = apply_filters( 'chardonnay_filter_get_template_part', 'templates/single-styles/' . chardonnay_get_theme_option( 'single_style' ) );
					if ( chardonnay_get_file_dir( $chardonnay_path . '.php' ) != '' ) {
						get_template_part( $chardonnay_path );
					}
				}

				// Widgets area above page
				$chardonnay_body_style   = chardonnay_get_theme_option( 'body_style' );
				$chardonnay_widgets_name = chardonnay_get_theme_option( 'widgets_above_page' );
				$chardonnay_show_widgets = ! chardonnay_is_off( $chardonnay_widgets_name ) && is_active_sidebar( $chardonnay_widgets_name );
				if ( $chardonnay_show_widgets ) {
					if ( 'fullscreen' != $chardonnay_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					chardonnay_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $chardonnay_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'chardonnay_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $chardonnay_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'chardonnay_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'chardonnay_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="chardonnay_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( chardonnay_is_singular( 'post' ) || chardonnay_is_singular( 'attachment' ) )
							&& $chardonnay_prev_post_loading 
							&& chardonnay_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'chardonnay_action_between_posts' );
						}

						// Widgets area above content
						chardonnay_create_widgets_area( 'widgets_above_content' );

						do_action( 'chardonnay_action_page_content_start_text' );
