<?php

namespace MediaplanetClientLogos;

use MediaplanetClientLogos\Settings\Settings;
use MediaplanetClientLogos\Widget\Widget;
use MediaplanetClientLogos\Block\Block;

class VickyInit
{
    private $i18n;
    private $widget;
    private $settings;
    private $render;
    private $assets;
    private $block;

    public function __construct()
    {
        $this->i18n = new I18N();
        $this->widget = new Widget();
        $this->settings = new Settings();
        $this->render = new Renderer();
        $this->assets = new Assets();
        $this->block = new Block();
    }

    public function run()
    {
        $this->i18n->hooks();
        $this->widget->hooks();
        $this->settings->hooks();
        $this->render->hooks();
        $this->assets->hooks();
        $this->block->hooks();
    }
}
