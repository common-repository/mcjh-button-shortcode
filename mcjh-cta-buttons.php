<?php
defined ( 'ABSPATH' ) or die ( "No script kiddies please!" );
/*
 * Plugin Name: mcjh Shortcode Buttons
 * Plugin URI: https://www.mcjh-medien.de/cta-button-shortcode/
 * Description: Vielfältige Buttons erstellen, ausschließlich durch Shortcodes
 * Version: 1.6.4
 * Author: Marcus C. J. Hartmann
 * Author URI: http://www.mcjh-medien.de/
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mcjh-cta-buttons
 * Domain Path: /lang
 * Copyright 2014-2017 Marcus C. J. Hartmann (email : info@mcjh-medien.de)
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */

function mcjh_ctabutton_load_textdomain() {
	load_plugin_textdomain ( 'mcjh-cta-buttons', false, dirname ( plugin_basename ( __FILE__ ) ) . '/lang/' );
}
add_action ( 'plugins_loaded', 'mcjh_ctabutton_load_textdomain' );

include( 'inc/mcjh-cta-script-loader.php');
include("inc/mcjh-cta-color-calculating.php");
include("inc/mcjh-cta-button-class.php");
include("inc/mcjh-cta-admin-page.php");
include( 'inc/mcjh-cta-shortcode.php');
include("inc/mcjh-cta-backend-ajax.php");