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

// function render_style1($settings) {
//     // Card Design
//     echo '<div class="huge-post-grid-item huge-post-style-1">';
    
//     if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
//         $image_size = isset($settings['image_size']) ? $settings['image_size'] : 'large';
//         echo '<div class="huge-post-grid-thumbnail"><a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), $image_size) . '</a></div>';
//     }
    
//     echo '<div class="huge-post-grid-content-wrapper">';
    
//     if ($settings['show_category'] === 'yes') {
//         $categories = get_the_category();
//         if (!empty($categories)) {
//             echo '<div class="huge-post-grid-category">' . esc_html($categories[0]->name) . '</div>';
//         }
//     }
    
//     echo '<h3 class="huge-post-grid-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';

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
//         echo '<div class="huge-post-grid-footer">';
//         if ($settings['show_author'] === 'yes') {
//             echo '<span class="huge-post-grid-author">' . get_the_author() . '</span>';
//         }
//         if ($settings['show_date'] === 'yes') {
//             echo '<span class="huge-post-grid-date">' . get_the_date() . '</span>';
//         }
//         echo '</div>';
//     }
    
//     echo '</div></div>';
// }

// function render_style2($settings) {
//     // Card Overlay (ElementPack's Alice)
//     echo '<div class="huge-post-grid-item style-2 huge-post-style-2">';
    
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
//     echo '</div>'; // .huge-post-grid-item
// }

// function render_style3($settings) {
//     // Creative Box (ElementPack's Portfolio Style)
//     echo '<div class="huge-post-grid-item huge-post-style-3">';
    
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
    
//     echo '</div>'; // .huge-post-grid-item
// }

// function render_style4($settings) {
//     // Metro Grid (ElementPack's Metro Style)
//     echo '<div class="huge-post-grid-item style-4">';
    
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
//     echo '</div>'; // .huge-post-grid-item
// }

// function render_style5($settings) {
//     // Hover Card (ElementPack's Hover Style)
//     echo '<div class="huge-post-grid-item style-5">';
    
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
//     echo '</div>'; // .huge-post-grid-item
// }

function render_huge_style1($settings) {
    // Card Design
    echo '<div class="huge-post-grid-item huge-post-style-1">';
    
    if ($settings['show_image'] === 'yes' && has_post_thumbnail()) {
        $image_size = isset($settings['image_size']) ? $settings['image_size'] : 'large';
        echo '<div class="huge-post-grid-thumbnail"><a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), $image_size) . '</a></div>';
    }
    
    echo '<div class="huge-post-grid-content-wrapper">';
    
    if ($settings['show_category'] === 'yes') {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<div class="huge-post-grid-category">' . esc_html($categories[0]->name) . '</div>';
        }
    }
    
    echo '<h3 class="huge-post-grid-title"><a href="' . get_permalink() . '">' . wp_trim_words(get_the_title(), $settings['title_word_limit'], '...') . '</a></h3>';

    if ($settings['show_content'] === 'yes') {
        $word_limit = !empty($settings['content_word_limit']) ? $settings['content_word_limit'] : 20;
        $excerpt = get_the_excerpt();
        
        if (empty($excerpt)) {
            $excerpt = wp_trim_words(get_the_content(), $word_limit, '...');
        }
        
        echo '<div class="huge-post-excerpt">'. esc_html(wp_trim_words($excerpt, $word_limit, '...')) . '</div>';
    }
    
    if ($settings['show_author'] === 'yes' || $settings['show_date'] === 'yes') {
        echo '<div class="huge-post-grid-footer">';
        if ($settings['show_author'] === 'yes') {
            echo '<span class="huge-post-grid-author">' . get_the_author() . '</span>';
        }
        if ($settings['show_date'] === 'yes') {
            echo '<span class="huge-post-grid-date">' . get_the_date() . '</span>';
        }
        echo '</div>';
    }
    if ($settings['show_tags'] === 'yes') {
        $tags = get_the_tags();
        if (!empty($tags)) {
            echo '<div class="huge-post-grid-tags">';
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
    echo '<div class="huge-post-grid-item style-2 huge-post-style-2">';
    
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
    echo '<div class="huge-post-grid-item huge-post-style-3">';
    
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
    echo '<div class="huge-post-grid-item huge-post-style-5">';  // Changed from style-5
    
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

// function render_ep_style1($settings) {
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

// function render_ep_style2($settings) {
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

// function render_ep_style3($settings) {
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

// function render_ep_style4($settings) {
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

// function render_ep_style5($settings) {
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





