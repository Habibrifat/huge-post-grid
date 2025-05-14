<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function ep_render_post_style($style, $settings){
    switch ($style) {
        case 'huge-style1':
           render_huge_style1($settings);
            break;
        case 'huge-style2':
            render_huge_style2($settings);
            break;
        case 'huge-style3':
            render_huge_style3($settings);
            break;
        // case 'style4':
        //    render_huge_style4($settings);
        //     break;
        case 'huge-style4':
            render_huge_style4($settings);
            break;     
        case 'huge-style5':
            render_huge_style5($settings);
            break;
        case 'huge-style6':
            render_huge_style6($settings);
            break;
        case 'huge-style7':
            render_huge_style7($settings);
            break;
        case 'huge-style8':
            render_huge_style8($settings);
            break;
        case 'huge-style9':
            render_huge_style9($settings);
            break;
        default:
            // render_style1($settings);
            render_huge_style1($settings);
    }
}


function render_huge_style1($settings) {
    // Card Design
    echo '<div class="huge-post-item huge-post-style-1">';
    
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        $image_size = isset($settings['image_size']) ? $settings['image_size'] : 'large';
        echo '<div class="huge-post-thumbnail"><a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), $image_size) . '</a></div>';
    }
    
    echo '<div class="huge-post-content-wrapper">';
    
    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<div class="huge-post-category">' . esc_html($categories[0]->name) . '</div>';
        }
    }
    
    echo '<h3 class="huge-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';

    if ($settings['show_content'] === 'yes') {
        $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
        $excerpt = get_the_excerpt();
        
        if (empty($excerpt)) {
            $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
        }
        
        echo '<div class="huge-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
    }
    
    if ($settings['show_author'] === 'yes' || $settings['show_date'] === 'yes') {
        echo '<div class="huge-post-footer">';
        if ($settings['show_author'] === 'yes') {
            echo '<span class="huge-post-author">' . get_the_author() . '</span>';
        }
        if ($settings['show_date'] === 'yes') {
            echo '<span class="huge-post-date">' . get_the_date() . '</span>';
        }
        echo '</div>';
    }
    if ($settings['show_tags'] === 'yes') {
        $tags = get_the_tags();
        if (!empty($tags)) {
            echo '<div class="huge-post-tags">';
            foreach ($tags as $tag) {
                echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
            }
            echo '</div>';
        }
    }
    
    echo '</div></div>';
}

function render_huge_style2($settings) {
    // Card Overlay
    echo '<div class="huge-post-item style-2 huge-post-style-2">';
    
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        $image_size = isset($settings['image_size']) ? $settings['image_size'] : 'large';
        echo '<div class="huge-post-thumbnail">';
        echo get_the_post_thumbnail(get_the_ID(), $image_size);
        echo '<div class="huge-post-overlay"></div>';
        echo '</div>';
    }
    
    echo '<div class="huge-post-content">';
    
    if ($settings['show_date'] === 'yes') {
        echo '<div class="huge-post-meta-top">';
        echo '<span class="huge-post-date">' . get_the_date('d M') . '</span>';
        echo '</div>';
    }
    
    echo '<h3 class="huge-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    echo '<div class="huge-post-meta-bottom">';
    if ($settings['show_author'] === 'yes') {
        echo '<span class="huge-post-author"><i class="fas fa-user"></i> ' . get_the_author() . '</span>';
    }
    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<span class="huge-post-category"><i class="fas fa-tag"></i> ' . esc_html($categories[0]->name) . '</span>';
        }
    }
    echo '</div>';
    
    echo '</div>';
    echo '</div>';
}

function render_huge_style3($settings) {
    // Creative Box
    echo '<div class="huge-post-item huge-post-style-3">';
    
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<div class="huge-post-thumbnail">';
        echo get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large');
        echo '<div class="huge-post-overlay"></div>';
        
        echo '<div class="huge-post-hover-content">';
        echo '<div class="huge-post-hover-inner">';
        
        if ($settings['show_category'] === 'yes') {
            $categories = get_the_category();
            if (!empty($categories)) {
                echo '<span class="huge-post-category">' . esc_html($categories[0]->name) . '</span>';
            }
        }
        
        echo '<h3 class="huge-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
        
        if ($settings['show_date'] === 'yes') {
            echo '<span class="huge-post-date">' . get_the_date() . '</span>';
        }
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
    echo '</div>';
}

