<?php
/**
 * Template Name: Support
 */

  use Firebelly\Utils;
  $intro_title_left = get_post_meta($post->ID, '_cmb2_intro_title_left', true);
  $intro_content_left = get_post_meta($post->ID, '_cmb2_intro_content_left', true);
  $intro_title_right = get_post_meta($post->ID, '_cmb2_intro_title_right', true);
  $intro_content_right = get_post_meta($post->ID, '_cmb2_intro_content_right', true);
  // Bottom content areas
  $bottom_title_left = get_post_meta($post->ID, '_cmb2_bottom_title_left', true);
  $bottom_content_left = get_post_meta($post->ID, '_cmb2_bottom_content_left', true);
  $bottom_title_right = get_post_meta($post->ID, '_cmb2_bottom_title_right', true);
  $bottom_content_right = get_post_meta($post->ID, '_cmb2_bottom_content_right', true);
?>

<div class="site-grid grid">
  <div class="main-gutter main-column-left -top">
    <div class="header-gutter-icons">
      <svg class="icon icon-community"><use xlink:href="#icon-community"></svg>
      <svg class="icon icon-city"><use xlink:href="#icon-city"></svg>
      <svg class="icon icon-community"><use xlink:href="#icon-community"></svg>
      <svg class="icon icon-city"><use xlink:href="#icon-city"></svg>
    </div>
  </div>

  <div class="main-column-right -top grid">

    <div class="row intro-text">
      <?php get_template_part('templates/page', 'header'); ?>
      <?= apply_filters('the_content', $post->post_content); ?>
    </div>

  </div>

</div>

<?php if (!empty($intro_content_left) || !empty($intro_content_right)) { ?>
  <div class="intro-section secondary-content site-grid grid">

    <div class="main-gutter main-column-left"><svg class="icon icon-city"><use xlink:href="#icon-city"></svg></div>

    <div class="main-column-right grid">
      
      <div class="content-left flex-item one-half">

        <?= !empty($intro_title_left) ? '<h2>' . $intro_title_left . '</h2>' : ''; ?>
        <div class="user-content">
          <?php if ($intro_content_left) { echo apply_filters('the_content', $intro_content_left); } ?>
        </div>

      </div>

      <div class="content-right flex-item one-half">
        
        <?php if ($intro_content_right) { ?>
          <div class="stat">
            <div class="stat-content">          
              <?= !empty($intro_title_right) ? '<h3>' . $intro_title_right . '</h3>' : ''; ?>
              <?= apply_filters('the_content', $intro_content_right); ?>
            </div>
          </div>
        <?php } ?>

      </div>

    </div>

  </div>
<?php } ?>

<?php if (!empty($bottom_content_left) || !empty($bottom_content_right)) { ?>
  <div class="bottom-content emphasized-section secondary-content site-grid grid">

    <div class="main-gutter main-column-left"><svg class="icon icon-city"><use xlink:href="#icon-city"></svg></div>

    <div class="main-column-right grid">
      
      <div class="content-left flex-item one-half">

        <?= !empty($bottom_title_left) ? '<h2>' . $bottom_title_left . '</h2>' : ''; ?>
        <div class="user-content">
          <?php if ($bottom_content_left) { echo apply_filters('the_content', $bottom_content_left); } ?>
        </div>

      </div>

      <div class="content-right flex-item one-half">
        
        <?= !empty($bottom_title_right) ? '<h2>' . $bottom_title_right . '</h2>' : ''; ?>
        <div class="user-content">
          <?php if ($bottom_content_right) { echo apply_filters('the_content', $bottom_content_right); } ?>
        </div>

      </div>

    </div>

  </div>
<?php } ?>