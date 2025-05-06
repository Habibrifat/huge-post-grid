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

        // $this->add_control(
        //     'post_style',
        //     [
        //         'label' => __('Post Design Style', 'elementor-post-grid'),
        //         'type' => \Elementor\Controls_Manager::SELECT,
        //         'options' => [
        //             'style1' => __('Design 1 - Classic', 'elementor-post-grid'),
        //             'style2' => __('Design 2 - Card', 'elementor-post-grid'),
        //             'style3' => __('Design 3 - Modern', 'elementor-post-grid'),
        //             'style4' => __('Design 4 - Magazine', 'elementor-post-grid'),
        //             'style5' => __('Design 5 - Minimal', 'elementor-post-grid'),
        //         ],
        //         'default' => 'style1',
        //     ]
        // );

        $this->add_control(
            'post_style',
            [
                'label' => __('Post Design Style', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style1' => __('Design 1 - Card', 'elementor-post-grid'),
                    'style2' => __('Design 2 - Card Overlay', 'elementor-post-grid'),
                    'style3' => __('Design 3 - Creative Box', 'elementor-post-grid'),
                    'style4' => __('Design 4 - Metro Grid', 'elementor-post-grid'),
                    'style5' => __('Design 5 - Hover Card', 'elementor-post-grid'),
                    'ep-style1' => __('Design 1 - Classic Overlay', 'elementor-post-grid'),
                     'ep-style2' => __('Design 2 - Card Gradient', 'elementor-post-grid'),
                     'ep-style3' => __('Design 3 - Modern Hover', 'elementor-post-grid'),
                     'ep-style4' => __('Design 4 - Creative Tilt', 'elementor-post-grid'),
                     'ep-style5' => __('Design 5 - Minimal List', 'elementor-post-grid'),
                ],
                'default' => 'style1',
                'separator' => 'before',
            ]
        );

        // $this->add_control(
        //     'post_style',
        //     [
        //         'label' => __('Post Design Style', 'elementor-post-grid'),
        //         'type' => \Elementor\Controls_Manager::SELECT,
        //         'options' => [
        //             'ep-style1' => __('Design 1 - Classic Overlay', 'elementor-post-grid'),
        //             'ep-style2' => __('Design 2 - Card Gradient', 'elementor-post-grid'),
        //             'ep-style3' => __('Design 3 - Modern Hover', 'elementor-post-grid'),
        //             'ep-style4' => __('Design 4 - Creative Tilt', 'elementor-post-grid'),
        //             'ep-style5' => __('Design 5 - Minimal List', 'elementor-post-grid'),
        //         ],
        //         'default' => 'ep-style1',
        //     ]
        // );

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
            'content_word_limit',
            [
                'label' => __('Content Word Limit', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 20,
                'description' => __('Limit the number of words in the post excerpt/content.', 'elementor-post-grid'),
            ]
        );
        
        $this->add_control(
            'show_meta',
            [
                'label' => __('Show Meta', 'elementor-post-grid'),
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

        $this->end_controls_section();
    }
    public function get_script_depends() {
        return ['elementor-post-grid'];
    }


// protected function render() {
//     $settings = $this->get_settings_for_display();
    
//     $posts_per_page = $settings['posts_per_page'];
//     $selected_category = $settings['selected_category'];
//     $pagination_type = $settings['pagination_type'];
    
//     // First page load
//     $query_args = [
//         'post_type'      => 'post',
//         'posts_per_page' => ($pagination_type === 'none') ? -1 : $posts_per_page, // Show all posts if no pagination
//         'paged'          => max(1, get_query_var('paged'), get_query_var('page')),
//     ];
    
//     if (!empty($selected_category)) {
//         $query_args['category_name'] = $selected_category;
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
            
//             echo '</div>'; // .post-item
//         }
        
//         echo '</div>'; // .custom-post-grid
        
//         // Handle pagination based on selected type
//         if ($pagination_type === 'load_more') {
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
//                       </button>';
//                 echo '</div>';
//             }
//         } elseif ($pagination_type === 'pagination') {
//             $big = 999999999; // need an unlikely integer
//             echo '<div class="post-grid-pagination">';
//             echo paginate_links([
//                 'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
//                 'format'  => '?paged=%#%',
//                 'current' => max(1, get_query_var('paged')),
//                 'total'   => $query->max_num_pages,
//                 'prev_text' => __('« Previous'),
//                 'next_text' => __('Next »'),
//             ]);
//             echo '</div>';
//         }
//         // No output for 'none' option
        
//         wp_reset_postdata();
//     } else {
//         echo '<p>' . __('No posts found', 'elementor-post-grid') . '</p>';
//     }
// }
    
// protected function render() {
//     $settings = $this->get_settings_for_display();
    
//     $posts_per_page = $settings['posts_per_page'];
//     $selected_category = $settings['selected_category'];
//     $pagination_type = $settings['pagination_type'];
    
//     // First page load
//     $query_args = [
//         'post_type'      => 'post',
//         'posts_per_page' => ($pagination_type === 'none') ? -1 : $posts_per_page,
//         'paged'          => max(1, get_query_var('paged'), get_query_var('page')),
//     ];
    
//     if (!empty($selected_category)) {
//         $query_args['category_name'] = $selected_category;
//     }
    
//     $query = new WP_Query($query_args);
    
//     if ($query->have_posts()) {
//         echo '<div class="custom-post-grid">';
        
//         while ($query->have_posts()) {
//             $query->the_post();
            
//             echo '<div class="post-item">';
            
//             // Post Thumbnail
//             if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//                 echo '<div class="post-thumbnail">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</div>';
//             }
            
//             // Post Title
//             echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
            
//             // Post Meta (Category, Author, Date)
//             if ($settings['show_category'] === 'yes' || $settings['show_author'] === 'yes' || $settings['show_date'] === 'yes') {
//                 echo '<div class="post-meta">';
                
//                 // Categories
//                 if ($settings['show_category'] === 'yes') {
//                     $categories = get_the_category();
//                     if (!empty($categories)) {
//                         echo '<span class="post-categories">';
//                         foreach ($categories as $index => $category) {
//                             if ($index > 0) echo ', ';
//                             echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
//                         }
//                         echo '</span>';
//                     }
//                 }
                
//                 // Author
//                 if ($settings['show_author'] === 'yes') {
//                     echo '<span class="post-author">';
//                     echo __('By ', 'elementor-post-grid') . '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() . '</a>';
//                     echo '</span>';
//                 }
                
//                 // Date
//                 if ($settings['show_date'] === 'yes') {
//                     echo '<span class="post-date">' . get_the_date() . '</span>';
//                 }
                
//                 echo '</div>'; // .post-meta
//             }
            
//             // Post Content
//             if ($settings['show_content'] === 'yes') {
//                 echo '<div class="post-content">' . get_the_excerpt() . '</div>';
//             }
            
//             // Tags
//             if ($settings['show_tags'] === 'yes') {
//                 $tags = get_the_tags();
//                 if (!empty($tags)) {
//                     echo '<div class="post-tags">';
//                     foreach ($tags as $tag) {
//                         echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
//                     }
//                     echo '</div>';
//                 }
//             }
            
//             echo '</div>'; // .post-item
//         }
        
//         echo '</div>'; // .custom-post-grid
        
//         // Handle pagination based on selected type
//         if ($pagination_type === 'load_more') {
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
//                       </button>';
//                 echo '</div>';
//             }
//         } elseif ($pagination_type === 'pagination') {
//             $big = 999999999; // need an unlikely integer
//             echo '<div class="post-grid-pagination">';
//             echo paginate_links([
//                 'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
//                 'format'  => '?paged=%#%',
//                 'current' => max(1, get_query_var('paged')),
//                 'total'   => $query->max_num_pages,
//                 'prev_text' => __('« Previous'),
//                 'next_text' => __('Next »'),
//             ]);
//             echo '</div>';
//         }
        
//         wp_reset_postdata();
//     } else {
//         echo '<p>' . __('No posts found', 'elementor-post-grid') . '</p>';
//     }
// }

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
        echo '<div class="custom-post-grid style-' . esc_attr($settings['post_style']) . '">';
        
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
    switch ($style) {
        case 'style1':
            $this->render_style1($settings);
            break;
        case 'style2':
            $this->render_style2($settings);
            break;
        case 'style3':
            $this->render_style3($settings);
            break;
        case 'style4':
            $this->render_style4($settings);
            break;
        case 'style5':
            $this->render_style5($settings);
            break;
        // case 'style6':
        //     $this->render_style6($settings);
        //     break;
        // case 'style7':
        //     $this->render_style7($settings);
        //     break;       
        case 'ep-style1':
            $this->render_ep_style1($settings);
            break;
        case 'ep-style2':
            $this->render_ep_style2($settings);
            break;
        case 'ep-style3':
            $this->render_ep_style3($settings);
            break;
        case 'ep-style4':
            $this->render_ep_style4($settings);
            break;
        case 'ep-style5':
            $this->render_ep_style5($settings);
            break;
        default:
            $this->render_style1($settings);
    }
}

