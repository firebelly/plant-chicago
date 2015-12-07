<?php
/**
 * Template Name: Homepage
 */

?>

<div class="content-left flex-item one-half">
  <?= apply_filters('the_content', $post->post_content); ?>
  
</div>

<div class="content-right flex-item one-half">
  <?php if (!have_posts()) : ?>
    <div class="alert alert-warning">
      <?php _e('Sorry, no results were found.', 'sage'); ?>
    </div>
    <?php get_search_form(); ?>
  <?php endif; ?>

  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
  <?php endwhile; ?>
</div>