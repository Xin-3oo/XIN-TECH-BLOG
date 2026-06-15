<?php
/*
Template Name: Message Board
*/
get_header();
?>

<main class="site-main message-board-page">
    <div class="board-container">
        <div class="board-header">
            <h2>留言板</h2>
            <a class="add-note-btn" href="<?php echo esc_url(home_url('/wp-comments-post.php')); ?>" onclick="return false;">
                <i class="fas fa-plus"></i> 留言互动
            </a>
        </div>

        <div class="blackboard" id="blackboard">
            <?php
            $latest_comments = get_comments(array(
                'status' => 'approve',
                'number' => 5,
            ));

            if (!empty($latest_comments)) :
                $note_styles = array(
                    'left: 50px; top: 30px; transform: rotate(-3deg);',
                    'left: 220px; top: 70px; transform: rotate(2deg);',
                    'left: 400px; top: 40px; transform: rotate(-1deg);',
                    'left: 120px; top: 210px; transform: rotate(4deg);',
                    'left: 320px; top: 230px; transform: rotate(-2deg);',
                );

                foreach ($latest_comments as $index => $comment) :
                    $style = $note_styles[$index % count($note_styles)];
                    ?>
                    <div class="sticky-note" data-id="<?php echo (int) $comment->comment_ID; ?>" style="<?php echo esc_attr($style); ?>">
                        <div class="note-header">
                            <span class="note-author"><?php echo esc_html($comment->comment_author); ?></span>
                            <span class="note-time"><?php echo esc_html(get_comment_date('Y-m-d', $comment)); ?></span>
                        </div>
                        <div class="note-content">
                            <p><?php echo esc_html(wp_trim_words($comment->comment_content, 18, '...')); ?></p>
                        </div>
                    </div>
                    <?php
                endforeach;
            else :
                ?>
                <div class="sticky-note" style="left: 80px; top: 60px; transform: rotate(-2deg);">
                    <div class="note-header">
                        <span class="note-author">站长</span>
                        <span class="note-time"><?php echo esc_html(current_time('Y-m-d')); ?></span>
                    </div>
                    <div class="note-content">
                        <p>欢迎来到留言板，去文章页评论后会自动显示在这里。</p>
                    </div>
                </div>
                <?php
            endif;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
