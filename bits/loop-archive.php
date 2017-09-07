<article id="post-<?php the_ID(); ?>" data-pid="<?php the_ID(); ?>" <?php post_class(); ?> role="article">
	<div class="article-header">
		<?php if ( has_post_thumbnail()) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
		
		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><h1><?php the_title(); ?></h1></a>
	</div>

	<?php the_excerpt(); ?>

	<div class="article-footer">
		<p class="tags"><?php the_tags( __( 'Tags: ', 'skelet' ), ', ', '<br>'); ?></p>
	</div>									
</article>