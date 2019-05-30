<?php 
$url = $_SERVER['REQUEST_URI'];
$url = urldecode($url);
preg_match('/term=([^&]+)/', $url, $match);
$term = $match[1];
?>
 
<?php 
  $cover_post = get_page_by_title($term, OBJECT, 'column_cover');
  $img = $cover_post->column_img2;
  $img_url = wp_get_attachment_url($img);
?>
 
<div class="column__head">
  <img src="<?php echo $img_url; ?>" alt="<?php echo $term; ?>">
</div>

 <div class="container">
   <div class="column__desc">
     <?php echo $cover_post->column_desc; ?>
   </div>
  <main class="main">
    <section class="articles">
      <h2 class="articles__ttl">執筆記事</h2>
      <?php
      $paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
      $args = array(
        'post_type' => 'column',
        'post_status' => 'publish',
        'paged' => $paged,
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
      $the_query = new WP_Query($args); if($the_query->have_posts()):
      $post_no = $the_query->post_count;
      $cnt = $post_no;
      ?>

      <?php while ($the_query->have_posts()): $the_query->the_post(); ?>

      <article class="article">
        <a href="<?php the_permalink(); ?>" class="article__link">
          <h2 class="article__ttl"><?php the_title(); ?></h2>
          <div class="article__img"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>">
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
      <!-- /.articles --></section>  
  </main>
   <aside class="sidebar">
     <?php get_template_part('parts/related-articles'); ?>
     <?php get_template_part('parts/ranking-articles'); ?>
     <?php get_template_part('parts/new-articles'); ?>
     <?php get_template_part('parts/app-articles'); ?>
  <!-- /.sidebar --></aside>
<!-- /.container --></div>