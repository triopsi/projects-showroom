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
	// $projectsdetails = get_post_meta( $post->ID, '_psr_project_url', true);
	$projecturlpageid = (int)get_post_meta( $post->ID, '_psr_project_url_page_id', true);
	$projecturlpostid = (int)get_post_meta( $post->ID, '_psr_project_url_post_id', true);
	$projecturllink = get_post_meta( $post->ID, '_psr_project_url_link', true);

	$projecturlpageid = (empty($projecturlpageid))?0:$projecturlpageid;
	$projecturlpostid = (empty($projecturlpostid))?0:$projecturlpostid;
	$projecturllink = (empty($projecturllink))?'':$projecturllink;

	/* GetIcon Array */
	$social_links_options = getIconArrayList();

	//Hidden field.
    wp_nonce_field( 'psr_meta_box_nonce', 'psr_meta_box_nonce' ); 
    
    ?>
    
	<div class="projects_field">
		<div class="projects_field_title">
			<?php echo __('More information URL','psr'); ?>
		</div>
		<div class="psr_field_title">
			<?php echo __('Site','psr'); ?>
		</div>
		<?php
		wp_dropdown_pages(array(
			'selected' => $projecturlpageid,
			'name'   => 'psr_info_url_page_id',
			'show_option_none'  => __('Please Choose','psr'),
			'option_none_value' => 0,
			'hierarchical' => true,
			'id'	=> 'infoLinkInputId',
			'selected' => $projecturlpageid,
			));
		?>
		<br>
		<small> - <?= __('or','psr') ?> - </small>
		<br>
		<div class="psr_field_title">
			<?php echo __('Post','psr'); ?>
		</div>
		<select name="psr_info_url_post_id" id="page_id">
			<option value="0"><?php echo __('Please Choose','psr'); ?></option>
			<?php
			
			global $post;
			$args = array( 'numberposts' => -1);
			$posts = get_posts($args);
			foreach( $posts as $post ) : setup_postdata($post); 
				if($projecturlpostid == $post->ID){
				?>
					<option value="<?= $post->ID; ?>" selected><?php the_title(); ?></option>
				<?php
				}else{ ?>
				<option value="<?= $post->ID; ?>"><?php the_title(); ?></option>
			<?php 
				}
			endforeach; 
			?>
		</select>
		<br>
		<small> - <?= __('or','psr') ?> - </small>
		<br>
		<div class="psr_field_title">
			URL
		</div>
			<input class="psr-field regular-text" id="infoLinkInputLink" name="psr_info_url" type="text" value="<?php echo esc_url( $projecturllink ) ?>" placeholder="<?php echo __('e.g. https://example.com','psr'); ?>">
        </br>
        <em><?= __('Empty Value = No Link','psr') ?></em>
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

	//Site Link
	$project_url_page_id = stripslashes( strip_tags( sanitize_text_field( $_POST['psr_info_url_page_id'] ) ) );
	$project_url_post_id = stripslashes( strip_tags( sanitize_text_field( $_POST['psr_info_url_post_id'] ) ) );
	$project_url_link = stripslashes( strip_tags( sanitize_text_field( $_POST['psr_info_url'] ) ) );
	
	if($project_url_page_id != 0){
		update_post_meta( $post_id, '_psr_project_url_page_id', $project_url_page_id );
		update_post_meta( $post_id, '_psr_project_url_post_id', 0 );
		update_post_meta( $post_id, '_psr_project_url_link', '' );
	}
	
	if($project_url_post_id != 0){
		update_post_meta( $post_id, '_psr_project_url_page_id', 0 );
		update_post_meta( $post_id, '_psr_project_url_post_id', $project_url_post_id );
		update_post_meta( $post_id, '_psr_project_url_link', '' );
	}
	
	if(!empty($project_url_link)){
		update_post_meta( $post_id, '_psr_project_url_page_id', 0 );
		update_post_meta( $post_id, '_psr_project_url_post_id', 0 );
		update_post_meta( $post_id, '_psr_project_url_link', $project_url_link );
	}
	
	if($project_url_page_id==0 && $project_url_post_id==0 && empty($project_url_link)){
		update_post_meta( $post_id, '_psr_project_url_page_id', 0 );
		update_post_meta( $post_id, '_psr_project_url_post_id', 0 );
		update_post_meta( $post_id, '_psr_project_url_link', '' );
	}
}