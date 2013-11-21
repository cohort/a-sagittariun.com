<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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


			<?php if ( have_posts() ) : ?>

				<div class="entry-content">

					<?php /* The loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<div class="blog-post-excerpt clearfix">
							<div class="blog-post-excerpt-thumbnail">
								<div class="blog-post-meta clearfix">
									<p class="blog-post-meta-date"><?php echo get_the_date("jS F Y"); ?></p>
									<p class="blog-post-meta-comments"><span class="icon-bubble"></span> <?php comments_number(); ?></p>
								</div>
								<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail(); ?>
								</a>
								<?php endif; ?>
							</div>
							<div class="blog-post-excerpt-content">
								<div class="blog-post-meta clearfix">
									<p class="blog-post-meta-date"><?php echo get_the_date("jS F Y"); ?></p>
									<p class="blog-post-meta-comments"><span class="icon-bubble"></span> <?php comments_number(); ?></p>
								</div>
								<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
								<?php the_excerpt(); ?>
							</div>
						</div>

					<?php endwhile; ?>

				</div><!-- /.entry-content -->

				<?php twentythirteen_paging_nav(); ?>

			<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>