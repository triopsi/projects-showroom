<?php
/**
 * Author: triopsi
 * Author URI: http://wiki.profoxi.de
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0
 *
 * Psr is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * psr is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with psr. If not, see https://www.gnu.org/licenses/gpl-3.0.
 *
 * @package psr
 *
 **/

/* Add CSS Class to the front */
add_action( 'wp_enqueue_scripts', 'add_psr_front_css', 99 );
function add_psr_front_css() {

	/* CSS */
	wp_enqueue_style( 'psr-style', plugins_url( '../assets/css/psr-style.css', __FILE__ ) );

	/* JS */
	wp_enqueue_script( 'psr-script', plugins_url( '../assets/js/psr-script.js', __FILE__ ), array( 'jquery' ) );

}

/**
 * Function to get post featured image
 */
function psr_get_logo_image( $post_id = '', $size = 'full' ) {
	$imageurl = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
	if ( ! empty( $imageurl ) ) {
		$imageurl = isset( $imageurl[0] ) ? $imageurl[0] : '';
	}
	return $imageurl;
}
