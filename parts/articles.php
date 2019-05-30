<section class="articles">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <article class="article">
    <a href="<?php the_permalink(); ?>" class="article__link">
      <h2 class="article__ttl"><?php the_title(); ?></h2>
      <div class="article__img"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>">
        <?php if ( is_newest_post($post, 3) ) { ?>
        <span class="article__rank"><span class="article__rank-txt">New</span></span>
        <?php } ?>
      </div>
    </a>
  </article>

  <?php endwhile; ?>
  <?php get_template_part('parts/pagination'); ?>
  <?php endif; ?>
<!-- /.articles --></section>