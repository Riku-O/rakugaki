<?php get_header(); ?>

<?php if( is_url('&author=') ): ?>
<?php get_template_part('parts/search-author'); ?>
<?php elseif( is_url('&term=') ): ?>
<?php get_template_part('parts/search-column'); ?>
<?php else : ?>
<?php get_template_part('parts/search-post'); ?>
<?php endif; ?>
<?php get_footer();
