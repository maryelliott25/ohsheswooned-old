<?php

/**
 * Content region for recipe
 * @package oss
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <!-- Featured image -->
  <?php if(has_post_thumbnail( $post->ID )) { ?>
  <div class="featured-image-wrapper">
    <?php $featured_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0]; ?>
    <div class="featured-image" style="background-image: url('<?php echo $featured_image_src; ?>');"></div>
  </div>
  <?php } ?>

  <!-- Right aligned social icons -->
  <div class="social-icons">
    <a href="http://facebook.com" class="social-icon facebook"></a>
    <a href="http://pinterest.com" class="social-icon pinterest"></a>
    <a href="http://twitter.com" class="social-icon twitter"></a>
    <a href="http://evernote.com" class="social-icon evernote"></a>
  </div>

	<header class="entry-header">
    <div class="entry-meta">

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

      <?php
      $tags = get_the_tags();
      if($tags) { ?>
      <div class="meta-icon">
        <div class="icon-image icon-tags"></div>
        <?php echo get_the_tag_list('<div class="icon-text">', ', ', '</div>') ?>
      </div>
      <?php } ?>

		</div><!-- .entry-meta -->
    <div class="title-wrapper">
  		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
      <div class="entry-line"></div>
    </div>

    <div class="post-date"><?php the_date('l, F jS, Y'); ?></div>

	</header><!-- .entry-header -->

	<div class="entry-content">

    <div class="entry-excerpt">
      <?php the_excerpt(); ?>
    </div>

    <?php $ingredients = oss_has_ingredients($post->ID);
      if($ingredients) { ?>
      <div class="oss-ingredients-wrapper">
        <div id="oss-ingredients" class="ingredients">
            <h3>Ingredients</h3>
            <?php oss_print_ingredients($ingredients); ?>
        </div>
      </div>
    <?php } ?>

    <div class="post-content"><?php the_content(); ?></div>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'oss' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php oss_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
