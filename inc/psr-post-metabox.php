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

/* Hooks the metabox */
add_action('admin_init', 'psr_add_project', 1);
function psr_add_project() {
	add_meta_box( 
		'psr-project-info', 
		__('Projects details', 'psr' ), 
		'psr_add_project_display',
		'psr', 
		'normal'
	);
}

/**
 * Show the add/edit postpage in admin
 *
 * @return void
 */
function psr_add_project_display(){

	//Global Post
    global $post;
	
	//get post meta data
	$projectsdetails = get_post_meta( $post->ID, '_psr_projetc_url', true);

	/* GetIcon Array */
	$social_links_options = getIconArrayList();

	//Hidden field.
    wp_nonce_field( 'psr_meta_box_nonce', 'psr_meta_box_nonce' ); 
    
    ?>
    
	<div class="projects_field">
		<div class="projects_field_title">
			<?php echo __('More information URL','psr'); ?>
		</div>
		<input class="projects-field regular-text" name="psr_info_link" type="text" value="<?php echo esc_url( $projectsdetails ) ?>" placeholder="<?php echo __('e.g. https://example.com','psr'); ?>">
        </br>
        <em>Display on the front.</em>
    </div><!-- ./member_field_firstname -->

<?php
}

add_action( 'save_post', 'psr_save_meta_box_data' );

function psr_save_meta_box_data( $post_id ) {

	if ( ! isset( $_POST['psr_meta_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['psr_meta_box_nonce'], 'psr_meta_box_nonce' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'psr' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	if ( ! isset( $_POST['psr_info_link'] ) ) {
		return;
    }
    
    //Update postdata
    $link_data = stripslashes_deep( $_POST['psr_info_link'] );
    update_post_meta( $post_id, '_psr_projetc_url', $link_data );
}