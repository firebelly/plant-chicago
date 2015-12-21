<?php
/**
 * Template Name: Who We Are
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
      <svg class="icon icon-land"><use xlink:href="#icon-land"></svg>
      <svg class="icon icon-factory"><use xlink:href="#icon-factory"></svg>
      <svg class="icon icon-land"><use xlink:href="#icon-land"></svg>
      <svg class="icon icon-factory"><use xlink:href="#icon-factory"></svg>
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

<div class="people-section site-grid grid">

  <div class="global-overlay"></div>
  <div class="active-person-container site-grid grid">
    <div class="main-gutter main-column-left"></div>
    <div class="-column-right">
      <div class="post-nav">
        <div class="previous previous-person"><span class="arrow-wrap"><span class="arrow -long -left"></span></span><span class="text">Previous</span></div>
        <div class="next next-person"><span class="arrow-wrap"><span class="arrow -long"></span></span><span class="text">Next</span></div>
      </div>
      <button class="person-deactivate person-toggle x-button"><div class="x"></div></button>
      <div class="row">
        <h2 class="active-person-header">Staff: Details</h2>
        <div class="person-data-container">

        </div>
      </div>
    </div>
  </div>

  <div class="main-gutter main-column-left"><svg class="icon icon-factory"><use xlink:href="#icon-factory"></svg></div>

  <div class="main-column-right">

    <div class="row staff">
      <h2>Staff</h2>    
      <?= \Firebelly\PostTypes\Person\get_people(['member_type' => 'staff']); ?>
    </div>

    <div class="row board">
      <h2>Board of Directors</h2>    
      <?= \Firebelly\PostTypes\Person\get_people(['member_type' => 'board']); ?>
    </div>

  </div>

</div>

<?php if (!empty($bottom_content_left) || !empty($bottom_content_right)) { ?>
  <div class="bottom-content secondary-content site-grid grid">

    <div class="main-gutter main-column-left"><svg class="icon icon-factory"><use xlink:href="#icon-factory"></svg></div>

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