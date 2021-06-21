<?php


namespace MediaplanetClientLogos;

class Renderer
{
    public function __construct()
    {
    }

    public function hooks()
    {
        add_action('wp_head', [$this, 'head_scripts']);
    }

    public function head_scripts()
    {
        echo get_field('document_header', 'option');
    }
}
