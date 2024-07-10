<div class="front_page_section front_page_section_googlemap<?php
	$chardonnay_scheme = chardonnay_get_theme_option( 'front_page_googlemap_scheme' );
	if ( ! empty( $chardonnay_scheme ) && ! chardonnay_is_inherit( $chardonnay_scheme ) ) {
		echo ' scheme_' . esc_attr( $chardonnay_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( chardonnay_get_theme_option( 'front_page_googlemap_paddings' ) );
	if ( chardonnay_get_theme_option( 'front_page_googlemap_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$chardonnay_css      = '';
		$chardonnay_bg_image = chardonnay_get_theme_option( 'front_page_googlemap_bg_image' );
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
	$chardonnay_anchor_icon = chardonnay_get_theme_option( 'front_page_googlemap_anchor_icon' );
	$chardonnay_anchor_text = chardonnay_get_theme_option( 'front_page_googlemap_anchor_text' );
if ( ( ! empty( $chardonnay_anchor_icon ) || ! empty( $chardonnay_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_googlemap"'
									. ( ! empty( $chardonnay_anchor_icon ) ? ' icon="' . esc_attr( $chardonnay_anchor_icon ) . '"' : '' )
									. ( ! empty( $chardonnay_anchor_text ) ? ' title="' . esc_attr( $chardonnay_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_googlemap_inner
		<?php
		$chardonnay_layout = chardonnay_get_theme_option( 'front_page_googlemap_layout' );
		echo ' front_page_section_layout_' . esc_attr( $chardonnay_layout );
		if ( chardonnay_get_theme_option( 'front_page_googlemap_fullheight' ) ) {
			echo ' chardonnay-full-height sc_layouts_flex sc_layouts_columns_middle';
		}
		?>
		"
			<?php
			$chardonnay_css      = '';
			$chardonnay_bg_mask  = chardonnay_get_theme_option( 'front_page_googlemap_bg_mask' );
			$chardonnay_bg_color_type = chardonnay_get_theme_option( 'front_page_googlemap_bg_color_type' );
			if ( 'custom' == $chardonnay_bg_color_type ) {
				$chardonnay_bg_color = chardonnay_get_theme_option( 'front_page_googlemap_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap
		<?php
		if ( 'fullwidth' != $chardonnay_layout ) {
			echo ' content_wrap';
		}
		?>
		">
			<?php
			// Content wrap with title and description
			$chardonnay_caption     = chardonnay_get_theme_option( 'front_page_googlemap_caption' );
			$chardonnay_description = chardonnay_get_theme_option( 'front_page_googlemap_description' );
			if ( ! empty( $chardonnay_caption ) || ! empty( $chardonnay_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'fullwidth' == $chardonnay_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}
					// Caption
				if ( ! empty( $chardonnay_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo ! empty( $chardonnay_caption ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $chardonnay_caption, 'chardonnay_kses_content' );
					?>
					</h2>
					<?php
				}

					// Description (text)
				if ( ! empty( $chardonnay_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo ! empty( $chardonnay_description ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( wpautop( $chardonnay_description ), 'chardonnay_kses_content' );
					?>
					</div>
					<?php
				}
				if ( 'fullwidth' == $chardonnay_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$chardonnay_content = chardonnay_get_theme_option( 'front_page_googlemap_content' );
			if ( ! empty( $chardonnay_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'columns' == $chardonnay_layout ) {
					?>
					<div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} elseif ( 'fullwidth' == $chardonnay_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}

				?>
				<div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo ! empty( $chardonnay_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $chardonnay_content, 'chardonnay_kses_content' );
				?>
				</div>
				<?php

				if ( 'columns' == $chardonnay_layout ) {
					?>
					</div><div class="column-2_3">
					<?php
				} elseif ( 'fullwidth' == $chardonnay_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Widgets output
			?>
			<div class="front_page_section_output front_page_section_googlemap_output">
				<?php
				if ( is_active_sidebar( 'front_page_googlemap_widgets' ) ) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! chardonnay_exists_trx_addons() ) {
						chardonnay_customizer_need_trx_addons_message();
					} else {
						chardonnay_customizer_need_widgets_message( 'front_page_googlemap_caption', 'ThemeREX Addons - Google map' );
					}
				}
				?>
			</div>
			<?php

			if ( 'columns' == $chardonnay_layout && ( ! empty( $chardonnay_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>
		</div>
	</div>
</div>
