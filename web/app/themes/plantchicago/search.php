<div class="site-grid grid">
  
  <div class="main-column-left -top"></div>

  <div class="main-column-right -top">
    
    <?php get_template_part('templates/page', 'header'); ?>

    <div class="grid">

      <div class="content-left flex-item one-half">

        <div class="news-grid">
          <h2>Results:</h2>

          <?php if (!have_posts()) : ?>
            <div class="alert alert-warning">
              <?php _e('Sorry, no results were found.', 'sage'); ?>
            </div>
            <?php get_search_form(); ?>
          <?php endif; ?>

          <?php while (have_posts()) : the_post(); ?>

            <?php 
            $show_images = false;

            if ($post->post_type=='post'):

              $news_post = $post;
              include(locate_template('templates/article-news.php'));

            elseif (preg_match('/(event)/',$post->post_type)):

              $event_post = $post;
              include(locate_template('templates/article-event.php'));

            // elseif (preg_match('/(page)/',$post->post_type)):

            //   include(locate_template('templates/article-page.php'));

            endif;
            ?>

          <?php endwhile; ?>
        </div>
      </div>

      <div class="events-list content-right flex-item one-half">
        <h2>Upcoming Events</h2>

        <?php echo \Firebelly\PostTypes\Event\get_events(['num_posts' => 10]); ?>

      </div>
      
    </div>

  </div>

</div>

<?php the_posts_navigation(); ?>