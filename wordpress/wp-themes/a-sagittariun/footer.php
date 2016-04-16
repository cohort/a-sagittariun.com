		</div><!-- #main -->

		<?php
				// footer on all but home page
				if (!is_page('dream-ritual') && !is_page('elasticity')) {
		?>

		<footer class="site-foot clearfix">
			<div class="site-foot-inner">
				<div class="mailing-list">
					<?php get_sidebar( 'main' ); ?>
					<script>jQuery(".mailing-list input[type=text]").attr("placeholder", "you@email.com");</script>
				</div>
				<div class="footer-links">
					<div class="social-links">
						<p>A Sagittariun on:</p>
						<?php wp_nav_menu( array( 'menu' => 'Footer menu' ) ); ?>
					</div>
					<div class="site-credits">
						<p><a href="http://cohortstudio.com" rel="external">Site by Cohort</a></p>
					</div>
				</div>
			</div>
		</footer>

		<?php
				} // end if
		?>

	</div><!-- #page -->

	<?php wp_footer(); ?>

	<script>var templateDirectory = "<?php echo get_stylesheet_directory_uri(); ?>";</script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.flexslider-min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.touchSwipe.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/screenfull.js"></script>

	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/a-sag.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/responsive-menu.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/home-slides.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/releases.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/init.js"></script>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-45835615-1', 'a-sagittariun.com');
	  ga('send', 'pageview');
	</script>

</body>
</html>