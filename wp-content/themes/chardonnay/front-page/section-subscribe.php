<div class="front_page_section front_page_section_subscribe<?php
	$chardonnay_scheme = chardonnay_get_theme_option( 'front_page_subscribe_scheme' );
	if ( ! empty( $chardonnay_scheme ) && ! chardonnay_is_inherit( $chardonnay_scheme ) ) {
		echo ' scheme_' . esc_attr( $chardonnay_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( chardonnay_get_theme_option( 'front_page_subscribe_paddings' ) );
	if ( chardonnay_get_theme_option( 'front_page_subscribe_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$chardonnay_css      = '';
		$chardonnay_bg_image = chardonnay_get_theme_option( 'front_page_subscribe_bg_image' );
		if ( ! empty( $chardonnay_bg_image ) ) {
			$chardonnay_css .= 'background-image: url(' . esc_url( chardonnay_get_attachment_url( $chardonnay_bg_image ) ) . ');';
		}
		if ( ! empty( $chardonnay_css ) ) {
			echo ' style="' . esc_attr( $chardonnay_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$chardonnay_anchor_icon = chardonnay_get_theme_option( 'front_page_subscribe_anchor_icon' );
	$chardonnay_anchor_text = chardonnay_get_theme_option( 'front_page_subscribe_anchor_text' );
if ( ( ! empty( $chardonnay_anchor_icon ) || ! empty( $chardonnay_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_subscribe"'
									. ( ! empty( $chardonnay_anchor_icon ) ? ' icon="' . esc_attr( $chardonnay_anchor_icon ) . '"' : '' )
									. ( ! empty( $chardonnay_anchor_text ) ? ' title="' . esc_attr( $chardonnay_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_subscribe_inner
	<?php
	if ( chardonnay_get_theme_option( 'front_page_subscribe_fullheight' ) ) {
		echo ' chardonnay-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$chardonnay_css      = '';
			$chardonnay_bg_mask  = chardonnay_get_theme_option( 'front_page_subscribe_bg_mask' );
			$chardonnay_bg_color_type = chardonnay_get_theme_option( 'front_page_subscribe_bg_color_type' );
			if ( 'custom' == $chardonnay_bg_color_type ) {
				$chardonnay_bg_color = chardonnay_get_theme_option( 'front_page_subscribe_bg_color' );
			} elseif ( 'scheme_bg_color' == $chardonnay_bg_color_type ) {
				$chardonnay_bg_color = chardonnay_get_scheme_color( 'bg_color', $chardonnay_scheme );
			} else {
				$chardonnay_bg_color = '';
			}
			if ( ! empty( $chardonnay_bg_color ) && $chardonnay_bg_mask > 0 ) {
				$chardonnay_css .= 'background-color: ' . esc_attr(
					1 == $chardonnay_bg_mask ? $chardonnay_bg_color : chardonnay_hex2rgba( $chardonnay_bg_color, $chardonnay_bg_mask )
				) . ';';
			}
			if ( ! empty( $chardonnay_css ) ) {
				echo ' style="' . esc_attr( $chardonnay_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_subscribe_content_wrap content_wrap">
			<?php
			// Caption
			$chardonnay_caption = chardonnay_get_theme_option( 'front_page_subscribe_caption' );
			if ( ! empty( $chardonnay_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_subscribe_caption front_page_block_<?php echo ! empty( $chardonnay_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $chardonnay_caption, 'chardonnay_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$chardonnay_description = chardonnay_get_theme_option( 'front_page_subscribe_description' );
			if ( ! empty( $chardonnay_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_subscribe_description front_page_block_<?php echo ! empty( $chardonnay_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $chardonnay_description ), 'chardonnay_kses_content' ); ?></div>
				<?php
			}

			// Content
			$chardonnay_sc = chardonnay_get_theme_option( 'front_page_subscribe_shortcode' );
			if ( ! empty( $chardonnay_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_subscribe_output front_page_block_<?php echo ! empty( $chardonnay_sc ) ? 'filled' : 'empty'; ?>">
				<?php
					chardonnay_show_layout( do_shortcode( $chardonnay_sc ) );
				?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
