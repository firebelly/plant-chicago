<?php
/**
 * Various media functions
 */

namespace Firebelly\Media;

// image size for popout thumbs
add_image_size( 'popout-thumb', 360, 360, ['center', 'top'] );

/**
 * Get thumbnail image for post
 * @param  integer $post_id
 * @return string image URL
 */
function get_post_thumbnail($post_id, $size='medium') {
  $return = false;
  if (has_post_thumbnail($post_id)) {
    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
    $return = $thumb[0];
  }
  return $return;
}

/**
 * Get header bg for post, duotone treated with the random IHC_BACKGROUND + Dark Blue  
 * @param  string|object   $post_or_image (WP post object or background image)
 * @return HTML            background image code
 */
function get_header_bg($post_or_image, $thumb_id='', $options=[]) {

  $defaults = ['color' => PAGE_COLOR, 'size'=>'full' ];
  $options = wp_parse_args($options,$defaults);
  $color = $options['color'];
  $size = $options['size'];

  $header_bg = $background_image = false;
  // If WP post object, get the featured image
  if (is_object($post_or_image)) {
    if (has_post_thumbnail($post_or_image->ID)) {
      $thumb_id = get_post_thumbnail_id($post_or_image->ID);
      $background_image = wp_get_attachment_image_src($thumb_id, $size)[0];
    }
  } else {
    // These are sent from a taxonomy page
    $background_image = $post_or_image;
  }
  if ($background_image) {
    $upload_dir = wp_upload_dir();
    $base_dir = $upload_dir['basedir'] . '/backgrounds/';

    // Build treated filename with thumb_id in case there are filename conflicts
    $treated_filename = preg_replace("/.+\/(.+)\.(\w{2,5})$/", $thumb_id."-$1-".$color.".$2", $background_image);
    $treated_image = $base_dir . $treated_filename;
  
    // If treated file doesn't exist, create it
    if (!file_exists($treated_image)) {

      // If the background directory doesn't exist, create it first
      if(!file_exists($base_dir)) {
        mkdir($base_dir);
      }
      $convert_command = (WP_ENV==='development') ? '/usr/local/bin/convert' : '/usr/bin/convert';
      exec($convert_command.' '.$background_image.' +profile "*" -quality 65 -modulate 100,0 -size 256x1! gradient:#414141-#'.$color.' -clut '.$treated_image);
    }    
    $header_bg = ' style="background-image:url(' . $upload_dir['baseurl'] . '/backgrounds/' . $treated_filename . ');"';
  }
  return $header_bg;
}