<?php
/**
 * Template Name: Farmers Market
 */

  use Firebelly\Utils;
  $intro_title_left = get_post_meta($post->ID, '_cmb2_intro_title_left', true);
  $intro_content_left = get_post_meta($post->ID, '_cmb2_intro_content_left', true);
  $intro_title_right = get_post_meta($post->ID, '_cmb2_intro_title_right', true);
  $intro_content_right = get_post_meta($post->ID, '_cmb2_intro_content_right', true);
?>

<div class="site-grid grid">
  <div class="main-gutter main-column-left -top">
    <div class="header-gutter-icons">
      <svg class="icon icon-community"><use xlink:href="#icon-community"></svg>
      <svg class="icon icon-market"><use xlink:href="#icon-market"></svg>
      <svg class="icon icon-community"><use xlink:href="#icon-community"></svg>
      <svg class="icon icon-market"><use xlink:href="#icon-market"></svg>
    </div>
  </div>

  <div class="main-column-right -top grid">

    <?php while (have_posts()) : the_post(); ?>
      <div class="row intro-text">
        <?php get_template_part('templates/page', 'header'); ?>
        <?php get_template_part('templates/content', 'page'); ?>
      </div>
    <?php endwhile; ?>

  </div>

</div>

<?php if (!empty($intro_content_left) || !empty($intro_content_right)) { ?>
  <div class="intro-section secondary-content site-grid grid">

    <div class="main-gutter main-column-left"></div>

    <div class="main-column-right grid">
      
      <div class="content-left flex-item one-half">

        <?= !empty($intro_title_left) ? '<h2>' . $intro_title_left . '</h2>' : ''; ?>
        <div class="user-content">
          <?php if ($intro_content_left) { echo apply_filters('the_content', $intro_content_left); } ?>
        </div>

      </div>

      <div class="content-right flex-item one-half">
        
        <?= !empty($intro_title_right) ? '<h2>' . $intro_title_right . '</h2>' : ''; ?>
        <div class="user-content">
          <?php if ($intro_content_right) { echo apply_filters('the_content', $intro_content_right); } ?>
        </div>

      </div>

    </div>

  </div>
<?php } ?>