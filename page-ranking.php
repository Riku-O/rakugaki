<?php get_header(); ?>

<div class="container">
  <main class="main">
    <h1 class="archives__ttl">
      <span class="archives__sub">カテゴリー</span>
      <div class="archives__main"><?php the_title(); ?></div>
    </h1>
    
    <section class="articles">

      <?php
      $paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
      $args = array(
        'post_status' => 'publish',
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
      $cnt = 1;
      ?>

      <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
      
      <?php 
      $str_flag = strlen($cnt);
      if ( $str_flag == 1) {
        $str_cnt = mb_convert_kana($cnt, N);
      } else {
        $str_cnt = $cnt;
      }
      ?>
      
      <article class="article">
        <a href="<?php the_permalink(); ?>" class="article__link">
          <h2 class="article__ttl"><?php the_title(); ?></h2>
          <div class="article__img"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>">
            <?php if ( $cnt <= 10 ) { ?>
            <span class="article__rank"><span class="article__rank-txt--ranking"><?php echo $str_cnt; ?>位</span></span>
            <?php } ?>
          </div>
        </a>
      </article>
      <?php 
        if ( $cnt <= 10 ) {
          $cnt++;
        }
      ?>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
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

  <aside class="sidebar">
    <?php get_template_part('parts/related-articles'); ?>
    <?php get_template_part('parts/app-articles'); ?>
    <!-- /.sidebar --></aside>
  <!-- /.container --></div>

<?php get_footer();
