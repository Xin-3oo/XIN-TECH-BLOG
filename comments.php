<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ('1' === $comments_number) {
                printf('一条评论');
            } else {
                printf('%d 条评论', $comments_number);
            }
            ?>
        </h3>

        <ul class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ul',
                'short_ping'  => true,
                'callback'    => 'anime_blog_custom_comment',
            ));
            ?>
        </ul>

        <?php the_comments_navigation(); ?>

    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply'       => '发表评论',
        'class_form'        => 'comment-form',
        'class_submit'      => 'submit-comment',
        'submit_button'     => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">发表评论</button>',
    ));
    ?>
</div>