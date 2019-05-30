<?php get_header(); ?>
   
<div class="container">
  <main class="main">
  
  <h1 class="page__ttl"><?php the_title(); ?></h1>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>  
  <?php the_content(); ?>
  <?php endwhile; ?>
  <?php endif; ?>
  <!-- /.main --></main>

<!-- /.container --></div>
<?php get_template_part('parts/app-row-articles'); ?>

<?php get_footer();