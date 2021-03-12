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
 **/

/**
 * Init setting setup
 *
 * @return void
 */
function psr_settings_init() {
	// register new settings main color. Nav/Button color.
	register_setting( 'psr', 'psr_setting_main_color' );

	// register new settings color on hover link.
	register_setting( 'psr', 'psr_setting_main_color_hover' );

	// register new settings roudned size.
	register_setting( 'psr', 'psr_setting_round_buttons_size' );

	// register new settings spacing between the single projects.
	register_setting( 'psr', 'psr_setting_spacing' );

	// Social Media CND.
	add_settings_section(
		'psr_settings_section_font_cdn',
		esc_html__( 'Color shema', 'psr' ),
		'psr_settings_cdn_section_cb',
		'psr'
	);

	// Social Media CND.
	add_settings_section(
		'psr_settings_section_front',
		esc_html__( 'Display on the front', 'psr' ),
		'psr_settings_section_front_cb',
		'psr'
	);

	// Social Media Style CDN Field.
	add_settings_field(
		'psr_settings_main_color',
		esc_html__( 'Choose a main color:', 'psr' ),
		'psr_settings_field_main_color_cb',
		'psr',
		'psr_settings_section_font_cdn'
	);

	// Social Media Style CDN Field.
	add_settings_field(
		'psr_settings_hover_color',
		esc_html__( 'Choose a main hover color:', 'psr' ),
		'psr_settings_field_hover_color_cb',
		'psr',
		'psr_settings_section_font_cdn'
	);

	// Round style.
	add_settings_field(
		'psr_settings_round_size',
		esc_html__( 'Type the rounded size in px (0 equals don\'t show rounded buttons)', 'psr' ),
		'psr_settings_field_round_button_cb',
		'psr',
		'psr_settings_section_front'
	);

	// Spacing between projects.
	add_settings_field(
		'psr_settings_spacing',
		esc_html__( 'Type the spacing in pixel between the single projects', 'psr' ),
		'psr_settings_field_spacing_between_projects_cb',
		'psr',
		'psr_settings_section_front'
	);

}

// register psr_settings_init to the admin_init action hook.
add_action( 'admin_init', 'psr_settings_init' );


/**
 * Display the section description.
 *
 */
function psr_settings_cdn_section_cb() {
	echo esc_html_x( 'This color will use for the Titel, Menue bar and description.', 'psr' );
}

/**
 * Display the section description.
 * 
 */
function psr_settings_section_front_cb() {
	echo esc_html_x( 'This options change the display on the front.', 'psr' );
}

/**
 * Main Color CP
 *
 * @param array $args
 * @return void
 */
function psr_settings_field_main_color_cb( array $args ) {
	$old_setting_value = get_option( 'psr_setting_main_color', '#eb5466' );
	?>
	<input type="text" id="psr-main-color-field" class="psr-main-color-field" name="psr_setting_main_color" value="<?php echo esc_attr( $old_setting_value ); ?>">

	<?php
}

/**
 * Hover Color CB
 *
 * @param array $args
 * @return void
 */
function psr_settings_field_hover_color_cb( array $args ) {
	$old_setting_value = get_option( 'psr_setting_main_color_hover', '#ffffff');
	?>
	<input type="text" id="psr-hover-color-field" class="psr-hover-color-field" name="psr_setting_main_color_hover" value="<?php echo esc_attr( $old_setting_value ); ?>">
	<?php
}

/**
 * Rounded Button Field CB
 *
 * @param array $args
 * @return void
 */
function psr_settings_field_round_button_cb( array $args ) {
	$old_setting_value_round_buttons_size = get_option( 'psr_setting_round_buttons_size', 0 );
	?>
	<input type="number" min="0" max="100" id="psr-button-round-field" class="psr-button-round-field" name="psr_setting_round_buttons_size" value="<?php echo esc_attr( $old_setting_value_round_buttons_size ); ?>">
	<?php
}

/**
 * Number of pixel between the projects
 *
 * @param array $args
 * @return void
 */
function psr_settings_field_spacing_between_projects_cb( array $args ) {
	$old_setting_value_spacing = get_option( 'psr_setting_spacing' , 5 );
	?>
	<input type="number" min="0" max="1000" id="psr-spacing-field" class="psr-spacing-field" name="psr_setting_spacing" value="<?php echo esc_attr( $old_setting_value_spacing ); ?>">
	<?php
}

/**
 * Add setting in the menu
 *
 * @return void
 */
function psr_option_menue() {

	add_options_page(
		__( 'Projects options', 'psr' ),
		__( 'Projects options', 'psr' ),
		'manage_options',
		'psr',
		'psr_options_page_html'
	);
}

// Register our psr_options_page to the admin_menu action hook.
add_action( 'admin_menu', 'psr_option_menue' );

/**
 * Display the page.
 *
 */
function psr_options_page_html() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
			<?php
				// output security fields for the registered setting "psr".
				settings_fields( 'psr' );

				// output setting sections and their fields.
				// (sections are registered for "psr", each field is registered to a specific section).
				do_settings_sections( 'psr' );

				// output save settings button.
				submit_button( __( 'Save Settings', 'psr' ) );
			?>
			<div class="psr-wrap-option-page">
			<a href="https://paypal.me/triopsi" target="_blank" class="button-secondary">❤️ <?php _e( 'Donate', 'psr' ); ?></a> 
			<a href="https://wiki.profoxi.de/" target="_blank" class="button-secondary"><?php _e( 'Help', 'psr' ); ?></a> 
			</div>
		</form>
		<?php if ( WP_DEBUG ) { ?>
			<div class="debug-info">
				<h3><?php _e( 'Debug information', 'psr' ); ?></h3>
				<p><?php _e( 'You are seeing this because your WP_DEBUG variable is set to true.', 'psr' ); ?></p>
				<pre>psr_plugin_version: <?php print_r( get_option( 'psr_plugin_version' ) ); ?></pre>
				<pre>psr_setting_main_color: <?php print_r( get_option( 'psr_setting_main_color' ) ); ?></pre>
				<pre>psr_setting_main_color_hover: <?php print_r( get_option( 'psr_setting_main_color_hover' ) ); ?></pre>
				<pre>psr_setting_round_buttons_size:  <?php print_r( get_option( 'psr_setting_round_buttons_size' ) ); ?></pre>
				<pre>psr_setting_spacing:  <?php print_r( get_option( 'psr_setting_spacing' ) ); ?></pre>
			</div><!-- /.debug-info -->
		<?php } ?>
	</div>
	<?php
}
