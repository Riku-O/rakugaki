<?php
get_header(); ?>

<div class="container e404">
  <main class="main">
    <section class="articles">
      <h1 class="articles__ttl">404 Page Not Found</h1>

      <div class="article">
        <p class="e404__desc">
          いつも当サイトをご利用いただきありがとうございます。</p>
        <p class="e404__desc">
          大変恐れ入りますが、お探しのページは見つかりませんでした。
        </p>
        <p class="e404__desc">
          すでに削除されているか、リンクが変更されている、あるいはリンクに相違がある可能性がございます。
        </p>
      </div>
      
      <div class="e404__links">
        <a class="e404__btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">ホームへ戻る</a>
      </div>

      <!-- /.articles --></section>  
  </main>
</div>

<?php
get_footer();