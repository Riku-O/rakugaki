<?php
$s = get_search_query();
if ( empty($s) ) { ?>
<div class="container">
  <main class="main">
    <section class="articles">
      <h1 class="articles__ttl">「<?php echo $s; ?>」の検索結果</h1>

      <div class="article e404">
        <p class="e404__desc">
          いつも当サイトをご利用いただきありがとうございます。</p>
        <p class="e404__desc">
          大変申し訳ございませんが、お探しの条件に一致するページは<br>
          見つかりませんでした。
        </p>
        <p class="e404__desc">
          条件を変えて再度検索いただくか、改めてホームよりコンテンツをお探しください。
        </p>
        <div class="e404__links">
          <a class="e404__btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">ホームへ戻る</a>
        </div>
      </div>

      <?php } else {?>
      <div class="container">
        <main class="main">
          <section class="articles">
            <h1 class="articles__ttl">「<?php echo $s; ?>」の検索結果</h1>
            <?php
                    $args = array( 
                      'post_type' => 'post',
                      'posts_per_page' => 15,
                      's' => $s
                    );
                    $the_query = new WP_Query($args); if($the_query->have_posts()):
            ?>
            <?php while ($the_query->have_posts()): $the_query->the_post(); ?>

            <article class="article">
              <a href="<?php the_permalink(); ?>" class="article__link">
                <h2 class="article__ttl"><?php the_title(); ?></h2>
                <div class="article__img"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>">
                </div>
              </a>
            </article>

            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <?php get_template_part('parts/pagination'); ?>
            <?php else: ?>
            <div class="article e404">
              <p class="e404__desc">
                いつも当サイトをご利用いただきありがとうございます。</p>
              <p class="e404__desc">
                お探しの条件に一致するページは見つかりませんでした。
              </p>
              <p class="e404__desc">
                条件を変えて再度検索いただくか、改めてホームよりコンテンツをお探しください。
              </p>
            </div>

            <div class="e404__links">
              <a class="e404__btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">ホームへ戻る</a>
            </div>

            <?php endif; ?>
            <?php } ?>
            <!-- /.articles --></section>  
        </main>
      </div>