<form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
	<input class="search-input" type="search" name="s" <?php if(is_search()): echo 'value="'. get_search_query() .'"'; endif; ?> placeholder="<?php _e( 'Search for content.', 'skelet' ); ?>">
	<button class="search-submit" type="submit" role="button"><?php _e( 'Search', 'skelet' ); ?></button>
</form>
