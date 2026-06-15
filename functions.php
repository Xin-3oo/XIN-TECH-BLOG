<?php

function anime_blog_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-background', array(
        'default-color' => 'fff5f8',
    ));

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'anime-blog'),
        'footer'  => __('Footer Menu', 'anime-blog'),
    ));
}
add_action('after_setup_theme', 'anime_blog_setup');

function anime_blog_scripts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+SC:wght@400;500;700&display=swap', array(), null);
    wp_enqueue_style('font-awesome', 'https://cdn.bootcdn.net/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    wp_enqueue_style('anime-blog-style', get_stylesheet_uri(), array('font-awesome'), '1.0.0');
    wp_enqueue_style('anime-blog-single', get_template_directory_uri() . '/assets/css/single.css', array(), '1.0.0');
    wp_enqueue_style('anime-blog-archive', get_template_directory_uri() . '/assets/css/archive.css', array(), '1.0.0');
    wp_enqueue_style('anime-blog-components', get_template_directory_uri() . '/assets/css/components.css', array(), '1.0.0');

    wp_enqueue_script('anime-blog-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

    wp_localize_script('anime-blog-main', 'animeBlog', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('anime_blog_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'anime_blog_scripts');

function anime_blog_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'anime-blog'),
        'id'            => 'sidebar-1',
        'description'   => __('Add sidebar widgets here.', 'anime-blog'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widgets', 'anime-blog'),
        'id'            => 'footer-widgets',
        'description'   => __('Add footer widgets here.', 'anime-blog'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'anime_blog_widgets_init');

function anime_blog_excerpt_length($length) {
    return 120;
}
add_filter('excerpt_length', 'anime_blog_excerpt_length');

function anime_blog_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'anime_blog_excerpt_more');

function anime_blog_reading_time($content) {
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 300);
    return $reading_time;
}

function anime_blog_post_categories() {
    $categories = get_the_category();
    if ($categories) {
        echo '<div class="post-categories">';
        foreach ($categories as $category) {
            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="category-tag">' . esc_html($category->name) . '</a>';
        }
        echo '</div>';
    }
}

function anime_blog_post_tags() {
    $tags = get_the_tags();
    if ($tags) {
        echo '<div class="post-tags">';
        foreach ($tags as $tag) {
            echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag-link">#' . esc_html($tag->name) . '</a>';
        }
        echo '</div>';
    }
}

function anime_blog_table_of_contents($content) {
    if (is_single()) {
        $toc = '';
        preg_match_all('/<h([2-4])(.*?)>(.*?)<\/h\1>/', $content, $matches, PREG_SET_ORDER);

        if (count($matches) >= 3) {
            $toc .= '<div class="table-of-contents">';
            $toc .= '<h4 class="toc-title"><i class="fas fa-list"></i> 目录</h4>';
            $toc .= '<ul class="toc-list">';

            foreach ($matches as $match) {
                $level = $match[1];
                $title = strip_tags($match[3]);
                $id = sanitize_title($title);

                $content = str_replace($match[0], '<h' . $level . ' id="' . $id . '"' . $match[2] . '>' . $match[3] . '</h' . $level . '>', $content);

                $toc .= '<li class="toc-item toc-level-' . $level . '">';
                $toc .= '<a href="#' . $id . '">' . $title . '</a>';
                $toc .= '</li>';
            }

            $toc .= '</ul></div>';
            $content = $toc . $content;
        }
    }
    return $content;
}
add_filter('the_content', 'anime_blog_table_of_contents');

function anime_blog_custom_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class('comment-item'); ?> id="comment-<?php comment_ID(); ?>">
        <article class="comment-body">
            <div class="comment-avatar">
                <?php echo get_avatar($comment, 50); ?>
            </div>
            <div class="comment-content">
                <div class="comment-meta">
                    <span class="comment-author"><?php comment_author_link(); ?></span>
                    <span class="comment-date"><?php comment_date(); ?></span>
                </div>
                <div class="comment-text">
                    <?php comment_text(); ?>
                </div>
                <div class="comment-reply">
                    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                </div>
            </div>
        </article>
    <?php
}

function anime_blog_search_filter($query) {
    if ($query->is_search && !is_admin()) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts', 'anime_blog_search_filter');

function anime_blog_primary_menu_fallback() {
    $about_page = get_page_by_path('about');
    $board_page = get_page_by_path('message-board');
    ?>
    <ul id="primary-menu" class="menu">
        <li><a href="<?php echo esc_url(home_url('/')); ?>">首页</a></li>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">归档</a></li>
        <?php if ($board_page instanceof WP_Post) : ?>
            <li><a href="<?php echo esc_url(get_permalink($board_page->ID)); ?>">留言板</a></li>
        <?php endif; ?>
        <?php if ($about_page instanceof WP_Post) : ?>
            <li><a href="<?php echo esc_url(get_permalink($about_page->ID)); ?>">关于</a></li>
        <?php endif; ?>
    </ul>
    <?php
}

function anime_blog_footer_menu_fallback() {
    echo '<ul class="menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">首页</a></li>';
    echo '<li><a href="' . esc_url(home_url('/?s=')) . '">搜索</a></li>';
    echo '<li><a href="' . esc_url(home_url('/wp-admin/')) . '">后台</a></li>';
    echo '</ul>';
}

function anime_blog_ajax_search() {
    check_ajax_referer('anime_blog_nonce', 'nonce');

    $search_term = sanitize_text_field($_POST['search_term']);

    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        's'              => $search_term,
        'posts_per_page' => 10,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<ul class="search-results-list">';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<li class="search-result-item">';
            echo '<a href="' . get_permalink() . '">';
            echo '<span class="result-title">' . get_the_title() . '</span>';
            echo '<span class="result-date">' . get_the_date() . '</span>';
            echo '</a>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p class="no-results">没有找到相关文章</p>';
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_anime_blog_search', 'anime_blog_ajax_search');
add_action('wp_ajax_nopriv_anime_blog_search', 'anime_blog_ajax_search');

function anime_blog_post_views($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

function anime_blog_track_post_views() {
    if (!is_single()) return;
    global $post;
    anime_blog_post_views($post->ID);
}
add_action('wp_head', 'anime_blog_track_post_views');
