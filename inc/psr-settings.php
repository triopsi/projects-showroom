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

/**
 * Init setting setup
 *
 * @return void
 */
function psr_settings_init() {
	// register new settings.
	register_setting( 'psr', 'psr_setting_main_color' );

	// register new settings.
	register_setting( 'psr', 'psr_setting_main_color_hover' );

	// Social Media CND.
	add_settings_section(
		'psr_settings_section_font_cdn',
		__( 'Color shema', 'psr' ),
		'psr_settings_cdn_section_cb',
		'psr'
	);

	// Social Media Style CDN Field.
	add_settings_field(
		'psr_settings_main_color',
		__( 'Choose a main color:', 'psr' ),
		'psr_settings_field_main_color_cb',
		'psr',
		'psr_settings_section_font_cdn'
	);

	// Social Media Style CDN Field.
	add_settings_field(
		'psr_settings_hover_color',
		__( 'Choose a main hover color:', 'psr' ),
		'psr_settings_field_hover_color_cb',
		'psr',
		'psr_settings_section_font_cdn'
	);

}

// register psr_settings_init to the admin_init action hook.
add_action( 'admin_init', 'psr_settings_init' );

// section CDN Description.
function psr_settings_cdn_section_cb() {
	echo __( 'This color will use for the Titel, Menue bar and description.', 'psr' );
}


/**
 * Main Color CP
 *
 * @param array $args
 * @return void
 */
function psr_settings_field_main_color_cb( array $args ) {
	$old_setting_value = ( ! empty( get_option( 'psr_setting_main_color' ) ) ? get_option( 'psr_setting_main_color' ) : '#eb5466' );
	?>
	<input type="text" id="psr-main-color-field" class="psr-main-color-field" name="psr_setting_main_color" value="<?php echo $old_setting_value; ?>">

	<?php
}

/**
 * Hover Color CP
 *
 * @param array $args
 * @return void
 */
function psr_settings_field_hover_color_cb( array $args ) {
	$old_setting_value = ( ! empty( get_option( 'psr_setting_main_color_hover' ) ) ? get_option( 'psr_setting_main_color_hover' ) : '#ffffff' );
	?>
	<input type="text" id="psr-hover-color-field" class="psr-hover-color-field" name="psr_setting_main_color_hover" value="<?php echo $old_setting_value; ?>">
	<?php
}

// top level menu.
function psr_option_menue() {

	add_options_page(
		__( 'Projects options', 'psr' ),
		__( 'Projects options', 'psr' ),
		'manage_options',
		'psr',
		'psr_options_page_html'
	);
}

// register our psr_options_page to the admin_menu action hook.
add_action( 'admin_menu', 'psr_option_menue' );

/**
 * top level menu
 *
 * @return void
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
			</div><!-- /.debug-info -->
		<?php } ?>
	</div>
	<?php
}
