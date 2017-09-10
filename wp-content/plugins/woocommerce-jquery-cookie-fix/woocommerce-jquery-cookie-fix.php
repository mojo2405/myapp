<?php
/*
Plugin Name: WooCommerce jQuery Cookie Fix
Plugin URI: http://royho.me
Description: Due to hosting companies using outdated mod_security ruleset, some sites are having trouble loading the jQuery.cookie.min.js file which in turn causes add to cart for variable products impossible.  This plugin fixes that issue by renaming the file being loaded. NOTE: please remove any previous fixes to this that you may have applied.
Author: Roy Ho
Author URI: http://royho.me
Version: 1.0
License: GPLv3
*/

/*  Copyright 2013  Roy Ho  (email : roy@splashingpixels.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 3, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// only load in frontend
if ( ! is_admin() ) {
	add_action( 'wp_enqueue_scripts', 'run_script_action' );
	add_action( 'wp_enqueue_scripts', 'woocommerce_jquery_cookie_script' );

	function run_script_action() {

		// deregister script
		wp_deregister_script( 'jquery-cookie' );
		wp_dequeue_script( 'jquery-cookie' ); 
	}

	function woocommerce_jquery_cookie_script() {

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_register_script( 'jquery-cookie', plugins_url( 'jquery_cookie' . $suffix . '.js', __FILE__ ), array( 'jquery' ), '1.3.1', true );

	}
}