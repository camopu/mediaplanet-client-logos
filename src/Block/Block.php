<?php

namespace MediaplanetClientLogos\Block;

class Block
{

    public function hooks()
    {
        // Register Gutenberg block
        add_action('acf/init', [$this, 'vam_block_init']);
    }

    public function vam_block_init() {
        if( function_exists('acf_register_block_type') ) {

            // Register a testimonial block.
            acf_register_block_type(array(
                'name'              => 'Vicky Ad',
                'title'             => __('Vicky Ad'),
                'description'       => __('A Vicky Ad block that allow to insert Google Ad'),
                'render_template'   =>  __DIR__ . '/front.php',
                'mode'              => 'preview',
                'icon'              => 'dashicons dashicons-money-alt',
                'category'          => 'embed',
            ));
        }
    }
}