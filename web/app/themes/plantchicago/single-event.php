<?php
$event = \Firebelly\PostTypes\Event\get_event_details($post);
?>

<div class="site-grid grid">
  <div class="main-gutter main-column-left"></div>

  <div class="main-column-right">

    <div class="page-header">
      <h2>Event Details</h2>
      <a href="news-events" class="back-to-list">Back to list</a>
    </div>

    <article class="post event" data-lat="<?= $event->lat ?>" data-lng="<?= $event->lng ?>" data-title="<?= $event->title ?>" data-desc="<?= $event->desc ?>" data-id="<?= $event->ID ?>">

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
          <h1 class="article-title"><?= $post->post_title ?></h1>
        </header>
        <div class="article-meta">
          <?php if ($event->price) { ?>
          <h3 class="sr-only">Price:</h3>
          <p><?= $event->price ?></p>
          <?php } ?>
          <div class="grid">
            <div class="one-half">
              <h3 class="sr-only">When:</h3>
              <?php if ($event->multiple_days) { ?>
                <p><?= date('l', $event->event_start) ?>, <?= date('m/d/y', $event->event_start) ?>
                <br><em>through</em>
                <br><?= date('l', $event->event_start) ?>, <?= date('m/d/y', $event->event_end) ?>
                <br><?= $event->time_txt ?> Daily</p>
              <?php } else { ?>
                <p><?= date('l', $event->event_start) ?>
                <br><?= date('m/d/y', $event->event_start) ?>
                <br><?= $event->time_txt ?></p>
              <?php } ?>
            </div>
            <div class="one-half">
              <h3 class="sr-only">Where:</h3>
              <p><?= $event->venue ?>
              <br><?= $event->address['address-1'] ?>
              <?php if (!empty($event->address['address-2'])): ?>
                <br><?= $event->address['address-2'] ?>
              <?php endif; ?>
              <br><?= $event->address['city'] ?>, <?= $event->address['state'] ?> <?= $event->address['zip'] ?>
              </p>
            </div>
          </div>

        </div>
        <div class="entry-content user-content">
          <?= $event->body ?>
        </div>

        <?php if ($event->registration_url) { ?>
          <a href="<?= $event->registration_url ?>" class="btn registration-link">RSVP</a>
        <?php } ?>

      </main>

      <aside>
        <?php get_template_part('templates/share'); ?>
      </aside>

      <a href="news-events" class="back-to-list">Back to list</a>

    </article>

  </div>

</div>