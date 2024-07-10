<?php
/**
 * The template to display the main menu
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0
 */
?>
<div class="top_panel_navi sc_layouts_row sc_layouts_row_type_compact  
	<?php
	if ( chardonnay_is_on( chardonnay_get_theme_option( 'header_mobile_enabled' ) ) ) {
		?>
		sc_layouts_hide_on_mobile
		<?php
	}
	?>
">
	<div class="content_wrap_width">
		<div class="columns_wrap columns_fluid">
			<div class="sc_layouts_hide_on_mobile sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left sc_layouts_column_fluid column-2_5"><?php

				?><div class="sc_layouts_item">
					<?php
					// Main menu
					$chardonnay_menu_main = chardonnay_get_nav_menu( 'menu_main' );
					// Show any menu if no menu selected in the location 'menu_main'
					if ( chardonnay_get_theme_setting( 'autoselect_menu' ) && empty( $chardonnay_menu_main ) ) {
						$chardonnay_menu_main = chardonnay_get_nav_menu();
					}
					chardonnay_show_layout(
						$chardonnay_menu_main,
						'<nav class="menu_main_nav_area sc_layouts_menu sc_layouts_menu_default sc_layouts_hide_on_mobile"'
							. ' itemscope="itemscope" itemtype="' . esc_attr( chardonnay_get_protocol( true ) ) . '//schema.org/SiteNavigationElement"'
							. '>',
						'</nav>'
					);					
					?>					
				</div>
			</div><div class="sc_layouts_item_logo sc_layouts_column sc_layouts_column_align_center sc_layouts_column_icons_position_left sc_layouts_column_fluid column-1_5">
				<div class="sc_layouts_item">
					<?php
					// Logo
					get_template_part( apply_filters( 'chardonnay_filter_get_template_part', 'templates/header-logo' ) );
					?>
				</div>
			</div><div class="sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left sc_layouts_column_fluid column-2_5"><?php
				if ( chardonnay_exists_trx_addons() ) {
					// Display cart button
					ob_start();
					do_action( 'chardonnay_action_cart' );
					$chardonnay_action_output = ob_get_contents();
					ob_end_clean();
					if ( ! empty( $chardonnay_action_output ) ) {
						?><div class="sc_layouts_item">
							<?php
								chardonnay_show_layout( $chardonnay_action_output );
							?>
						</div><?php
					}					
					?><div class="sc_layouts_item">
						<?php
						// Display search field
						do_action(
							'chardonnay_action_search',
							array(
								'style' => 'fullscreen',
								'class' => 'header_search',
								'ajax'  => false
							)
						);
						?>
					</div><?php
				}
				?><div class="sc_layouts_item sc_layouts_hide_on_wide sc_layouts_hide_on_desktop sc_layouts_hide_on_notebook sc_layouts_hide_on_tablet">
					<div class="sc_layouts_iconed_text sc_layouts_menu_mobile_button">
						<a class="sc_layouts_item_link sc_layouts_iconed_text_link" href="#">
							<span class="sc_layouts_item_icon sc_layouts_iconed_text_icon trx_addons_icon-menu"></span>
						</a>
					</div>
				</div>
			</div>
		</div><!-- /.columns_wrap -->
	</div><!-- /.content_wrap -->
</div><!-- /.top_panel_navi -->
