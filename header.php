<!DOCTYPE html>
<html lang="ja">
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    
    <?php wp_head(); ?>
    
	</head>

  <body <?php body_class(); ?>>

    <nav class="gnav">
      <div class="gnav__header">
        <div class="gnav__header-inner">
          <div class="gnav__header-close js-close"></div>
          <div class="gnav__header-ttl">
            <a class="header__ttl-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
              <span class="header__ttl-main"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo3.png" alt="月刊MA"></span>
              <span class="header__ttl-sub">出会いの情報なら<br>月刊マッチングアプリ</span>
            </a>
          </div>
        </div>
      </div>
      
      <div class="gnav__search">
        <form method="get" class="gnav__search-inner" action="<?php echo esc_url( home_url( '/' ) ); ?>">
          <input class="gnav__search-form" type="text" value="<?php echo get_search_query(); ?>" placeholder="検索する" name="s" id="s" />
          <input type="submit" value="&#xf002;" class="fas gnav__search-submit">
        </form>
      </div>
      
      <div class="gnav__contents">
        <h3 class="gnav__ttl">アプリの種類から選ぶ</h3>
        <div class="gnav__apps">
        <?php
        $terms = get_terms('apps_type');
        foreach ( $terms as $term ) {
          $term = $term->name;?>
          <div class="gnav__apps-list">
            <h4 class="gnav__apps-ttl">◆ <?php echo $term; ?><span class="gnav__apps-btn"></span></h4>     
            <ul class="gnav__apps-item">
              
        <?php
          $args = array(
            'post_type' => 'apps',
            'post_status' => 'publish',
            'tax_query' => array(
              'relation' => 'AND',
              array(
                'taxonomy' => 'apps_type',
                'field' => 'slug',
                'terms' => $term,
                'include_children' => true,
                'operator' => 'IN'
              ),
            )
          );
          $the_query = new WP_Query($args); if($the_query->have_posts()):
        ?>
        <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
              <li class="gnav__apps-links"><a class="gnav__apps-link" href="<?php echo esc_url( home_url( '/' ) ); ?>category/<?php the_title(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            </ul>
          </div>
          
        <?php }
        ?>
        </div>
      <!-- /.contents --></div>
      
      <div class="gnav__contents">
        <h3 class="gnav__ttl">タグ一覧</h3>
        <div class="gnav__apps">
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
            echo ' <ul class="gnav__tag-list"> ';
            foreach( $posttags as $tag ) {
              echo '<li class="gnav__tag-item"><a class="gnav__tag-link" href="'. get_tag_link( $tag->term_id ) . '">#' . $tag->name . '</a></li>';
            }
            echo ' </ul> ';
          }
          ?>
        </div>
        <!-- /.contents --></div>
        
      <div class="gnav__contents">
        <h3 class="gnav__ttl">連載</h3>
        <div class="gnav__apps">
          <ul class="gnav__column-list">
            
            <?php
            $args = array( 
              'post_type' => 'column_cover'
            );
            $the_query = new WP_Query($args); if($the_query->have_posts()):
            ?>
            <?php while ($the_query->have_posts()): $the_query->the_post(); ?>

            <li class="gnav__column-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>?s=&term=<?php the_title(); ?>" class="gnav__column-link"><?php the_title(); ?></a></li>

            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <?php endif; ?> 
            
          </ul>
        </div>
      <!-- /.contents --></div>
      
      <div class="gnav__contents">
        <h3 class="gnav__ttl">月間ランキング</h3>
        <div class="gnav__apps">

          <?php
          $paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
          $args = array(
            'post_status' => 'publish',
            'posts_per_page' => 3,
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

          <article class="article">
            <a href="<?php the_permalink(); ?>" class="article__link">
              <h2 class="article__ttl"><?php the_title(); ?></h2>
              <div class="article__img"><img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>">
                <?php if ( $cnt <= 3 ) { ?>
                <span class="article__rank"><span class="article__rank-txt--ranking"><?php echo $cnt; ?>位</span></span>
                <?php } ?>
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
          <?php endif; ?>
          
        </div>
      <!-- /.contents --></div>
      
      <div class="gnav__contents">
        <h3 class="gnav__ttl">月刊MAライター</h3>
        <div class="gnav__apps swiper-writer swiper-container" id="sw">
          <ul class="gnav__writer-list swiper-wrapper">
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

            <li class="gnav__writer-item swiper-slide">
              <a class="gnav__writer-link" href="<?php echo $link; ?>">
              <img src="<?php echo wp_get_attachment_url($img); ?>" alt="<?php echo $name; ?>">
              <p class="gnav__writer-name"><?php echo $name; ?></p>
              </a>
            </li>

            <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>
        <!-- /.contents --></div>
        
      <div class="gnav__contents">
        <h3 class="gnav__ttl">お問い合わせ</h3>
        <p class="gnav__contact"><a class="gnav__contact-link" href="<?php echo esc_url( home_url( '/' ) ); ?>contact">こちら</a>よりお問合わせください</p>
      <!-- /.contents --></div>
      
    </nav>
    
        <?php if ( is_front_page() ): ?>
        <header class="header header--front">
          <div class="header__inner--front">
        <div class="header__menu--front js-menu"></div>
        <h1 class="header__ttl">
          <a class="header__ttl-link--front" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <span class="header__ttl-main--front"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="月刊MA"></span>
            <span class="header__ttl-sub--front">出会いの情報なら月刊マッチングアプリ</span>
          </a>
        </h1>
        <div class="header__search--front js-search"></div>
        <?php else:?>
            <header class="header header">
              <div class="header__inner">
        <div class="header__menu js-menu"></div>
        <div class="header__ttl">
          <a class="header__ttl-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <span class="header__ttl-main"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo3.png" alt="月刊MA"></span>
            <span class="header__ttl-sub">出会いの情報なら<br>月刊マッチングアプリ</span>
          </a>
        </div>
        <div class="header__search js-search"></div>
        <?php endif; ?>
      <!-- /.inner --></div>
    <!-- /.header --></header>
    
