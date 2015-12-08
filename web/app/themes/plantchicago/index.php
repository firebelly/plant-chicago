<?php get_template_part('templates/page', 'header'); ?>


<div class="content-left flex-item one-half">
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

<div class="events-list content-right flex-item one-half">
  <h2>Upcoming Events</h2>
  <?php if (!have_posts()) : ?>
    <div class="alert alert-warning">
      <?php _e('Sorry, no results were found.', 'sage'); ?>
    </div>
    <?php get_search_form(); ?>
  <?php endif; ?>

  <?php echo \Firebelly\PostTypes\Event\get_events(['num_posts' => 4]); ?>

  <a href="events" class="btn">See more <span class="arrow"></span></a>
</div>

<?php the_posts_navigation(); ?>
