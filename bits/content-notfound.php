<article id="not-found">
	<section class="no-results">
	<?php if ( is_search() ) : ?>
		<h1><?php _e( 'Sorry, No Results were found.', 'skelet' );?></h1>
	<?php else: ?>
		<h1><?php _e( 'Sorry, nothing to show you.', 'skelet' ); ?></h1>
	<?php endif; ?>
	</section>
	<section class="search-again">
		<div><?php get_search_form(); ?></div>
	</section>
</article>