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

/* Registers the teams post type. */
add_action( 'init', 'register_psr_type' );

/**
 * Function about the ini of the Plugin
 *
 * @return void
 */
function register_psr_type() {
	
  	/* Defines labels */
  	$labels = array(
		'name'               => __( 'Projects', 'psr' ),
		'singular_name'      => __( 'Projects', 'psr' ),
		'menu_name'          => __( 'Projects', 'psr' ),
		'add_new'            => __( 'Add Projects', 'psr' ),
		'add_new_item'       => __( 'Add New Project', 'psr' ),
		'new_item'           => __( 'New Projects', 'psr' ),
		'edit_item'          => __( 'Edit Project', 'psr' ),
		'view_item'          => __( 'View Project', 'psr' ),
		'all_items'          => __( 'All Projects', 'psr' ),
		'search_items'       => __( 'Search Projects', 'psr' ),
		'not_found'          => __( 'No Projects found.', 'psr' ),
		'not_found_in_trash' => __( 'No Projects found in Trash.', 'psr' )
	);

  	/* Defines permissions. */
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
    	'show_in_admin_bar'  => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'supports'           => array( 'title' ),
		'menu_icon'          => 'dashicons-grid-view',
		// 'taxonomies'		 => $psr_taxonomies
	);

  	/* Registers post type. */
	register_post_type( 'psr', $args );  

}


function register_psr_taxonomy() {

	$labels = array(
        'name'              			=> __( 'Projects', 'psr' ),
        'singular_name'     			=> __( 'Project', 'psr' ),
        'search_items'      			=> __( 'Search Projects', 'psr' ),
		'all_items'         			=> __( 'All Projects', 'psr' ),
		'parent_item'					=> null,
        'parent_item_colon'				=> null,
        'edit_item'         			=> __( 'Edit Project', 'psr' ),
        'update_item'       			=> __( 'Update Projects', 'psr' ),
		'add_new_item'      			=> __( 'Add New Projects', 'psr' ),
		'new_item_name'     			=> __( 'New Project Name', 'psr' ),
		'separate_items_with_commas'	=> __( 'Separate writers with commas', 'psr' ),
		'add_or_remove_items'        	=> __( 'Add or remove writers', 'psr' ),
        'choose_from_most_used'      	=> __( 'Choose from the most used writers', 'psr' ),
        'not_found'                  	=> __( 'No writers found.', 'psr' ),
		'menu_name'         			=> __( 'Projects', 'psr' ),
	);
	
    $args = array(
		'hierarchical'  		=> false,
		'labels'        		=> $labels,
		'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'writer' ),
    );
    register_taxonomy( 'projects', 'psr', $args );
}
add_action( 'init', 'register_psr_taxonomy', 0 );


/* Add update messages */
add_filter( 'post_updated_messages', 'psr_updated_messages' );

/**
 * Update post message functions
 *
 * @param [type] $messages
 * @return void
 */
function psr_updated_messages( $messages ) {
	$post             = get_post();
	$post_type        = get_post_type( $post );
    $post_type_object = get_post_type_object( $post_type );
	$messages['psr'] = array(
		1  => __( 'Project updated.', 'psr' ),
		4  => __( 'Project updated.', 'psr' ),
		6  => __( 'Project published.', 'psr' ),
		7  => __( 'Project saved.', 'psr' ),
		10 => __( 'Project draft updated.', 'psr' )
	);

	return $messages;

}