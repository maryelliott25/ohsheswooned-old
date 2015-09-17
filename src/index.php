<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package oss
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div id="featured-slick" class="featured-post-slider">

				<?php query_posts('category_name=featured'); ?>

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="featured-post">
						<a href="<?php the_permalink(); ?>">
							<?php 
							the_post_thumbnail();
							?>
						</a>
						<div class="slide-info">
							<div class="slide-copy">
								<?php
									foreach((get_the_category()) as $category) {
									    if ($category->cat_name != 'Featured') {
									    echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> ';
										}
									}
								?>
								<a href="<?php the_permalink(); ?>">
									<h2 class="slide-title"><?php the_title(); ?></h2>
								</a>
							</div>
						</div>
					</div>
					<?php /* Test Comment */ ?>
				<?php endwhile; else: ?>

					<p>Sorry, there are no posts to display</p>

				<?php endif; ?>

			</div>

		<?php wp_reset_query(); ?>

		<div class="content-wrap">
			<div class="post-wrap">
				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );
						?>

					<?php endwhile; ?>

					<div class="index-posts-navigation">

						<?php echo paginate_links(array(
							'prev_text' => '< Newer Posts',
							'next_text' => 'Older Posts >'
						)); ?>

					</div>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>
			</div>
			<?php get_sidebar(); ?>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