// protected function render_style1($settings) {
//     // Classic Design
//     echo '<div class="post-item style-1">';
    
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         echo '<div class="post-thumbnail"><a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</a></div>';
//     }
    
//     echo '<div class="post-content-wrapper">';
//     echo '<h3 class="post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    
//     if ($settings['show_category'] === 'yes' || $settings['show_date'] === 'yes') {
//         echo '<div class="post-meta">';
//         if ($settings['show_category'] === 'yes') {
//             $categories = get_the_category();
//             if (!empty($categories)) {
//                 echo '<span class="post-category">' . esc_html($categories[0]->name) . '</span>';
//             }
//         }
//         if ($settings['show_date'] === 'yes') {
//             echo '<span class="post-date">' . get_the_date() . '</span>';
//         }
//         echo '</div>';
//     }
    
//     if ($settings['show_content'] === 'yes') {
//         echo '<div class="post-excerpt">' . get_the_excerpt() . '</div>';
//     }
    
//     echo '</div></div>';
// }

protected function render_style1($settings) {
    // Card Design
    echo '<div class="post-item style-2">';
    
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<div class="post-thumbnail"><a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</a></div>';
    }
    
    echo '<div class="post-content-wrapper">';
    
    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<div class="post-category">' . esc_html($categories[0]->name) . '</div>';
        }
    }
    
    // echo '<h3 class="post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    echo '<h3 class="post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    if ($settings['show_content'] === 'yes') {
        echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words(get_the_excerpt(), $settings['content_word_limit'], '...')) . '</div>';
    }
    
    if ($settings['show_author'] === 'yes' || $settings['show_date'] === 'yes') {
        echo '<div class="post-footer">';
        if ($settings['show_author'] === 'yes') {
            echo '<span class="post-author">' . get_the_author() . '</span>';
        }
        if ($settings['show_date'] === 'yes') {
            echo '<span class="post-date">' . get_the_date() . '</span>';
        }
        echo '</div>';
    }
    
    echo '</div></div>';
}

