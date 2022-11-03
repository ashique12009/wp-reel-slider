<?php
/**
 *  Helper trait
 * */ 
trait Wp_Reel_Slider_Helper_Trait {
    
    public static function fetch_post_types() {
        
        $all_post_types = get_post_types();

        $desire_post_types = [];

        foreach ($all_post_types as $post_type) {
            if ( post_type_supports( $post_type, 'thumbnail' ) ) {
                array_push( $desire_post_types, $post_type );
            }
        }

        return $desire_post_types;
    }

}