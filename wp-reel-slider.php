<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ashique12009.blogspot.com
 * @since             1.0.0
 * @package           Wp_Reel_Slider
 *
 * @wordpress-plugin
 * Plugin Name:       Ashique Reel Slider
 * Plugin URI:        https://ashique12009.blogspot.com
 * Description:       A reel type scrolling post feature image slider. Which will flow right to left infinity type like html marque.
 * Version:           1.0.0
 * Author:            Khandoker Ashique Mahamud
 * Author URI:        https://mathrules12009.50webs.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-reel-slider
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_REEL_SLIDER_VERSION', '1.0.0' );
define( 'WP_REEL_SLIDER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_REEL_SLIDER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_REEL_SLIDER_TEXT_DOMAIN', 'wp-reel-slider' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-reel-slider-activator.php
 */
function activate_wp_reel_slider() {
	require_once WP_REEL_SLIDER_PLUGIN_DIR . 'includes/class-wp-reel-slider-activator.php';
	Wp_Reel_Slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-reel-slider-deactivator.php
 */
function deactivate_wp_reel_slider() {
	require_once WP_REEL_SLIDER_PLUGIN_DIR . 'includes/class-wp-reel-slider-deactivator.php';
	Wp_Reel_Slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_reel_slider' );
register_deactivation_hook( __FILE__, 'deactivate_wp_reel_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require WP_REEL_SLIDER_PLUGIN_DIR . 'includes/class-wp-reel-slider.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_reel_slider() {

	$plugin = new Wp_Reel_Slider();
	$plugin->run();

}
run_wp_reel_slider();