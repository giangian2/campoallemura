<?php
/**
 * The template to display the background video in the header
 *
 * @package CHARDONNAY
 * @since CHARDONNAY 1.0.14
 */
$chardonnay_header_video = chardonnay_get_header_video();
$chardonnay_embed_video  = '';
if ( ! empty( $chardonnay_header_video ) && ! chardonnay_is_from_uploads( $chardonnay_header_video ) ) {
	if ( chardonnay_is_youtube_url( $chardonnay_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $chardonnay_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php chardonnay_show_layout( chardonnay_get_embed_video( $chardonnay_header_video ) ); ?></div>
		<?php
	}
}
