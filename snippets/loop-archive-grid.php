<?php 
// Adjust the amount of rows in the grid
$grid_columns = 4; ?>

<?php if( 0 === ( $wp_query->current_post  )  % $grid_columns ): ?>
<div class="archive-grid" data-equalizer>
<?php endif; ?> 

	<div class="flex-it flex-it-wrap flex-it-wrap-space-around" data-equalizer-watch>
		<article id="post-<?php the_ID(); ?>" data-pid="<?php the_ID(); ?>" <?php post_class(); ?> role="article">
			
			<?php if ( has_post_thumbnail()) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
				</a>
			<?php endif; ?>
			
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			
			<?php the_excerpt(); ?>

		</article>
	</div>

<?php if( 0 === ( $wp_query->current_post + 1 )  % $grid_columns ||  ( $wp_query->current_post + 1 ) ===  $wp_query->post_count ): ?>
</div>
<?php endif; ?>