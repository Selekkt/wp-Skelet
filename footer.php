	<footer class="footer">
		<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
	</footer>
</div> <!-- closing .main -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/modules.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/app.js"></script>

<?php wp_footer(); ?>

<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-XXXXX-Y', 'auto'); // change UA-XXXXX-Y with your own.
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->

</body>
</html>