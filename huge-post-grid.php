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

// function post_grid_enqueue_styles() {
//     wp_enqueue_style('post-grid-style', plugins_url('assets/css/style.css', __FILE__));
//     wp_enqueue_style('post-grid-style', plugins_url('assets/js/loadmore.js', __FILE__));
// }
// add_action('wp_enqueue_scripts', 'post_grid_enqueue_styles');

// new 

// function post_grid_enqueue_assets() {
//     wp_enqueue_style('post-grid-style', plugins_url('assets/css/style.css', __FILE__));

//     wp_enqueue_script(
//         'post-grid-loadmore',
//         plugins_url('assets/js/loadmore.js', __FILE__),
//         ['jquery'],
//         null,
//         true
//     );
//     // Pagination script
//     wp_enqueue_script(
//         'post-grid-pagination',
//         plugins_url('assets/js/pagination.js', __FILE__),
//         ['jquery'],
//         null,
//         true
//     );

//     // Localize script with AJAX URL and nonce
//     wp_localize_script('post-grid-loadmore', 'post_grid_ajax_obj', [
//         'ajaxurl' => admin_url('admin-ajax.php'),
//         'nonce'   => wp_create_nonce('load_more_nonce'),
//     ]);
// }
// add_action('wp_enqueue_scripts', 'post_grid_enqueue_assets');


// First, fix the nonce inconsistency
// function post_grid_enqueue_assets() {
//     wp_enqueue_style('post-grid-style', plugins_url('assets/css/style.css', __FILE__));

//     // Load More script
//     wp_enqueue_script(
//         'post-grid-loadmore',
//         plugins_url('assets/js/loadmore.js', __FILE__),
//         ['jquery'],
//         null,
//         true
//     );
    
//     // Pagination script
//     wp_enqueue_script(
//         'post-grid-pagination',
//         plugins_url('assets/js/pagination.js', __FILE__),
//         ['jquery'],
//         null,
//         true
//     );

//     // Localize scripts with separate nonces
//     wp_localize_script('post-grid-loadmore', 'post_grid_loadmore_obj', [
//         'ajaxurl' => admin_url('admin-ajax.php'),
//         'nonce'   => wp_create_nonce('load_more_nonce'),
//     ]);
    
//     wp_localize_script('post-grid-pagination', 'post_grid_pagination_obj', [
//         'ajaxurl' => admin_url('admin-ajax.php'),
//         'nonce'   => wp_create_nonce('pagination_nonce'),
//     ]);
// }

// function post_grid_enqueue_assets() {
//     wp_enqueue_style('post-grid-style', plugins_url('assets/css/style.css', __FILE__));

//     // Enqueue scripts with proper dependencies
//     wp_enqueue_script(
//         'post-grid-loadmore',
//         plugins_url('assets/js/loadmore.js', __FILE__),
//         ['jquery'],
//         filemtime(plugin_dir_path(__FILE__) . 'assets/js/loadmore.js'),
//         true
//     );
    
//     wp_enqueue_script(
//         'post-grid-pagination',
//         plugins_url('assets/js/pagination.js', __FILE__),
//         ['jquery'],
//         filemtime(plugin_dir_path(__FILE__) . 'assets/js/pagination.js'),
//         true
//     );

//     // Use the same nonce for both to simplify
//     $ajax_data = [
//         'ajaxurl' => admin_url('admin-ajax.php'),
//         'nonce'   => wp_create_nonce('post_grid_nonce'),
//     ];
    
//     wp_localize_script('post-grid-loadmore', 'postGrid', $ajax_data);
//     wp_localize_script('post-grid-pagination', 'postGrid', $ajax_data);
// }
// add_action('wp_enqueue_scripts', 'post_grid_enqueue_assets');


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

// add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts_callback');
// add_action('wp_ajax_load_more_posts', 'load_more_posts_callback');



// function load_more_posts_callback() {
//     require_once plugin_dir_path(__FILE__) . 'widgets/post-grid-renderers.php';
//     check_ajax_referer('load_more_nonce', 'nonce');

//     // Get all parameters
//     $page = isset($_POST['page']) ? intval($_POST['page']) : 2;
//     $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 6;
//     $selected_category = isset($_POST['selected_category']) ? sanitize_text_field($_POST['selected_category']) : '';
//     $post_style = isset($_POST['post_style']) ? sanitize_text_field($_POST['post_style']) : 'huge-style1';

//     // Get settings - either from direct POST or nested settings array
//     $settings = [
//         'show_image' => 'yes',
//         'show_category' => 'yes',
//         'show_content' => 'yes',
//         'show_author' => 'yes',
//         'show_date' => 'yes',
//         'image_size' => 'large',
//         'title_word_limit' => 10,
//         'content_word_limit' => 20,
//     ];

//     // Handle both flat and nested settings
//     if (isset($_POST['settings'])) {
//         if (is_array($_POST['settings'])) {
//             $settings = array_merge($settings, $_POST['settings']);
//         } else {
//             $decoded = json_decode(stripslashes($_POST['settings']), true);
//             if (is_array($decoded)) {
//                 $settings = array_merge($settings, $decoded);
//             }
//         }
//     }

