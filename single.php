<?php get_header(); ?>

<main class="site-main single-post">
    <div class="container">
        <div class="content-wrapper">
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
                <?php while (have_posts()) : the_post(); ?>
                    <header class="article-header">
                        <?php anime_blog_post_categories(); ?>
                        <h1 class="article-title"><?php the_title(); ?></h1>
                        
                        <div class="article-meta">
                            <span class="meta-item author">
                                <i class="far fa-user"></i>
                                <?php the_author_posts_link(); ?>
                            </span>
                            <span class="meta-item date">
                                <i class="far fa-calendar-alt"></i>
                                <?php echo get_the_date(); ?>
                            </span>
                            <span class="meta-item reading-time">
                                <i class="far fa-clock"></i>
                                <?php echo anime_blog_reading_time(get_the_content()); ?> 分钟阅读
                            </span>
                            <span class="meta-item views">
                                <i class="far fa-eye"></i>
                                <?php echo get_post_meta(get_the_ID(), 'post_views_count', true) ?: '0'; ?> 次阅读
                            </span>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="article-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="article-content">
                        <?php the_content(); ?>
                    </div>

                    <footer class="article-footer">
                        <?php anime_blog_post_tags(); ?>

                        <div class="article-navigation">
                            <div class="nav-previous">
                                <?php previous_post_link('%link', '<i class="fas fa-chevron-left"></i> %title'); ?>
                            </div>
                            <div class="nav-next">
                                <?php next_post_link('%link', '%title <i class="fas fa-chevron-right"></i>'); ?>
                            </div>
                        </div>

                        <div class="author-box">
                            <div class="author-avatar">
                                <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                            </div>
                            <div class="author-info">
                                <h4 class="author-name"><?php the_author(); ?></h4>
                                <p class="author-description"><?php the_author_meta('description'); ?></p>
                            </div>
                        </div>

                        <div class="related-posts">
                            <h3 class="related-title">相关文章</h3>
                            <?php
                            $categories = get_the_category();
                            if ($categories) {
                                $category_ids = array();
                                foreach ($categories as $category) {
                                    $category_ids[] = $category->term_id;
                                }

                                $related_args = array(
                                    'category__in'   => $category_ids,
                                    'post__not_in'   => array(get_the_ID()),
                                    'posts_per_page' => 3,
                                    'orderby'        => 'rand',
                                );

                                $related_query = new WP_Query($related_args);

                                if ($related_query->have_posts()) :
                                    echo '<div class="related-posts-grid">';
                                    while ($related_query->have_posts()) : $related_query->the_post();
                                        ?>
                                        <div class="related-post-item">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="related-thumb">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail('medium'); ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <h4 class="related-post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h4>
                                        </div>
                                        <?php
                                    endwhile;
                                    echo '</div>';
                                    wp_reset_postdata();
                                endif;
                            }
                            ?>
                        </div>
                    </footer>

                    <?php
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>

                <?php endwhile; ?>
            </article>
        </div>

        <aside class="sidebar">
            <?php if (is_active_sidebar('sidebar-1')) : ?>
                <?php dynamic_sidebar('sidebar-1'); ?>
            <?php else : ?>
                <div class="widget">
                    <h3 class="widget-title">关于我</h3>
                    <p>欢迎来到我的博客！这里分享技术与生活。</p>
                </div>
                <div class="widget">
                    <h3 class="widget-title">最新文章</h3>
                    <ul class="recent-posts">
                        <?php
                        $recent_posts = wp_get_recent_posts(array('numberposts' => 5));
                        foreach ($recent_posts as $post) :
                            ?>
                            <li>
                                <a href="<?php echo get_permalink($post['ID']); ?>">
                                    <?php echo $post['post_title']; ?>
                                </a>
                            </li>
                            <?php
                        endforeach;
                        ?>
                    </ul>
                </div>
            <?php endif; ?>
        </aside>
    </div>
</main>

<?php get_footer(); ?>