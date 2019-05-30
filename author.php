<?php get_header(); ?>

<div class="container">
  <main class="main">
    <h1 class="archives__ttl">
      <span class="archives__sub">カテゴリー</span>
      <div class="archives__main">監修&amp;ライター</div>
    </h1>
    
    <?php 
    $user = get_userdata($author);
    $userID = $user->user_login;
    $name = $user->writer_name;
    $subname = $user->writer_subname;
    $position = $user->writer_position;
    $product = $user->writer_product;
    $img = $user->writer_img;
    $desc = $user->writer_desc;
    $tw = $user->writer_tw;
    $fb = $user->writer_fb;
    $link = get_author_posts_url($id);
    ?>
    <section class="author-prof">
      <img src="<?php echo wp_get_attachment_url($img); ?>" alt="<?php echo $name; ?>">
      <div class="author-prof__meta">
        <div class="author-prof__meta-name">
          <h2 class="author-prof__name"><?php echo $name; ?></h2>
          <p class="author-prof__position"><?php echo $position; ?></p>
        </div>
        <p class="author-prof__subname"><?php echo $subname; ?></p>
      </div>
      <div class="author-prof__desc">
        <?php echo $desc; ?>
      </div>
      <ul class="author-prof__sns">
        <li class="author-prof__sns-item"><a href="https://twitter.com/<?php echo $tw; ?>" class="author-prof__tw" target="_blank">@<?php echo $tw; ?></a></li>
        <li class="author-prof__sns-item"><a href="https://ja-jp.facebook.com/<?php echo $fb; ?>" class="author-prof__fb" target="_blank"><?php echo $fb; ?></a></li>
      </ul>
    <!-- /.author-prof --></section>
    
    <section class="articles articles-side"> 

      <h2 class="archives__ttl">
        <div class="archives__side">執筆記事</div>
      </h2>

      <?php

      $args = array( 
        'author' => $user->ID,
        'posts_per_page' => 3
      );
      $the_query = new WP_Query($args); if($the_query->have_posts()):
      $cnt = 1;
      ?>

      <?php while ($the_query->have_posts()): $the_query->the_post(); ?>

      <article class="article">
        <a href="<?php the_permalink(); ?>" class="article__link">
          <h3 class="article__ttl"><?php the_title(); ?></h3>
          <div class="article__img"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>">
          </div>
        </a>
      </article>
      <?php 
      if ( $cnt <= 3 ) {
        $cnt++;
      }
      ?>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
      <a class="author-prof__more" href="<?php echo esc_url( home_url( '/' ) ); ?>?s=&author=<?php echo $userID; ?>"><?php echo $name; ?>の執筆記事一覧</a>
      <?php else: ?>
      <p>まだ記事はありません。</p>
      <?php endif; ?>
      
      <!-- /.articles --></section>
    
    <!-- /.main --></main>

  <aside class="sidebar">
    <?php get_template_part('parts/related-articles'); ?>
    <?php get_template_part('parts/ranking-articles'); ?>
    <?php get_template_part('parts/new-articles'); ?>
    <?php get_template_part('parts/app-articles'); ?>
    <!-- /.sidebar --></aside>
  <!-- /.container --></div>

<?php get_footer();
