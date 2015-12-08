<?php
/**
 * Template Name: Homepage
 */

?>

<div class="content-left flex-item one-half">
  <?= apply_filters('the_content', $post->post_content); ?>
  
</div>

<div class="events-list content-right flex-item one-half">
  <h2>Upcoming Events</h2>
  <?php if (!have_posts()) : ?>
    <div class="alert alert-warning">
      <?php _e('Sorry, no results were found.', 'sage'); ?>
    </div>
    <?php get_search_form(); ?>
  <?php endif; ?>

  <?php echo \Firebelly\PostTypes\Event\get_events(['num_posts' => 4]); ?>

  <a href="news-events" class="btn">See more <span class="arrow -right"></span></a>
</div>