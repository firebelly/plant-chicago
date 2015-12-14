<?php
/**
 * Template Name: Homepage
 */

?>

<div class="site-grid grid">
  <div class="main-gutter main-column-left">
    <div class="header-gutter-icons">
      <svg class="icon icon-community"><use xlink:href="#icon-community"></svg>
      <svg class="icon icon-land"><use xlink:href="#icon-land"></svg>
      <svg class="icon icon-water"><use xlink:href="#icon-water"></svg>
    </div>
    <svg class="icon icon-factory"><use xlink:href="#icon-factory"></svg>
  </div>

  <div class="main-column-right grid">

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

      <?php 
        $events = \Firebelly\PostTypes\Event\get_events(['num_posts' => 4]); 
        if ($events) {
          echo  $events,
                '<a href="news-events" class="btn">See more <span class="arrow -right"></span></a>';
        } else {
          echo  '<div class="no-events">',
                '<p>There are no upcoming events at the moment,<br> check back soon!</p>',
                '<svg class="pattern"><rect x="0" y="0" width="100%" height="36" fill="url(#footerPattern)"></svg>',
                '</div><!--.no-events-->';
        }
      ?>
      
    </div>

  </div>

</div>

<div class="site-grid grid recent-news">

  <div class="main-gutter main-column-left">
    <svg class="icon icon-city"><use xlink:href="#icon-city"></svg>
  </div>

  <div class="main-column-right grid">
    <div class="row">
      <h2>Recent News</h2>

      <div class="article-list grid">      
        <?php 
        // Recent Blog & News posts
        $news_posts = get_posts(['numberposts' => 4]);
        if ($news_posts):
          foreach ($news_posts as $news_post) {
            include(locate_template('templates/article-news.php'));
          }
        endif;
        ?>
      </div>

    </div>
  </div>

</div>



