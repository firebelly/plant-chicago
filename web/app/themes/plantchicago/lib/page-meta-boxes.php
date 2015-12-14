<?php
/**
 * Extra fields for Pages
 */

namespace Firebelly\PostTypes\Pages;

// Custom CMB2 fields for post type
function metaboxes( array $meta_boxes ) {
  $prefix = '_cmb2_'; // Start with underscore to hide from custom fields list

  $meta_boxes['page_metabox'] = array(
    'id'            => 'page_metabox',
    'title'         => __( 'Extra Fields', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
    'fields'        => array(
      
      // General page fields
      array(
        'name' => 'Header Text',
        'desc' => 'Text that appears on top of the big image in the header',
        'id'   => $prefix . 'header_text',
        'type' => 'wysiwyg',
      ),
    ),
  );

  $meta_boxes['intro_content_metabox'] = array(
    'id'            => 'intro_content_metabox',
    'title'         => __( 'Page Intro Content', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
    'fields'        => array(
      
      // General page fields
      array(
        'name' => 'Intro Content Left Title',
        'desc' => 'Shows up on the left side',
        'id'   => $prefix . 'intro_title_left',
        'type' => 'text',
      ),
      array(
        'name' => 'Intro Content Left',
        'desc' => 'Shows up on the left side',
        'id'   => $prefix . 'intro_content_left',
        'type' => 'wysiwyg',
      ),
      array(
        'name' => 'Intro Content Right Title',
        'desc' => 'Shows up on the right side',
        'id'   => $prefix . 'intro_title_right',
        'type' => 'text',
      ),
      array(
        'name' => 'Intro Content Right',
        'desc' => 'Shows up on the right side',
        'id'   => $prefix . 'intro_content_right',
        'type' => 'wysiwyg',
      ),
    ),
  );

  $meta_boxes['who_we_are_bottom_content_metabox'] = array(
    'id'            => 'who_we_are_bottom_content_metabox',
    'title'         => __( 'Page Bottom Content', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'show_on'       => array( 'key' => 'id', 'value' => 6 ), // Only show on 'Who We Are' page
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
    'fields'        => array(
      
      // General page fields
      array(
        'name' => 'Bottom Content Left Title',
        'desc' => 'Shows up on the left side',
        'id'   => $prefix . 'bottom_title_left',
        'type' => 'text',
      ),
      array(
        'name' => 'Bottom Content Left',
        'desc' => 'Shows up on the left side',
        'id'   => $prefix . 'bottom_content_left',
        'type' => 'wysiwyg',
      ),
      array(
        'name' => 'Bottom Content Right Title',
        'desc' => 'Shows up on the right side',
        'id'   => $prefix . 'bottom_title_right',
        'type' => 'text',
      ),
      array(
        'name' => 'Bottom Content Right',
        'desc' => 'Shows up on the right side',
        'id'   => $prefix . 'bottom_content_right',
        'type' => 'wysiwyg',
      ),
    ),
  );

  return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', __NAMESPACE__ . '\metaboxes' );