// function render_huge_style5($settings) {
//     // Metro Grid
//     echo '<div class="huge-post-grid-item huge-post-style-4">';  // Changed from style-4
    
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         echo '<div class="huge-post-thumbnail">';
//         echo get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large');
//         echo '<div class="huge-post-overlay"></div>';
//         echo '</div>';
//     }
    
//     echo '<div class="huge-post-content">';
    
//     if ($settings['show_category'] === 'yes') {
//         $categories = get_the_category();
//         if (!empty($categories)) {
//             echo '<span class="huge-post-category">' . esc_html($categories[0]->name) . '</span>';
//         }
//     }
    
//     echo '<h3 class="huge-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
//     if ($settings['show_date'] === 'yes') {
//         echo '<span class="huge-post-date">' . get_the_date('F j, Y') . '</span>';
//     }
    
//     echo '</div>';
//     echo '</div>';
// }

function render_huge_style4($settings) {
    // Hover Card
    echo '<div class="huge-post-item huge-post-style-5">';  // Changed from style-5
    
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<div class="huge-post-thumbnail">';
        echo get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large');
        echo '</div>';
    }
    
    echo '<div class="huge-post-content">';
    
    if ($settings['show_date'] === 'yes') {
        echo '<span class="huge-post-date">' . get_the_date('M d') . '</span>';
    }
    
    echo '<h3 class="huge-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    if ($settings['show_content'] === 'yes') {
        $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
        $excerpt = get_the_excerpt();
        
        if (empty($excerpt)) {
            $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
        }
        
        echo '<div class="huge-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
    }
    
    echo '<a href="' . get_permalink() . '" class="huge-post-readmore"><i class="fas fa-arrow-right"></i></a>';
    
    echo '</div>';
    echo '</div>';
}

function render_huge_style5($settings) {
    // Classic Overlay Design
    echo '<div class="huge-post-item huge-post-style-6">';
    
    echo '<div class="huge-post-thumbnail">';
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large') . '</a>';
    }
    echo '<div class="huge-post-overlay"></div>';
    
    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<div class="huge-post-category"><a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></div>';
        }
    }
    echo '</div>';
    
    echo '<div class="huge-post-content">';
    echo '<h3 class="huge-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    echo '<div class="huge-post-meta">';
    if ($settings['show_author'] === 'yes') {
        echo '<span class="huge-post-author"><i class="fas fa-user"></i> ' . get_the_author() . '</span>';
    }
    if ($settings['show_date'] === 'yes') {
        echo '<span class="huge-post-date"><i class="far fa-calendar-alt"></i> ' . get_the_date() . '</span>';
    }
    echo '</div>';
    
    if ($settings['show_content'] === 'yes') {
        $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
        $excerpt = get_the_excerpt();
        
        if (empty($excerpt)) {
            $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
        }
        
        echo '<div class="huge-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
    }
    
    if ($settings['show_readmore'] === 'yes') {
        echo '<a href="' . get_permalink() . '" class="huge-read-more">' . __('Read More', 'elementor-post-grid') . '</a>';
    }
    
    echo '</div></div>';
}

function render_huge_style6($settings) {
    // Card Gradient Design
    echo '<div class="huge-post-item huge-post-style-7">';
    
    echo '<div class="huge-post-thumbnail">';
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large') . '</a>';
    }
    echo '</div>';
    
    echo '<div class="huge-post-content">';
    
    if ($settings['show_date'] === 'yes') {
        echo '<div class="huge-post-date">';
        echo '<span class="huge-date-day">' . get_the_date('d') . '</span>';
        echo '<span class="huge-date-month">' . get_the_date('M') . '</span>';
        echo '</div>';
    }
    
    echo '<div class="huge-post-content-inner">';
    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<div class="huge-post-category">' . esc_html($categories[0]->name) . '</div>';
        }
    }
    
    echo '<h3 class="huge-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    echo '<div class="huge-post-meta">';
    if ($settings['show_author'] === 'yes') {
        echo '<span class="huge-post-author"><i class="fas fa-user"></i> ' . get_the_author() . '</span>';
    }
    if ($settings['show_comments'] === 'yes') {
        echo '<span class="huge-post-comments"><i class="far fa-comment"></i> ' . get_comments_number() . '</span>';
    }
    echo '</div>';
    
    if ($settings['show_content'] === 'yes') {
        $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
        $excerpt = get_the_excerpt();
        
        if (empty($excerpt)) {
            $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
        }
        
        echo '<div class="huge-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
    }
    echo '</div></div></div>';
}

