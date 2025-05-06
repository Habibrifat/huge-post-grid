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


add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts_callback');
add_action('wp_ajax_load_more_posts', 'load_more_posts_callback');


function load_more_posts_callback() {
    check_ajax_referer('load_more_nonce', 'nonce');

    $page = isset($_POST['page']) ? intval($_POST['page']) : 2;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 6;
    $selected_category = sanitize_text_field($_POST['selected_category']);

    $query_args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'paged'          => $page,
        'posts_per_page' => $posts_per_page,
    ];

    if (!empty($selected_category)) {
        $query_args['category_name'] = $selected_category;
    }

    $query = new WP_Query($query_args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="post-item">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail"><?php the_post_thumbnail('medium'); ?></div>
                <?php endif; ?>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <div class="post-content"><?php the_excerpt(); ?></div>
            </div>
            <?php
        }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo 0;
    }

    wp_die();
}





