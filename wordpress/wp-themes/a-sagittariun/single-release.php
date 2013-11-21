<?php
    /*
     * Music page - single item
     */
get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<header class="entry-header">
                <h2 class="entry-title">Music</h2>
            </header>

			<?php while ( have_posts() ) : the_post(); ?>

                <?php
                    include "partials/release.php";
                ?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>