//     // Check for individual settings in root of POST
//     foreach ($settings as $key => $default) {
//         if (isset($_POST[$key])) {
//             $settings[$key] = sanitize_text_field($_POST[$key]);
//         }
//     }

//     error_log('Final settings: ' . print_r($settings, true));

//     $query_args = [
//         'post_type' => 'post',
//         'post_status' => 'publish',
//         'paged' => $page,
//         'posts_per_page' => $posts_per_page,
//         'category_name' => $selected_category,
//         'ignore_sticky_posts' => true
//     ];

//     $query = new WP_Query($query_args);

//     if ($query->have_posts()) {
//         ob_start();
//         while ($query->have_posts()) {
//             $query->the_post();
//             ep_render_post_style($post_style, $settings);
//         }
//         wp_reset_postdata();
//         echo ob_get_clean();
//     } else {
//         echo 0;
//     }
//     wp_die();
// }


// function load_more_posts_callback() {
//     require_once plugin_dir_path(__FILE__) . 'widgets/post-grid-renderers.php';
//     check_ajax_referer('load_more_nonce', 'nonce');

//     // Get all parameters
//     $page = isset($_POST['page']) ? intval($_POST['page']) : 2;
//     $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 6;
//     $selected_category = isset($_POST['selected_category']) ? sanitize_text_field($_POST['selected_category']) : '';
//     $post_style = isset($_POST['post_style']) ? sanitize_text_field($_POST['post_style']) : 'huge-style1';

//     // Get settings - either from direct POST or nested settings array
//     $settings = [
//         'show_image' => 'yes',
//         'show_category' => 'yes',
//         'show_content' => 'yes',
//         'show_author' => 'yes',
//         'show_date' => 'yes',
//         'image_size' => 'large',
//         'title_word_limit' => 10,
//         'content_word_limit' => 20,
//     ];

//     // Handle both flat and nested settings
//     if (isset($_POST['settings'])) {
//         if (is_array($_POST['settings'])) {
//             $settings = array_merge($settings, $_POST['settings']);
//         } else {
//             $decoded = json_decode(stripslashes($_POST['settings']), true);
//             if (is_array($decoded)) {
//                 $settings = array_merge($settings, $decoded);
//             }
//         }
//     }

//     $query_args = [
//         'post_type' => 'post',
//         'post_status' => 'publish',
//         'paged' => $page,
//         'posts_per_page' => $posts_per_page,
//         'category_name' => $selected_category,
//         'ignore_sticky_posts' => true
//     ];

//     $query = new WP_Query($query_args);

//     if ($query->have_posts()) {
//         ob_start();
//         while ($query->have_posts()) {
//             $query->the_post();
//             ep_render_post_style($post_style, $settings);
//         }
//         wp_reset_postdata();
//         echo ob_get_clean();
//     } else {
//         echo 0;
//     }
//     wp_die();
// }

// new 

// function load_more_posts_callback() {
//     // Security check first
//     check_ajax_referer('load_more_nonce', 'nonce');
    
//     // Include the renderers file
//     require_once plugin_dir_path(__FILE__) . 'widgets/post-grid-renderers.php';

//     // Sanitize and validate required parameters
//     $page = isset($_POST['page']) ? absint($_POST['page']) : 2;
//     $posts_per_page = isset($_POST['posts_per_page']) ? absint($_POST['posts_per_page']) : 6;
//     $selected_category = isset($_POST['selected_category']) ? sanitize_text_field($_POST['selected_category']) : '';
//     $post_style = isset($_POST['post_style']) ? sanitize_key($_POST['post_style']) : 'huge-style1';

//     // Default settings with all possible options
//     $default_settings = [
//         'show_image' => 'yes',
//         'show_category' => 'yes',
//         'show_content' => 'yes',
//         'show_author' => 'yes',
//         'show_date' => 'yes',
//         'show_tags' => 'no',
//         'image_size' => 'large',
//         'title_word_limit' => 10,
//         'content_word_limit' => 20,
//         'columns' => 3, // Added default for columns
//     ];

//     // Initialize settings with defaults
//     $settings = $default_settings;

//     // Handle settings input
//     if (isset($_POST['settings'])) {
//         $posted_settings = [];
        
//         // Handle both array and JSON string
//         if (is_array($_POST['settings'])) {
//             $posted_settings = $_POST['settings'];
//         } elseif (is_string($_POST['settings'])) {
//             $posted_settings = json_decode(wp_unslash($_POST['settings']), true);
//             $posted_settings = is_array($posted_settings) ? $posted_settings : [];
//         }

//         // Sanitize each setting
//         foreach ($posted_settings as $key => $value) {
//             if (array_key_exists($key, $default_settings)) {
//                 $settings[$key] = sanitize_text_field($value);
//             }
//         }
//     }

//     // Additional sanitization for specific fields
//     $settings['image_size'] = sanitize_key($settings['image_size']);
//     $settings['title_word_limit'] = absint($settings['title_word_limit']);
//     $settings['content_word_limit'] = absint($settings['content_word_limit']);
//     $settings['columns'] = absint($settings['columns']);

