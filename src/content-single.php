<?php
/**
 * @package oss
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<!-- Featured image -->
	<?php if(has_post_thumbnail( $post->ID )) { ?>
	<div class="featured-image-wrapper">
	  <?php $featured_image_src = 
	    MultiPostThumbnails::get_post_thumbnail_url(
	        get_post_type(),
	        'secondary-image'
	    )
	  ?>
	  <div class="featured-image" style="background-image: url('<?php echo $featured_image_src; ?>');"></div>
	</div>
	<?php } ?>


	<header class="entry-header">
		<div class="post-title-wrap"><?php the_title( sprintf( '<h1 class="entry-title"><a rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?></div>

		<div class="post-date"><?php the_date('l, F jS, Y'); ?></div>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<div class="entry-excerpt">
		  <?php the_excerpt(); ?>
		</div>

		<div class="post-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'oss' ),
					'after'  => '</div>',
				) );
			?>
		</div>
		
		    <div class="previous-next-posts">
				<?php

		      $prev_post = mod_get_adjacent_post('prev', array('oss_recipe', 'post'));
					if($prev_post) { ?>
		        <div class="pn-post previous-post">
		          <div class="meta-wrapper">
		            <div class="pn-meta">Previous Post</div>
		            <div class="header-line"></div>
		          </div>
		          <?php $prev_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ), 'thumbnail' )[0]; ?>
		          <div class="pn-content">
		            <a href="<?php echo get_permalink($prev_post->ID); ?>"><img src="<?php echo $prev_thumbnail; ?>" class="pn-image" /></a>
		            <h4 class="pn-title"><a href="<?php echo get_permalink($prev_post->ID); ?>"><?php echo get_the_title($prev_post->ID); ?></a></h4>
		            <div class="pn-info">
		              <div class="pn-date"><?php echo get_the_date('l, F jS, Y', $prev_post->ID); ?></div>
		              <?php $tags = get_the_tags($prev_post->ID);
		              if($tags) {
		                echo "<div class='pn-tags'>";
		                $tag_array = [];
		                foreach($tags as $tag) {
		                  $tag_name = $tag->name;
		                  $tag_link = get_tag_link($tag->term_id);
		                  $tag_array[] = "<a href='$tag_link'>$tag_name</a>";
		                }
		                echo implode(', ', $tag_array);
		                echo "</div>";
		              } ?>
		            </div>
		          </div>
		        </div>
		      <?php }?>

		      <?php $next_post = mod_get_adjacent_post('next', array('oss_recipe', 'post'));
					if($next_post) { ?>
		        <div class="pn-post next-post">
		          <div class="meta-wrapper">
		            <div class="pn-meta">Next Post</div>
		            <div class="header-line"></div>
		          </div>
		          <?php $next_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'thumbnail' )[0]; ?>
		          <div class="pn-content">
		            <a href="<?php echo get_permalink($next_post->ID); ?>"><img src="<?php echo $next_thumbnail; ?>" class="pn-image" /></a>
		            <h4 class="pn-title"><a href="<?php echo get_permalink($next_post->ID); ?>"><?php echo get_the_title($next_post->ID); ?></a></h4>
		            <div class="pn-info">
		              <div class="pn-date"><?php echo get_the_date('l, F jS, Y', $next_post->ID); ?></div>
		              <?php $tags = get_the_tags($next_post->ID);
		              if($tags) {
		                echo "<div class='pn-tags'>";
		                $tag_array = [];
		                foreach($tags as $tag) {
		                  $tag_name = $tag->name;
		                  $tag_link = get_tag_link($tag->term_id);
		                  $tag_array[] = "<a href='$tag_link'>$tag_name</a>";
		                }
		                echo implode(', ', $tag_array);
		                echo "</div>";
		              } ?>
		            </div>
		          </div>
		        </div>
		      <?php }?>
		    </div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
