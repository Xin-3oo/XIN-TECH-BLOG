<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/live2d/css/live2d.css" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="reading-progress" id="readingProgress"></div>

<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <div class="header-search" id="searchToggle">
                <i class="fas fa-search"></i>
            </div>
            
            <nav class="main-navigation main-navigation-centered" id="primary-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </button>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => 'anime_blog_primary_menu_fallback',
                ));
                ?>
            </nav>

            <div class="header-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title">
                    <i class="fas fa-star site-logo-icon"></i>
                    <?php bloginfo('name'); ?>
                </a>
            </div>
        </div>
    </div>

    <div id="searchFormWrapper" class="search-form-wrapper">
        <div class="search-container">
            <input type="text" id="searchField" placeholder="搜索文章..." />
            <button type="submit" class="search-submit">
                <i class="fas fa-search"></i>
            </button>
            <div id="searchResults" class="search-results"></div>
        </div>
    </div>
</header>

<div class="sakura-petals" id="sakuraPetals"></div>
