<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Post_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'huge_post_grid';
    }

    public function get_title() {
        return __('Huge Post Grid', 'huge-post-grid');
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Settings', 'elementor-post-grid'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Number of Posts', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 6,
            ]
        );

    // Get all categories dynamically
    $categories = get_categories();
    $category_options = ['' => __('All Categories', 'elementor-post-grid')];

    foreach ($categories as $category) {
        $category_options[$category->slug] = $category->name;
    }

    // Add Category Dropdown in Elementor Controls
    $this->add_control(
        'selected_category',
        [
            'label' => __('Filter by Category', 'elementor-post-grid'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => $category_options,
            'default' => '',
        ]
    );


        // Toggle controls
        $this->add_control(
            'show_image',
            [
                'label' => __('Show Image', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementor-post-grid'),
                'label_off' => __('Hide', 'elementor-post-grid'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_content',
            [
                'label' => __('Show Content', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label' => __('Show Category', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_tags',
            [
                'label' => __('Show Tags', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_author',
            [
                'label' => __('Show Author', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label' => __('Show Date', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        // $this->add_control(
        //     'pagination_type',
        //     [
        //         'label' => __('Pagination Type', 'elementor-post-grid'),
        //         'type' => \Elementor\Controls_Manager::SELECT,
        //         'options' => [
        //             'pagination' => __('Pagination', 'elementor-post-grid'),
        //             'load_more' => __('Load More Button', 'elementor-post-grid'),
        //         ],
        //         'default' => 'pagination',
        //     ]
        // );

        $this->add_control(
            'pagination_type',
            [
                'label' => __('Pagination Type', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'none' => __('No Pagination', 'elementor-post-grid'),
                    'pagination' => __('Numbered Pagination', 'elementor-post-grid'),
                    'load_more' => __('Load More Button', 'elementor-post-grid'),
                ],
                'default' => 'pagination',
            ]
        );

        $this->end_controls_section();
    }
    public function get_script_depends() {
        return ['elementor-post-grid'];
    }

    // protected function render() {
    //     $settings = $this->get_settings_for_display();
    
    //     $query_args = [
    //         'post_type' => 'post',
    //         'posts_per_page' => $settings['posts_per_page'],
    //         'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
    //     ];
    
    //     // Apply selected category filter
    //     if (!empty($settings['selected_category'])) {
    //         $query_args['category_name'] = $settings['selected_category'];
    //     }
    
    //     $query = new WP_Query($query_args);
    
    //     if ($query->have_posts()) {
    //         echo '<div class="custom-post-grid">';
    //         while ($query->have_posts()) {
    //             $query->the_post();
    //             echo '<div class="post-item">';
                
    //             if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
    //                 echo '<div class="post-thumbnail">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</div>';
    //             }
    
    //             echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    
    //             if ($settings['show_content'] === 'yes') {
    //                 echo '<div class="post-content">' . get_the_excerpt() . '</div>';
    //             }
    
    //             echo '</div>';
    //         }
    //         echo '</div>';
    
    //         // Pagination or Load More Button
    //         if ($settings['pagination_type'] === 'pagination') {
    //             echo '<div class="post-grid-pagination">' . paginate_links() . '</div>';
    //         } else {
    //             echo '<button id="load-more-posts" data-page="1" class="load-more-btn">Load More</button>';
    //         }
    
    //         wp_reset_postdata();
    //     } else {
    //         echo __('No posts found', 'elementor-post-grid');
    //     }
    // }

//     protected function render() {
//         $settings = $this->get_settings_for_display();
    
//         $posts_per_page = $settings['posts_per_page'];
//         $selected_category = $settings['selected_category'];
    
//         // First page load
//         $query_args = [
//             'post_type'      => 'post',
//             'posts_per_page' => $posts_per_page,
//             'paged'          => 1,
//         ];
    
//         if (!empty($selected_category)) {
//             $query_args['category_name'] = $selected_category;
//         }
    
//         $query = new WP_Query($query_args);
    
//         if ($query->have_posts()) {
//             echo '<div class="custom-post-grid">';
    
//             while ($query->have_posts()) {
//                 $query->the_post();
    
//                 echo '<div class="post-item">';
    
//                 if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//                     echo '<div class="post-thumbnail">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</div>';
//                 }
    
//                 echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    
//                 if ($settings['show_content'] === 'yes') {
//                     echo '<div class="post-content">' . get_the_excerpt() . '</div>';
//                 }
    
//                 echo '</div>'; // .post-item
//             }
    
//             echo '</div>'; // .custom-post-grid
    
//             // Load More Button
//             // if ($settings['pagination_type'] === 'load_more') {
//             //     echo '<div class="load-more-wrapper" style="text-align: center; margin-top: 20px;">';
//             //     echo '<button id="load-more-posts"
//             //                 class="load-more-btn"
//             //                 data-page="1"
//             //                 data-posts-per-page="' . esc_attr($posts_per_page) . '"
//             //                 data-category="' . esc_attr($selected_category) . '">
//             //             ' . __('Load More', 'elementor-post-grid') . '
//             //           </button>';
//             //     echo '</div>';
//             // } else {
//             //     // Traditional Pagination
//             //     echo '<div class="post-grid-pagination">' . paginate_links() . '</div>';
//             // }

//         // Total pages
//         // Load More Button - Only show if there are more posts
//         if ($settings['pagination_type'] === 'load_more') {
//             $max_pages = $query->max_num_pages;
//             if ($max_pages > 1) {
//                 echo '<div class="load-more-wrapper" style="text-align: center; margin-top: 20px;">';
//                 echo '<button id="load-more-posts"
//                             class="load-more-btn"
//                             data-page="1"
//                             data-max-pages="' . esc_attr($max_pages) . '"
//                             data-posts-per-page="' . esc_attr($posts_per_page) . '"
//                             data-category="' . esc_attr($selected_category) . '">
//                         ' . __('Load More', 'elementor-post-grid') . '
//                     </button>';
//                 echo '</div>';
//             }
//         } else {
//             // Traditional Pagination
//             echo '<div class="post-grid-pagination">' . paginate_links() . '</div>';
//         }



    
//             wp_reset_postdata();
//         } else {
//             echo '<p>' . __('No posts found', 'elementor-post-grid') . '</p>';
//         }
// }

protected function render() {
    $settings = $this->get_settings_for_display();
    
    $posts_per_page = $settings['posts_per_page'];
    $selected_category = $settings['selected_category'];
    $pagination_type = $settings['pagination_type'];
    
    // First page load
    $query_args = [
        'post_type'      => 'post',
        'posts_per_page' => ($pagination_type === 'none') ? -1 : $posts_per_page, // Show all posts if no pagination
        'paged'          => max(1, get_query_var('paged'), get_query_var('page')),
    ];
    
    if (!empty($selected_category)) {
        $query_args['category_name'] = $selected_category;
    }
    
    $query = new WP_Query($query_args);
    
    if ($query->have_posts()) {
        echo '<div class="custom-post-grid">';
        
        while ($query->have_posts()) {
            $query->the_post();
            
            echo '<div class="post-item">';
            
            if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
                echo '<div class="post-thumbnail">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</div>';
            }
            
            echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
            
            if ($settings['show_content'] === 'yes') {
                echo '<div class="post-content">' . get_the_excerpt() . '</div>';
            }
            
            echo '</div>'; // .post-item
        }
        
        echo '</div>'; // .custom-post-grid
        
        // Handle pagination based on selected type
        if ($pagination_type === 'load_more') {
            $max_pages = $query->max_num_pages;
            if ($max_pages > 1) {
                echo '<div class="load-more-wrapper" style="text-align: center; margin-top: 20px;">';
                echo '<button id="load-more-posts"
                            class="load-more-btn"
                            data-page="1"
                            data-max-pages="' . esc_attr($max_pages) . '"
                            data-posts-per-page="' . esc_attr($posts_per_page) . '"
                            data-category="' . esc_attr($selected_category) . '">
                        ' . __('Load More', 'elementor-post-grid') . '
                      </button>';
                echo '</div>';
            }
        } elseif ($pagination_type === 'pagination') {
            $big = 999999999; // need an unlikely integer
            echo '<div class="post-grid-pagination">';
            echo paginate_links([
                'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'  => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total'   => $query->max_num_pages,
                'prev_text' => __('« Previous'),
                'next_text' => __('Next »'),
            ]);
            echo '</div>';
        }
        // No output for 'none' option
        
        wp_reset_postdata();
    } else {
        echo '<p>' . __('No posts found', 'elementor-post-grid') . '</p>';
    }
}
    
    
 




    protected function content_template() {}
}