// protected function render_style3($settings) {
//     // Modern Design
//     echo '<div class="post-item style-3">';
    
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         echo '<div class="post-thumbnail"><a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</a></div>';
//     }
    
//     echo '<div class="post-content-wrapper">';
    
//     echo '<h3 class="post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    
//     if ($settings['show_content'] === 'yes') {
//         echo '<div class="post-excerpt">' . get_the_excerpt() . '</div>';
//     }
    
//     echo '<div class="post-meta">';
//     if ($settings['show_author'] === 'yes') {
//         echo '<span class="post-author">' . get_avatar(get_the_author_meta('ID'), 24) . ' ' . get_the_author() . '</span>';
//     }
//     if ($settings['show_date'] === 'yes') {
//         echo '<span class="post-date">' . human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago</span>';
//     }
//     echo '</div>';
    
//     echo '</div></div>';
// }

// protected function render_style7($settings) {
//     // Magazine Design
//     echo '<div class="post-item style-4">';
    
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         echo '<div class="post-thumbnail"><a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'large') . '</a></div>';
//     }
    
//     echo '<div class="post-content-wrapper">';
    
//     if ($settings['show_category'] === 'yes') {
//         $categories = get_the_category();
//         if (!empty($categories)) {
//             echo '<div class="post-category">' . esc_html($categories[0]->name) . '</div>';
//         }
//     }
    
