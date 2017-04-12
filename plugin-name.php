<?php

/*
Plugin Name: Plugin Name
Plugin URI: http://d3applications.com
Description: Plugin Description
Version: 1.0.0
Author: Max Baun
Author URI: http://github.com/maxbaun
License: GPL2
*/

require_once plugin_dir_path(__FILE__) . 'src/classes/Config.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Helpers.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Activation.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/JsonManifest.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/Assets.php';
require_once plugin_dir_path(__FILE__) . 'src/classes/ShortcodeExample.php';

use D3\Plugin;
use D3\Plugin\JsonManifest;
use D3\Plugin\Config;
use D3\Plugin\Assets;
use D3\Plugin\Activation;
use D3\Plugin\ShortcodeExample;

add_action('init', function () {
	$paths = [
		'dir.plugin' => plugin_dir_path(__FILE__),
		'uri.plugin' => plugins_url(null, __FILE__)
	];

	$manifest = new JsonManifest("{$paths['dir.plugin']}dist/assets.json", "{$paths['uri.plugin']}/dist");
	Config::setManifest($manifest);

	Assets::init($manifest);
	ShortcodeExample::init();
});

register_activation_hook(__FILE__, function () {
	Activation::init();
});
