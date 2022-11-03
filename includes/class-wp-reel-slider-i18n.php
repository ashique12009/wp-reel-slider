<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://ashique12009.blogspot.com
 * @since      1.0.0
 *
 * @package    Wp_Reel_Slider
 * @subpackage Wp_Reel_Slider/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Reel_Slider
 * @subpackage Wp_Reel_Slider/includes
 * @author     Khandoker Ashique Mahamud <ashique12009@gmail.com>
 */
class Wp_Reel_Slider_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-reel-slider',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
