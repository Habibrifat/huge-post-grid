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
        $this->add_responsive_control(
            'columns',
            [
                'label' => __('Columns', 'elementor-post-grid'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => __('1', 'elementor-post-grid'),
                    '2' => __('2', 'elementor-post-grid'),
                    '3' => __('3', 'elementor-post-grid'),
                    '4' => __('4', 'elementor-post-grid'),
                    '5' => __('5', 'elementor-post-grid'),
                    '6' => __('6', 'elementor-post-grid'),
                ],
                'desktop_default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'prefix_class' => 'huge-post-grid-column-%s-', // Changed class prefix
                'frontend_available' => true,
            ]
        );
        $this->add_responsive_control(
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
                    '{{WRAPPER}} .huge-post-grid' => 'grid-column-gap: {{SIZE}}{{UNIT}}; column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
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
                    '{{WRAPPER}} .huge-post-grid' => 'grid-row-gap: {{SIZE}}{{UNIT}}; row-gap: {{SIZE}}{{UNIT}};',
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
        echo '<div class="custom-post-grid style-' . esc_attr($settings['post_style']) . '">';
        // echo '<div class="huge-post-grid huge-post-grid-style huge-post-grid-' . esc_attr($settings['post_style']) . '">';
        
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

// Remove all the individual render_styleX() methods from your widget class
// since they're now in the separate file

// protected function render_post_style($style, $settings) {
//     switch ($style) {
//         case 'style1':
//             $this->render_style1($settings);
//             break;
//         case 'style2':
//             $this->render_style2($settings);
//             break;
//         case 'style3':
//             $this->render_style3($settings);
//             break;
//         case 'style4':
//             $this->render_style4($settings);
//             break;
//         case 'style5':
//             $this->render_style5($settings);
//             break;     
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
//             $this->render_style1($settings);
//     }
// }

// protected function render_style1($settings) {
//     // Card Design
//     echo '<div class="post-item style-2">';
    
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         $image_size = isset($settings['image_size']) ? $settings['image_size'] : 'large';
//         echo '<div class="post-thumbnail"><a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), $image_size) . '</a></div>';
//     }
    
//     echo '<div class="post-content-wrapper">';
    
//     if ($settings['show_category'] === 'yes') {
//         $categories = get_the_category();
//         if (!empty($categories)) {
//             echo '<div class="post-category">' . esc_html($categories[0]->name) . '</div>';
//         }
//     }
    
//     echo '<h3 class="post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';

//     // Excerpt with fallback for empty values
//     if ($settings['show_content'] === 'yes') {
//         $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
//         $excerpt = get_the_excerpt();
        
//         if (empty($excerpt)) {
//             $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
//         }
        
//         echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
//     }
    
//     if ($settings['show_author'] === 'yes' || $settings['show_date'] === 'yes') {
//         echo '<div class="post-footer">';
//         if ($settings['show_author'] === 'yes') {
//             echo '<span class="post-author">' . get_the_author() . '</span>';
//         }
//         if ($settings['show_date'] === 'yes') {
//             echo '<span class="post-date">' . get_the_date() . '</span>';
//         }
//         echo '</div>';
//     }
    
//     echo '</div></div>';
// }

// protected function render_style2($settings) {
//     // Card Overlay (ElementPack's Alice)
//     echo '<div class="ep-post-grid-item style-2">';
    
//     // Featured Image
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         $image_size = isset($settings['image_size']) ? $settings['image_size'] : 'large';
//         echo '<div class="ep-post-thumbnail">';
//         echo get_the_post_thumbnail(get_the_ID(), $image_size);
//         echo '<div class="ep-post-overlay"></div>';
//         echo '</div>';
//     }
    
//     // Content (Overlay)
//     echo '<div class="ep-post-content">';
    
//     // Meta (Top)
//     if ($settings['show_date'] === 'yes') {
//         echo '<div class="ep-post-meta-top">';
//         echo '<span class="ep-post-date">' . get_the_date('d M') . '</span>';
//         echo '</div>';
//     }
    
//     // Title
//     echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
//     // Meta (Bottom)
//     echo '<div class="ep-post-meta-bottom">';
//     if ($settings['show_author'] === 'yes') {
//         echo '<span class="ep-post-author"><i class="fas fa-user"></i> ' . get_the_author() . '</span>';
//     }
//     if ($settings['show_category'] === 'yes') {
//         $categories = get_the_category();
//         if (!empty($categories)) {
//             echo '<span class="ep-post-category"><i class="fas fa-tag"></i> ' . esc_html($categories[0]->name) . '</span>';
//         }
//     }
//     echo '</div>';
    
//     echo '</div>'; // .ep-post-content
//     echo '</div>'; // .ep-post-grid-item
// }

// protected function render_style3($settings) {
//     // Creative Box (ElementPack's Portfolio Style)
//     echo '<div class="ep-post-grid-item style-3">';
    
//     // Featured Image
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         echo '<div class="ep-post-thumbnail">';
//         echo get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large');
//         echo '<div class="ep-post-overlay"></div>';
        
//         // Hover Content
//         echo '<div class="ep-post-hover-content">';
//         echo '<div class="ep-post-hover-inner">';
        
//         // Category
//         if ($settings['show_category'] === 'yes') {
//             $categories = get_the_category();
//             if (!empty($categories)) {
//                 echo '<span class="ep-post-category">' . esc_html($categories[0]->name) . '</span>';
//             }
//         }
        
//         // Title
//         echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
        
//         // Meta
//         if ($settings['show_date'] === 'yes') {
//             echo '<span class="ep-post-date">' . get_the_date() . '</span>';
//         }
        
//         echo '</div>'; // .ep-post-hover-inner
//         echo '</div>'; // .ep-post-hover-content
//         echo '</div>'; // .ep-post-thumbnail
//     }
    
//     echo '</div>'; // .ep-post-grid-item
// }

// protected function render_style4($settings) {
//     // Metro Grid (ElementPack's Metro Style)
//     echo '<div class="ep-post-grid-item style-4">';
    
//     // Featured Image
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         echo '<div class="ep-post-thumbnail">';
//         echo get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large');
//         echo '<div class="ep-post-overlay"></div>';
//         echo '</div>';
//     }
    
//     // Content
//     echo '<div class="ep-post-content">';
    
//     // Category
//     if ($settings['show_category'] === 'yes') {
//         $categories = get_the_category();
//         if (!empty($categories)) {
//             echo '<span class="ep-post-category">' . esc_html($categories[0]->name) . '</span>';
//         }
//     }
    
//     // Title
//     echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
//     // Meta
//     if ($settings['show_date'] === 'yes') {
//         echo '<span class="ep-post-date">' . get_the_date('F j, Y') . '</span>';
//     }
    
//     echo '</div>'; // .ep-post-content
//     echo '</div>'; // .ep-post-grid-item
// }

// protected function render_style5($settings) {
//     // Hover Card (ElementPack's Hover Style)
//     echo '<div class="ep-post-grid-item style-5">';
    
//     // Featured Image
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         echo '<div class="ep-post-thumbnail">';
//         echo get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large');
//         echo '</div>';
//     }
    
//     // Content
//     echo '<div class="ep-post-content">';
    
//     // Meta
//     if ($settings['show_date'] === 'yes') {
//         echo '<span class="ep-post-date">' . get_the_date('M d') . '</span>';
//     }
    
//     // Title
//     echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
//     // Excerpt with fallback for empty values
//     if ($settings['show_content'] === 'yes') {
//         $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
//         $excerpt = get_the_excerpt();
        
//         if (empty($excerpt)) {
//             $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
//         }
        
//         echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
//     }
    
//     // Read More
//     echo '<a href="' . get_permalink() . '" class="ep-post-readmore"><i class="fas fa-arrow-right"></i></a>';
    
//     echo '</div>'; // .ep-post-content
//     echo '</div>'; // .ep-post-grid-item
// }

// protected function render_ep_style1($settings) {
//     // Classic Overlay Design
//     echo '<div class="ep-post-item ep-style1">';
    
//     echo '<div class="ep-post-thumbnail">';
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large') . '</a>';
//     }
//     echo '<div class="ep-post-overlay"></div>';
    
//     if ($settings['show_category'] === 'yes') {
//         $categories = get_the_category();
//         if (!empty($categories)) {
//             echo '<div class="ep-post-category"><a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></div>';
//         }
//     }
//     echo '</div>';
    
//     echo '<div class="ep-post-content">';
//     echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
//     // if ($settings['show_meta'] === 'yes') {
//         echo '<div class="ep-post-meta">';
//         if ($settings['show_author'] === 'yes') {
//             echo '<span class="ep-post-author"><i class="fas fa-user"></i> ' . get_the_author() . '</span>';
//         }
//         if ($settings['show_date'] === 'yes') {
//             echo '<span class="ep-post-date"><i class="far fa-calendar-alt"></i> ' . get_the_date() . '</span>';
//         }
//         echo '</div>';
//     // }
    
//     // Excerpt with fallback for empty values
//     if ($settings['show_content'] === 'yes') {
//         $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
//         $excerpt = get_the_excerpt();
        
//         if (empty($excerpt)) {
//             $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
//         }
        
//         echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
//     }
    
//     if ($settings['show_readmore'] === 'yes') {
//         echo '<a href="' . get_permalink() . '" class="ep-read-more">' . __('Read More', 'elementor-post-grid') . '</a>';
//     }
    
//     echo '</div></div>';
// }

// protected function render_ep_style2($settings) {
//     // Card Gradient Design
//     echo '<div class="ep-post-item ep-style2">';
    
//     echo '<div class="ep-post-thumbnail">';
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large') . '</a>';
//     }
//     echo '</div>';
    
//     echo '<div class="ep-post-content">';
    
//     if ($settings['show_date'] === 'yes') {
//         echo '<div class="ep-post-date">';
//         echo '<span class="ep-date-day">' . get_the_date('d') . '</span>';
//         echo '<span class="ep-date-month">' . get_the_date('M') . '</span>';
//         echo '</div>';
//     }
    
//     echo '<div class="ep-post-content-inner">';
//     if ($settings['show_category'] === 'yes') {
//         $categories = get_the_category();
//         if (!empty($categories)) {
//             echo '<div class="ep-post-category">' . esc_html($categories[0]->name) . '</div>';
//         }
//     }
    
//     echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
//     // if ($settings['show_meta'] === 'yes') {
//         echo '<div class="ep-post-meta">';
//         if ($settings['show_author'] === 'yes') {
//             echo '<span class="ep-post-author"><i class="fas fa-user"></i> ' . get_the_author() . '</span>';
//         }
//         if ($settings['show_comments'] === 'yes') {
//             echo '<span class="ep-post-comments"><i class="far fa-comment"></i> ' . get_comments_number() . '</span>';
//         }
//         echo '</div>';
//     // }
    
//         // Excerpt with fallback for empty values
//         if ($settings['show_content'] === 'yes') {
//             $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
//             $excerpt = get_the_excerpt();
            
//             if (empty($excerpt)) {
//                 $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
//             }
            
//             echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
//         }
//     echo '</div></div></div>';
// }

// protected function render_ep_style3($settings) {
//     // Modern Hover Design
//     echo '<div class="ep-post-item ep-style3">';
    
//     echo '<div class="ep-post-thumbnail">';
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large') . '</a>';
//     }
//     echo '<div class="ep-post-hover-content">';
//     echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
//     // if ($settings['show_meta'] === 'yes') {
//         echo '<div class="ep-post-meta">';
//         if ($settings['show_date'] === 'yes') {
//             echo '<span class="ep-post-date">' . get_the_date() . '</span>';
//         }
//         echo '</div>';
//     // }
    
//     if ($settings['show_readmore'] === 'yes') {
//         echo '<a href="' . get_permalink() . '" class="ep-read-more"><i class="fas fa-long-arrow-alt-right"></i></a>';
//     }
//     echo '</div></div>';

//     if ($settings['show_category'] === 'yes') {
//         $categories = get_the_category();
//         if (!empty($categories)) {
//             echo '<div class="ep-post-category"><a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></div>';
//         }
//     }

//     // Excerpt with fallback for empty values
//     if ($settings['show_content'] === 'yes') {
//         $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
//         $excerpt = get_the_excerpt();
        
//         if (empty($excerpt)) {
//             $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
//         }
        
//         echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
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

//     echo '</div>';
// }

// protected function render_ep_style4($settings) {
//     // Creative Tilt Design
//     echo '<div class="ep-post-item ep-style4">';
//     echo '<div class="ep-post-tilt-box">';
    
//     echo '<div class="ep-post-thumbnail">';
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large') . '</a>';
//     }
//     echo '</div>';
    
//     echo '<div class="ep-post-content">';
//     if ($settings['show_category'] === 'yes') {
//         $categories = get_the_category();
//         if (!empty($categories)) {
//             echo '<div class="ep-post-category">' . esc_html($categories[0]->name) . '</div>';
//         }
//     }
    
//     echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
//     // if ($settings['show_meta'] === 'yes') {
//         echo '<div class="ep-post-meta">';
//         if ($settings['show_author'] === 'yes') {
//             echo '<span class="ep-post-author"><i class="fas fa-user"></i> ' . get_the_author() . '</span>';
//         }
//         if ($settings['show_date'] === 'yes') {
//             echo '<span class="ep-post-date">' . get_the_date() . '</span>';
//         }
//         echo '</div>';
//     // }
    
//     // Excerpt with fallback for empty values
//     if ($settings['show_content'] === 'yes') {
//         $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
//         $excerpt = get_the_excerpt();
        
//         if (empty($excerpt)) {
//             $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
//         }
        
//         echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
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
    
//     if ($settings['show_readmore'] === 'yes') {
//         echo '<a href="' . get_permalink() . '" class="ep-read-more">' . __('Continue Reading', 'elementor-post-grid') . '</a>';
//     }
//     echo '</div></div></div>';
// }

// protected function render_ep_style5($settings) {
//     // Minimal List Design
//     echo '<div class="ep-post-item ep-style5">';
    
//     if ($settings['show_date'] === 'yes') {
//         echo '<div class="ep-post-date">';
//         echo '<span class="ep-date-day">' . get_the_date('d') . '</span>';
//         echo '<span class="ep-date-month">' . get_the_date('M') . '</span>';
//         echo '</div>';
//     }
    
//     echo '<div class="ep-post-content">';
//     echo '<h3 class="ep-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
//     // if ($settings['show_meta'] === 'yes') {
//         echo '<div class="ep-post-meta">';
//         if ($settings['show_author'] === 'yes') {
//             echo '<span class="ep-post-author">' . __('By', 'elementor-post-grid') . ' ' . get_the_author() . '</span>';
//         }
//         if ($settings['show_comments'] === 'yes') {
//             echo '<span class="ep-post-comments">' . get_comments_number() . ' ' . __('Comments', 'elementor-post-grid') . '</span>';
//         }
//         echo '</div>';
//     // }
    
//     // Excerpt with fallback for empty values
//     if ($settings['show_content'] === 'yes') {
//         $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
//         $excerpt = get_the_excerpt();
        
//         if (empty($excerpt)) {
//             $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
//         }
        
//         echo '<div class="ep-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
//     }
//     echo '</div></div>';
// }
// protected function render_pagination($query, $settings) {

//     if ($settings['pagination_type'] === 'load_more') {
//         $max_pages = $query->max_num_pages;
//         if ($max_pages > 1) {
//             echo '<div class="load-more-wrapper">';
//             echo '<button id="load-more-posts" class="load-more-btn" data-page="1" 
//                       data-max-pages="' . esc_attr($max_pages) . '"
//                       data-posts-per-page="' . esc_attr($settings['posts_per_page']) . '"
//                       data-category="' . esc_attr($settings['selected_category']) . '"
//                       data-post-style="' . esc_attr($settings['post_style']) . '"
//                       data-settings="' . esc_attr(json_encode($settings)) . '">'
//                    . __('Load More', 'elementor-post-grid') . '</button>';
//             echo '</div>';
//         }
//     }
//     elseif ($settings['pagination_type'] === 'pagination') {
//         $big = 999999999; // need an unlikely integer
//         echo '<div class="post-grid-pagination">';
//         echo paginate_links([
//             'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
//             'format'    => '?paged=%#%',
//             'current'   => max(1, get_query_var('paged'), get_query_var('page')),
//             'total'     => $query->max_num_pages,
//             'prev_text' => __('« Prev', 'elementor-post-grid'),
//             'next_text' => __('Next »', 'elementor-post-grid'),
//         ]);
//         echo '</div>';
//     }
// }

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
//     }elseif ($settings['pagination_type'] === 'pagination') {
//         $big = 999999999;
//         echo '<div class="post-grid-pagination">';
//         echo paginate_links([
//             'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
//             'format'  => '?paged=%#%',
//             'current' => max(1, get_query_var('paged')),
//             'total'   => $query->max_num_pages,
//         ]);
//         echo '</div>';
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
                   . __('Load More', 'elementor-post-grid') . '</button>';
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
                'prev_text' => __('« Prev', 'elementor-post-grid'),
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