//     // Prepare query args
//     $query_args = [
//         'post_type' => 'post',
//         'post_status' => 'publish',
//         'paged' => $page,
//         'posts_per_page' => $posts_per_page,
//         'category_name' => $selected_category,
//         'ignore_sticky_posts' => true
//     ];

//     // Run the query
//     $query = new WP_Query($query_args);

//     if ($query->have_posts()) {
//         ob_start();
//         while ($query->have_posts()) {
//             $query->the_post();
//             ep_render_post_style($post_style, $settings);
//         }
//         wp_reset_postdata();
//         echo ob_get_clean();
//     } else {
//         echo 0; // Return 0 when no more posts
//     }
    
//     wp_die(); // Always terminate AJAX requests properly
// }

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
                $settings[$key] = sanitize_text_field($value);
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
            ep_render_post_style($post_style, $settings);
        }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo 0;
    }
    
    wp_die();
}



// add_action('wp_ajax_nopriv_post_grid_pagination', 'post_grid_pagination_callback');
// add_action('wp_ajax_post_grid_pagination', 'post_grid_pagination_callback');

// function post_grid_pagination_callback() {
//     // Verify nonce first
//     check_ajax_referer('pagination_nonce', 'nonce');

//     error_log('Pagination callback triggered'); // Debug log
    
//     // Include renderers
//     require_once plugin_dir_path(__FILE__) . 'widgets/post-grid-renderers.php';

//     // Get and sanitize all parameters with error logging
//     $page = isset($_POST['page']) ? absint($_POST['page']) : 1;
//     $posts_per_page = isset($_POST['posts_per_page']) ? absint($_POST['posts_per_page']) : get_option('posts_per_page');
//     $selected_category = isset($_POST['selected_category']) ? sanitize_text_field($_POST['selected_category']) : '';
//     $post_style = isset($_POST['post_style']) ? sanitize_key($_POST['post_style']) : 'huge-style1';
//     $container_id = isset($_POST['container_id']) ? sanitize_text_field($_POST['container_id']) : '';

//     error_log('Received parameters: ' . print_r($_POST, true)); // Debug log

//     // Default settings
//     $default_settings = [
//         'show_image' => 'yes',
//         'show_category' => 'yes',
//         'show_content' => 'yes',
//         'show_author' => 'yes',
//         'show_date' => 'yes',
//         'image_size' => 'large',
//         'title_word_limit' => 10,
//         'content_word_limit' => 20,
//         'columns' => 3,
//     ];

//     // Process settings
//     $settings = $default_settings;
//     if (isset($_POST['settings'])) {
//         if (is_array($_POST['settings'])) {
//             $posted_settings = $_POST['settings'];
//         } elseif (is_string($_POST['settings'])) {
//             $posted_settings = json_decode(wp_unslash($_POST['settings']), true);
//         }
        
//         if (is_array($posted_settings)) {
//             foreach ($posted_settings as $key => $value) {
//                 if (array_key_exists($key, $default_settings)) {
//                     $settings[$key] = sanitize_text_field($value);
//                 }
//             }
//         }
//     }

//     // Query arguments
//     $query_args = [
//         'post_type' => 'post',
//         'post_status' => 'publish',
//         'paged' => $page,
//         'posts_per_page' => $posts_per_page,
//         'category_name' => $selected_category,
//         'ignore_sticky_posts' => true
//     ];

//     error_log('Query args: ' . print_r($query_args, true)); // Debug log

//     $query = new WP_Query($query_args);

//     if ($query->have_posts()) {
//         ob_start();
//         echo '<div id="' . esc_attr($container_id) . '" class="huge-post-grid ep-post-grid huge-post-grid-' . esc_attr($post_style) . ' huge-post-columns-' . esc_attr($settings['columns']) . '">';
        
//         while ($query->have_posts()) {
//             $query->the_post();
//             ep_render_post_style($post_style, $settings);
//         }
        
//         echo '</div>';
        
//         // Pagination
//         if ($query->max_num_pages > 1) {
//             echo '<div class="post-grid-pagination">';
//             echo paginate_links([
//                 'base' => add_query_arg('paged', '%#%'),
//                 'format' => '?paged=%#%',
//                 'current' => $page,
//                 'total' => $query->max_num_pages,
//                 'prev_text' => __('« Previous', 'elementor-post-grid'),
//                 'next_text' => __('Next »', 'elementor-post-grid'),
//                 'type' => 'list',
//             ]);
//             echo '</div>';
//         }
        
//         wp_reset_postdata();
        
//         $html = ob_get_clean();
//         error_log('Generated HTML length: ' . strlen($html)); // Debug log
        
//         wp_send_json_success([
//             'html' => $html,
//             'max_pages' => $query->max_num_pages
//         ]);
//     } else {
//         error_log('No posts found'); // Debug log
//         wp_send_json_error(['message' => 'No posts found']);
//     }
// }

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
                $settings[$key] = sanitize_text_field($value);
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
            ep_render_post_style($post_style, $settings);
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
                'prev_text' => __('« Previous', 'elementor-post-grid'),
                'next_text' => __('Next »', 'elementor-post-grid'),
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