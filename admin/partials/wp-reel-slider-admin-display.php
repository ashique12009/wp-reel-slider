<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://ashique12009.blogspot.com
 * @since      1.0.0
 *
 * @package    Wp_Reel_Slider
 * @subpackage Wp_Reel_Slider/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php 
if (!defined('ABSPATH')) {
    die;
}
?>

<?php 
    if (isset($_POST['post_type_setting'])) {
        if (!wp_verify_nonce($_POST['wp_reel_slider_settings_nonce_field'], 'wp-reel-slider-settings-nonce' )) {
            die('Something went wrong!');
        }
        elseif ($_POST['post_type_setting'] === '') {
            header('Location: ' . admin_url( 'options-general.php?page=wp-reel-slider-settings&error=1' ));
        }
        else {
            update_option( 'wprs_post_type', sanitize_text_field( $_POST['post_type_setting'] ) );
            update_option( 'wprs_post_title', sanitize_text_field( $_POST['need_title_setting'] ) );
            header('Location: ' . admin_url( 'options-general.php?page=wp-reel-slider-settings&error=2' ));
        }
    }

?>

<div class="wrap">
    <h1>WP reel slider settings</h1>
    <form method="post" action="">
        <?php wp_nonce_field( 'wp-reel-slider-settings-nonce', 'wp_reel_slider_settings_nonce_field' ); ?>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="ashique-most-read-post-post-number"><?php _e( 'Select your post type', WP_REEL_SLIDER_TEXT_DOMAIN ); ?>: </label></th>
                    <td>
                        <?php 
                            $desire_post_types = Wp_Reel_Slider_Helper_Trait::fetch_post_types();
                        ?>
                        <?php if (count($desire_post_types) > 0) : ?>
                            <select name="post_type_setting">
                                <?php foreach ($desire_post_types as $pt) : ?>
                                    <option value="<?php echo $pt;?>"><?php echo $pt;?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th scope="row"><label for="ashique-most-read-post-days-number"><?php _e( 'Do you want title bottom of featured image in slider', WP_REEL_SLIDER_TEXT_DOMAIN ); ?>: </label></th>
                    <td>
                        <input type="radio" name="need_title_setting" value="yes" /> Yes 
                        <input type="radio" name="need_title_setting" value="no" /> No 
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button();?>
    </form>
</div>