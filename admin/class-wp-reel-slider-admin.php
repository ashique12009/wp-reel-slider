<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://ashique12009.blogspot.com
 * @since      1.0.0
 *
 * @package    Wp_Reel_Slider
 * @subpackage Wp_Reel_Slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Reel_Slider
 * @subpackage Wp_Reel_Slider/admin
 * @author     Khandoker Ashique Mahamud <ashique12009@gmail.com>
 */
class Wp_Reel_Slider_Admin {

	use Wp_Reel_Slider_Helper_Trait;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Reel_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Reel_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, WP_REEL_SLIDER_PLUGIN_URL . 'admin/css/wp-reel-slider-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Reel_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Reel_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, WP_REEL_SLIDER_PLUGIN_URL . 'admin/js/wp-reel-slider-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Set settings menu
	 */
	public function wprs_admin_settings_option_menu() {
		$page_title = 'Reel slider';
		$menu_title = 'Reel slider';
		$capability = 'manage_options';
		$menu_slug = 'wp-reel-slider-settings';
		add_options_page(
			$page_title,
			$menu_title,
			$capability,
			$menu_slug,
			[$this, 'wprs_admin_settings_page_display']
		);
	}

	/**
	 * Admin settings page display
	 */
	public function wprs_admin_settings_page_display() {
		$view = sanitize_text_field( $_GET['view'] );
		$view = isset( $view ) ? $view : '';
		if ($view == '')
			include 'partials/wp-reel-slider-admin-display.php';
	}

	/**
	 * Show admin notice for settings success or error
	 */
	public function wprs_admin_notice_for_settings() {

		$screen = get_current_screen();

		if ($screen->id === 'settings_page_wp-reel-slider-settings') {
			$error = ( isset( $_GET['error'] ) ) ? sanitize_text_field( $_GET['error'] ) : '';
			if ($error === '1') {
				?>
				<div class="notice notice-error is-dismissible">
					<p><?php _e( 'Set psot type!', WP_REEL_SLIDER_TEXT_DOMAIN ); ?></p>
				</div>
				<?php 
			}
			elseif ($error === '2') {
				?>
				<div class="notice notice-success is-dismissible">
					<p><?php _e( 'Settings saved!', WP_REEL_SLIDER_TEXT_DOMAIN ); ?></p>
				</div>
				<?php 
			}
		}
	}

}
