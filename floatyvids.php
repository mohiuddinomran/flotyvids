<?php
/**
 * Plugin Name: Floatyvids
 * Plugin URI: https://github.com/mohiuddinomran/floatyvids
 * Description: Add a floating video bubble to your website using a shortcode. Supports YouTube and local videos.
 * Version: 1.0.0
 * Author: Mohiuddin Omran
 * Author URI: https://github.com/mohiuddinomran
 * License: GPL2
 * Text Domain: floatyvids
 */

if (!defined('ABSPATH')) exit;

// Enqueue assets
function floatyvids_enqueue_assets() {
    wp_enqueue_style('floatyvids-style', plugin_dir_url(__FILE__) . 'css/floatyvids.css');
    wp_enqueue_script('floatyvids-script', plugin_dir_url(__FILE__) . 'js/floatyvids.js', ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', 'floatyvids_enqueue_assets');

// Admin settings
if (is_admin()) {
    require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
}

// Shortcode to render video bubble
function floatyvids_shortcode($atts) {
    $options = get_option('floatyvids_settings');
    if (!isset($options['enabled']) || $options['enabled'] != '1') return '';

    $atts = shortcode_atts([
        'src' => '',
        'width' => '320',
        'height' => '180'
    ], $atts);

    if (empty($atts['src'])) return '';

    ob_start(); ?>
    <div class="floatyvids-bubble" id="floatyvids-bubble">
        <?php if (strpos($atts['src'], 'youtube.com') !== false || strpos($atts['src'], 'youtu.be') !== false): ?>
            <iframe src="<?php echo esc_url($atts['src']); ?>" width="<?php echo esc_attr($atts['width']); ?>" height="<?php echo esc_attr($atts['height']); ?>" frameborder="0" allowfullscreen></iframe>
        <?php else: ?>
            <video width="<?php echo esc_attr($atts['width']); ?>" height="<?php echo esc_attr($atts['height']); ?>" controls>
                <source src="<?php echo esc_url($atts['src']); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        <?php endif; ?>
        <?php if (!empty($options['show_close'])): ?>
            <span class="floatyvids-close" id="floatyvids-close">&times;</span>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('floatyvids', 'floatyvids_shortcode');
