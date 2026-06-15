<?php get_header(); ?>

<div class="hero-cover">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title"><?php bloginfo('name'); ?></h1>
        <p class="hero-subtitle"><?php bloginfo('description'); ?></p>
    </div>
    <div class="scroll-hint">
        <i class="fas fa-chevron-down"></i>
        <span>向下滚动</span>
    </div>
    <div class="wave-container">
        <svg class="wave wave1" viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path d="M0,60 C180,100 360,20 540,60 C720,100 900,20 1080,60 C1260,100 1440,20 1440,60 L1440,120 L0,120 Z"></path>
        </svg>
        <svg class="wave wave2" viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path d="M0,40 C240,80 480,0 720,40 C960,80 1200,0 1440,40 L1440,120 L0,120 Z"></path>
        </svg>
        <svg class="wave wave3" viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path d="M0,80 C180,40 360,100 540,60 C720,20 900,80 1080,40 C1260,0 1440,60 1440,80 L1440,120 L0,120 Z"></path>
        </svg>
    </div>
</div>

<main class="site-main home-content">
    <div class="container">
        <?php
        $front_posts = new WP_Query(array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => get_option('posts_per_page'),
            'paged'          => max(1, get_query_var('paged')),
        ));
        ?>

        <?php if ($front_posts->have_posts()) : ?>
            <div class="posts-wrapper">
                <?php while ($front_posts->have_posts()) : $front_posts->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?> onclick="window.location.href='<?php the_permalink(); ?>'">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="post-content">
                            <header class="post-header">
                                <?php anime_blog_post_categories(); ?>
                                <h2 class="post-title"><?php the_title(); ?></h2>
                            </header>

                            <div class="post-meta">
                                <span class="post-date"><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                                <span class="post-author"><i class="far fa-user"></i> <?php the_author(); ?></span>
                                <span class="post-reading-time"><i class="far fa-clock"></i> <?php echo anime_blog_reading_time(get_the_content()); ?> 分钟阅读</span>
                            </div>

                            <div class="post-excerpt"><?php the_excerpt(); ?></div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <nav class="pagination">
                <?php
                echo paginate_links(array(
                    'total'     => $front_posts->max_num_pages,
                    'current'   => max(1, get_query_var('paged')),
                    'prev_text' => '<i class="fas fa-chevron-left"></i>',
                    'next_text' => '<i class="fas fa-chevron-right"></i>',
                ));
                ?>
            </nav>
        <?php else : ?>
            <div class="no-posts">
                <div class="no-posts-icon"><i class="fas fa-search"></i></div>
                <h2>暂无文章</h2>
                <p>还没有发布任何文章，请稍后再来查看。</p>
            </div>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</main>

<?php get_footer(); ?>
