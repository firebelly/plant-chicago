<?php
/**
 * Template Name: Tour
 */

  use Firebelly\Utils;
  $intro_title_left = get_post_meta($post->ID, '_cmb2_intro_title_left', true);
  $intro_content_left = get_post_meta($post->ID, '_cmb2_intro_content_left', true);
  $intro_title_right = get_post_meta($post->ID, '_cmb2_intro_title_right', true);
  $intro_content_right = get_post_meta($post->ID, '_cmb2_intro_content_right', true);
  // Middle content areas
  $middle_title = get_post_meta($post->ID, '_cmb2_middle_title', true);
  $middle_content = get_post_meta($post->ID, '_cmb2_middle_content', true);
?>

<div class="site-grid grid">
  <div class="main-gutter main-column-left -top">
    <div class="header-gutter-icons">
      <svg class="icon icon-community"><use xlink:href="#icon-community"></svg>
      <svg class="icon icon-energy"><use xlink:href="#icon-energy"></svg>
      <svg class="icon icon-community"><use xlink:href="#icon-community"></svg>
      <svg class="icon icon-energy"><use xlink:href="#icon-energy"></svg>
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

<?php if (!empty($middle_content)) { ?>
  <div class="visit-section middle-content secondary-content site-grid grid">

    <div class="main-gutter main-column-left"><svg class="icon icon-energy"><use xlink:href="#icon-energy"></svg></div>

    <div class="main-column-right grid">
      
      <div class="content-left flex-item one-half">

        <?= !empty($middle_title) ? '<h2>' . $middle_title . '</h2>' : ''; ?>
        <div class="user-content">
          <?php if ($middle_content) { echo apply_filters('the_content', $middle_content); } ?>
        </div>

      </div>

      <div class="content-right flex-item one-half">
        
        <div class="user-content">

        </div>

      </div>

    </div>

  </div>
<?php } ?>

  <div class="projects-section bottom-content secondary-content site-grid grid">

    <div class="main-gutter main-column-left"><svg class="icon icon-energy"><use xlink:href="#icon-energy"></svg></div>

    <div class="main-column-right">

      <h2>current tech demonstration projects</h2>
      
      <div class="project-list grid row">

        <?= \Firebelly\PostTypes\Pages\get_project_blocks($post); ?>

      </div>

    </div>

  </div>
