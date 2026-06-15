<?php get_header(); ?>

<main class="site-main search-page">
    <div class="container">
        <header class="search-header">
            <div class="search-icon"><i class="fas fa-search"></i></div>
            <h1 class="search-title">
                搜索结果: <?php echo get_search_query(); ?>
            </h1>
            <p class="search-count">
                找到 <?php global $wp_query; echo $wp_query->found_posts; ?> 篇相关文章
            </p>
        </header>

        <div class="search-form-large">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" class="search-field" placeholder="输入关键词搜索..." value="<?php echo get_search_query(); ?>" name="s">
                <button type="submit" class="search-submit">
                    <i class="fas fa-search"></i> 搜索
                </button>
            </form>
        </div>

        <?php if (have_posts()) : ?>
            <div class="search-results-wrapper">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
                        <div class="result-content">
                            <header class="result-header">
                                <?php anime_blog_post_categories(); ?>
                                <h2 class="result-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                            </header>

                            <div class="result-meta">
                                <span class="result-date">
                                    <i class="far fa-calendar-alt"></i>
                                    <?php echo get_the_date(); ?>
                                </span>
                                <span class="result-type">
                                    <i class="far fa-file-alt"></i>
                                    <?php echo get_post_type_object(get_post_type())->labels->singular_name; ?>
                                </span>
                            </div>

                            <div class="result-excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="result-link">
                                查看全文 <i class="fas fa-arrow-right"></i>
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
            <div class="no-results">
                <div class="no-results-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h2>没有找到相关文章</h2>
                <p>尝试使用其他关键词进行搜索，或者浏览我们的文章分类。</p>
                <div class="suggestions">
                    <h4>热门标签</h4>
                    <div class="tag-cloud">
                        <?php wp_tag_cloud(array('number' => 10, 'orderby' => 'count', 'order' => 'DESC')); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
