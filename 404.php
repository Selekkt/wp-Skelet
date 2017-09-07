<?php get_header(); ?>
	<main role="main">
		<section>
			<article id="post-404" data-pid="404">
				<h1><?php _e( 'Page not found', 'skelet' ); ?></h1>
				<h3><a href="<?php echo home_url(); ?>"><?php _e( 'Go home?', 'skelet' ); ?></a></h3>
			</article>
		</section>
	</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>