<section class="articles articles-side"> 

  <h2 class="archives__ttl">
    <div class="archives__side">新着記事</div>
  </h2>
  
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>news/" class="archives__more">もっと見る</a>

  <div class="swiper-container swiper-new">
    <div class="swiper-wrapper">

      <?php
      $args = array( 
        'posts_per_page' => 5
      );
      $the_query = new WP_Query($args); if($the_query->have_posts()):
      ?>

      <?php while ($the_query->have_posts()): $the_query->the_post(); ?>

      <article class="article-rows swiper-slide">
        <a href="<?php the_permalink(); ?>" class="article-rows__link">
          <h3 class="article-rows__ttl"><?php the_title(); ?></h3>
          <div class="article-rows__img"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>">
            <?php if ( is_newest_post($post, 3) ) { ?>
            <span class="article__rank article__rank"><span class="article__rank-txt article__rank-txt">New</span></span>
            <?php } ?>
          </div>
        </a>
      </article>

      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
      <?php endif; ?>

      <!-- /.swiper-wrapper --></div>
    <!-- /.swiper-container --></div>
  <!-- /.articles --></section>