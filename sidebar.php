<aside class="sidebar" role="complementary">
	<!-- To see additional archive styles, visit the /bits folder -->
	<?php get_template_part( 'bits/content', 'searchform' ); ?>

	<div class="sidebar-widget">
		<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar1' ); ?>
		<?php else : ?>
		<!-- This content shows up if there are no widgets defined in the backend. -->	
		<div class="alert alert-warning">
			<p><?php _e( 'Please activate some Widgets.', 'skelet' );  ?></p>
		</div>

		<?php endif; ?>
	</div>

	<div class="sidebar-widget">
		<?php if ( is_active_sidebar( 'sidebar2' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar2' ); ?>
		<?php else : ?>
		<!-- This content shows up if there are no widgets defined in the backend. -->		
		<div class="alert alert-warning">
			<p><?php _e( 'Please activate some Widgets.', 'skelet' );  ?></p>
		</div>

		<?php endif; ?>
	</div>

</aside>