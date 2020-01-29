<?php
/**
* Author: triopsi
* Author URI: http://wiki.profoxi.de
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
   * Add Style and JS in the Admin page
   *
   * @return void
   */
  function add_admin_psr_style_js() {
  
    /* Gets the post type. */
    global $post_type;
  
    if( 'psr' == $post_type ) {
  
      /* CSS */
      wp_enqueue_style( 'psr-admin-style', plugins_url('../assets/css/psr-admin-style.css', __FILE__));
  
      /* JS */
      wp_enqueue_script( 'psr-admin-script', plugins_url('../assets/js/psr-admin-script.js', __FILE__), array( 'jquery' ) );

      /* Localizes string for JS file. */
      wp_localize_script( 'psr-admin-script', 'psrobjjs', array(
        'no_title' => __( 'please set a project name', 'psr' ),
        'no_image' => __( 'please set a featured image!', 'psr' ),
      ));
      
    }else{

      /* Color JS */
      wp_enqueue_script( 'psr-admin-script-color', plugins_url('../assets/js/psr-admin-script-color.js', __FILE__), array( 'jquery', 'wp-color-picker'  ) );

    }
  
  }