//     echo '<h3 class="post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    
//     if ($settings['show_content'] === 'yes') {
//         echo '<div class="post-excerpt">' . get_the_excerpt() . '</div>';
//     }
    
//     if ($settings['show_tags'] === 'yes') {
//         $tags = get_the_tags();
//         if (!empty($tags)) {
//             echo '<div class="post-tags">';
//             foreach ($tags as $tag) {
//                 echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
//             }
//             echo '</div>';
//         }
//     }
    
//     echo '</div></div>';
// }

// protected function render_style5($settings) {
//     // Minimal Design
//     echo '<div class="post-item style-5">';
    
//     echo '<div class="post-content-wrapper">';
    
//     if ($settings['show_date'] === 'yes') {
//         echo '<div class="post-date">' . get_the_date('M j') . '</div>';
//     }
    
//     echo '<h3 class="post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    
//     if ($settings['show_content'] === 'yes') {
//         echo '<div class="post-excerpt">' . get_the_excerpt() . '</div>';
//     }
    
//     if ($settings['show_author'] === 'yes') {
//         echo '<div class="post-author">By ' . get_the_author() . '</div>';
//     }
    
//     echo '</div></div>';
// }

// protected function render_style1($settings) {
//     // Classic Grid (ElementPack's Standard)
//     echo '<div class="ep-post-grid-item style-1">';
    
//     // Featured Image with Overlay
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         echo '<div class="ep-post-thumbnail">';
//         echo get_the_post_thumbnail(get_the_ID(), 'large');
//         echo '<div class="ep-post-overlay"></div>';
        
//         // Overlay Content
//         echo '<div class="ep-post-overlay-content">';
//         if ($settings['show_category'] === 'yes') {
//             $categories = get_the_category();
//             if (!empty($categories)) {
//                 echo '<span class="ep-post-category">' . esc_html($categories[0]->name) . '</span>';
//             }
//         }
//         echo '</div>';
        
//         echo '</div>'; // .ep-post-thumbnail
//     }
    
//     // Content Wrapper
//     echo '<div class="ep-post-content">';
    
//     // Title
//     echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
    
//     // Meta
//     if ($settings['show_author'] === 'yes' || $settings['show_date'] === 'yes') {
//         echo '<div class="ep-post-meta">';
//         if ($settings['show_author'] === 'yes') {
//             echo '<span class="ep-post-author"><i class="fas fa-user"></i> ' . get_the_author() . '</span>';
//         }
//         if ($settings['show_date'] === 'yes') {
//             echo '<span class="ep-post-date"><i class="far fa-calendar-alt"></i> ' . get_the_date() . '</span>';
//         }
//         echo '</div>';
//     }
    
//     // Excerpt
//     if ($settings['show_content'] === 'yes') {
//         echo '<div class="ep-post-excerpt">' . wp_trim_words(get_the_excerpt(), 15, '...') . '</div>';
//     }
    
//     // Read More
//     echo '<a href="' . get_permalink() . '" class="ep-post-readmore">' . __('Read More', 'elementor-post-grid') . '</a>';
    
//     echo '</div>'; // .ep-post-content
//     echo '</div>'; // .ep-post-grid-item
// }

