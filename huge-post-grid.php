<?php
/**
 * Plugin Name: Huge Post Grid
 * Description: A custom Elementor widget to display posts in a grid layout.
 * Version: 1.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Register the widget on Elementor initialization
function register_post_grid_widget($widgets_manager) {
    require_once(__DIR__ . '/widgets/post-grid-widget.php');
    $widgets_manager->register(new \Post_Grid_Widget());
}
add_action('elementor/widgets/register', 'register_post_grid_widget');

function post_grid_enqueue_styles() {
    wp_enqueue_style('post-grid-style', plugins_url('assets/css/style.css', __FILE__));
    wp_enqueue_style('post-grid-style', plugins_url('assets/js/loadmore.js', __FILE__));
}
add_action('wp_enqueue_scripts', 'post_grid_enqueue_styles');



function post_grid_enqueue_assets() {
    wp_enqueue_style('post-grid-style', plugins_url('assets/css/style.css', __FILE__));

    wp_enqueue_script(
        'post-grid-loadmore',
        plugins_url('assets/js/loadmore.js', __FILE__),
        ['jquery'],
        null,
        true
    );

    // Localize script with AJAX URL and nonce
    wp_localize_script('post-grid-loadmore', 'post_grid_ajax_obj', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('load_more_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'post_grid_enqueue_assets');


// Include the renderers file from widgets folder
require_once plugin_dir_path(__FILE__) . 'widgets/post-grid-renderers.php';

add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts_callback');
add_action('wp_ajax_load_more_posts', 'load_more_posts_callback');



function load_more_posts_callback() {
    require_once plugin_dir_path(__FILE__) . 'widgets/post-grid-renderers.php';
    check_ajax_referer('load_more_nonce', 'nonce');

    // Get all parameters
    $page = isset($_POST['page']) ? intval($_POST['page']) : 2;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 6;
    $selected_category = isset($_POST['selected_category']) ? sanitize_text_field($_POST['selected_category']) : '';
    $post_style = isset($_POST['post_style']) ? sanitize_text_field($_POST['post_style']) : 'huge-style1';

    // Get settings - either from direct POST or nested settings array
    $settings = [
        'show_image' => 'yes',
        'show_category' => 'yes',
        'show_content' => 'yes',
        'show_author' => 'yes',
        'show_date' => 'yes',
        'image_size' => 'large',
        'title_word_limit' => 10,
        'content_word_limit' => 20,
    ];

    // Handle both flat and nested settings
    if (isset($_POST['settings'])) {
        if (is_array($_POST['settings'])) {
            $settings = array_merge($settings, $_POST['settings']);
        } else {
            $decoded = json_decode(stripslashes($_POST['settings']), true);
            if (is_array($decoded)) {
                $settings = array_merge($settings, $decoded);
            }
        }
    }

    // Check for individual settings in root of POST
    foreach ($settings as $key => $default) {
        if (isset($_POST[$key])) {
            $settings[$key] = sanitize_text_field($_POST[$key]);
        }
    }

    error_log('Final settings: ' . print_r($settings, true));

    $query_args = [
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => $page,
        'posts_per_page' => $posts_per_page,
        'category_name' => $selected_category,
        'ignore_sticky_posts' => true
    ];

    $query = new WP_Query($query_args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            ep_render_post_style($post_style, $settings);
        }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo 0;
    }
    wp_die();
}









