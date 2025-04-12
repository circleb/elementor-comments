<?php

/**
 * Plugin Name: Elementor Comments
 * Description: Customizeable comment list and form widget for Elementor.
 * Version:     0.1
 * Author:      Ben Owen
 * Author URI:  https://benowen.net
 * Text Domain: elementor-comments
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Comment_Addon
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('admin_init', array($this, 'check_elementor'));
        add_action('elementor/widgets/register', array($this, 'register_widgets'));
    }

    public function enqueue_styles()
    {
        wp_enqueue_style('ec-styles-css', plugins_url('assets/css/ec-styles.css', __FILE__), array(), '1.1');
    }

    public function check_elementor()
    {
        if (! class_exists('Elementor\Plugin')) {
            deactivate_plugins(plugin_basename(__FILE__));
            add_action('admin_notices', array($this, 'elementor_missing_notice'));
        }
    }

    public function elementor_missing_notice()
    {
?>
        <div class="error">
            <p><?php echo sprintf('The <strong>%s</strong> plugin requires <strong>Elementor</strong> to be installed and activated.', 'Elementor Comments'); ?></p>
        </div>
<?php
    }

    public function register_widgets($widgets_manager)
    {
        require_once(__DIR__ . '/widgets/comment-form.php');
        require_once(__DIR__ . '/widgets/comment-list.php');

        $widgets_manager->register_widget_type(new Comment_Form_Widget());
        $widgets_manager->register_widget_type(new Comment_List_Widget());
    }
}

// Instantiate the plugin class
new Comment_Addon();
