<?php
$event = \Firebelly\PostTypes\Event\get_event_details($post);
$with_image_class = (has_post_thumbnail($post->ID)) ? 'with-image' : '';
?>
<article class="post event map-point" data-lat="<?= $event->lat ?>" data-lng="<?= $event->lng ?>" data-title="<?= $event->title ?>" data-desc="<?= $event->desc ?>" data-id="<?= $event->ID ?>">
  <main>
    <time class="article-date flagged" datetime="<?= date('c', $event->event_start); ?>">
    <?php if (date('Y-m-d', $event->event_start) != date('Y-m-d', $event->event_end)) { ?>
      <span class="month event-start"><?= date('M d', $event->event_start) ?></span>
      <span class="month event-end"><?= date('M d', $event->event_end) ?></span>
    <?php } else { ?>
      <span class="month"><?= date('M', $event->event_start) ?></span> <span class="day"><?= date('d', $event->event_start) ?></span> <?= ($event->year == date('Y') ? ' <span class="year">'.$event->year.'</span>' : '') ?>
    <?php } ?>
    </time>
    <?php if ($thumb = \Firebelly\Media\get_post_thumbnail($post->ID, 'large')): ?>
      <div class="article-thumb" style="background-image:url(<?= $thumb ?>);"></div>
    <?php endif; ?>
    <div class="post-inner">
      <header class="no-header-text <?= $with_image_class ?>">
        <h1 class="article-title"><span><?= $post->post_title ?></span></h1>
      </header>
      <div class="entry-content user-content">
        <?= $event->body ?>
      </div>
      <footer>
        <?php get_template_part('templates/share'); ?>
      </footer>
    </div>

  </main>

  <aside class="main">
    <h2 class="flag">Event Details</h2>
    <div id="map"></div>
    <div class="event-details">
      <h3>When:</h3>

      <?php if ($event->multiple_days) { ?>
        <p><?= date('l, F j, Y', $event->event_start) ?>
        <br><em>through</em>
        <br><?= date('l, F j, Y', $event->event_end) ?></p>
        <p><?= $event->time_txt ?> Daily</p>
      <?php } else { ?>
        <p><?= date('l, F j, Y', $event->event_start) ?>
        <br><?= $event->time_txt ?></p>
      <?php } ?>

      <h3>Where:</h3>
      <p><?= $event->venue ?>
      <br><?= $event->address['address-1'] ?>
      <?php if (!empty($event->address['address-2'])): ?>
        <br><?= $event->address['address-2'] ?>
      <?php endif; ?>
      <br><?= $event->address['city'] ?>, <?= $event->address['state'] ?> <?= $event->address['zip'] ?>
      </p>

    </div>
    
  </aside>
</article>