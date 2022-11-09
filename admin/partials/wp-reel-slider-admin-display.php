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
            $post_type_setting = sanitize_text_field( $_POST['post_type_setting'] );
            update_option( 'wprs_post_type', ($post_type_setting == '') ? 'post' : $post_type_setting );

            $need_title_setting = sanitize_text_field( $_POST['need_title_setting'] );
            update_option( 'wprs_post_title', ($need_title_setting == '') ? 'no' : $need_title_setting );
            
            $post_featured_iamge_size_setting = sanitize_text_field( $_POST['post_featured_iamge_size_setting'] );
            update_option( 'wprs_post_featured_iamge_size', ($post_featured_iamge_size_setting == '') ? 'medium' : $post_featured_iamge_size_setting);
            
            $image_number_setting = sanitize_text_field( $_POST['image_number_setting'] );            
            update_option( 'wprs_image_number', ($image_number_setting == '') ? -1 : $image_number_setting);

            header('Location: ' . admin_url( 'options-general.php?page=wp-reel-slider-settings&error=2' ));
        }
    }

?>

<div class="wrap">
    <h1>Reel slider settings</h1>
    <?php
        $post_type_setting = esc_html( get_option( 'wprs_post_type', 'post' ) );
        $need_title_setting = esc_html( get_option( 'wprs_post_title', 'no' ) );
        $post_featured_iamge_size_setting = esc_html( get_option( 'wprs_post_featured_iamge_size', 'medium' ) );
        $image_number_setting = esc_html( get_option( 'wprs_image_number', -1 ) );
    ?>
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
                                    <option value="<?php echo esc_attr( $pt );?>" <?php echo ($post_type_setting == $pt) ? ' selected="selected"': '';?>><?php echo esc_html( $pt );?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="ashique-most-read-post-days-number"><?php _e( 'Do you want title bottom of featured image in slider', WP_REEL_SLIDER_TEXT_DOMAIN ); ?>: </label></th>
                    <td>
                        <input type="radio" name="need_title_setting" value="yes" <?php echo ($need_title_setting == 'yes') ? 'checked="checked"' : '';?> /> Yes 
                        <input type="radio" name="need_title_setting" value="no" <?php echo ($need_title_setting == 'no') ? 'checked="checked"' : '';?> /> No 
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="ashique-most-read-post-days-number"><?php _e( 'Slider image size', WP_REEL_SLIDER_TEXT_DOMAIN ); ?>: </label></th>
                    <td>
                        <input type="radio" name="post_featured_iamge_size_setting" value="medium" <?php echo ($post_featured_iamge_size_setting == 'medium') ? 'checked="checked"' : '';?> /> Medium ( 300 X 300 ) 
                        <input type="radio" name="post_featured_iamge_size_setting" value="thumbnail" <?php echo ($post_featured_iamge_size_setting == 'thumbnail') ? 'checked="checked"' : '';?> /> Thumbnail ( 150 X 150 )
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="ashique-most-read-post-post-number"><?php _e( 'How many images do you want to show', WP_REEL_SLIDER_TEXT_DOMAIN ); ?>: </label></th>
                    <td>
                        <input type="number" id="ashique-most-read-post-post-number" name="image_number_setting" class="regular-text" value="<?php echo esc_html( $image_number_setting );?>">
                        <small class="dis-block">-1 means show all images from that mentioned post type</small>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button();?>
    </form>
</div>