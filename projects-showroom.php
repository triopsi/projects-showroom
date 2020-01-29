<?php
/**
* Plugin Name: Projects Showroom
* Plugin URI: https://www.wiki.profoxi.de
* Description: A very simple showroom for your projects. Create projects and copy-paste the shortcode everywhere in your post or site.
* Version: 0.0.1
* Author: triopsi
* Author URI: http://wiki.profoxi.de
* Text Domain: psr
* Domain Path: /lang/
* License: GPL3
* License URI: https://www.gnu.org/licenses/gpl-3.0
*
* psr is free software: you can redistribute it and/or modify
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
**/

//Definie plugin version
if (!defined('PSR_VERSION'))
    define('PSR_VERSION', '0.0.1');

/**
 * Define path
 */
define('PSR_PATH', plugin_dir_path(__FILE__));

/* General */
/* Loads plugin's text domain. */
add_action( 'init', 'psr_load_plugin_textdomain' );

/* Admin Scripts */
require_once('inc/psr-admin.php');

/* Types */
require_once('inc/psr-types.php');

/* Metaboxes */
require_once('inc/psr-post-metabox.php');

/* Menue */
require_once('inc/psr-help.php');

/* Admin Setting */
require_once('inc/psr-settings.php');

/* Front Scripts and Styles */
require_once('inc/psr-user.php');

/* Shortcode */
require_once('inc/psr-shortcode.php');

/**
 * Init Script. Load languages
 *
 * @return void
 */
function psr_load_plugin_textdomain() {
    load_plugin_textdomain( 'psr', FALSE, basename(PSR_PATH.'/lang/') );
  }