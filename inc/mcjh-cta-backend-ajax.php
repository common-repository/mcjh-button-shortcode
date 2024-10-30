<?php

if (is_admin ())
	add_action ( 'init', function () {
		mcjh_register_button_shortcode_ajax ( 'mcjh_execute_button_shortcode', 'mcjh_execute_button_shortcode' );
	} );
		function mcjh_register_button_shortcode_ajax($callable, $action) {
			if (empty ( $_POST ['action'] ) || $_POST ['action'] != $action)
				return;

				call_user_func ( $callable );
		}
		function mcjh_execute_button_shortcode() {
			if (isset ( $_POST ['cta_button_shortcode'] )) {
				$string = str_replace ( "%20", " ", $_POST ['cta_button_shortcode'] );
				$string = stripslashes ( $string );
				echo do_shortcode ( $string );
			}
			wp_die ();
		}