protected function render_style2($settings) {
    // Card Overlay (ElementPack's Alice)
    echo '<div class="ep-post-grid-item style-2">';
    
    // Featured Image
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<div class="ep-post-thumbnail">';
        echo get_the_post_thumbnail(get_the_ID(), 'large');
        echo '<div class="ep-post-overlay"></div>';
        echo '</div>';
    }
    
    // Content (Overlay)
    echo '<div class="ep-post-content">';
    
    // Meta (Top)
    if ($settings['show_date'] === 'yes') {
        echo '<div class="ep-post-meta-top">';
        echo '<span class="ep-post-date">' . get_the_date('d M') . '</span>';
        echo '</div>';
    }
    
    // Title
    echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    // Meta (Bottom)
    echo '<div class="ep-post-meta-bottom">';
    if ($settings['show_author'] === 'yes') {
        echo '<span class="ep-post-author"><i class="fas fa-user"></i> ' . get_the_author() . '</span>';
    }
    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<span class="ep-post-category"><i class="fas fa-tag"></i> ' . esc_html($categories[0]->name) . '</span>';
        }
    }
    echo '</div>';
    
    echo '</div>'; // .ep-post-content
    echo '</div>'; // .ep-post-grid-item
}

protected function render_style3($settings) {
    // Creative Box (ElementPack's Portfolio Style)
    echo '<div class="ep-post-grid-item style-3">';
    
    // Featured Image
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<div class="ep-post-thumbnail">';
        echo get_the_post_thumbnail(get_the_ID(), 'large');
        echo '<div class="ep-post-overlay"></div>';
        
        // Hover Content
        echo '<div class="ep-post-hover-content">';
        echo '<div class="ep-post-hover-inner">';
        
        // Category
        if ($settings['show_category'] === 'yes') {
            $categories = get_the_category();
            if (!empty($categories)) {
                echo '<span class="ep-post-category">' . esc_html($categories[0]->name) . '</span>';
            }
        }
        
        // Title
        echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
        
        // Meta
        if ($settings['show_date'] === 'yes') {
            echo '<span class="ep-post-date">' . get_the_date() . '</span>';
        }
        
        echo '</div>'; // .ep-post-hover-inner
        echo '</div>'; // .ep-post-hover-content
        echo '</div>'; // .ep-post-thumbnail
    }
    
    echo '</div>'; // .ep-post-grid-item
}

protected function render_style4($settings) {
    // Metro Grid (ElementPack's Metro Style)
    echo '<div class="ep-post-grid-item style-4">';
    
    // Featured Image
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<div class="ep-post-thumbnail">';
        echo get_the_post_thumbnail(get_the_ID(), 'large');
        echo '<div class="ep-post-overlay"></div>';
        echo '</div>';
    }
    
    // Content
    echo '<div class="ep-post-content">';
    
    // Category
    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<span class="ep-post-category">' . esc_html($categories[0]->name) . '</span>';
        }
    }
    
    // Title
    echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    // Meta
    if ($settings['show_date'] === 'yes') {
        echo '<span class="ep-post-date">' . get_the_date('F j, Y') . '</span>';
    }
    
    echo '</div>'; // .ep-post-content
    echo '</div>'; // .ep-post-grid-item
}

protected function render_style5($settings) {
    // Hover Card (ElementPack's Hover Style)
    echo '<div class="ep-post-grid-item style-5">';
    
    // Featured Image
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<div class="ep-post-thumbnail">';
        echo get_the_post_thumbnail(get_the_ID(), 'large');
        echo '</div>';
    }
    
    // Content
    echo '<div class="ep-post-content">';
    
    // Meta
    if ($settings['show_date'] === 'yes') {
        echo '<span class="ep-post-date">' . get_the_date('M d') . '</span>';
    }
    
    // Title
    echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    // Excerpt
    if ($settings['show_content'] === 'yes') {
        echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words(get_the_excerpt(), $settings['content_word_limit'], '...')) . '</div>';
    }
    
    // Read More
    echo '<a href="' . get_permalink() . '" class="ep-post-readmore"><i class="fas fa-arrow-right"></i></a>';
    
    echo '</div>'; // .ep-post-content
    echo '</div>'; // .ep-post-grid-item
}

