<?php
/**
 * @package oss
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-category-wrap">
	<?php
		$current_post_type = get_post_type();
		if($current_post_type === 'oss_recipe') {
			echo '<a href="'. get_post_type_archive_link("oss_recipe") . '" title="View all recipes">Recipes</a>';
		} else if ($current_post_type === 'post'){
			foreach((get_the_category()) as $category) {
			    if ($category->cat_name != 'Featured') {
			    echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> ';
				}
			}
		}
	?>
	</div>
	<?php
		if(has_post_thumbnail()) {
				if(is_home()) {
					$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'homepage-featured' );
				} else {
		    	$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
				}
		    echo '<img src="' . $image_src[0]  . '" class="post-thumbnail" width="100%"  />';
		}
	?>
	<div class="post-body-copy">
		<header class="entry-header">
			<div class="post-title-wrap"><?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?></div>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php the_date('l, F j, Y'); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */

				the_content('...Read More');

			?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'oss' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<div class="index-post-tags">
			<img src="wp-content/themes/oss/assets/images/tag-icon.png" class="tag-icon" />
			<?php the_tags( '', ', ', '' ); ?>
		</div>

	</div>

</article><!-- #post-## -->
