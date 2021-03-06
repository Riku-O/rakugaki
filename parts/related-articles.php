<section class="articles articles-side"> 

  <h2 class="archives__ttl">
    <div class="archives__side">あなたにオススメの記事</div>
  </h2>

  <?php if ( is_singular('column') ): ?>
  <?php 
  $tarms =  get_the_terms( $post ->ID, 'column_cat' );
  $term = $tarms[0]->slug;
  $args = array(
    'post__not_in' => array($post -> ID),
    'post_type' => 'column',
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'tax_query' => array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'column_cat',
        'field' => 'slug',
        'terms' => $term,
        'include_children' => true,
        'operator' => 'IN'
      ),
    )
  );
  ?>
  <?php else : ?>
  <?php
  $categories = get_the_category($post->ID);
  $category_ID = array();
  foreach($categories as $category):
  array_push( $category_ID, $category -> cat_ID);
  endforeach ;  

  // 現在の記事と同一カテゴリから3記事ランダムに出力
  $args = array( 
    'post__not_in' => array($post -> ID),
    'posts_per_page' => 3,
    'category__in' => $category_ID,
    'orderby' => 'rand', 
  );?>
  <?php endif; ?>    
  <?php 
 $the_query = new WP_Query($args); if($the_query->have_posts()):
 ?>
 
 <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
   
  <article class="article">
    <a href="<?php the_permalink(); ?>" class="article__link">
      <h3 class="article__ttl"><?php the_title(); ?></h3>
      <div class="article__img"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>"></div>
    </a>
  </article>
 
 <?php endwhile; ?>
 <?php wp_reset_postdata(); ?>
 <?php endif; ?>
<!-- /.articles --></section>