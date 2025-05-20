<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

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
                'label' => __('Settings', 'huge-post-grid'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'post_style',
            [
                'label' => __('Post Design Style', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'huge-style1' => __('Design 1 - Classic Card', 'huge-post-grid'),
                    'huge-style2' => __('Design 2 - Boxed Layout', 'huge-post-grid'),
                    'huge-style3' => __('Design 3 - Overlay Card', 'huge-post-grid'),
                    'huge-style4' => __('Design 4 - Split Card', 'huge-post-grid'),
                    'huge-style5' => __('Design 5 - Modern Hover', 'huge-post-grid'),
                    'huge-style6' => __('Design 6 - Classic Overlay', 'huge-post-grid'),
                    'huge-style7' => __('Design 7 - Sleek Hover', 'huge-post-grid'),
                    'huge-style8' => __('Design 8 - Elegant Overlay', 'huge-post-grid'),
                    'huge-style9' => __('Design 9 - Creative Tilt', 'huge-post-grid'),
                    'huge-style10' => __('Design 10 - Minimal List', 'huge-post-grid'),
                ],
                'default' => 'huge-style1',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Number of Posts', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 6,
            ]
        );

    // Get all categories dynamically
    $categories = get_categories();
    $category_options = ['' => __('All Categories', 'huge-post-grid')];

    foreach ($categories as $category) {
        $category_options[$category->slug] = $category->name;
    }

    // Add Category Dropdown in Elementor Controls
    $this->add_control(
        'selected_category',
        [
            'label' => __('Filter by Category', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => $category_options,
            'default' => '',
        ]
    );

        // Toggle controls
        $this->add_control(
            'show_image',
            [
                'label' => __('Show Image', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'huge-post-grid'),
                'label_off' => __('Hide', 'huge-post-grid'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label' => __('Image Size', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'medium',
                'options' => [
                    'thumbnail'      => __('Thumbnail - 150x150', 'huge-post-grid'),
                    'medium'         => __('Medium - 300x300', 'huge-post-grid'),
                    'medium_large'   => __('Medium Large - 768x0', 'huge-post-grid'),
                    'large'          => __('Large - 1024x1024', 'huge-post-grid'),
                    '1536x1536'      => __('1536x1536', 'huge-post-grid'),
                    '2048x2048'      => __('2048x2048', 'huge-post-grid'),
                    'full'           => __('Full', 'huge-post-grid'),
                ],
                'condition' => [
                    'show_image' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_word_limit',
            [
                'label' => __('Title Word Limit', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'default' => 10,
                'description' => __('Limit the number of words in the post title.', 'huge-post-grid'),
            ]
        );

        $this->add_control(
            'show_content',
            [
                'label' => __('Show Content', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'content_type',
            [
                'label' => __('Content Type', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'excerpt' => __('Excerpt', 'huge-post-grid'),
                    'content' => __('Full Content', 'huge-post-grid'),
                ],
                'default' => 'excerpt',
                'condition' => [
                    'show_content' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'content_word_limit',
            [
                'label' => __('Content Word Limit', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 20,
                'condition' => [
                    'show_content' => 'yes',
                ],
                'description' => __('Limit the number of words in the post excerpt/content.', 'huge-post-grid'),
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label' => __('Show Category', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before',
                
            ]
        );

        $this->add_control(
            'show_tags',
            [
                'label' => __('Show Tags', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_author',
            [
                'label' => __('Show Author', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label' => __('Show Date', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_readmore',
            [
                'label' => __('Read More', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_comments',
            [
                'label' => __('Show Comments', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'huge-post-grid'),
                'label_off' => __('No', 'huge-post-grid'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'pagination_type',
            [
                'label' => __('Pagination Type', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'pagination' => __('Numbered Pagination', 'huge-post-grid'),
                    'load_more' => __('Load More Button', 'huge-post-grid'),
                ],
                'default' => 'pagination',
                'condition' => [
                    'show_pagination' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'       => __('Columns', 'huge-post-grid'),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'description' => __('Set the number of columns for different screen sizes.', 'huge-post-grid'),
                'options'     => [
                    '1' => __('1 Column', 'huge-post-grid'),
                    '2' => __('2 Columns', 'huge-post-grid'),
                    '3' => __('3 Columns', 'huge-post-grid'),
                    '4' => __('4 Columns', 'huge-post-grid'),
                    '5' => __('5 Columns', 'huge-post-grid'),
                    '6' => __('6 Columns', 'huge-post-grid'),
                    '8' => __('8 Columns', 'huge-post-grid'),
                ],
                'default'     => '3',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .huge-post-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
                
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label' => __('Column Gap', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem','%'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 50],
                    'em' => ['min' => 0, 'max' => 5],
                    'rem' => ['min' => 0, 'max' => 5],
                    '%' => ['min' => 0, 'max' => 100],
                ],
                'default' => ['size' => 20, 'unit' => 'px'],
                'selectors' => [
                    '{{WRAPPER}} .huge-post-grid' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label' => __('Row Gap', 'huge-post-grid'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem','%'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 50],
                    'em' => ['min' => 0, 'max' => 5],
                    'rem' => ['min' => 0, 'max' => 5],
                    '%' => ['min' => 0, 'max' => 100],
                ],
                'default' => ['size' => 20, 'unit' => 'px'],
                'selectors' => [
                    '{{WRAPPER}} .huge-post-grid' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();


    /***************************************************************************************** Style Tab ********************************************************************************************************/
    // Container Style
    $this->start_controls_section(
        'section_container_style',
        [
            'label' => __('Container', 'huge-post-grid'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    // Background
    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'container_background',
            'label' => __('Background', 'huge-post-grid'),
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .huge-post-item',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'container_border',
            'selector' => '{{WRAPPER}} .huge-post-item',
        ]
    );

    $this->add_responsive_control(
        'container_border_radius',
        [
            'label' => __('Border Radius', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'container_box_shadow',
            'selector' => '{{WRAPPER}} .huge-post-item',
        ]
    );

    $this->add_responsive_control(
        'container_padding',
        [
            'label' => __('Padding', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'container_margin',
        [
            'label' => __('Margin', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    // Hover effects
    $this->start_controls_tabs('container_hover_tabs');

    $this->start_controls_tab(
        'container_normal',
        [
            'label' => __('Normal', 'huge-post-grid'),
        ]
    );

    $this->add_control(
        'container_bg_color',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
        'container_hover',
        [
            'label' => __('Hover', 'huge-post-grid'),
        ]
    );

    $this->add_control(
        'container_bg_color_hover',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item:hover' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'container_border_color_hover',
        [
            'label' => __('Border Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item:hover' => 'border-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'container_box_shadow_hover',
            'label' => __('Box Shadow', 'huge-post-grid'),
            'selector' => '{{WRAPPER}} .huge-post-item:hover',
        ]
    );

    $this->add_control(
        'container_hover_transition',
        [
            'label' => __('Transition Duration', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 3,
                    'step' => 0.1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .huge-post-item' => 'transition-duration: {{SIZE}}s',
            ],
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->end_controls_section();

     // Title Style

    $this->start_controls_section(
        'section_title_style',
        [
            'label' => __('Title', 'huge-post-grid'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .huge-post-title',
        ]
    );

    $this->add_control(
        'title_color',
        [
            'label' => __('Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-title a' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'title_hover_color',
        [
            'label' => __('Hover Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item:hover .huge-post-title a' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'title_alignment',
        [
            'label' => __('Alignment', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'huge-post-grid'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'huge-post-grid'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'huge-post-grid'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'left',
            'selectors' => [
                '{{WRAPPER}} .huge-post-title' => 'text-align: {{VALUE}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'title_margin',
        [
            'label' => __('Margin', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    

    $this->end_controls_section();

    // Content Style
    $this->start_controls_section(
        'section_excerpt_style',
        [
            'label' => __('Content', 'huge-post-grid'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                    'show_content' => 'yes'
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'excerpt_typography',
            'selector' => '{{WRAPPER}} .huge-post-excerpt',
        ]
    );

    $this->add_control(
        'excerpt_color',
        [
            'label' => __('Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-excerpt' => 'color: {{VALUE}};',
            ],
        ]
    );
    $this->add_control(
        'content_background',
        [
            'label' => __('Content Background', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-content' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'content_padding',
        [
            'label' => __('Padding', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
        $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'content_border',
            'selector' => '{{WRAPPER}} .huge-post-content',
        ]
    );

    $this->add_responsive_control(
        'content_border_radius',
        [
            'label' => __('Border Radius', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'content_box_shadow',
            'selector' => '{{WRAPPER}} .huge-post-content',
        ]
    );

    $this->add_responsive_control(
        'excerpt_alignment',
        [
            'label' => __('Alignment', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'huge-post-grid'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'huge-post-grid'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'huge-post-grid'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'left',
            'selectors' => [
                '{{WRAPPER}} .huge-post-excerpt' => 'text-align: {{VALUE}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'excerpt_margin',
        [
            'label' => __('Margin', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();

    // Category Style
    $this->start_controls_section(
        'section_category_style',
        [
            'label' => __('Category', 'huge-post-grid'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_category' => 'yes',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'category_typography',
            'selector' => '{{WRAPPER}} .huge-post-category',
        ]
    );

    // Category color tabs
    $this->start_controls_tabs('category_colors');

    $this->start_controls_tab(
        'category_color_normal',
        [
            'label' => __('Normal', 'huge-post-grid'),
        ]
    );

    $this->add_control(
        'category_text_color',
        [
            'label' => __('Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-category' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'category_bg_color',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-category' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
        'category_text_color_hover',
        [
            'label' => __('Hover', 'huge-post-grid'),
        ]
    );

    $this->add_control(
        'category_color_hover',
        [
            'label' => __('Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item:hover .huge-post-category' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'category_bg_color_hover',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item:hover .huge-post-category' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->add_responsive_control(
        'category_padding',
        [
            'label' => __('Padding', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'category_border_radius',
        [
            'label' => __('Border Radius', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'category_border',
            'selector' => '{{WRAPPER}} .huge-post-category',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'category_box_shadow',
            'selector' => '{{WRAPPER}} .huge-post-category',
        ]
    );

    $this->end_controls_section();

    // Author Style
    $this->start_controls_section(
        'section_author_style',
        [
            'label' => __('Author', 'huge-post-grid'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_author' => 'yes',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'author_typography',
            'selector' => '{{WRAPPER}} .huge-post-author',
        ]
    );

    // Author color tabs
    $this->start_controls_tabs('author_colors');

    $this->start_controls_tab(
        'author_color_normal',
        [
            'label' => __('Normal', 'huge-post-grid'),
        ]
    );

    $this->add_control(
        'author_text_color',
        [
            'label' => __('Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-author' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'author_bg_color',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-author' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
        'author_color_hover',
        [
            'label' => __('Hover', 'huge-post-grid'),
        ]
    );

    $this->add_control(
        'author_text_color_hover',
        [
            'label' => __('Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item:hover .huge-post-author' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'author_bg_color_hover',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item:hover .huge-post-author' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->add_responsive_control(
        'author_padding',
        [
            'label' => __('Padding', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'author_border_radius',
        [
            'label' => __('Border Radius', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-author' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'author_border',
            'selector' => '{{WRAPPER}} .huge-post-author',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'author_box_shadow',
            'selector' => '{{WRAPPER}} .huge-post-author',
        ]
    );

    $this->end_controls_section();

    // Date Style
    $this->start_controls_section(
        'section_date_style',
        [
            'label' => __('Date', 'huge-post-grid'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_date' => 'yes',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'date_typography',
            'selector' => '{{WRAPPER}} .huge-post-date',
        ]
    );

    // Date color tabs
    $this->start_controls_tabs('date_colors');

    $this->start_controls_tab(
        'date_color_normal',
        [
            'label' => __('Normal', 'huge-post-grid'),
        ]
    );

    $this->add_control(
        'date_text_color',
        [
            'label' => __('Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-date' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'date_bg_color',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-date' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
        'date_color_hover',
        [
            'label' => __('Hover', 'huge-post-grid'),
        ]
    );

    $this->add_control(
        'date_text_color_hover',
        [
            'label' => __('Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item:hover .huge-post-date' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'date_bg_color_hover',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item:hover .huge-post-date' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->add_responsive_control(
        'date_padding',
        [
            'label' => __('Padding', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'date_border_radius',
        [
            'label' => __('Border Radius', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'date_border',
            'selector' => '{{WRAPPER}} .huge-post-date',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'date_box_shadow',
            'selector' => '{{WRAPPER}} .huge-post-date',
        ]
    );

    $this->end_controls_section();

    // Tags Style
    $this->start_controls_section(
        'section_tags_style',
        [
            'label' => __('Tags', 'huge-post-grid'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_tags' => 'yes',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'tags_typography',
            'selector' => '{{WRAPPER}} .huge-post-tags, {{WRAPPER}} .huge-post-tags a',
        ]
    );

    // Tags color
    $this->start_controls_tabs('tags_colors');

    $this->start_controls_tab(
        'tags_color_normal',
        [
            'label' => __('Normal', 'huge-post-grid'),
        ]
    );

    $this->add_control(
        'tags_text_color',
        [
            'label' => __('Text Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-tags a' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'tags_bg_color',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-tags a' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
        'tags_color_hover',
        [
            'label' => __('Hover', 'huge-post-grid'),
        ]
    );

    $this->add_control(
        'tags_text_color_hover',
        [
            'label' => __('Text Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item:hover .huge-post-tags a' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'tags_bg_color_hover',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item:hover .huge-post-tags a' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();

    // Tags spacing
    $this->add_responsive_control(
        'tags_gap',
        [
            'label' => __('Gap Between Tags', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                ],
                'rem' => [
                    'min' => 0,
                    'max' => 5,
                ],
            ],
            'size_units' => ['px', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-tags a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'tags_padding',
        [
            'label' => __('Padding', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-tags a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_responsive_control(
        'tags_margin',
        [
            'label' => __('Margin', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-tags a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'tags_border_radius',
        [
            'label' => __('Border Radius', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-tags a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'tags_box_shadow',
            'selector' => '{{WRAPPER}} .huge-post-tags a',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'tags_border',
            'selector' => '{{WRAPPER}} .huge-post-tags a',
        ]
    );

    $this->end_controls_section();

    // Image Style
    $this->start_controls_section(
        'section_image_style',
        [
            'label' => __('Image', 'huge-post-grid'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_image' => 'yes',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'image_border',
            'selector' => '{{WRAPPER}} .huge-post-thumbnail img',
        ]
    );

    $this->add_responsive_control(
        'image_border_radius',
        [
            'label' => __('Border Radius', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .huge-post-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'image_box_shadow',
            'selector' => '{{WRAPPER}} .huge-post-thumbnail img',
        ]
    );

    $this->add_responsive_control(
        'image_padding',
        [
            'label' => __('Padding', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'image_margin',
        [
            'label' => __('Margin', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-post-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    // Overlay Section
    $this->add_control(
        'image_overlay_heading',
        [
            'label' => __('Image Overlay', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    // Overlay Type
    $this->add_control(
        'image_overlay_type',
        [
            'label' => __('Overlay Type', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'default',
            'options' => [
                'default' => __('Default', 'huge-post-grid'),
                'color' => __('Color', 'huge-post-grid'),
                'gradient' => __('Gradient', 'huge-post-grid'),
            ],
        ]
    );

    // Color Overlay
    $this->add_control(
        'image_overlay_color',
        [
            'label' => __('Overlay Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-overlay' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'image_overlay_type' => 'color',
            ],
        ]
    );

    // Gradient Overlay
    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'image_overlay_gradient',
            'label' => __('Overlay Gradient', 'huge-post-grid'),
            'types' => ['gradient'],
            'selector' => '{{WRAPPER}} .huge-post-overlay',
            'condition' => [
                'image_overlay_type' => 'gradient',
            ],
        ]
    );

    // Overlay Opacity
    $this->add_control(
        'image_overlay_opacity',
        [
            'label' => __('Overlay Opacity', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 1,
                    'min' => 0,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .huge-post-overlay' => 'opacity: {{SIZE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'name' => 'image_overlay_type',
                        'operator' => '==',
                        'value' => 'color'
                    ],
                    [
                        'name' => 'image_overlay_type',
                        'operator' => '==',
                        'value' => 'gradient'
                    ],
                ],
            ],
        ]
    );

    // Hover Effects
    $this->add_control(
        'image_hover_effects_heading',
        [
            'label' => __('Hover Effects', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'image_overlay_type!' => 'default',
            ],
        ]
    );

    // Hover Overlay Opacity
    $this->add_control(
        'image_overlay_opacity_hover',
        [
            'label' => __('Hover Overlay Opacity', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'max' => 1,
                    'min' => 0,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .huge-post-thumbnail:hover .huge-post-overlay' => 'opacity: {{SIZE}};',
            ],
            'conditions' => [
                'relation' => 'or',
                'terms' => [
                    [
                        'name' => 'image_overlay_type',
                        'operator' => '==',
                        'value' => 'color'
                    ],
                    [
                        'name' => 'image_overlay_type',
                        'operator' => '==',
                        'value' => 'gradient'
                    ],
                ],
            ],
        ]
    );

    $this->end_controls_section();

    // Read More Style
    $this->start_controls_section(
        'section_readmore_style',
        [
            'label' => __('Read More', 'huge-post-grid'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_readmore' => 'yes', 
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'readmore_typography',
            'selector' => '{{WRAPPER}} .huge-read-more',
        ]
    );

    // Color tabs (normal/hover)
    $this->start_controls_tabs('readmore_colors');

    // Normal tab
    $this->start_controls_tab(
        'readmore_color_normal',
        [
            'label' => __('Normal', 'huge-post-grid'),
        ]
    );

    $this->add_control(
        'readmore_text_color',
        [
            'label' => __('Text Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-read-more' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'readmore_bg_color',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-read-more' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_tab();

    // Hover tab
    $this->start_controls_tab(
        'readmore_color_hover',
        [
            'label' => __('Hover', 'huge-post-grid'),
        ]
    );

    $this->add_control(
        'readmore_text_color_hover',
        [
            'label' => __('Text Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item:hover .huge-read-more' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'readmore_bg_color_hover',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .huge-post-item:hover .huge-read-more' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();

    // Spacing
    $this->add_responsive_control(
        'readmore_margin',
        [
            'label' => __('Margin', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'readmore_padding',
        [
            'label' => __('Padding', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .huge-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'readmore_border',
            'selector' => '{{WRAPPER}} .huge-read-more',
        ]
    );

    $this->add_responsive_control(
        'readmore_border_radius',
        [
            'label' => __('Border Radius', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .huge-read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'readmore_box_shadow',
            'selector' => '{{WRAPPER}} .huge-read-more',
        ]
    );

    $this->end_controls_section();

    // Pagination Style
    $this->start_controls_section(
        'section_pagination_style',
        [
            'label' => __('Pagination', 'huge-post-grid'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                    'show_pagination' => 'yes',
            ],
        ]
    );

    // Load More Button Tab
    $this->start_controls_tabs('pagination_tabs');

    // Load More Button - Normal
    $this->start_controls_tab(
        'load_more_normal',
        [
            'label' => __('Load More', 'huge-post-grid'),
            'condition' => [
                'pagination_type' => 'load_more',
            ],
        ]
    );

    $this->add_control(
        'load_more_text_color',
        [
            'label' => __('Text Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .load-more-btn' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'pagination_type' => 'load_more',
            ],
        ]
    );

    $this->add_control(
        'load_more_bg_color',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .load-more-btn' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'pagination_type' => 'load_more',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'load_more_typography',
            'selector' => '{{WRAPPER}} .load-more-btn',
            'condition' => [
                'pagination_type' => 'load_more',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'load_more_border',
            'selector' => '{{WRAPPER}} .load-more-btn',
            'condition' => [
                'pagination_type' => 'load_more',
            ],
        ]
    );

    $this->add_responsive_control(
        'load_more_border_radius',
        [
            'label' => __('Border Radius', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .load-more-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'pagination_type' => 'load_more',
            ],
        ]
    );

    $this->add_responsive_control(
        'load_more_padding',
        [
            'label' => __('Padding', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .load-more-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'pagination_type' => 'load_more',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'load_more_box_shadow',
            'selector' => '{{WRAPPER}} .load-more-btn',
            'condition' => [
                'pagination_type' => 'load_more',
            ],
        ]
    );

    $this->end_controls_tab();

    // Load More Button - Hover
    $this->start_controls_tab(
        'load_more_hover',
        [
            'label' => __('Hover', 'huge-post-grid'),
            'condition' => [
                'pagination_type' => 'load_more',
            ],
        ]
    );

    $this->add_control(
        'load_more_text_color_hover',
        [
            'label' => __('Text Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .load-more-btn:hover' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'pagination_type' => 'load_more',
            ],
        ]
    );

    $this->add_control(
        'load_more_bg_color_hover',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .load-more-btn:hover' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'pagination_type' => 'load_more',
            ],
        ]
    );

    $this->add_control(
        'load_more_border_color_hover',
        [
            'label' => __('Border Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .load-more-btn:hover' => 'border-color: {{VALUE}};',
            ],
            'condition' => [
                'pagination_type' => 'load_more',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'load_more_box_shadow_hover',
            'selector' => '{{WRAPPER}} .load-more-btn:hover',
            'condition' => [
                'pagination_type' => 'load_more',
            ],
        ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();

    // Numbered Pagination
    $this->add_control(
        'pagination_numbers_heading',
        [
            'label' => __('Numbered Pagination', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'pagination_type' => 'pagination',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'pagination_numbers_border',
            'selector' => '{{WRAPPER}} .post-grid-pagination a, {{WRAPPER}} .post-grid-pagination span',
            'condition' => [
                'pagination_type' => 'pagination',
            ],
        ]
    );

    $this->add_control(
        'pagination_numbers_color',
        [
            'label' => __('Text Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .post-grid-pagination a' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'pagination_type' => 'pagination',
            ],
        ]
    );

    $this->add_control(
        'pagination_numbers_bg_color',
        [
            'label' => __('Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .post-grid-pagination a' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'pagination_type' => 'pagination',
            ],
        ]
    );

    $this->add_control(
        'pagination_numbers_active_color',
        [
            'label' => __('Active Text Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .post-grid-pagination .current' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'pagination_type' => 'pagination',
            ],
        ]
    );

    $this->add_control(
        'pagination_numbers_active_bg_color',
        [
            'label' => __('Active Background Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .post-grid-pagination .current' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'pagination_type' => 'pagination',
            ],
        ]
    );

    $this->add_control(
        'pagination_numbers_active_border_color',
        [
            'label' => __('Active Border Color', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .post-grid-pagination .current' => 'border-color: {{VALUE}};',
            ],
            'condition' => [
                'pagination_type' => 'pagination',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'pagination_numbers_typography',
            'selector' => '{{WRAPPER}} .post-grid-pagination a, {{WRAPPER}} .post-grid-pagination span',
            'condition' => [
                'pagination_type' => 'pagination',
            ],
        ]
    );

    $this->add_responsive_control(
        'pagination_numbers_padding',
        [
            'label' => __('Padding', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .post-grid-pagination a, {{WRAPPER}} .post-grid-pagination span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'pagination_type' => 'pagination',
            ],
        ]
    );

    $this->add_responsive_control(
        'pagination_numbers_border_radius',
        [
            'label' => __('Border Radius', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .post-grid-pagination a, {{WRAPPER}} .post-grid-pagination span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'pagination_type' => 'pagination',
            ],
        ]
    );

    $this->add_responsive_control(
        'pagination_numbers_gap',
        [
            'label' => __('Gap Between Items', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .post-grid-pagination ul' => 'gap: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'pagination_type' => 'pagination',
            ],
        ]
    );

    $this->add_responsive_control(
        'pagination_alignment',
        [
            'label' => __('Alignment', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'huge-post-grid'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'huge-post-grid'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'huge-post-grid'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .load-more-wrapper' => 'text-align: {{VALUE}};',
                '{{WRAPPER}} .post-grid-pagination' => 'justify-content: {{VALUE}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'pagination_margin',
        [
            'label' => __('Margin', 'huge-post-grid'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .load-more-wrapper, {{WRAPPER}} .post-grid-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();
    
    }
    public function get_script_depends() {
        // return ['elementor-post-grid'];
        return ['post-grid-loadmore', 'post-grid-pagination'];
    }


protected function render() {
    $settings = $this->get_settings_for_display();
    $unique_id = 'huge-post-grid-' . $this->get_id();
    
    // Add all settings as data attributes
    echo '<div class="elementor-widget-huge-post-grid" 
          data-posts-per-page="' . esc_attr($settings['posts_per_page']) . '"
          data-selected-category="' . esc_attr($settings['selected_category']) . '"
          data-post-style="' . esc_attr($settings['post_style']) . '"
          data-show-image="' . esc_attr($settings['show_image']) . '"
          data-show-category="' . esc_attr($settings['show_category']) . '"
          data-show-content="' . esc_attr($settings['show_content']) . '"
          data-content-type="' . esc_attr($settings['content_type']) . '"
          data-show-author="' . esc_attr($settings['show_author']) . '"
          data-show-date="' . esc_attr($settings['show_date']) . '"
          data-image-size="' . esc_attr($settings['image_size']) . '"
          data-title-word-limit="' . esc_attr($settings['title_word_limit']) . '"
          data-content-word-limit="' . esc_attr($settings['content_word_limit']) . '">';
    
    // Initial query
    $query_args = [
        'post_type' => 'post',
        'posts_per_page' => $settings['posts_per_page'],
        'paged' => max(1, get_query_var('paged'), get_query_var('page')),
        'category_name' => $settings['selected_category']
    ];
    
    $query = new WP_Query($query_args);
    
    if ($query->have_posts()) {
        // echo '<div id="' . esc_attr($unique_id) . '" class="huge-post-grid ep-post-grid huge-post-grid-' . esc_attr($settings['post_style']) . ' huge-post-columns-' . esc_attr($settings['columns']) . '">';
        echo '<div id="' . esc_attr($unique_id) . '" class="huge-post-grid ep-post-grid huge-post-grid-' . esc_attr($settings['post_style']) .'">';
        
        while ($query->have_posts()) {
            $query->the_post();
            $this->render_post_style($settings['post_style'], $settings);
        }
        
        echo '</div>';
        
        // Render pagination
        if ($settings['show_pagination'] === 'yes') {
            $this->render_pagination($query, $settings, $unique_id);
        }
        
        wp_reset_postdata();
    }
    
    echo '</div>'; // Close widget wrapper
}



protected function render_post_style($style, $settings) {
    huge_render_post_style($style, $settings);
}


// fixed
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
//                    . __('Load More', 'elementor-post-grid') 
//                    . '<span class="spinner"></span></button>';
//             echo '</div>';
//         }
//     } 
//     elseif ($settings['pagination_type'] === 'pagination') {
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
//                 'prev_text' => __('« Previous', 'elementor-post-grid'),
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

protected function render_pagination($query, $settings, $unique_id) {
    if ($settings['pagination_type'] === 'load_more') {
        $max_pages = $query->max_num_pages;
        if ($max_pages > 1) {
            echo '<div class="load-more-wrapper">';
            echo '<button class="load-more-btn" 
                      data-container="' . esc_attr($unique_id) . '"
                      data-page="1" 
                      data-max-pages="' . esc_attr($max_pages) . '"
                      data-posts-per-page="' . esc_attr($settings['posts_per_page']) . '"
                      data-category="' . esc_attr($settings['selected_category']) . '"
                      data-post-style="' . esc_attr($settings['post_style']) . '"
                      data-show-image="' . esc_attr($settings['show_image']) . '"
                      data-show-category="' . esc_attr($settings['show_category']) . '"
                      data-show-content="' . esc_attr($settings['show_content']) . '"
                      data-content-type="' . esc_attr($settings['content_type']) . '"
                      data-show-author="' . esc_attr($settings['show_author']) . '"
                      data-show-date="' . esc_attr($settings['show_date']) . '"
                      data-image-size="' . esc_attr($settings['image_size']) . '"
                      data-title-word-limit="' . esc_attr($settings['title_word_limit']) . '"
                      data-content-word-limit="' . esc_attr($settings['content_word_limit']) . '" >'
                   . __('Load More', 'huge-post-grid') 
                   . '</button>';
            echo '</div>';
        }
    } elseif ($settings['pagination_type'] === 'pagination') {
        $total_pages = $query->max_num_pages;
        if ($total_pages > 1) {
            $current_page = max(1, get_query_var('paged'), get_query_var('page'));
            
            echo '<div class="post-grid-pagination">';
            echo paginate_links([
                'base' => add_query_arg('paged', '%#%'),
                'format' => '?paged=%#%',
                'current' => $current_page,
                'total' => $total_pages,
                'prev_text' => __('« Previous', 'huge-post-grid'),
                'next_text' => __('Next »', 'huge-post-grid'),
                'type' => 'list',
                'end_size' => 1,
                'mid_size' => 2,
            ]);
            echo '</div>';
        }
    }
}



protected function content_template() {}


    
}


