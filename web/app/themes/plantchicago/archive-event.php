<?php 
/**
 * Events landing page
 */

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$per_page = get_option('posts_per_page');
$past_events = get_query_var('past_events', 0);
$total_events = \Firebelly\PostTypes\Event\get_events([
  'countposts' => 1,
  'past_events' => $past_events,
  'program' => $filter_program,
  'focus_area' => $filter_focus_area
]);
$total_pages = ($total_events > 0) ? ceil($total_events / $per_page) : 1;

$post = get_page_by_path('/events');
$with_image_class = (has_post_thumbnail($post->ID)) ? 'with-image' : '';
$page_content = apply_filters('the_content', $post->post_content);
?>
<div class="content-wrap <?= $with_image_class ?>">
  <div id="map" class="large hide"></div>

  <main>

  <?php while (have_posts()) : the_post(); ?>

    <?php 
    if ($post->post_type=='post'):

    elseif (preg_match('/(event)/',$post->post_type)):

      $event_post = $post;
      include(locate_template('templates/article-event.php'));

    endif;
    ?>

  <?php endwhile; ?>

  </main>
</div>