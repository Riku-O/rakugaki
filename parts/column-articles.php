 <section class="articles articles-side"> 
  <?php $ttl = get_the_title();?>
   <div class="swiper-container swiper-normal">
    <div class="swiper-wrapper">

      <?php
      $args = array(
        'post_type' => 'column',
        'post_status' => 'publish',
        'tax_query' => array(
          'relation' => 'AND',
          array(
            'taxonomy' => 'column_cat',
            'field' => 'slug',
            'terms' => $ttl,
            'include_children' => true,
            'operator' => 'IN'
          ),
        )
      );
      $the_query = new WP_Query($args); if($the_query->have_posts()):
      $post_no = $the_query->post_count;
      $cnt = $post_no;
      ?>

      <?php while ($the_query->have_posts()): $the_query->the_post(); ?>

      <article class="article-rows swiper-slide article-rows--column" data-get="<?php echo $ttl; ?>">
        <a href="<?php the_permalink(); ?>" class="article-rows__link">
          <h3 class="article-rows__ttl"><?php the_title(); ?></h3>
          <div class="article-rows__img"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>">
            <?php if ( $cnt == $post_no ) { ?>
            <span class="article__rank"><span class="article__rank-txt">New</span></span>
            <?php } else { ?>
            <span class="article__rank article__no"><span class="article__rank-txt">No.<?php echo $post_no; ?></span></span>
            <?php }; ?>
          </div>
        </a>
      </article>

      <?php $post_no--; ?>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
      <?php else: ?>
      ありません
      <?php endif; ?>
      <div class="article-rows swiper-slide">
        <div class="column__cover-more" data-set="<?php echo $ttl; ?>">
         <a href="<?php echo esc_url( home_url( '/' ) ); ?>?s=&term=<?php echo $ttl; ?>" class="column__more column__more--big">この連載を見る</a>
       </div>
      </div>
      
      <script>
        if (datas.indexOf('<?php echo $ttl; ?>') == -1){
          datas.push('<?php echo $ttl; ?>');
        }
      </script>

      <!-- /.swiper-wrapper --></div>
    <!-- /.swiper-container --></div>
  <!-- /.articles --></section>