<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

\Firebelly\Utils\page_color();
?>

<!doctype html>
<!--[if IE 8]> <html class="no-js ie8 lt-ie9 lt-ie10" lang="en"> <![endif]-->
<!--[if IE 9 ]> <html class="no-js ie9 lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MHPK634"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <div class="site-container" role="document">
      <div class="content grid">
        <main class="site-main" role="main">
          <?php include Wrapper\template_path(); ?>
        </main>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
