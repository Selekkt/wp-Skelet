<article id="page-<?php the_ID(); ?>" data-pid="<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/WebPage">			
	<div class="article-header">
		<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
	</div>
		
	<?php the_content(); ?>
	<?php wp_link_pages(); ?>		
</article>