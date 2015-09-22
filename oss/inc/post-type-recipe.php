<?php
/**
 * Sets up recipe post type and adds necessary meta fields
 *
 * @package oss
 */
add_action('init', 'oss_create_recipe_post_type');

function oss_create_recipe_post_type() {
  register_post_type( 'oss_recipe',
    array(
      'labels' => array(
        'name' => __( 'Recipes' ),
        'singular_name' => __( 'Recipe' ),
      ),
      'description' => 'Fancy recipe listing for ohsheswooned blog',
      'public' => true,
      'has_archive' => true,
      'rewrite' => array(
        'slug' => 'recipes'
      ),
      'menu_position' => 5,
      'menu_icon' => 'dashicons-carrot',
      'supports' => array(
        'title',
        'author',
        'custom-fields',
        'comments',
        'revisions',
        'thumbnail',
        'excerpt'
      ),
      'register_meta_box_cb' => 'oss_create_recipe_post_meta_boxes'
    )
  );
}

function oss_create_recipe_post_meta_boxes() {
  
}
