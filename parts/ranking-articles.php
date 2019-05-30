<section class="articles articles-side"> 

  <h2 class="archives__ttl">
    <div class="archives__side">月間ランキング</div>
  </h2>
  
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>ranking/" class="archives__more">もっと見る</a>

  <div class="swiper-container swiper-normal">
    <div class="swiper-wrapper">

      <?php
      $paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
      $args = array(
        'post_status' => 'publish',
        'posts_per_page' => 5,
        'paged' => $paged,
        'orderby' => array( 'ranking' => 'ASC', 'views' => 'DESC' ),
        'meta_query' => array(
          'relation' => 'AND',
          'ranking'=>array(
            'key'     => 'ranking',
            'type'    => 'numeric',
          ),
          'views'=>array(
            'key'     => 'views',
            'type'    => 'numeric',
          ),
        ),
      );
      $the_query = new WP_Query($args); if($the_query->have_posts()):
      ?>

      <?php while ($the_query->have_posts()): $the_query->the_post(); ?>

      <article class="article-rows swiper-slide">
        <a href="<?php the_permalink(); ?>" class="article-rows__link">
          <h3 class="article-rows__ttl"><?php the_title(); ?></h3>
          <div class="article-rows__img"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>"></div>
        </a>
      </article>

      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
      <?php endif; ?>

      <!-- /.swiper-wrapper --></div>
    <!-- /.swiper-container --></div>
  <!-- /.articles --></section>