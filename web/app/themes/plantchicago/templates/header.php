<?php 

$header_bg = \Firebelly\Media\get_header_bg($post);

?>

<header class="site-header" role="banner" <?= $header_bg ?>>
  <div class="container">
    <h1 class="site-title"><a href="<?= esc_url(home_url('/')); ?>"><svg class="icon icon-logo"><use xlink:href="#icon-logo"/></svg><span class="sr-only"><?php bloginfo('name'); ?></span></a></h1>
    <nav class="site-nav" role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
  </div>
</header>
