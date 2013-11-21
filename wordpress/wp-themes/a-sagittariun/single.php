<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<header class="entry-header">
				<h2 class="entry-title">Blog</h2>
			</header><!-- .entry-header -->

				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="entry-content">

						<div class="blog-post">
							<div class="blog-post-meta clearfix">
								<p class="blog-post-meta-date"><?php the_date("jS F Y"); ?></p>
								<p class="blog-post-meta-comments"><span class="icon-bubble"></span> <?php comments_number(); ?></p>
							</div>
							<h3><?php the_title(); ?></h3>
							<?php the_content(); ?>
						</div>
					</div><!-- /.entry-content -->

					<?php comments_template(); ?>

				<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>