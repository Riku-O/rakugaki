<?php get_header(); ?>

<?php 
$url = $_SERVER['REQUEST_URI'];
preg_match('/author=([^&]+)/', $url, $match);
$user_name = $match[1];
$user = get_user_by( 'login', $user_name );

$id = $user->ID;
$name = $user->writer_name;
$subname = $user->writer_subname;
$position = $user->writer_position;
$product = $user->writer_product;
$desc = $user->writer_desc;
$img = $user->writer_img2;
$tw = $user->writer_tw;
$fb = $user->writer_fb;
?>

<div class="search-author__head">
  <div class="search-author__img"><img src="<?php echo wp_get_attachment_url($img); ?>" alt="<?php echo $name; ?>"></div>
  <div class="search-author__meta">
     <h1 class="search-author__name"><?php echo $name; ?></h1>
     <p class="search-author__position"><?php echo $position; ?></p>
     <div class="search-author__desc"><?php echo $desc; ?></div>
     <ul class="search-author__sns">
       <li class="search-author__sns-item"><a href="https://twitter.com/<?php echo $tw; ?>" class="search-author__tw" target="_blank"><span class="se-none">@<?php echo $tw; ?></span></a></li>
       <li class="search-author__sns-item"><a href="https://ja-jp.facebook.com/<?php echo $fb; ?>" class="search-author__fb" target="_blank"><span class="se-none"><?php echo $fb; ?></span></a></li>
     </ul> 
  </div>
</div>


<div class="container">
  <main class="main">

    <section class="articles">
      <h2 class="articles__ttl">執筆記事</h2>
      <?php
      $paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
      $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'author' => $id,
        'paged' => $paged,
      );
      $the_query = new WP_Query($args); if($the_query->have_posts()):
      ?>

      <?php while ($the_query->have_posts()): $the_query->the_post(); ?>

      <article class="article">
        <a href="<?php the_permalink(); ?>" class="article__link">
          <h2 class="article__ttl"><?php the_title(); ?></h2>
          <div class="article__img"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>"></div>
        </a>
      </article>
      <?php 
      ?>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
      <?php else : ?>
      <p>まだ記事がありません。</p>
      <?php endif; ?>

      <div class="pagination">
        <?php
        // WP_query用のpagination
        $big = 999999999; // need an unlikely integer

        echo paginate_links( array(
          'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format' => '?paged=%#%',
          'current' => max( 1, get_query_var('paged') ),
          'total' => $the_query->max_num_pages,
          'prev_text' => '前のページへ',
          'next_text' => '次のページへ',
        ) );
        ?>
        <!-- /.pagination --></div>

      <!-- /.articles --></section>

    <!-- /.main --></main>

  <!-- /.container --></div>

<?php get_footer();
