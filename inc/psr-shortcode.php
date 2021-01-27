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

/* Shortcode on the Page */
add_shortcode("psr", "psr_shortcode");


//Show the Shortcode in the post/site/content
function psr_shortcode($atts) {

    //Data of the current Post
    global $post;

    // Shortcode Parameter
	extract(shortcode_atts(array(
		'link_target'		=> 'self',
		'show_title'		=> 'true',
		'image_size'		=> 'original',
		'orderby'			=> 'date',
        'order'				=> 'ASC',
        'projectname'       => '',
        'cat'               => '',
        'show_menu_bar'     => 'true',
		), $atts));

    
    $link_target 		= ( $link_target == 'blank' ) 		? '_blank' 	: '_self';
    $cat 				= ( !empty($cat) )	                ? explode(',',$cat) 	: '';
    $projectname		= !empty($projectname)              ? $projectname : '';
    $show_title 		= ( $show_title == 'false') 	    ? false	: true;
    $image_size 		= ( !empty($image_size) ) 			? $image_size	: 'original';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' : 'DESC';
    $orderby 			= !empty($orderby)	 				? $orderby 	: 'date';
    $show_menu_bar 		= ( $show_menu_bar == 'false') 	    ? false	: true;
        
    // WP Query Parameters
    $query_args = array(
        'post_type' 			=> 'psr',
        'post_status' 			=> array( 'publish' ),
        'posts_per_page'		=> -1,
        'order'          		=> $order,
		'orderby'        		=> $orderby,
    );

    //search a categorie
    if( !empty( $cat ) ) {
        $query_args['tax_query'] = array(
            array( 
                'taxonomy' => 'projects', 
                'field' => 'term_id', 
                'terms' => $cat,
            )
        );
        $show_menu_bar = false;
    }

    //search single project
    if(!empty($projectname)){
        $query_args['name'] = $projectname;
        $show_menu_bar = false;
    }

    //Get Taxio/Slugs
    $taxio_projects = get_terms( array(
        'taxonomy'      => 'projects',
        'fields'        => 'names',
        'hide_empty'    => false,
    )
    );

    // WP Query Parameters
	$psr_query = new WP_Query($query_args);
    $post_count = $psr_query->post_count;
    
    //Buffer Start
    ob_start();
    
    //Style
    $main_color = get_option( 'psr_setting_main_color' , '#eb5466');
    $hover_color = get_option( 'psr_setting_main_color_hover' , '#ffffff');

    ?>
    <style>
        .showroom-project-sub-sub-description p a,
        .showroom-project-sub-description p{
            color:<?php echo $main_color; ?>;
        }
        .showroom-project-sub-sub-description p a:hover{
            color:<?php echo $hover_color; ?>;
        }
        .psr-nav:hover{
            color:<?php echo $hover_color; ?>;
            background-color: <?php echo $main_color; ?>;
        }
        .psr-nav.active{
            background-color: <?php echo $main_color; ?>;
        }
	</style>
    <?php

    //Output Buffer and Clean Buffer
    $o = ob_get_clean();

    //Empty team Sring
    $team_view = '';

    //show project
    if( $psr_query->have_posts() ) { 
        
        $team_view.='
          <div class="showroom shr-row shr-container">';
          if ( $show_menu_bar && empty($cat) ){
            $team_view.='
            <div class="showroom-navigation">
                <div class="showroom-projects">
                    <div class="psr-all-show-button psr-nav active" psr-data="all">'. _x('All','psr') .'</div>';
                    foreach ( $taxio_projects as $key => $taxo ){
                        $orign = $taxo;
                        $taxo = str_replace(' ', '-', $taxo);
                        $team_view.='<div class="psr-pr1-show-button psr-nav" psr-data="'.$taxo.'">'.$orign.'</div>';
                    }
                $team_view.='
                </div>
            </div>';
          }
    
            $team_view.='
            <div class="showroom-projetcs shr-flex">';
            while ($psr_query->have_posts()) : $psr_query->the_post();

                //Get links
                $project_url_page_id = (int)get_post_meta( $post->ID, '_psr_project_url_page_id', true );
                $project_url_post_id = (int)get_post_meta( $post->ID, '_psr_project_url_post_id', true );
                $project_url_link = get_post_meta( $post->ID, '_psr_project_url_link', true );

                //Default url
                $htmlurl='';

                //Set the url
                if($project_url_page_id !=0){
                    $htmlurl=get_page_link($project_url_page_id);
                }
                if($project_url_post_id !=0){
                    $htmlurl=get_page_link($project_url_page_id);
                }
                if($project_url_link !=''){
                    $htmlurl=$project_url_link;
                }
                        
                $title_project = get_the_title();        
                $feat_image = psr_get_logo_image( $post->ID, $image_size);
                $taxio = wp_get_post_terms($post->ID, 'projects', array( 'fields' => 'names'));

                if( is_array($taxio) && count($taxio) > 1 ){
                    $slug = implode(' + ',$taxio);
                    $slug_css = implode(' ',$taxio);
                }elseif (empty($taxio)){
                    $slug = '';
                    $slug_css = '';
                }else{
                    $slug = $taxio[0];
                    $slug_css = $taxio[0];
                }

                $slug_css = str_replace(' ', '-', $slug_css);

                $team_view.='
                    <div class="showroom-project '.$slug_css.'">
                        <div class="showrrom-thumbnail-image" style="background: url('.$feat_image.') center center/cover;">
                            <div class="projects-container">';
                                if( $show_title && !empty($title_project) ){
                                    $team_view.='<div class="showroom-project-description"><p>'.$title_project.'</p></div>';
                                }
                                if(!empty($taxio)){
                                    $team_view.='<div class="showroom-project-sub-description"><p>'.$slug.'</p></div>';
                                }
                                if(!empty($htmlurl)){
                                    $team_view.='<div class="showroom-project-sub-sub-description"><p><a target="'.$link_target.'" href="'.$htmlurl.'">'. _x('More information','psr') .'</a></p></div>';
                                }
                                $team_view.='
                            </div>
                        </div>
                    </div>';	
            endwhile;
        $team_view.='
            </div><!-- ./showroom-projetcs -->
        </div><!-- /.showroom -->';
    }
    wp_reset_postdata(); // Reset WP Query
    return $o.$team_view;
  
  }