function render_huge_style7($settings) {
    // Modern Hover Design
    echo '<div class="huge-post-item huge-post-style-8">';
    
    echo '<div class="huge-post-thumbnail">';
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large') . '</a>';
    }
    echo '<div class="huge-post-hover-content">';
    echo '<h3 class="huge-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    echo '<div class="huge-post-meta">';
    if ($settings['show_date'] === 'yes') {
        echo '<span class="huge-post-date">' . get_the_date() . '</span>';
    }
    echo '</div>';
    
    if ($settings['show_readmore'] === 'yes') {
        echo '<a href="' . get_permalink() . '" class="huge-read-more"><i class="fas fa-long-arrow-alt-right"></i></a>';
    }
    echo '</div></div>';

    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<div class="huge-post-category"><a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></div>';
        }
    }

    if ($settings['show_content'] === 'yes') {
        $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
        $excerpt = get_the_excerpt();
        
        if (empty($excerpt)) {
            $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
        }
        
        echo '<div class="huge-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
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

function render_huge_style8($settings) {
    // Creative Tilt Design
    echo '<div class="huge-post-item huge-post-style-9">';
    echo '<div class="huge-post-tilt-box">';
    
    echo '<div class="huge-post-thumbnail">';
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), isset($settings['image_size']) ? $settings['image_size'] : 'large') . '</a>';
    }
    echo '</div>';
    
    echo '<div class="huge-post-content">';
    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<div class="huge-post-category">' . esc_html($categories[0]->name) . '</div>';
        }
    }
    
    echo '<h3 class="huge-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    echo '<div class="huge-post-meta">';
    if ($settings['show_author'] === 'yes') {
        echo '<span class="huge-post-author"><i class="fas fa-user"></i> ' . get_the_author() . '</span>';
    }
    if ($settings['show_date'] === 'yes') {
        echo '<span class="huge-post-date">' . get_the_date() . '</span>';
    }
    echo '</div>';
    
    if ($settings['show_content'] === 'yes') {
        $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
        $excerpt = get_the_excerpt();
        
        if (empty($excerpt)) {
            $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
        }
        
        echo '<div class="huge-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
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
        echo '<a href="' . get_permalink() . '" class="huge-read-more">' . __('Continue Reading', 'elementor-post-grid') . '</a>';
    }
    echo '</div></div></div>';
}

function render_huge_style9($settings) {
    // Minimal List Design
    echo '<div class="huge-post-item huge-post-style-10">';
    
    if ($settings['show_date'] === 'yes') {
        echo '<div class="huge-post-date">';
        echo '<span class="huge-date-day">' . get_the_date('d') . '</span>';
        echo '<span class="huge-date-month">' . get_the_date('M') . '</span>';
        echo '</div>';
    }
    
    echo '<div class="huge-post-content">';
    echo '<h3 class="huge-post-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';
    
    echo '<div class="huge-post-meta">';
    if ($settings['show_author'] === 'yes') {
        echo '<span class="huge-post-author">' . __('By', 'elementor-post-grid') . ' ' . get_the_author() . '</span>';
    }
    if ($settings['show_comments'] === 'yes') {
        echo '<span class="huge-post-comments">' . get_comments_number() . ' ' . __('Comments', 'elementor-post-grid') . '</span>';
    }
    echo '</div>';
    
    if ($settings['show_content'] === 'yes') {
        $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
        $excerpt = get_the_excerpt();
        
        if (empty($excerpt)) {
            $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
        }
        
        echo '<div class="huge-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
    }
    echo '</div></div>';
}





