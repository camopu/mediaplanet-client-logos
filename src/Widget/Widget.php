<?php

namespace MediaplanetClientLogos\Widget;

class Widget extends \WP_Widget
{
    private $defaults = [];

    private $admin_options = [];

    public function __construct(array $options = [], array $config = [])
    {
        // Create the widget
        parent::__construct(
            'vam',
            'Mediaplanet Client Logos',
            [
                'classname' => 'mediaplanet-client-logos',
                'description' => __('', 'vam')
            ]
        );

        $this->defaults = $options;
        $this->admin_options = $config;
        require_once plugin_dir_path(__FILE__) . 'fields.php';
    }

    public function hooks()
    {
        // Register the widget
        add_action('widgets_init', [$this, 'register']);
    }

    public function register()
    {
        register_widget($this);
    }

    public function widget($args, $instance)
    {
        if (! isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        // widget ID with prefix for use in ACF API functions
        $widget_id = 'widget_' . $args['widget_id'];
        $ad_unit_path = get_field('ad-unit-path', $widget_id);
        $ad_placeholder_id = get_field('ad_placeholder_id', $widget_id);
        $ad_sizes = get_field('ad_sizes', $widget_id);
        $targets = get_field('target-key-values', $widget_id);

        if (count($ad_sizes) > 1) {
            $ad_sizes = array_column($ad_sizes, 'size');
            $sizes = '[' . implode(',', $ad_sizes) . ']';
        } else {
            $sizes = array_column($ad_sizes, 'size')[0];
        }
        require plugin_dir_path(__FILE__) . 'front.php';
    }


    public function form($instance)
    {
    }


    public function update($new_instance, $old_instance)
    {
    }
}
