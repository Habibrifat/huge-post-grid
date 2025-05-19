<?php
/**
 * Plugin Name: Huge Post Grid
 * Description: A custom Elementor widget to display posts in a grid layout.
 * Version: 1.0
 * Author: Rifat
 */

use BcMath\Number;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Register the widget on Elementor initialization
function register_post_grid_widget($widgets_manager) {
    require_once(__DIR__ . '/widgets/post-grid-widget.php');
    $widgets_manager->register(new \Post_Grid_Widget());
}
add_action('elementor/widgets/register', 'register_post_grid_widget');

function post_grid_enqueue_assets() {
    wp_enqueue_style('post-grid-style', plugins_url('assets/css/style.css', __FILE__));

    // Load More script
    wp_enqueue_script(
        'post-grid-loadmore',
        plugins_url('assets/js/loadmore.js', __FILE__),
        ['jquery'],
        null,
        true
    );
    
    // Pagination script
    wp_enqueue_script(
        'post-grid-pagination',
        plugins_url('assets/js/pagination.js', __FILE__),
        ['jquery'],
        null,
        true
    );

    // Localize scripts with consistent naming
    wp_localize_script('post-grid-loadmore', 'postGrid', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('post_grid_nonce'), // Single nonce for both
    ]);
}
add_action('wp_enqueue_scripts', 'post_grid_enqueue_assets');


// Include the renderers file from widgets folder
require_once plugin_dir_path(__FILE__) . 'widgets/post-grid-renderers.php';

// Load More 
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts_callback');
add_action('wp_ajax_load_more_posts', 'load_more_posts_callback');

function load_more_posts_callback() {
    // Security check with consistent nonce
    check_ajax_referer('post_grid_nonce', 'nonce');
    
    require_once plugin_dir_path(__FILE__) . 'widgets/post-grid-renderers.php';

    // Sanitize inputs
    $page = isset($_POST['page']) ? absint($_POST['page']) : 2;
    $posts_per_page = isset($_POST['posts_per_page']) ? absint($_POST['posts_per_page']) : 6;
    $selected_category = isset($_POST['selected_category']) ? sanitize_text_field($_POST['selected_category']) : '';
    $post_style = isset($_POST['post_style']) ? sanitize_key($_POST['post_style']) : 'huge-style1';

    // Default settings
    $default_settings = [
        'show_image' => 'yes',
        'show_category' => 'yes',
        'show_content' => 'yes',
        'content_type' => 'excerpt', // Default to excerpt
        'show_author' => 'yes',
        'show_date' => 'yes',
        'show_tags' => 'no',
        'image_size' => 'large',
        'title_word_limit' => 10,
        'content_word_limit' => 20,
        'columns' => 3,
    ];

    // Merge with posted settings
    $settings = $default_settings;
    if (isset($_POST['settings']) && is_array($_POST['settings'])) {
        foreach ($_POST['settings'] as $key => $value) {
            if (array_key_exists($key, $default_settings)) {
                // $settings[$key] = sanitize_text_field($value);
                // Special sanitization for content_type
                if ($key === 'content_type') {
                    $settings[$key] = in_array($value, ['excerpt', 'content']) ? $value : 'excerpt';
                } else {
                    $settings[$key] = sanitize_text_field($value);
                }

            }
        }
    }

    // Run query
    $query = new WP_Query([
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => $page,
        'posts_per_page' => $posts_per_page,
        'category_name' => $selected_category,
        'ignore_sticky_posts' => true
    ]);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
             huge_render_post_style($post_style, $settings);
        }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo 0;
    }
    
    wp_die();
}

// Number Pagination 
add_action('wp_ajax_nopriv_post_grid_pagination', 'post_grid_pagination_callback');
add_action('wp_ajax_post_grid_pagination', 'post_grid_pagination_callback');

function post_grid_pagination_callback() {
    check_ajax_referer('post_grid_nonce', 'nonce');
    require_once plugin_dir_path(__FILE__) . 'widgets/post-grid-renderers.php';

    // Sanitize all inputs
    $page = isset($_POST['page']) ? absint($_POST['page']) : 1;
    $container_id = isset($_POST['container_id']) ? sanitize_text_field($_POST['container_id']) : '';
    $posts_per_page = isset($_POST['posts_per_page']) ? absint($_POST['posts_per_page']) : get_option('posts_per_page');
    $selected_category = isset($_POST['selected_category']) ? sanitize_text_field($_POST['selected_category']) : '';
    $post_style = isset($_POST['post_style']) ? sanitize_key($_POST['post_style']) : 'huge-style1';

    // Default settings
    $default_settings = [
        'show_image' => 'yes',
        'show_category' => 'yes',
        'show_content' => 'yes',
        'content_type' => 'excerpt', // Default to excerpt
        'show_author' => 'yes',
        'show_date' => 'yes',
        'show_tags' => 'no',
        'image_size' => 'large',
        'title_word_limit' => 10,
        'content_word_limit' => 20,
        'columns' => 3,
    ];

    // Merge with posted settings
    $settings = $default_settings;
    if (isset($_POST['settings']) && is_array($_POST['settings'])) {
        foreach ($_POST['settings'] as $key => $value) {
            if (array_key_exists($key, $default_settings)) {
                // $settings[$key] = sanitize_text_field($value);
                // Special sanitization for content_type
                if ($key === 'content_type') {
                    $settings[$key] = in_array($value, ['excerpt', 'content']) ? $value : 'excerpt';
                } else {
                    $settings[$key] = sanitize_text_field($value);
                }
            }
        }
    }

    // Run query
    $query = new WP_Query([
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => $page,
        'posts_per_page' => $posts_per_page,
        'category_name' => $selected_category,
        'ignore_sticky_posts' => true
    ]);

    if ($query->have_posts()) {
        ob_start();
        // Maintain the original container ID
        echo '<div id="' . esc_attr($container_id) . '" class="huge-post-grid ep-post-grid huge-post-grid-' . esc_attr($post_style) . ' huge-post-columns-' . esc_attr($settings['columns']) . '">';
        
        while ($query->have_posts()) {
            $query->the_post();
             huge_render_post_style($post_style, $settings);
        }
        
        echo '</div>';
        
        // Pagination
        if ($query->max_num_pages > 1) {
            echo '<div class="post-grid-pagination">';
            echo paginate_links([
                'base' => add_query_arg('paged', '%#%'),
                'format' => '?paged=%#%',
                'current' => $page,
                'total' => $query->max_num_pages,
                'prev_text' => __('« Previous', 'huge-post-grid'),
                'next_text' => __('Next »', 'huge-post-grid'),
                'type' => 'list',
            ]);
            echo '</div>';
        }
        
        wp_reset_postdata();
        wp_send_json_success(['html' => ob_get_clean()]);
    } else {
        wp_send_json_error(['message' => 'No posts found']);
    }
}