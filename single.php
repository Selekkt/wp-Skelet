<?php get_header(); ?>
<main role="main">
	<section>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php // To see additional archive styles, visit the /snippets folder ?>
		<?php get_template_part( 'snippets/loop', 'single' ); ?>
	<?php endwhile; ?>
		<?php skelet_page_navi(); ?>
	<?php else : ?>				
		<?php get_template_part( 'snippets/content', 'notfound' ); ?>
	<?php endif; ?>
	</section>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>