// protected function render_post_style($style, $settings) {
//     switch ($style) {
//         case 'ep-style1':
//             $this->render_ep_style1($settings);
//             break;
//         case 'ep-style2':
//             $this->render_ep_style2($settings);
//             break;
//         case 'ep-style3':
//             $this->render_ep_style3($settings);
//             break;
//         case 'ep-style4':
//             $this->render_ep_style4($settings);
//             break;
//         case 'ep-style5':
//             $this->render_ep_style5($settings);
//             break;
//         default:
//             $this->render_ep_style1($settings);
//     }
// }

protected function render_ep_style1($settings) {
    // Classic Overlay Design
    echo '<div class="ep-post-item ep-style1">';
    
    echo '<div class="ep-post-thumbnail">';
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'large') . '</a>';
    }
    echo '<div class="ep-post-overlay"></div>';
    
    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<div class="ep-post-category"><a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></div>';
        }
    }
    echo '</div>';
    
    echo '<div class="ep-post-content">';
    echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    if ($settings['show_meta'] === 'yes') {
        echo '<div class="ep-post-meta">';
        if ($settings['show_author'] === 'yes') {
            echo '<span class="ep-post-author"><i class="fas fa-user"></i> ' . get_the_author() . '</span>';
        }
        if ($settings['show_date'] === 'yes') {
            echo '<span class="ep-post-date"><i class="far fa-calendar-alt"></i> ' . get_the_date() . '</span>';
        }
        echo '</div>';
    }
    
    if ($settings['show_content'] === 'yes') {
        echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words(get_the_excerpt(), $settings['content_word_limit'], '...')) . '</div>';
    }
    
    if ($settings['show_readmore'] === 'yes') {
        echo '<a href="' . get_permalink() . '" class="ep-read-more">' . __('Read More', 'elementor-post-grid') . '</a>';
    }
    
    echo '</div></div>';
}

protected function render_ep_style2($settings) {
    // Card Gradient Design
    echo '<div class="ep-post-item ep-style2">';
    
    echo '<div class="ep-post-thumbnail">';
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'large') . '</a>';
    }
    echo '</div>';
    
    echo '<div class="ep-post-content">';
    
    if ($settings['show_date'] === 'yes') {
        echo '<div class="ep-post-date">';
        echo '<span class="ep-date-day">' . get_the_date('d') . '</span>';
        echo '<span class="ep-date-month">' . get_the_date('M') . '</span>';
        echo '</div>';
    }
    
    echo '<div class="ep-post-content-inner">';
    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<div class="ep-post-category">' . esc_html($categories[0]->name) . '</div>';
        }
    }
    
    echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    if ($settings['show_meta'] === 'yes') {
        echo '<div class="ep-post-meta">';
        if ($settings['show_author'] === 'yes') {
            echo '<span class="ep-post-author"><i class="fas fa-user"></i> ' . get_the_author() . '</span>';
        }
        if ($settings['show_comments'] === 'yes') {
            echo '<span class="ep-post-comments"><i class="far fa-comment"></i> ' . get_comments_number() . '</span>';
        }
        echo '</div>';
    }
    
    if ($settings['show_content'] === 'yes') {
        echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words(get_the_excerpt(), $settings['content_word_limit'], '...')) . '</div>';
    }
    echo '</div></div></div>';
}

protected function render_ep_style3($settings) {
    // Modern Hover Design
    echo '<div class="ep-post-item ep-style3">';
    
    echo '<div class="ep-post-thumbnail">';
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'large') . '</a>';
    }
    echo '<div class="ep-post-hover-content">';
    echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    if ($settings['show_meta'] === 'yes') {
        echo '<div class="ep-post-meta">';
        if ($settings['show_date'] === 'yes') {
            echo '<span class="ep-post-date">' . get_the_date() . '</span>';
        }
        echo '</div>';
    }
    
    if ($settings['show_readmore'] === 'yes') {
        echo '<a href="' . get_permalink() . '" class="ep-read-more"><i class="fas fa-long-arrow-alt-right"></i></a>';
    }
    echo '</div></div>';

    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<div class="ep-post-category"><a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></div>';
        }
    }

    if ($settings['show_content'] === 'yes') {
        echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words(get_the_excerpt(), $settings['content_word_limit'], '...')) . '</div>';
    }

    if ($settings['show_tags'] === 'yes') {
        $tags = get_the_tags();
        if (!empty($tags)) {
            echo '<div class="post-tags">';
            foreach ($tags as $tag) {
                echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
            }
            echo '</div>';
        }
    }

    echo '</div>';
}

