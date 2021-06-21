<?php


namespace MediaplanetClientLogos;

class Assets
{
    public function hooks()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('wp_head', [$this, 'init_ad_manager']);
    }

    public function enqueue_assets()
    {
        wp_register_script('vam-js', plugin_dir_url(dirname(dirname(__FILE__))) . 'mediaplanet-client-logos/assets/js/vam.min.js', [], VAM_VERSION, false);
        wp_enqueue_script('vam-js');
    }

    public function init_ad_manager() {
        $show_default_targeting = "true";
        if (is_front_page()) {
            $show_default_targeting = "false";
        }
        echo "    <script async src=\"https://securepubads.g.doubleclick.net/tag/js/gpt.js\"></script>
        <script>
          window.googletag = window.googletag || {cmd: []};
          window.vamShowDefaultTargeting = ".$show_default_targeting."
        </script>";
    }
}
