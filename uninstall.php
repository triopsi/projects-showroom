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
 **/

// if uninstall.php is not called by WordPress, die.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

// Options.
$plg_options = array(
	'psr_plugin_version',
	'psr_setting_main_color',
	'psr_setting_main_color_hover',
	'psr_setting_round_buttons_size',
	'psr_setting_spacing',
);

// Delete options.
foreach ( $plg_options as $plg_option ) {
	delete_option( $plg_options );
}

// Delete metadata and posts.
$post_type_arg = array(
	'post_type'      => 'psr',
	'posts_per_page' => -1,
);

$getpostsentries = get_posts( $post_type_arg );
foreach ( $getpostsentries as $delpost ) {
	wp_delete_post( $delpost->ID, true );
}

