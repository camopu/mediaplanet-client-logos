<?php


namespace MediaplanetClientLogos\Settings;

class Settings
{
    public function __construct()
    {
        require_once plugin_dir_path(__FILE__) . 'fields.php';
    }

    public function hooks()
    {
        add_action('admin_menu', [$this, 'vam_settings_page']);
        add_action('admin_init', [$this, 'add_acf_variables']);
        add_filter('acf/prepare_field', [$this, 'disable_fields']);
    }

    public function vam_settings_page()
    {
        add_menu_page(
            'Mediaplanet Client Logos Settings',
            'Mediaplanet Client Logos',
            'read',
            'vam-settings',
            [$this, 'vam_settings_page_content'],
            'dashicons-admin-plugins',
            100
        );
    }

    public function vam_settings_page_content()
    {
        do_action('acf/input/admin_head'); // Add ACF admin head hooks
        do_action('acf/input/admin_enqueue_scripts'); // Add ACF scripts

        acf_form([
            'id' => 'acf-form',
            'post_id' => 'options',
            'new_post' => false,
            'field_groups' => ['group_602e3814eaa06'],
            'return' => admin_url('admin.php?page=vam-settings'),
            'submit_value' => 'Update',
            'kses' => false
        ]);
    }

    public function add_acf_variables()
    {
        acf_form_head();
    }

    public function disable_fields($field)
    {
        $disabled_fields = ['field_602e3b74360ae', 'field_60337d8059345'];
        if (in_array($field['key'], $disabled_fields)) {
            if (!is_admin() || !current_user_can('administrator')) {
                $field['readonly'] = true;
            }
        }
        return $field;
    }
}
