<div class="site-grid grid">
  
  <div class="main-column-left"></div>

  <div class="main-column-right">
    
    <?php get_template_part('templates/page', 'header'); ?>

    <div class="grid">

      <div class="content-left flex-item one-half">
        <h2>News Archive</h2>

        <div class="news-grid grid">      
          <?php 
          // Recent Blog & News posts
          $news_posts = get_posts(['numberposts' => 10]);
          if ($news_posts):
            foreach ($news_posts as $news_post) {
              include(locate_template('templates/article-news.php'));
            }
          endif;
          ?>
        </div>
      </div>

      <div class="events-list content-right flex-item one-half">
        <h2>Upcoming Events</h2>
        <?php if (!have_posts()) : ?>
          <div class="alert alert-warning">
            <?php _e('Sorry, no results were found.', 'sage'); ?>
          </div>
          <?php get_search_form(); ?>
        <?php endif; ?>

        <?php echo \Firebelly\PostTypes\Event\get_events(['num_posts' => 10]); ?>

      </div>
      
    </div>

  </div>

</div>

<?php the_posts_navigation(); ?>
