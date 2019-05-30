<?php get_header(); ?>

  <main class="main">
    <section class="front__fv">
      <div class="swiper-container swiper-fv">
        <div class="swiper-wrapper">
          
          <?php 
          function str_clean($text, $limit) {
            if(mb_strlen($text) > $limit) { 
              $title = mb_substr($text,0,$limit);
              return $title. ･･･ ;
            } else {
              return $text;
            }
          }
          ?>

          <?php
          $args = array( 
            'posts_per_page' => 1
          );
          $the_query = new WP_Query($args); if($the_query->have_posts()):
          ?>

          <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
              
          <article class="front__fv-article swiper-slide" style="background: url(<?php echo get_thumbnail(); ?>); background-size: cover; height: 210px;">
            <a href="<?php the_permalink(); ?>" class="front__fv-article-link">
              <h2 class="front__fv-article-ttl"><?php echo str_clean(get_the_title(), 32); ?></h2>
              <?php if ( is_newest_post($post, 3) ) { ?>
              <span class="article__rank article__rank--fv"><span class="article__rank-txt article__rank-txt--fv">New</span></span>
              <?php } ?>
            </a>
          </article>

          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
          <?php endif; ?>
          
          <?php
          $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 4,
            'orderby' => array( 'favrite' => 'ASC'),
            'meta_query' => array(
              'relation' => 'AND',
              'ranking'=>array(
                'key'     => 'favorite',
                'type'    => 'numeric',
              ),
            ),
          );
          $the_query = new WP_Query($args); if($the_query->have_posts()):
          ?>

          <?php while ($the_query->have_posts()): $the_query->the_post(); ?>

          <article class="front__fv-article swiper-slide" style="background: url(<?php echo get_thumbnail(); ?>); background-size: cover; height: 210px;">
            <a href="<?php the_permalink(); ?>" class="front__fv-article-link">
              <h2 class="front__fv-article-ttl"><?php echo str_clean(get_the_title(), 32); ?></h2>
              <?php if ( is_newest_post($post, 3) ) { ?>
              <span class="article__rank article__rank--fv"><span class="article__rank-txt article__rank-txt--fv">New</span></span>
              <?php } ?>
            </a>
          </article>

          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
          <?php endif; ?>
          <!-- /.swiper-wrapper --></div>
        <!-- /.swiper-container --></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-pagination-wrap-fv">
        <div class="swiper-pagination"></div>
      </div>
    </section>
  
  <div class="container">
    <?php get_template_part('parts/new-articles'); ?>
  <!-- /.container --></div>
  
    <section class="articles articles-side articles-top-column"> 

       <div class="front__column-ttlwrap">
         <h2 class="archives__ttl">
           <div class="archives__side">月刊MA連載</div>
         </h2>
         <a href="<?php echo esc_url( home_url( '/' ) ); ?>column/" class="archives__more">もっと見る</a>
       </div>

      <div class="swiper-container swiper-col front__column">
        <div class="swiper-wrapper">

          <?php
          $args = array( 
            'post_type' => 'column'
          );
          $the_query = new WP_Query($args); if($the_query->have_posts()):
          ?>
          <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
          
          <?php 
          $tarms =  get_the_terms( $post ->ID, 'column_cat' );
          if (! is_array($tarms)) {
            $tarms = array(array('title'=>'該当するデータはありません'));
          } else {
            $column_name = $tarms[0]->name;
            $column = get_page_by_title($column_name, OBJECT, 'column_cover');
            $img = wp_get_attachment_url($column->column_img);
          }
          ?>

          <article class="front__column-article swiper-slide">
            <div class="front__column-wrap">
              <a class="front__column-cover" href="<?php echo esc_url( home_url( '/' ) ); ?>/?s=&term=<?php echo $column_name; ?>">
                <img src="<?php echo $img; ?>" alt="<?php ?>">
              </a>
              <a class="front__column-container" href="<?php the_permalink(); ?>">
                <div class="front__column-thumb"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>">        
                  <?php if ( is_newest_post($post, 3) ) { ?>
                  <span class="article__rank"><span class="article__rank-txt">New</span></span>
                  <?php } ?></div>
                <div class="front__column-subttl">
                  <h3 class="front__column-subttl-txt"><?php the_title(); ?></h3>
                  <time class="front__time" datetime="<?php echo get_the_date( 'Y-m-d' ) ?>"><?php echo get_the_date( 'Y.m.d' ); ?></time>
                </div>
              </a>
            </div>
          </article>
          
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
          <?php endif; ?> 
          
          <!-- /.swiper-wrapper --></div>
        <!-- /.swiper-container --></div>
        <div class="swiper-pagination-wrap">
          <div class="swiper-pagination"></div>
        </div>
      <!-- /.articles --></section>
    
    <div class="container">    
    <section class="articles articles-side front__writer"> 
      
      <?php
      $args = array(
        'post_status' => 'publish',
        'posts_per_page' => 1,
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
      ?>

      <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
      
      <div class="front__article">
        <div class="front__ttl-rank"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/tit_rank.png" alt="月間ランキング"></div>
        <article class="article-rows front__article-post">
          <a href="<?php the_permalink(); ?>" class="article-rows__link">
            <h3 class="article-rows__ttl"><?php the_title(); ?></h3>
            <div class="article-rows__img front__article-img"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>">
              <span class="article__rank"><span class="article__rank-txt--ranking">１位</span></span>
            </div>
          </a>
        </article>
      </div>
      
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
      <?php endif; ?>

      <div class="swiper-container swiper-new">
        <div class="swiper-wrapper">

          <?php
          $args = array(
            'post_status' => 'publish',
            'posts_per_page' => 10,
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
          ?>

          <?php while ($the_query->have_posts()): $the_query->the_post(); $cnt++;?>
          <?php if ($cnt <= 1) :?>
          <?php else : ?>
          <?php 
          $str_flag = strlen($cnt);
          if ( $str_flag == 1) {
            $str_cnt = mb_convert_kana($cnt, N);
          } else {
            $str_cnt = $cnt;
          }
          ?>
          <article class="article-rows swiper-slide">
            <a href="<?php the_permalink(); ?>" class="article-rows__link">
              <h3 class="article-rows__ttl"><?php the_title(); ?></h3>
              <div class="article-rows__img"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>"><span class="article__rank"><span class="article__rank-txt--ranking"><?php echo $str_cnt; ?>位</span></span></div>
            </a>
          </article>
          <?php endif; ?>

          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
          <?php endif; ?>

          <!-- /.swiper-wrapper --></div>
        <!-- /.swiper-container --></div>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>ranking" class="front__writer-more">もっと見る</a>
      <!-- /.articles --></section>
    
    <div class="front__contents front__writer">
      <h3 class="front__ttl">月刊MAライター</h3>
      <div class="front__apps swiper-writer swiper-container" id="sw">
        <ul class="front__writer-list swiper-wrapper">
          <?php
          $user_per_page = 20;
          if( $paged == 1 ){
            $offset = 0;  
          } else {
            $offset = ( $paged - 1 ) * $user_per_page;
          }

          $users = new WP_User_Query( 
		  	array( 
				'number' => $user_per_page, 
				'offset' => $offset,
				'meta_query'    => array(
					  array(
						'key'     => 'writer_name',
						'value'   => '',
						'compare' => '!='
					  )
					)
				) 
			);

          ?>
          <?php if (!empty($users->results)) : ?>
          <?php 
          foreach ($users->results as $user) : 
          $id = $user->ID;
          $name = $user->writer_name;
          $img = $user->writer_img2;
          $link = get_author_posts_url($id);
          ?>

          <li class="front__writer-item swiper-slide">
            <a href="<?php echo esc_url( $link ); ?>" class="front__writer-link">
            <img src="<?php echo wp_get_attachment_url($img); ?>" alt="<?php echo $name; ?>">
            <p class="front__writer-name"><?php echo $name; ?></p>
            </a>
          </li>

          <?php endforeach; ?>
          <?php endif; ?>
        </ul>
      </div>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>author" class="front__writer-more">もっと見る</a>
      <!-- /.contents --></div>
      
    <div class="front__contents">
      <h3 class="front__ttl">特集</h3>
      <ul class="front__special-list">
        <?php
        $args = array( 
          'post_type' => 'special',
          'posts_per_page' => 3
        );
        
        $the_query = new WP_Query($args); if($the_query->have_posts()):
        ?>
        <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
          
          <li class="front__special-item">
            <a href="<?php the_field('special_url'); ?>" class="front__special-link">
              <img src="<?php the_field('special_img') ?>" alt="<?php the_title(); ?>" class="front__special-img">
            </a>
          </li>
        
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
        <?php else: ?>
        <!-- 投稿が無い場合の処理 -->
        <?php endif; ?>
      </ul>
    </div>
      </div>
  </main>
  <div class="container">
  <div class="front__contents">
    <h3 class="front__ttl">タグ一覧</h3>
    <div class="front__apps">
      <?php
      // パラメータを指定
      $args = array(
        // タグ名順で指定
        'orderby' => 'name',
        // 昇順で指定
        'order' => 'ASC'
      );
      $posttags = get_tags( $args );

      if ( $posttags ){
        echo ' <ul class="front__tag-list"> ';
        foreach( $posttags as $tag ) {
          echo '<li class="front__tag-item"><a class="front__tag-link" href="'. get_tag_link( $tag->term_id ) . '">#' . $tag->name . '</a></li>';
        }
        echo ' </ul> ';
      }
      ?>
    </div>
    <!-- /.contents --></div>
</div>
<?php get_template_part('parts/app-row-articles'); ?>
<?php get_footer();
