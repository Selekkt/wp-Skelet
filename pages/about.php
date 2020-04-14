<?php 
	/* Template Name: About */ 
?>

<?php get_header(); ?>
<main role="main">
	<section>
		<article id="post-<?php the_ID(); ?>" data-pid="<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<!-- To see additional archive styles, visit the /bits folder -->
				<?php get_template_part( 'bits/loop', 'page' ); ?>
			<?php endwhile; ?>
				<?php skelet_page_navi(); ?>
			<?php else : ?>				
				<?php get_template_part( 'bits/content', 'notfound' ); ?>
			<?php endif; ?>
		</article>
	</section>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
