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
		'name'                  => __( 'Projects', 'psr' ),
		'singular_name'         => __( 'Projects', 'psr' ),
		'menu_name'             => __( 'Projects Showroom', 'psr' ),
		'add_new'               => __( 'Add Project', 'psr' ),
		'add_new_item'          => __( 'Add New Project', 'psr' ),
		'new_item'              => __( 'New Projects', 'psr' ),
		'edit_item'             => __( 'Edit Project', 'psr' ),
		'view_item'             => __( 'View Project', 'psr' ),
		'all_items'             => __( 'All Projects', 'psr' ),
		'search_items'          => __( 'Search Projects', 'psr' ),
		'not_found'             => __( 'No Projects found.', 'psr' ),
		'not_found_in_trash'    => __( 'No Projects found in Trash.', 'psr' ),
		'featured_image'        => __( 'Set logo image', 'psr' ),
		'set_featured_image'    => __( 'Set logo image', 'psr' ),
		'remove_featured_image' => __( 'Remove logo image', 'psr' ),
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
		'supports'           => array( 'title', 'thumbnail' ),
		'menu_icon'          => 'dashicons-grid-view',
	);

	/* Registers post type */
	register_post_type( 'psr', $args );

}

/**
 * Function to register post taxonomies
 */
function register_psr_taxonomy() {

	$labels = array(
		'name'                       => __( 'Categorie', 'psr' ),
		'singular_name'              => __( 'Category', 'psr' ),
		'search_items'               => __( 'Search categorie', 'psr' ),
		'all_items'                  => __( 'All categorie', 'psr' ),
		'parent_item'                => __( 'Parent Category', 'psr' ),
		'parent_item_colon'          => __( 'Parent Category:', 'psr' ),
		'edit_item'                  => __( 'Edit Category', 'psr' ),
		'update_item'                => __( 'Update Category', 'psr' ),
		'add_new_item'               => __( 'Add New Category', 'psr' ),
		'new_item_name'              => __( 'New Category Name', 'psr' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'psr' ),
		'add_or_remove_items'        => __( 'Add or remove category', 'psr' ),
		'choose_from_most_used'      => __( 'Choose from the most used categories', 'psr' ),
		'not_found'                  => __( 'No category found.', 'psr' ),
		'menu_name'                  => __( 'Projects Category', 'psr' ),
	);

	$args   = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => true,
	);
	$taxomy = register_taxonomy( 'projects', array( 'psr' ), $args );

}
add_action( 'init', 'register_psr_taxonomy' );

/* Add update messages */
add_filter( 'post_updated_messages', 'psr_updated_messages' );

/**
 * Update post message functions
 *
 * @param array $messages
 * @return array
 */
function psr_updated_messages( $messages ) {
	$post             = get_post();
	$post_type        = get_post_type( $post );
	$post_type_object = get_post_type_object( $post_type );
	$messages['psr']  = array(
		1  => __( 'Project updated.', 'psr' ),
		4  => __( 'Project updated.', 'psr' ),
		6  => __( 'Project published.', 'psr' ),
		7  => __( 'Project saved.', 'psr' ),
		10 => __( 'Project draft updated.', 'psr' ),
	);
	return $messages;
}

/**
 * Add info collumn function
 *
 * @param string $content
 * @param string $column_name
 * @param integer $term_id
 * @return string content
 */
function add_psr_column_content( $content, $column_name, $term_id ) {
	$term = get_term( $term_id, 'projects' );
	switch ( $column_name ) {
		case 'psr_tax_shortcode':
			$slug      = $term_id;
			$shortcode = '<span class="shortcode"><input type="text" onfocus="this.select();" readonly="readonly" value="[psr cat=&quot;' . $slug . '&quot;]" class="large-text code"></span>';
			echo $shortcode;
			break;
	}
	return $content;
}
add_filter( 'manage_projects_custom_column', 'add_psr_column_content', 10, 3 );


/**
 * Admin CollumnBar function
 *
 * @param array $columns colums.
 * @return array
 */
function add_psr_tax_columns( $columns ) {
	return array_merge( $columns, array( 'psr_tax_shortcode' => 'Shortcode' ) );
}

/* Adds the shortcode column in the postslistbar */
add_filter( 'manage_edit-projects_columns', 'add_psr_tax_columns' );

/**
 * Shortcodestyle function
 *
 * @param array $column
 * @param integer $post_id
 * @return void
 */
function psr_custom_columns( $column, $post_id ) {
	switch ( $column ) {
		case 'psr_shortcode':
			global $post;
			$slug      = '';
			$slug      = $post->post_name;
			$shortcode = '<span class="shortcode"><input type="text" onfocus="this.select();" readonly="readonly" value="[psr projectname=&quot;' . $slug . '&quot;]" class="large-text code"></span>';
			echo $shortcode;
			break;
	}
}

/* Handles shortcode column display. */
add_action( 'manage_psr_posts_custom_column', 'psr_custom_columns', 10, 2 );

/**
 * AdminCollumnBar function
 *
 * @param array $columns
 * @return void
 */
function add_psr_columns( $columns ) {
	$columns['title'] = __( 'Project name', 'psr' );
	unset( $columns['author'] );
	unset( $columns['date'] );
	return array_merge( $columns, array( 'psr_shortcode' => 'Shortcode' ) );
}

/* Adds the shortcode column in the postslistbar */
add_filter( 'manage_psr_posts_columns', 'add_psr_columns' );
