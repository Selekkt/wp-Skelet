<article id="post-<?php the_ID(); ?>" data-pid="<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

	<div class="article-image"><?php if(has_post_thumbnail()) { the_post_thumbnail(); } ?></div>					

	<div class="article-header">
		<h1 class="article-title" itemprop="headline"><?php the_title(); ?></h1>

		<ul>
			<li><span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span></li>
			<li><span class="author"><?php _e( 'Published by ', 'skelet' ); ?><?php the_author_posts_link(); ?></span></li>
			<li><span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'skelet' ), __( '1 Comment', 'skelet' ), __( '% Comments', 'skelet' )); ?></span></li>
		</ul>
	</div>

	<?php the_content(); ?>

	<div class="article-footer">
		<p class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></p>
		<p class="author"><?php _e( 'This post was written by ', 'skelet' ); the_author(); ?></p>
		<p class="tags"><?php the_tags( __( 'Tags: ', 'skelet' ), ', ', '<br>'); ?></p>
		<p class="cats"><?php _e( 'Categories: ', 'skelet' ); the_category(', '); ?></p>
	</div>

	<hr>

	<?php comments_template(); ?>										
</article>