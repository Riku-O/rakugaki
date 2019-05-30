
        <footer class="footer">
            <div class="footer__inner">
               <div class="footer__wrap">
                 <p class="footer__name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__link"><?php echo getOptionValue('cp'); ?></a></p>
                    <?php //ヘッダーナビ
                    wp_nav_menu(
                      array (
                      'theme_location' => 'footer_menu',
                      'menu_class' => 'footer__list',
                      'container' => false,
                      'fallback_cb' => false
                      )
                    ); ?>
                  <small class="footer__copy">&copy; <?php echo date("Y"); ?> <?php echo getOptionValue('cp'); ?></small>
                </div>
            
            </div>
        </footer>
       
        <?php wp_footer(); ?>
        
        <?php if ( is_author() || is_category() || is_tag() || is_post_type_archive() || is_url('&term=') ) : ?>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/load-swipe.js"></script>
        <?php elseif ( is_single() || is_singular('column') ) : ?>
          <script src="<?php echo get_template_directory_uri(); ?>/assets/js/load-swipe.js"></script>
          <script src="<?php echo get_template_directory_uri(); ?>/assets/js/load-single.js"></script>
        <?php elseif ( is_page('columns') ) : ?>
          <script src="<?php echo get_template_directory_uri(); ?>/assets/js/load-swipe.js"></script>
          <script src="<?php echo get_template_directory_uri(); ?>/assets/js/load-columns.js"></script>
          <?php elseif ( is_page('privacy') || is_page('about') ): ?>
        <script>
          var appSwiper = new Swiper ('.apps-row', {
            loop: false,
            slidesPerView: 5.4,
            spaceBetween: 10
          })
        </script>
        <?php elseif ( is_page('contact') ): ?>
        <script>
          var appSwiper = new Swiper ('.apps-row--contact', {
            loop: false,
            slidesPerView: 5.4,
            spaceBetween: 10
          })
        </script>
        <?php elseif ( is_front_page() ) : ?>
        <script>
          var appSwiper = new Swiper ('.apps-row', {
            loop: false,
            slidesPerView: 5.4,
            spaceBetween: 10
          })
          var newSwiper = new Swiper ('.swiper-new', {
            loop: false,
            slidesPerView: 1.5,
            spaceBetween: 21
          })
          var authorSwiper = new Swiper ('.swiper-writer', {
            loop: false,
            slidesPerView: 2.4,
            spaceBetween: 5
          })
          var colSwiper = new Swiper ('.front__column', {
            loop: false,
            slidesPerView: 1,
            spaceBetween: 5,
            speed: 900,
            autoplay: {
              delay: 4000,
            },
            pagination: {
              el: '.swiper-pagination',
              type: 'bullets',
            },
          })
          var fvSwiper = new Swiper ('.swiper-fv', {
            loop: false,
            slidesPerView: 1,
            speed: 900,
            autoplay: {
              delay: 4000,
            },
            loop: true,
            pagination: {
              el: '.swiper-pagination',
              type: 'bullets',
            },
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
            },
          })
        </script>
        <?php endif; ?>
        <script>
          var authorSwiper = new Swiper ('.swiper-writer', {
            loop: false,
            slidesPerView: 2.4,
            spaceBetween: 5
          })
        </script>
    </body>
</html>