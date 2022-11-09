<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://ashique12009.blogspot.com
 * @since      1.0.0
 *
 * @package    Wp_Reel_Slider
 * @subpackage Wp_Reel_Slider/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Reel_Slider
 * @subpackage Wp_Reel_Slider/public
 * @author     Khandoker Ashique Mahamud <ashique12009@gmail.com>
 */
class Wp_Reel_Slider_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, WP_REEL_SLIDER_PLUGIN_URL . 'public/css/wp-reel-slider-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		
		wp_enqueue_script( $this->plugin_name, WP_REEL_SLIDER_PLUGIN_URL . 'public/js/jquery.marque.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, WP_REEL_SLIDER_PLUGIN_URL . 'public/js/wp-reel-slider-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Adding marque starter into footer
	 */
	public function wprs_add_marque_js_starter_in_footer() {
		?>
		<script>
			jQuery(document).ready(function() {
				jQuery('.marquee').marquee({
					duration: 7000,
					pauseOnHover: true,
					duplicated: true,
					gap: 20,
					startVisible: true
				});
			});
		</script>
		<?php 
	}

	/**
	 * Add shortcode
	 */
	public function wprs_add_shortcode() {
		add_shortcode( 'show_ashique_reel_slider', [$this, 'wprs_shortcode_output'] );
	}

	/**
	 * Shortcode output
	 */
	public function wprs_shortcode_output() {

		// How many posts to show
		$post_type_setting = get_option( 'wprs_post_type', 'post' );
		$post_title_setting = get_option( 'wprs_post_title', 'no' );
		$post_featured_image_setting = get_option( 'wprs_post_featured_iamge_size', 'medium' );
		$post_image_number_setting = get_option( 'wprs_image_number', -1 );

		if ($post_featured_image_setting === 'thumbnail')
			$default_image_url = WP_REEL_SLIDER_PLUGIN_URL . 'public/images/default-image-thumbnail.png';
		elseif ($post_featured_image_setting === 'medium')
			$default_image_url = WP_REEL_SLIDER_PLUGIN_URL . 'public/images/default-image.png';

		$args = [
			'post_type' => $post_type_setting,
			'post_status' => 'publish',
			'numberposts' => $post_image_number_setting
		];

		$results = get_posts( $args );

		$html = "<div class='ashique-wp-reel-slider-flex-wrapper marquee'>";
		if ($results) {
			foreach ($results as $result) {
				$post_link = get_the_permalink( $result->ID );				
				$post_thumbnail_url = get_the_post_thumbnail_url( $result->ID, $post_featured_image_setting ) ? get_the_post_thumbnail_url( $result->ID, $post_featured_image_setting ) : $default_image_url;
				
                $html .= '<div class="ashique-custom-card-item">';
                	$html .= '<a class="ashique-image-anchor" href="' . $post_link . '">';
                		$html .= '<img src="' . $post_thumbnail_url . '" alt="article image" class="ashique-featured-img">';
                	$html .= '</a>';
                	
					if ($post_title_setting !== 'no') {
						$html .= '<a class="anchor text-center dis-block no-uderline-anchor black-text" href="' . $post_link . '">' . get_the_title( $result->ID ) . '</a>';
					}

                $html .= '</div>';
			}
		}
		$html .= "</div>";

		return $html;
	}

}
