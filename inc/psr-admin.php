<?php
/**
* Author: triopsi
* Author URI: http://wiki.profoxi.de
* License: GPL3
* License URI: https://www.gnu.org/licenses/gpl-3.0
*
* uebns is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 2 of the License, or
* any later version.
*  
* uebns is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*  
* You should have received a copy of the GNU General Public License
* along with uebns. If not, see https://www.gnu.org/licenses/gpl-3.0.
**/

/**
 * Version Check
 *
 * @return void
 */
function psr_check_version() {
    if (PSR_VERSION !== get_option('psr_plugin_version'))
        psr_activation();
  }
  
  /* Loaded Plugin */
  add_action('plugins_loaded', 'psr_check_version');
  
  /* Add Admin panel */
  add_action( 'admin_enqueue_scripts', 'add_admin_psr_style_js' );
  
  /**
   * Undocumented function
   *
   * @return void
   */
  function add_admin_psr_style_js() {
  
    /* Gets the post type. */
    global $post_type;
  
    if( 'psr' == $post_type ) {
  
      /* CSS */
      wp_enqueue_style( 'psr-style', plugins_url('../assets/css/psr-style.css', __FILE__));
  
      /* JS */
      wp_enqueue_script( 'psr-script', plugins_url('../assets/js/psr-script.js', __FILE__), array( 'jquery' ) );
      
    }
  
  }
  
  /**
   * Update Version Number
   *
   * @return void
   */
  function psr_activation(){
    update_option('psr_plugin_version', PSR_VERSION);
  }