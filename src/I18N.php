<?php


namespace MediaplanetClientLogos;

class I18N
{
    public function hooks()
    {
        add_action('plugins_loaded', [$this, 'load_plugin_textdomain']);
    }

    public function load_plugin_textdomain()
    {
        $locale = apply_filters('plugin_locale', get_locale(), 'vam');
        load_textdomain('vam', WP_LANG_DIR . '/' . 'vicky-ad-manager' . '/' . 'vicky-ad-manager' . '-' . $locale . '.mo');
    }
}
