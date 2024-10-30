<?php
add_action ( 'wp_enqueue_scripts', 'mcjh_ctabutton_enqueue_scripts' );
function mcjh_ctabutton_enqueue_scripts() {
	wp_enqueue_style ( 'mcjh-cta-buttons', str_replace("inc/","",plugin_dir_url (  __FILE__ )).'src/css/mcjh-ctabutton-plugin.css', 'all' );
	wp_enqueue_style ( 'dashicons' );
}
/* --------------------------------- Add CSS to admin ---------------------------------- */
add_action ( 'admin_enqueue_scripts', 'mcjh_ctabutton_enqueue_admin_scripts' );
function mcjh_ctabutton_enqueue_admin_scripts() {
	
	wp_enqueue_style ( 'mcjh-cta-buttons', str_replace("inc/","",plugin_dir_url (  __FILE__ )).'src/css/mcjh-ctabutton-plugin.css', 'all' );
	wp_enqueue_style ( 'mcjh-cta-buttons-admin', str_replace("inc/","",plugin_dir_url (  __FILE__ )).'src/css/mcjh-ctabutton-plugin-admin.css', 'all' );
	wp_enqueue_style ( 'color-picker-css', str_replace("inc/","",plugin_dir_url (  __FILE__ )).'src/colorpicker/css/colorpicker.css', 'all' );
	wp_enqueue_script ( "color-picker", str_replace("inc/","",plugin_dir_url (  __FILE__ )).'src/colorpicker/js/colorpicker.js', array (
			"jquery"
	) );

	wp_enqueue_script ( "ajax-script", str_replace("inc/","",plugin_dir_url (  __FILE__ )).'src/js/script.js', array (
			"jquery",
			"color-picker"
	) );
	wp_localize_script ( 'ajax-script', 'ajax_object', array (
			'ajax_url' => admin_url ( 'admin-ajax.php' )
	) );
}