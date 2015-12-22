<div class="site-grid grid">
  
  <div class="main-column-left -top">
    <div class="header-gutter-icons">
      <svg class="icon icon-community"><use xlink:href="#icon-community"></svg>
      <svg class="icon icon-plants"><use xlink:href="#icon-plants"></svg>
      <svg class="icon icon-community"><use xlink:href="#icon-community"></svg>
      <svg class="icon icon-plants"><use xlink:href="#icon-plants"></svg>
    </div>
  </div>

  <div class="main-column-right -top">
    
    <?php get_template_part('templates/page', 'header'); ?>

    <div class="grid">

      <div class="content-left flex-item one-half">
        <h2>News Archive</h2>
  
        <div class="categories-list">        
          <h3>Categories:</h3>
          <ul>
            <?= wp_list_categories('title_li='); ?>
          </ul>
        </div>

        <div class="news-grid">

          <?php if (!have_posts($post->post_type=='post')) : ?>
            <div class="alert alert-warning">
              <?php _e('Sorry, no results were found.', 'sage'); ?>
            </div>
            <?php get_search_form(); ?>
          <?php endif; ?>

          <?php while (have_posts()) : the_post(); ?>

            <?php 

            if ($post->post_type=='post'):

              $news_post = $post;
              include(locate_template('templates/article-news.php'));

            endif;
            ?>

          <?php endwhile; ?>

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

        <?php echo \Firebelly\PostTypes\Event\get_events(['num_posts' => 100]); ?>

      </div>
      
    </div>

    <?php the_posts_pagination(5); ?>

  </div>

</div>
