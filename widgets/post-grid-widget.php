<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

// In your widget class file
// require_once 'post-grid-renderers.php';

// Include the renderers file (same directory)
require_once plugin_dir_path(__FILE__) . 'post-grid-renderers.php';

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
            'post_style',
            [
                'label' => __('Post Design Style', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'huge-style1' => __('Design 1 - Card', 'elementor-post-grid'),
                    'huge-style2' => __('Design 2 - Card Overlay', 'elementor-post-grid'),
                    'huge-style3' => __('Design 3 - Creative Box', 'elementor-post-grid'),
                    // 'style4' => __('Design 4 - Metro Grid', 'elementor-post-grid'),
                    'huge-style4' => __('Design 5 - Hover Card', 'elementor-post-grid'),
                    'huge-style5' => __('Design 6 - Classic Overlay', 'elementor-post-grid'),
                     'huge-style6' => __('Design 7 - Card Gradient', 'elementor-post-grid'),
                     'huge-style7' => __('Design 8 - Modern Hover', 'elementor-post-grid'),
                     'huge-style8' => __('Design 9 - Creative Tilt', 'elementor-post-grid'),
                     'huge-style9' => __('Design 10 - Minimal List', 'elementor-post-grid'),
                ],
                'default' => 'huge-style1',
                'separator' => 'before',
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
            'image_size',
            [
                'label' => __('Image Size', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'medium',
                'options' => [
                    'thumbnail'      => __('Thumbnail - 150x150', 'elementor-post-grid'),
                    'medium'         => __('Medium - 300x300', 'elementor-post-grid'),
                    'medium_large'   => __('Medium Large - 768x0', 'elementor-post-grid'),
                    'large'          => __('Large - 1024x1024', 'elementor-post-grid'),
                    '1536x1536'      => __('1536x1536', 'elementor-post-grid'),
                    '2048x2048'      => __('2048x2048', 'elementor-post-grid'),
                    'full'           => __('Full', 'elementor-post-grid'),
                ],
                'condition' => [
                    'show_image' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'title_word_limit',
            [
                'label' => __('Title Word Limit', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'default' => 10,
                'description' => __('Limit the number of words in the post title.', 'elementor-post-grid'),
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
            'content_word_limit',
            [
                'label' => __('Content Word Limit', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 20,
                'condition' => [
                    'show_content' => 'yes'
                ],
                'description' => __('Limit the number of words in the post excerpt/content.', 'elementor-post-grid'),
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
        $this->add_control(
            'show_readmore',
            [
                'label' => __('Read More', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_comments',
            [
                'label' => __('Show Comments', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

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

        // Add this in your register_controls() function after the existing controls
        $this->add_control(
        'columns',
        [
            'label' => __('Columns', 'elementor-post-grid'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '1' => __('1 Column', 'elementor-post-grid'),
                '2' => __('2 Columns', 'elementor-post-grid'),
                '3' => __('3 Columns', 'elementor-post-grid'),
                '4' => __('4 Columns', 'elementor-post-grid'),
                '5' => __('5 Columns', 'elementor-post-grid'),
                '6' => __('6 Columns', 'elementor-post-grid'),
            ],
            'default' => '3',
            'separator' => 'before',
        ]
    );
$this->add_control(
    'column_gap',
    [
        'label' => __('Column Gap', 'elementor-post-grid'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'default' => [
            'size' => 30,
            'unit' => 'px',
        ],
        'selectors' => [
            '{{WRAPPER}} .huge-post-grid' => 'column-gap: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'row_gap',
    [
        'label' => __('Row Gap', 'elementor-post-grid'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'default' => [
            'size' => 30,
            'unit' => 'px',
        ],
        'selectors' => [
            '{{WRAPPER}} .huge-post-grid' => 'row-gap: {{SIZE}}{{UNIT}};',
        ],
    ]
);


        $this->end_controls_section();
    }
    public function get_script_depends() {
        return ['elementor-post-grid'];
    }


protected function render() {
    $settings = $this->get_settings_for_display();
    
    // Common query setup
    $query_args = [
        'post_type'      => 'post',
        'posts_per_page' => ($settings['pagination_type'] === 'none') ? -1 : $settings['posts_per_page'],
        'paged'          => max(1, get_query_var('paged'), get_query_var('page')),
    ];
    
    if (!empty($settings['selected_category'])) {
        $query_args['category_name'] = $settings['selected_category'];
    }
    
    $query = new WP_Query($query_args);
    
    if ($query->have_posts()) {
        // echo '<div class="custom-post-grid style-' . esc_attr($settings['post_style']) . '">';
        echo '<div class="huge-post-grid ep-post-grid huge-post-grid-' . esc_attr($settings['post_style']) . ' huge-post-columns-' . esc_attr($settings['columns']) . '">';
        
        while ($query->have_posts()) {
            $query->the_post();
            
            // Call the appropriate style renderer8
            $this->render_post_style($settings['post_style'], $settings);
        }
        
        echo '</div>';
        
        // Handle pagination (same as before)
        $this->render_pagination($query, $settings);
        
        wp_reset_postdata();
    } else {
        echo '<p>' . __('No posts found', 'elementor-post-grid') . '</p>';
    }
}

protected function render_post_style($style, $settings) {
    ep_render_post_style($style, $settings);
}

// protected function render_pagination($query, $settings) {
//     if ($settings['pagination_type'] === 'load_more') {
//         $max_pages = $query->max_num_pages;
//         if ($max_pages > 1) {
//             echo '<div class="load-more-wrapper">';
//             echo '<button id="load-more-posts" class="load-more-btn" 
//                       data-page="1" 
//                       data-max-pages="' . esc_attr($max_pages) . '"
//                       data-posts-per-page="' . esc_attr($settings['posts_per_page']) . '"
//                       data-category="' . esc_attr($settings['selected_category']) . '"
//                       data-post-style="' . esc_attr($settings['post_style']) . '"
                      
//                       data-show-image="' . esc_attr($settings['show_image']) . '"
//                       data-show-category="' . esc_attr($settings['show_category']) . '"
//                       data-show-content="' . esc_attr($settings['show_content']) . '"
//                       data-show-author="' . esc_attr($settings['show_author']) . '"
//                       data-show-date="' . esc_attr($settings['show_date']) . '"
//                       data-image-size="' . esc_attr($settings['image_size']) . '"
//                       data-title-word-limit="' . esc_attr($settings['title_word_limit']) . '"
//                       data-content-word-limit="' . esc_attr($settings['content_word_limit']) . '">'
//                    . __('Load More', 'elementor-post-grid') . '</button>';
//             echo '</div>';
//         }
//     } elseif ($settings['pagination_type'] === 'pagination') {
//         $total_pages = $query->max_num_pages;
//         if ($total_pages > 1) {
//             $current_page = max(1, get_query_var('paged'), get_query_var('page'));
            
//             // Get the base URL
//             $base = html_entity_decode(get_pagenum_link());
//             $base = add_query_arg('paged', '%#%', $base);
            
//             // Fix for home URL pagination
//             if (is_front_page()) {
//                 $base = home_url('page/%#%/');
//             }
            
//             echo '<div class="post-grid-pagination">';
//             echo paginate_links([
//                 'base'      => $base,
//                 'format'    => '?paged=%#%',
//                 'current'   => $current_page,
//                 'total'     => $total_pages,
//                 'prev_text' => __('« Prev', 'elementor-post-grid'),
//                 'next_text' => __('Next »', 'elementor-post-grid'),
//                 'type'      => 'list',
//                 'end_size'  => 1,
//                 'mid_size'  => 2,
//                 'add_args'  => false,
//             ]);
//             echo '</div>';
//         }
//     }
// }

protected function render_pagination($query, $settings) {
    if ($settings['pagination_type'] === 'load_more') {
        $max_pages = $query->max_num_pages;
        if ($max_pages > 1) {
            echo '<div class="load-more-wrapper">';
            echo '<button id="load-more-posts" class="load-more-btn" 
                      data-page="1" 
                      data-max-pages="' . esc_attr($max_pages) . '"
                      data-posts-per-page="' . esc_attr($settings['posts_per_page']) . '"
                      data-category="' . esc_attr($settings['selected_category']) . '"
                      data-post-style="' . esc_attr($settings['post_style']) . '"
                      data-show-image="' . esc_attr($settings['show_image']) . '"
                      data-show-category="' . esc_attr($settings['show_category']) . '"
                      data-show-content="' . esc_attr($settings['show_content']) . '"
                      data-show-author="' . esc_attr($settings['show_author']) . '"
                      data-show-date="' . esc_attr($settings['show_date']) . '"
                      data-image-size="' . esc_attr($settings['image_size']) . '"
                      data-title-word-limit="' . esc_attr($settings['title_word_limit']) . '"
                      data-content-word-limit="' . esc_attr($settings['content_word_limit']) . '">'
                   . __('Load More', 'elementor-post-grid') 
                   . '<span class="spinner"></span></button>';
            echo '</div>';
        }
    } elseif ($settings['pagination_type'] === 'pagination') {
        $total_pages = $query->max_num_pages;
        if ($total_pages > 1) {
            $current_page = max(1, get_query_var('paged'), get_query_var('page'));
            
            // Get the base URL
            $base = html_entity_decode(get_pagenum_link());
            $base = add_query_arg('paged', '%#%', $base);
            
            // Fix for home URL pagination
            if (is_front_page()) {
                $base = home_url('page/%#%/');
            }
            
            echo '<div class="post-grid-pagination">';
            echo paginate_links([
                'base'      => $base,
                'format'    => '?paged=%#%',
                'current'   => $current_page,
                'total'     => $total_pages,
                'prev_text' => __('« Previous', 'elementor-post-grid'),
                'next_text' => __('Next »', 'elementor-post-grid'),
                'type'      => 'list',
                'end_size'  => 1,
                'mid_size'  => 2,
                'add_args'  => false,
            ]);
            echo '</div>';
        }
    }
}

protected function content_template() {}


    
}


