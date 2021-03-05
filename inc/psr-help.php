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

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add Menue
add_action( 'admin_menu', 'psr_register_help_page' );

function psr_register_help_page() {
	add_submenu_page(
		'edit.php?post_type=psr',
		__( 'How It Works', 'psr' ),
		__( 'Help', 'psr' ),
		'manage_options',
		'psr_help',
		'psr_help_page'
	);
}

function psr_help_page() { ?>
	
	<style type="text/css">
		.psr-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
	</style>

	<div class="post-box-container">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<!--How it workd HTML -->
				<div id="post-body-content">
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								
								<h3 class="hndle">
									<span><?php _e( 'How It Works - Display and shortcode', 'psr' ); ?></span>
								</h3>
								
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e( 'Geeting Started with projects showroom', 'psr' ); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e( 'Step 1. Go to "All Projects --> Add New".', 'psr' ); ?></li>
														<li><?php _e( 'Step 2. Add project title, project link and a project image under featured image section.', 'psr' ); ?></li>
														<li><?php _e( 'Step 3. Display multiple projects showcase, create categories under "Projects --> Projects Category" and create categories.', 'psr' ); ?></li>
														<li><?php _e( 'Step 4. Copy-paste the shortcode <span class="psr-shortcode-preview">[psr]</span> anywhere in your post or site.', 'psr' ); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e( 'All Shortcodes', 'psr' ); ?>:</label>
												</th>
												<td>
													<span class="psr-shortcode-preview">[psr]</span> – <?php _e( 'Project Showroom Shortcode. Show all projects and show the menue bar', 'psr' ); ?> <br />
													<span class="psr-shortcode-preview">[psr cat="&lt;id&gt;"]</span> – <?php _e( 'show projects from a category', 'psr' ); ?> <br />
													<span class="psr-shortcode-preview">[psr projectname="&lt;id&gt;"]</span> – <?php _e( 'show a project in a showcase', 'psr' ); ?> <br />
												</td>
											</tr>			
											
											<tr>
												<th>
													<label><?php _e( 'All Shortcodes parameters', 'psr' ); ?>:</label>
												</th>
												<td>
													<span class="psr-shortcode-preview">link_target="_self"</span> – <?php _e( 'Project link target. Value=_self or _blank, Default=_self', 'psr' ); ?> <br />
													<span class="psr-shortcode-preview">show_title="true"</span> – <?php _e( 'Show the project titel in the showcase. Value=true or false, Default=true', 'psr' ); ?> <br />
													<span class="psr-shortcode-preview">orderby="date"</span> – <?php _e( 'orderby the atribute of projects Value=date, ID, title, name or rand, Default=date', 'psr' ); ?> <br />
													<span class="psr-shortcode-preview">order="asc"</span> – <?php _e( 'sort the project in ascending or descending order. Value=asc or desc, Default=ASC', 'psr' ); ?> <br />
													<span class="psr-shortcode-preview">show_menu_bar="true"</span> – <?php _e( 'show the menue bar. Value=true or false, Default=true', 'psr' ); ?> <br />
												
												</td>
											</tr>			

											<tr>
												<th>
													<label><?php _e( 'Need Support?', 'psr' ); ?></label>
												</th>
												<td>
													<p><?php _e( 'Check plugin document for shortcode parameters.', 'psr' ); ?></p> <br/>
													<a class="button button-primary" href="http://wiki.profoxi.de" target="_blank"><?php _e( 'Documentation', 'psr' ); ?></a>									
													<a class="button button-secondary" href="http://paypal.me/triopsi" target="_blank">❤️ <?php _e( 'Donate', 'psr' ); ?></a>
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-body-content -->
			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
	<?php
}
