<?php
/**
 *
 * @author Marcus
 *         the class used by the plugin to create shortcodes
 */
class mcjh_cta_button_manager {
	private static $buttoncounter = 0;

	function CreateButton($atts) {
		extract ( shortcode_atts ( array (
				'text' => 'Click here',
				'link' => get_bloginfo ( 'url' ),
				'color' => "green",
				'enabletracking' => 'false',
				'title' => "",
				'onclick' => "",
				'target' => "_blank",
				'css' => "",
				'tcolor' => "",
				'style' => "block left",
				'rounded' => "true"
		), $atts ) );
		$button = new mcjh_cta_button($text, $link, $color, $title, $onclick, $target, $css, $this->buttoncounter, $tcolor, $style, $rounded);
		$this->buttoncounter ++;
		return $button->draw();
	}
}

add_action ( 'init', 'mcjh_ctabutton_register_shortcode' );
function mcjh_ctabutton_register_shortcode() {

	$mcjh_cta_button = new mcjh_cta_button_manager ();
	add_shortcode ( 'createButton', array (
			$mcjh_cta_button,
			'CreateButton'
	) );
}