protected function render_ep_style4($settings) {
    // Creative Tilt Design
    echo '<div class="ep-post-item ep-style4">';
    echo '<div class="ep-post-tilt-box">';
    
    echo '<div class="ep-post-thumbnail">';
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'large') . '</a>';
    }
    echo '</div>';
    
    echo '<div class="ep-post-content">';
    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<div class="ep-post-category">' . esc_html($categories[0]->name) . '</div>';
        }
    }
    
    echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    if ($settings['show_meta'] === 'yes') {
        echo '<div class="ep-post-meta">';
        if ($settings['show_author'] === 'yes') {
            echo '<span class="ep-post-author"><i class="fas fa-user"></i> ' . get_the_author() . '</span>';
        }
        if ($settings['show_date'] === 'yes') {
            echo '<span class="ep-post-date">' . get_the_date() . '</span>';
        }
        echo '</div>';
    }
    
    if ($settings['show_content'] === 'yes') {
        echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words(get_the_excerpt(), $settings['content_word_limit'], '...')) . '</div>';
    }

    if ($settings['show_tags'] === 'yes') {
        $tags = get_the_tags();
        if (!empty($tags)) {
            echo '<div class="post-tags">';
            foreach ($tags as $tag) {
                echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
            }
            echo '</div>';
        }
    }
    
    if ($settings['show_readmore'] === 'yes') {
        echo '<a href="' . get_permalink() . '" class="ep-read-more">' . __('Continue Reading', 'elementor-post-grid') . '</a>';
    }
    echo '</div></div></div>';
}

protected function render_ep_style5($settings) {
    // Minimal List Design
    echo '<div class="ep-post-item ep-style5">';
    
    if ($settings['show_date'] === 'yes') {
        echo '<div class="ep-post-date">';
        echo '<span class="ep-date-day">' . get_the_date('d') . '</span>';
        echo '<span class="ep-date-month">' . get_the_date('M') . '</span>';
        echo '</div>';
    }
    
    echo '<div class="ep-post-content">';
    echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    if ($settings['show_meta'] === 'yes') {
        echo '<div class="ep-post-meta">';
        if ($settings['show_author'] === 'yes') {
            echo '<span class="ep-post-author">' . __('By', 'elementor-post-grid') . ' ' . get_the_author() . '</span>';
        }
        if ($settings['show_comments'] === 'yes') {
            echo '<span class="ep-post-comments">' . get_comments_number() . ' ' . __('Comments', 'elementor-post-grid') . '</span>';
        }
        echo '</div>';
    }
    
    if ($settings['show_content'] === 'yes') {
        echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words(get_the_excerpt(), $settings['content_word_limit'], '...')) . '</div>';
    }
    echo '</div></div>';
}

protected function render_pagination($query, $settings) {
    if ($settings['pagination_type'] === 'load_more') {
        $max_pages = $query->max_num_pages;
        if ($max_pages > 1) {
            echo '<div class="load-more-wrapper">';
            echo '<button id="load-more-posts" class="load-more-btn" data-page="1" 
                      data-max-pages="' . esc_attr($max_pages) . '"
                      data-posts-per-page="' . esc_attr($settings['posts_per_page']) . '"
                      data-category="' . esc_attr($settings['selected_category']) . '">'
                   . __('Load More', 'elementor-post-grid') . '</button>';
            echo '</div>';
        }
    } elseif ($settings['pagination_type'] === 'pagination') {
        $big = 999999999;
        echo '<div class="post-grid-pagination">';
        echo paginate_links([
            'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'  => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total'   => $query->max_num_pages,
        ]);
        echo '</div>';
    }
}
    
 




    protected function content_template() {}
}
