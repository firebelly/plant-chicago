<?php 
$event = \Firebelly\PostTypes\Event\get_event_details($event_post);
$event_url = get_permalink($event_post);
?>
<article class="event bigclicky"  data-url="<?= $event_url ?>" data-lat="<?= $event->lat ?>" data-lng="<?= $event->lng ?>" data-title="<?= $event->title ?>" data-desc="<?= $event->desc ?>" data-id="<?= $event->ID ?>">
  <div class="article-content">
    <time class="article-date" datetime="<?= date('c', $event->event_start); ?>">
      <span class="-inner">      
        <span class="day"><?= date('D', $event->event_start) ?></span> 
        <span class="date"><?= date('d/m/y', $event->event_start) ?></span>
        <span class="time"><?= date('g:iA', $event->event_start) ?></span>
      </span>
    </time>
    <div class="article-content-wrap"> 
      <h1 class="article-title"><a href="<?= $event_url ?>"><?= $event->title ?></a></h1>
      <p class="event-summary"><?= $event->event_summary ?></p>
      <?php if (!empty($show_view_all_button)): ?><p class="view-all"><a class="button" href="/news-events/">View All Events</a></p><?php endif; ?>
    </div>
  </div>
</article>