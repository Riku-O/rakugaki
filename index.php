<?php get_header(); ?>

<div class="container">
  <main class="main">
    <?php if ( is_page('news') ) : ?>
    <h1 class="archives__ttl">
      <span class="archives__sub">カテゴリー</span>
      <div class="archives__main">新着記事</div>
    </h1>
    <?php elseif ( is_category() ): ?>
    <h1 class="archives__ttl">
      <span class="archives__sub">カテゴリー</span>
      <div class="archives__main"><?php single_cat_title(); ?></div>
    </h1>
    <?php elseif ( is_post_type_archive() ): ?>
    <h1 class="archives__ttl">
      <span class="archives__sub">カテゴリー</span>
      <div class="archives__main">新着記事</div>
    </h1>
    <?php else: ?>
    <h1 class="archives__ttl">
      <span class="archives__sub">タグ</span>
      <div class="archives__main"><?php single_tag_title(); ?></div>
    </h1>    
    <?php endif; ?>
    <?php get_template_part('parts/articles'); ?>
  <!-- /.main --></main>
  
  <aside class="sidebar">
    <?php get_template_part('parts/related-articles'); ?>
    <?php get_template_part('parts/ranking-articles'); ?>
    <?php if ( !is_post_type_archive() ) : ?>
    <?php get_template_part('parts/new-articles'); ?>
    <?php endif; ?>
    <?php get_template_part('parts/app-articles'); ?>
  <!-- /.sidebar --></aside>
<!-- /.container --></div>

<?php get_footer();
