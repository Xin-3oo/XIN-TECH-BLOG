<?php get_header(); ?>

<main class="site-main archive-page">
    <div class="container">
        <header class="archive-header">
            <?php
            if (is_category()) :
                ?>
                <div class="archive-icon"><i class="fas fa-folder"></i></div>
                <h1 class="archive-title">分类: <?php single_cat_title(); ?></h1>
                <?php if (category_description()) : ?>
                    <div class="archive-description"><?php echo category_description(); ?></div>
                <?php endif; ?>
                <?php
            elseif (is_tag()) :
                ?>
                <div class="archive-icon"><i class="fas fa-tag"></i></div>
                <h1 class="archive-title">标签: <?php single_tag_title(); ?></h1>
                <?php if (tag_description()) : ?>
                    <div class="archive-description"><?php echo tag_description(); ?></div>
                <?php endif; ?>
                <?php
            elseif (is_author()) :
                ?>
                <div class="archive-icon"><i class="fas fa-user"></i></div>
                <h1 class="archive-title">作者: <?php the_author(); ?></h1>
                <?php if (get_the_author_meta('description')) : ?>
                    <div class="archive-description"><?php the_author_meta('description'); ?></div>
                <?php endif; ?>
                <?php
            elseif (is_date()) :
                ?>
                <div class="archive-icon"><i class="fas fa-calendar"></i></div>
                <h1 class="archive-title">
                    <?php
                    if (is_day()) :
                        printf(__('日期: %s', 'anime-blog'), get_the_date());
                    elseif (is_month()) :
                        printf(__('月份: %s', 'anime-blog'), get_the_date(_x('F Y', 'monthly archives date format', 'anime-blog')));
                    elseif (is_year()) :
                        printf(__('年份: %s', 'anime-blog'), get_the_date(_x('Y', 'yearly archives date format', 'anime-blog')));
                    endif;
                    ?>
                </h1>
                <?php
            else :
                ?>
                <h1 class="archive-title">文章归档</h1>
                <?php
            endif;
            ?>
        </header>

        <div class="archive-filter">
            <form class="filter-form" method="get">
                <select name="orderby" class="filter-select">
                    <option value="date" <?php selected(get_query_var('orderby'), 'date'); ?>>按时间排序</option>
                    <option value="title" <?php selected(get_query_var('orderby'), 'title'); ?>>按标题排序</option>
                    <option value="comment_count" <?php selected(get_query_var('orderby'), 'comment_count'); ?>>按评论数排序</option>
                </select>
                <select name="order" class="filter-select">
                    <option value="DESC" <?php selected(get_query_var('order'), 'DESC'); ?>>降序</option>
                    <option value="ASC" <?php selected(get_query_var('order'), 'ASC'); ?>>升序</option>
                </select>
                <button type="submit" class="filter-btn">筛选</button>
            </form>
        </div>

        <?php if (have_posts()) : ?>
            <div class="posts-wrapper">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="post-content">
                            <header class="post-header">
                                <?php anime_blog_post_categories(); ?>
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                            </header>

                            <div class="post-meta">
                                <span class="post-date">
                                    <i class="far fa-calendar-alt"></i>
                                    <?php echo get_the_date(); ?>
                                </span>
                                <span class="post-author">
                                    <i class="far fa-user"></i>
                                    <?php the_author(); ?>
                                </span>
                                <span class="post-reading-time">
                                    <i class="far fa-clock"></i>
                                    <?php echo anime_blog_reading_time(get_the_content()); ?> 分钟阅读
                                </span>
                            </div>

                            <div class="post-excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="read-more">
                                阅读全文 <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <nav class="pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '<i class="fas fa-chevron-left"></i>',
                    'next_text' => '<i class="fas fa-chevron-right"></i>',
                ));
                ?>
            </nav>

        <?php else : ?>
            <div class="no-posts">
                <div class="no-posts-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <h2>暂无文章</h2>
                <p>该分类下还没有发布任何文章。</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
