	<footer class="footer">
		<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
	</footer>
</div> <!-- closing .main -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/modules.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/app.js"></script>

<?php wp_footer(); ?>

<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-XXXXXXXXX-Y"></script><!-- change UA-XXXXXXXXX-Y with your own. -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-XXXXXXXXX-Y'); // change UA-XXXXXXXXX-Y with your own.
</script>
<!-- End Google Analytics -->

</body>
</html>
