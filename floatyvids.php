<?php
/**
 * Plugin Name: FloatyVids
 * Plugin URI: https://github.com/mohiuddinomran/floatyvids
 * Description: Display a floating video bubble using shortcodes. Supports YouTube or local video and an admin toggle.
 * Version: 1.0
 * Author: mohiuddin omran
 * Author URI: https://mohiuddinomran.com
 * License: GPLv2 or later
 * Text Domain: floatyvids
 */

if (!defined('ABSPATH')) {
    exit;
}

// Include files
require_once plugin_dir_path(__FILE__) . 'includes/floatyvids-functions.php';
require_once plugin_dir_path(__FILE__) . 'admin/floatyvids-admin.php';
require_once plugin_dir_path(__FILE__) . 'public/floatyvids-public.php';

// Enqueue scripts/styles
function floatyvids_enqueue_scripts() {
    wp_enqueue_style('floatyvids-style', plugin_dir_url(__FILE__) . 'public/css/floatyvids.css');
    wp_enqueue_script('floatyvids-script', plugin_dir_url(__FILE__) . 'public/js/floatyvids.js', array('jquery'), null, true);

    wp_localize_script('floatyvids-script', 'floatyvids_vars', array(
        'is_enabled' => get_option('floatyvids_enabled', '1')
    ));
}
add_action('wp_enqueue_scripts', 'floatyvids_enqueue_scripts');
