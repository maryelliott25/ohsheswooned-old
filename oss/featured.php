<?php
/**
 * The template for displaying the featured content slider.
 *
 * @package oss
 */
?>

<?php query_posts('category_name=featured'); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<h1><?php the_title() ;?></h1>		
	<?php the_post_thumbnail(); ?>
	<?php the_excerpt(); ?>

<?php endwhile; else: ?>

	<p>Sorry, there are no posts to display</p>

<?php endif; ?>

<?php wp_reset_query(); ?>