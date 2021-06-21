<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             4.0.0
 * @package           MediaplanetClientLogos
 *
 * @wordpress-plugin
 * Plugin Name:       Mediaplanet Client Logos
 * Description:       A plugin that allows to upload and managed logos.
 * Version:           0.1
 * Author:            Alexander Akimchenko
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       vam
 * Domain Path:       /languages
 */

require __DIR__ . '/vendor/autoload.php';
define('VAM_VERSION', '0.2');

use MediaplanetClientLogos\VickyInit;

$init = new VickyInit();
$init->run();
