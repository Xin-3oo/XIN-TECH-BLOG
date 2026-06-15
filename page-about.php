<?php
/*
Template Name: About Page
*/
get_header();
?>

<main class="site-main about-page">
    <div class="container">
        <div class="about-card">
            <div class="about-avatar">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/picture/avator.png'); ?>" alt="头像">
            </div>
            <h1 class="about-name"><?php echo esc_html(get_bloginfo('name')); ?></h1>
            <p class="about-bio"><?php echo esc_html(get_bloginfo('description')); ?></p>

            <div class="about-stats">
                <div class="stat-item">
                    <span class="stat-number"><?php echo (int) wp_count_posts('post')->publish; ?></span>
                    <span class="stat-label">文章</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><?php echo (int) wp_count_comments()->approved; ?></span>
                    <span class="stat-label">评论</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><?php echo (int) wp_count_terms(array('taxonomy' => 'category', 'hide_empty' => true)); ?></span>
                    <span class="stat-label">分类</span>
                </div>
            </div>

            <div class="about-social">
                <a href="#" class="social-link" title="GitHub"><i class="fab fa-github"></i></a>
                <a href="#" class="social-link" title="Bilibili"><span class="bilibili-icon">B</span></a>
                <a href="#" class="social-link" title="抖音"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>

        <div class="about-content card-content">
            <?php
            while (have_posts()) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
