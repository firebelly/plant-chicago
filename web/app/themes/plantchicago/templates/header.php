<?php 

use Firebelly\Utils;
if (is_front_page()) {
  $header_text = get_post_meta($post->ID, '_cmb2_header_text', true);
} else {
  $header_text = false;
}

if (\Firebelly\Utils\is_top_level_page($post)) {
  $background_page = get_page_by_path('news-events');
} else {
  $background_page = $post;
}
$header_bg = \Firebelly\Media\get_header_bg($background_page, ['color' => PAGE_COLOR]);

?>

<header class="site-header" role="banner" <?= $header_bg ?>>
  <div class="site-grid grid">

    <div class="main-column-left">
      <h1 class="site-title"><a href="<?= esc_url(home_url('/')); ?>"><svg class="icon icon-logo"><use xlink:href="#icon-logo"/></svg><span class="sr-only"><?php bloginfo('name'); ?></span></a></h1>
    </div>

    <div class="main-column-right">
      <nav class="site-nav" role="navigation">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
        endif;
        ?>
        <button class="search-toggle"><svg class="icon icon-search"><use xlink:href="#icon-search"></svg></button>
        <?php get_search_form(); ?>

        <svg class="header-pattern">
          <rect x="0" y="0" width="100%" height="36" fill="url(#footerPattern)">
        </svg>
      </nav>
      <button type="button" class="nav-toggle" aria-label="toggle navigation">
        <span class="nav-label">Menu</span>
        <span class="nav-svg">
          <span class="dots"></span>
          <svg width="50" height="50" version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
          viewBox="0 524.5 2000 2000.5" enable-background="new 0 524.5 2000 2000.5" xml:space="preserve">

            <path class="x" fill="none" stroke="#000000" stroke-miterlimit="10" d="M1410.5,1235.2H589.3"/>

            <path class="x" fill="none" stroke="#000000" stroke-miterlimit="10" d="M1410.5,1815H589.3"/>

            <path class="yy" fill="none" stroke="#000000" stroke-miterlimit="10" d="M1410.5,1524.7c0,0-821.2,0-821.2,0c-211.3,0-260,98-218.2,217.6
            l0,0.1c90.1,260.7,337.6,447.9,628.9,447.9c367.4,0,665.2-297.8,665.2-665.2c0-79-13.8-154.8-39.1-225.2"/>

            <path class="yy" fill="none" stroke="#000000" stroke-miterlimit="10" d="M589.3,1524.7c0,0,821.2,0,821.2,0c211.3,0,260-98,218.2-217.6l0-0.1
            c-90.1-260.7-337.6-447.9-628.9-447.9c-367.4,0-665.2,297.8-665.2,665.2c0,79,13.8,154.8,39.1,225.2"/>
          </svg>
        </span>
      </button>

      <?php if ($header_text) { ?>
        <div class="header-text">
          <?= apply_filters('the_content', $header_text); ?>
        </div>
      <?php } ?>
    </div>

  </div>
</header>
