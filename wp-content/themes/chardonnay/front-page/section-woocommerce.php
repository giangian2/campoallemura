<?php
$chardonnay_woocommerce_sc = chardonnay_get_theme_option( 'front_page_woocommerce_products' );
if ( ! empty( $chardonnay_woocommerce_sc ) ) {
	?><div class="front_page_section front_page_section_woocommerce<?php
		$chardonnay_scheme = chardonnay_get_theme_option( 'front_page_woocommerce_scheme' );
		if ( ! empty( $chardonnay_scheme ) && ! chardonnay_is_inherit( $chardonnay_scheme ) ) {
			echo ' scheme_' . esc_attr( $chardonnay_scheme );
		}
		echo ' front_page_section_paddings_' . esc_attr( chardonnay_get_theme_option( 'front_page_woocommerce_paddings' ) );
		if ( chardonnay_get_theme_option( 'front_page_woocommerce_stack' ) ) {
			echo ' sc_stack_section_on';
		}
	?>"
			<?php
			$chardonnay_css      = '';
			$chardonnay_bg_image = chardonnay_get_theme_option( 'front_page_woocommerce_bg_image' );
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
		$chardonnay_anchor_icon = chardonnay_get_theme_option( 'front_page_woocommerce_anchor_icon' );
		$chardonnay_anchor_text = chardonnay_get_theme_option( 'front_page_woocommerce_anchor_text' );
		if ( ( ! empty( $chardonnay_anchor_icon ) || ! empty( $chardonnay_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
			echo do_shortcode(
				'[trx_sc_anchor id="front_page_section_woocommerce"'
											. ( ! empty( $chardonnay_anchor_icon ) ? ' icon="' . esc_attr( $chardonnay_anchor_icon ) . '"' : '' )
											. ( ! empty( $chardonnay_anchor_text ) ? ' title="' . esc_attr( $chardonnay_anchor_text ) . '"' : '' )
											. ']'
			);
		}
	?>
		<div class="front_page_section_inner front_page_section_woocommerce_inner
			<?php
			if ( chardonnay_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
				echo ' chardonnay-full-height sc_layouts_flex sc_layouts_columns_middle';
			}
			?>
				"
				<?php
				$chardonnay_css      = '';
				$chardonnay_bg_mask  = chardonnay_get_theme_option( 'front_page_woocommerce_bg_mask' );
				$chardonnay_bg_color_type = chardonnay_get_theme_option( 'front_page_woocommerce_bg_color_type' );
				if ( 'custom' == $chardonnay_bg_color_type ) {
					$chardonnay_bg_color = chardonnay_get_theme_option( 'front_page_woocommerce_bg_color' );
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
			<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
				<?php
				// Content wrap with title and description
				$chardonnay_caption     = chardonnay_get_theme_option( 'front_page_woocommerce_caption' );
				$chardonnay_description = chardonnay_get_theme_option( 'front_page_woocommerce_description' );
				if ( ! empty( $chardonnay_caption ) || ! empty( $chardonnay_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					// Caption
					if ( ! empty( $chardonnay_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $chardonnay_caption ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( $chardonnay_caption, 'chardonnay_kses_content' );
						?>
						</h2>
						<?php
					}

					// Description (text)
					if ( ! empty( $chardonnay_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $chardonnay_description ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( wpautop( $chardonnay_description ), 'chardonnay_kses_content' );
						?>
						</div>
						<?php
					}
				}

				// Content (widgets)
				?>
				<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
					<?php
					if ( 'products' == $chardonnay_woocommerce_sc ) {
						$chardonnay_woocommerce_sc_ids      = chardonnay_get_theme_option( 'front_page_woocommerce_products_per_page' );
						$chardonnay_woocommerce_sc_per_page = count( explode( ',', $chardonnay_woocommerce_sc_ids ) );
					} else {
						$chardonnay_woocommerce_sc_per_page = max( 1, (int) chardonnay_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
					}
					$chardonnay_woocommerce_sc_columns = max( 1, min( $chardonnay_woocommerce_sc_per_page, (int) chardonnay_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
					echo do_shortcode(
						"[{$chardonnay_woocommerce_sc}"
										. ( 'products' == $chardonnay_woocommerce_sc
												? ' ids="' . esc_attr( $chardonnay_woocommerce_sc_ids ) . '"'
												: '' )
										. ( 'product_category' == $chardonnay_woocommerce_sc
												? ' category="' . esc_attr( chardonnay_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
												: '' )
										. ( 'best_selling_products' != $chardonnay_woocommerce_sc
												? ' orderby="' . esc_attr( chardonnay_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
													. ' order="' . esc_attr( chardonnay_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
												: '' )
										. ' per_page="' . esc_attr( $chardonnay_woocommerce_sc_per_page ) . '"'
										. ' columns="' . esc_attr( $chardonnay_woocommerce_sc_columns ) . '"'
						. ']'
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
