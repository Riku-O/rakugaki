<?php get_header(); ?>

<div class="single__head">
  <img src="<?php echo get_thumbnail(); ?>" alt="<?php echo get_thumbnail_alt(); ?>">
</div>

<div class="container">
  <main class="main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php 
    $cat = get_the_category();
    $cat = $cat[0];
    $writer = get_the_author_meta('writer_name');
    $url = get_permalink();
    $ttl = get_the_title();
    ?>
    
    <h1 class="single__ttl"><?php the_title(); ?></h1>
    <div class="single__meta">
      <p class="single__meta-cat"><?php echo $cat->cat_name; ?></p>
      <time class="single__meta-time" datetime="<?php echo get_the_date( 'Y-m-d' ) ?>"><?php echo get_the_date( 'Y.m.d' ); ?></time>
      <p class="single__meta-writer">written by <?php echo $writer; ?></p>
    </div>
    
    <div class="single-content">
      <?php the_content(); ?>
    </div>
    
    <?php endwhile; ?>
    <?php endif; ?>
    
    <?php if ( is_singular('column') ): ?>
    <?php 
    $tarms =  get_the_terms( $post ->ID, 'column_cat' );
    if (! is_array($tarms)) {
      $tarms = array(array('title'=>'該当するデータはありません'));
    } else {
      $column_name = $tarms[0]->name;
    }
    ?>
    <div class="single__type">
      <dl class="single__type-list">
        <dt class="single__type-ttl">連載：</dt>
        <dd class="single__type-desc"><a href="<?php echo esc_url( home_url( '/' ) ); ?>?s=&term=<?php echo $column_name; ?>"><?php echo $column_name; ?></a></dd>
      </dl>
    </div>
    <?php else: ?>
    <div class="single__type">
      <dl class="single__type-list">
        <dt class="single__type-ttl">カテゴリー：</dt>
        <dd class="single__type-desc"><?php the_category(', '); ?></dd>
      </dl>
      <dl class="single__type-list">
        <dt class="single__type-ttl">タグ：</dt>
        <dd class="single__type-desc"><?php the_tags('',', ', ''); ?></dd>
      </dl>
    </div>
    <?php endif; ?>
    
    <div class="single__share">
      <h3 class="single__share-ttl">この記事をシェアしよう！</h3>
      <ul class="single__share-list">
       
        <li class="single__share-items"><a href="https://twitter.com/share?text=<?php echo $ttl; ?>&url=<?php echo $url; ?>&hashtags=<?php echo bloginfo('sitename'); ?>" onClick="window.open(encodeURI(decodeURI(this.href)), 'tweetwindow', 'width=650, height=470, personalbar=0, toolbar=0, scrollbars=1, sizable=1'); return false;" rel="nofollow" class="single__share-item tb">ツイート</a></li>
        
        <li class="single__share-items"><a href="https://www.facebook.com/plugins/like.php?href=<?php echo $url; ?>" onclick="javascript:window.open('https://www.facebook.com/plugins/like.php?href=<?php echo $url; ?>' ,null ,'width=650 ,height=450'); return false;" rel="nofollow" class="single__share-item fbb">シェア</a></li>

        <li class="single__share-items"><a href="https://b.hatena.ne.jp/entry/<?php echo $url; ?>" data-hatena-bookmark-layout="simple" title="このエントリーをはてなブックマークに追加" class="single__share-item bb">はてブ</a>
          <script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" async="async"></script></li>

        <li class="single__share-items"><a href="https://plus.google.com/share?url=<?php echo $url; ?>" class="single__share-item gb">Google+</a></li>

        <li class="single__share-items"><a href="https://getpocket.com/edit?url=<?php echo $url; ?>&title=<?php echo $ttl; ?>" rel="nofollow" target="_blank" class="single__share-item pb">Pocket</a></li>

        <li class="single__share-items"><a href="http://cloud.feedly.com/#subscription%2Ffeed%2Fhttp%3A%2F%2F<?php the_permalink(); ?>/feed" class="single__share-item fb">feedly</a></li>
      </ul>
    </div>
    
  </main>
  <aside class="sidebar">
    <?php get_template_part('parts/related-articles'); ?>
    <?php get_template_part('parts/ranking-articles'); ?>
    <?php get_template_part('parts/new-articles'); ?>
    <?php get_template_part('parts/app-articles'); ?>
    <!-- /.sidebar --></aside>
  <div class="single__bookmark">
    <p class="single__bookmark-ttl">＜目次＞<span class="single__bookmark-btn"></span></p>
    <ol class="single__bookmark-list">
    </ol>
  </div>
  <!-- /.container --></div>
  


<?php get_footer();
