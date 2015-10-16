<?php
/**
 * @package oss
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-category-wrap">
	<?php
		$current_post_type = get_post_type();
		if($current_post_type === 'oss_recipe' && !is_archive()) {
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
	<a class="index-feature-img" href="<?php the_permalink(); ?>">
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
	</a>
	<div class="post-body-copy">
		<header class="entry-header">
			<?php if ($current_post_type === 'oss_recipe') : ?>
				<div class="meta-icon-wrapper">
					<div class="meta-icon">
					  <div class="icon-image icon-clock"></div>
					  <div class="icon-text"><?php
					    $cook_time = get_post_meta( $post->ID, '_oss_time_value_key', true );
					    echo $cook_time;
					  ?></div>
					</div>

					<div class="meta-icon">
					  <div class="icon-image icon-silverware"></div>
					  <div class="icon-text"><?php
					    $servings = get_post_meta( $post->ID, '_oss_servings_value_key', true );
					    echo $servings;
					  ?></div>
					</div>
				</div>
			<?php endif; ?>

			<div class="post-title-wrap"><?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?></div>

			<div class="post-date">
				<?php the_date('l, F j, Y'); ?>
			</div><!-- .entry-meta -->
		
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				if($current_post_type === 'oss_recipe') {
					echo '<p>' . get_the_excerpt() . '</p>';
				} else {
					the_content('...Read More');
				}

			?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'oss' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<div class="index-post-tags">
			<img src="/wp-content/themes/oss/assets/images/tag-icon.png" class="tag-icon" />
			<?php the_tags( '', ', ', '' ); ?>
		</div>

	</div>

</article><!-- #post-## -->
