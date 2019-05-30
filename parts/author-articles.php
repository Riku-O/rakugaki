<section class="articles articles-side"> 

  <h2 class="archives__ttl">
    <div class="archives__side">執筆記事</div>
  </h2>

  <?php

  $args = array( 
    'author' => $id,
    'posts_per_page' => 3
  );
  $the_query = new WP_Query($args); if($the_query->have_posts()):
  ?>

  <?php while ($the_query->have_posts()): $the_query->the_post(); ?>

<?php echo $id; ?>
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