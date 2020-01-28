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

/* Shortcode on the Page */
add_shortcode("psr", "psr_shortcode");


//Show the Shortcode in the post/site/content
function psr_shortcode($atts) {

    //Data of the current Post
    global $post;
  
    // Gets table slug (post name)
    $all_attr = shortcode_atts( array( "name" => '' ), $atts );
  
    //Name of the Team
    $name = $all_attr['name'];
  
    //Gets the team
    // $args = array('post_type' => 'uebns', 'name' => $name);
  
    // Get Posts
    // $custom_posts = get_posts($args);
    
    //Empty team Sring
    $team_view = '';
  
  
    // foreach($custom_posts as $post) : setup_postdata($post);

        //Load Members
        // $members = get_post_meta( get_the_id(), '_uebns_members', true );
  
        //Load Settings
        // $settings_layout = get_post_meta( get_the_id(), '_uebns_layout', true );
        // $settings_photo_setting = get_post_meta( get_the_id(), '_uebns_photo_setting', true );
        // $settings_color_shema = get_post_meta( get_the_id(), '_uebns_color_shema', true );
        // $settings_line_member = get_post_meta( get_the_id(), '_uebns_line_member', true );
        // $setting_image_filter = get_post_meta( get_the_id(), '_uebns_filter_image', true );
        // $setting_images_clickable = get_post_meta( get_the_id(), '_uebns_images_clickable', true );
        // $style_class_line_members = getRowStyleCount($settings_line_member);
        // $style_image_filter = getImageFilterStyle($setting_image_filter);
  
        if ( is_array($members) || is_object($members) || !empty($settings_layout) ) {
          $i=0;
          $memberscount=count($members);
          $team_view.='
          <div class="showroom shr-row shr-container">
            <div class="showroom-navigation">
                <div class="showroom-projects">
                    <div class="psr-all-show-button psr-nav active" psr-data="all">All</div>
                    <div class="psr-pr1-show-button psr-nav" psr-data="zip">zip</div>
                    <div class="psr-pr2-show-button psr-nav" psr-data="js">js</div>
                    <div class="psr-pr2-show-button psr-nav" psr-data="lib">lib</div>
                </div>
            </div>
            <div class="showroom-projetcs shr-flex">
                <div class="showroom-project zip">
                    <div class="showrrom-thumbnail-image" style="background: url("assets/img/thumb-5.jpg") center center/cover;">
                        <div class="projects-container">
                            <div class="showroom-project-description"><p>Test Projekt</p></div>
                            <div class="showroom-project-sub-description"><p>JS + HTML</p></div>
                            <div class="showroom-project-sub-sub-description"><p><a target="_blank" href="#">More information</a></p></div>
                        </div>
                    </div>
                </div>
                <div class="showroom-project zip">
                    <div class="showrrom-thumbnail-image" style="background: url("assets/img/thumb-4.jpg") center center/cover;">
                        <div class="projects-container">
                            <div class="showroom-project-description"><p>Test Projekt</p></div>
                            <div class="showroom-project-sub-description"><p>JS + HTML</p></div>
                            <div class="showroom-project-sub-sub-description"><p><a target="_blank" href="#">More information</a></p></div>
                        </div>
                    </div>
                </div> 
                <div class="showroom-project js">
                    <div class="showrrom-thumbnail-image" style="background: url("assets/img/thumb-6.jpg") center center/cover;">
                        <div class="projects-container">
                            <div class="showroom-project-description"><p>Test Projekt</p></div>
                            <div class="showroom-project-sub-description"><p>JS + HTML</p></div>
                            <div class="showroom-project-sub-sub-description"><p><a target="_blank" href="#">More information</a></p></div>
                        </div>
                    </div>
                </div> 
                <div class="showroom-project zip">
                    <div class="showrrom-thumbnail-image" style="background: url("assets/img/thumb-7.jpg") center center/cover;">
                        <div class="projects-container">
                            <div class="showroom-project-description"><p>Test Projekt</p></div>
                            <div class="showroom-project-sub-description"><p>JS + HTML</p></div>
                            <div class="showroom-project-sub-sub-description"><p><a target="_blank" href="#">More information</a></p></div>
                        </div>
                    </div>
                </div> 
                <div class="showroom-project js">
                    <div class="showrrom-thumbnail-image" style="background: url("assets/img/thumb-8.jpg") center center/cover;">
                        <div class="projects-container">
                            <div class="showroom-project-description"><p>Test Projekt</p></div>
                            <div class="showroom-project-sub-description"><p>JS + HTML</p></div>
                            <div class="showroom-project-sub-sub-description"><p><a target="_blank" href="#">More information</a></p></div>
                        </div>
                    </div>
                </div>
                <div class="showroom-project lib">
                    <div class="showrrom-thumbnail-image" style="background: url("assets/img/thumb-9.jpg") center center/cover;">
                        <div class="projects-container">
                            <div class="showroom-project-description"><p>Test Projekt</p></div>
                            <div class="showroom-project-sub-description"><p>JS + HTML</p></div>
                            <div class="showroom-project-sub-sub-description"><p><a target="_blank" href="#">More information</a></p></div>
                        </div>
                    </div>
                </div>
            </div>';
          $team_view.='</div><!-- /.showroom -->';
        }
    // endforeach; wp_reset_postdata();
  
    return $team_view;
  
  }