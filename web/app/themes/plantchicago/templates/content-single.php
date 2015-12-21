<?php
  use Firebelly\Utils;
  $category = Utils\get_category($post);
?>

<?php while (have_posts()) : the_post(); ?>
  
  <div class="page-header">
    <h2>Article: <?php if ($category): ?><span class="article-category"><a href="<?= get_term_link($category); ?>"><?= $category->name; ?></a></span><?php endif; ?></h2>
    <a href="news-events" class="back-to-list">Back to list</a>
  </div>

  <article <?php post_class(); ?>>

    <div class="post-nav-container">    
      <?php if (has_post_thumbnail()) {
        $thumb = wp_get_attachment_url(get_post_thumbnail_id());
        echo '<div class="article-image" style="background-image:url('.$thumb.');"></div>';
      } ?>
      <div class="post-nav">
        <div class="previous"><?php previous_post_link('%link', '<span class="arrow-wrap"><span class="arrow -long -left"></span></span><span class="text">Previous</span>'); ?></div>
        <div class="next"><?php next_post_link('%link', '<span class="arrow-wrap"><span class="arrow -long"></span></span><span class="text">Next</span>'); ?></div>
      </div>
    </div>

    <main>
      <header>
        <h1 class="article-title"><?php the_title(); ?></h1>
        <div class="article-meta">
          <?php get_template_part('templates/entry-meta'); ?>
        </div>
      </header>
      <div class="article-content">
        <?php the_content(); ?>
      </div>
      <footer>
        <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
      </footer>      
    </main>
    <aside>
      <?php get_template_part('templates/share'); ?>
    </aside>

    <a href="news-events" class="back-to-list">Back to list</a>

  </article>
<?php endwhile; ?>
