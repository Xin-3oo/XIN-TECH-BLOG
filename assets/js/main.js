(function($) {
    'use strict';

    var AnimeBlog = {
        init: function() {
            this.readingProgress();
            this.backToTop();
            this.sakuraPetals();
            this.searchToggle();
            this.ajaxSearch();
            this.mobileMenu();
            this.smoothScroll();
            this.codeHighlight();
        },

        readingProgress: function() {
            var progressBar = $('#readingProgress');
            if (progressBar.length === 0) return;

            $(window).on('scroll', function() {
                var scrollTop = $(window).scrollTop();
                var docHeight = $(document).height() - $(window).height();
                var progress = (scrollTop / docHeight) * 100;
                progressBar.css('width', progress + '%');
            });
        },

        backToTop: function() {
            var backToTop = $('#backToTop');
            if (backToTop.length === 0) return;

            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 300) {
                    backToTop.addClass('visible');
                } else {
                    backToTop.removeClass('visible');
                }
            });

            backToTop.on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({ scrollTop: 0 }, 600);
            });
        },

        sakuraPetals: function() {
            var container = $('#sakuraPetals');
            if (container.length === 0) return;

            function createSakura() {
                var sakura = $('<div class="sakura"></div>');
                var startX = Math.random() * $(window).width();
                var duration = 5 + Math.random() * 5;
                var size = 8 + Math.random() * 8;

                sakura.css({
                    left: startX,
                    width: size,
                    height: size,
                    animationDuration: duration + 's'
                });

                container.append(sakura);

                setTimeout(function() {
                    sakura.remove();
                }, duration * 1000);
            }

            setInterval(createSakura, 500);
        },

        searchToggle: function() {
            var toggle = $('#searchToggle');
            var wrapper = $('#searchFormWrapper');
            var field = $('#searchField');

            toggle.on('click', function(e) {
                e.preventDefault();
                wrapper.toggleClass('active');
                if (wrapper.hasClass('active')) {
                    field.focus();
                }
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.header-search').length) {
                    wrapper.removeClass('active');
                }
            });
        },

        ajaxSearch: function() {
            var searchField = $('#searchField');
            var resultsContainer = $('#searchResults');
            var searchTimer;

            searchField.on('input', function() {
                var searchTerm = $(this).val().trim();

                clearTimeout(searchTimer);

                if (searchTerm.length < 2) {
                    resultsContainer.empty();
                    return;
                }

                searchTimer = setTimeout(function() {
                    $.ajax({
                        url: animeBlog.ajaxUrl,
                        type: 'POST',
                        data: {
                            action: 'anime_blog_search',
                            search_term: searchTerm,
                            nonce: animeBlog.nonce
                        },
                        beforeSend: function() {
                            resultsContainer.html('<p class="loading">搜索中...</p>');
                        },
                        success: function(response) {
                            resultsContainer.html(response);
                        },
                        error: function() {
                            resultsContainer.html('<p class="error">搜索出错，请重试</p>');
                        }
                    });
                }, 300);
            });
        },

        mobileMenu: function() {
            var toggle = $('.menu-toggle');
            var menu = $('#primary-menu');

            toggle.on('click', function() {
                $(this).toggleClass('active');
                menu.toggleClass('active');
            });
        },

        smoothScroll: function() {
            $('a[href*="#"]:not([href="#"])').on('click', function(e) {
                var target = $(this.hash);
                if (target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 600);
                }
            });
        },

        codeHighlight: function() {
            $('pre code').each(function() {
                var code = $(this);
                var text = code.text();

                var highlighted = text
                    .replace(/(&lt;\/?[a-z][\s\S]*?&gt;)/gi, '<span class="tag">$1</span>')
                    .replace(/("(?:[^"\\]|\\.)*"|'(?:[^'\\]|\\.)*')/g, '<span class="string">$1</span>')
                    .replace(/\b(function|var|let|const|if|else|for|while|return|class|import|export|from|async|await)\b/g, '<span class="keyword">$1</span>')
                    .replace(/\b(\d+)\b/g, '<span class="number">$1</span>')
                    .replace(/(\/\/.*$|\/\*[\s\S]*?\*\/)/gm, '<span class="comment">$1</span>');

                code.html(highlighted);
            });
        }
    };

    $(document).ready(function() {
        AnimeBlog.init();
    });

})(jQuery);
