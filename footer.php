<footer class="site-footer">
    <div class="container">
        <div class="footer-widgets">
            <?php if (is_active_sidebar('footer-widgets')) : ?>
                <?php dynamic_sidebar('footer-widgets'); ?>
            <?php else : ?>
                <div class="footer-widget">
                    <h3>关于博客</h3>
                    <p>世界晴朗，万事可爱。</p>
                </div>
                <div class="footer-widget">
                    <h3>快速链接</h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'fallback_cb'    => 'anime_blog_footer_menu_fallback',
                    ));
                    ?>
                </div>
                <div class="footer-widget">
                    <h3>联系方式</h3>
                    <div class="social-links">
                        <a href="#" class="social-link" title="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="social-link" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" title="Bilibili">
                            <span class="bilibili-icon">B</span>
                        </a>
                        <a href="#" class="social-link" title="抖音">
                            <span class="douyin-icon">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> 随心3oo. All rights reserved.</p>
            <p>Powered by <a href="https://wordpress.org" target="_blank">WordPress</a></p>
        </div>
    </div>
</footer>

<div class="back-to-top" id="backToTop">
    <i class="fas fa-chevron-up"></i>
</div>

<!-- Live2D 看板娘 -->
<div id="landlord">
    <div class="message" style="opacity:0"></div>
    <canvas id="live2d" width="280" height="250" class="live2d"></canvas>
    <div class="hide-button">隐藏</div>
</div>

<script>
    var message_Path = '<?php echo get_template_directory_uri(); ?>/live2d/';
    var home_Path = '<?php echo home_url('/'); ?>';
</script>
<script src="<?php echo get_template_directory_uri(); ?>/live2d/js/live2d.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/live2d/js/message.js"></script>
<script type="text/javascript">
    loadlive2d("live2d", "<?php echo get_template_directory_uri(); ?>/live2d/model/tia/model.json");
</script>

<?php wp_footer(); ?>
</body>
</html>
