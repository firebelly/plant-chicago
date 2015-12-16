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

  $meta_boxes['learning_bottom_content_metabox'] = array(
    'id'            => 'learning_bottom_content_metabox',
    'title'         => __( 'Page Bottom Content', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'show_on'       => array( 'key' => 'id', 'value' => 13 ), // Only show on 'Hands-on Learning' page
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

  $meta_boxes['support_bottom_content_metabox'] = array(
    'id'            => 'support_bottom_content_metabox',
    'title'         => __( 'Page Bottom Content', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'show_on'       => array( 'key' => 'id', 'value' => 16 ), // Only show on 'Support Our Work' page
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

  $meta_boxes['tour_middle_content_metabox'] = array(
    'id'            => 'tour_middle_content_metabox',
    'title'         => __( 'Page Middle Content', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'show_on'       => array( 'key' => 'id', 'value' => 10 ), // Only show on 'Tour' page
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
    'fields'        => array(
      
      // General page fields
      array(
        'name' => 'Middle Content Title',
        'desc' => 'Shows up on the side',
        'id'   => $prefix . 'middle_title',
        'type' => 'text',
      ),
      array(
        'name' => 'Middle Content',
        'desc' => 'Shows up on the side',
        'id'   => $prefix . 'middle_content',
        'type' => 'wysiwyg',
      ),
    ),
  );

  /**
   * Repeating Tech Demo Project blocks for the Tours page
   */
  $cmb_group = new_cmb2_box( array(
    'id'           => $prefix . 'metabox',
    'title'        => __( 'Current Tech Demo Projects', 'cmb2' ),
    'show_on'       => array( 'key' => 'id', 'value' => 10 ), // Only show on 'Tour' page
    'priority'      => 'low',
    'object_types' => array( 'page', ),
  ) );

  $group_field_id = $cmb_group->add_field( array(
    'id'          => $prefix . 'tech_demo_project_blocks',
    'type'        => 'group',
    'description' => __( 'The current tech demo projects — you can add and remove them', 'cmb' ),
    'options'     => array(
        'group_title'   => __( 'Project {#}', 'cmb' ),
        'add_button'    => __( 'Add Another Project', 'cmb' ),
        'remove_button' => __( 'Remove Project', 'cmb' ),
        'sortable'      => true, // beta
    ),
  ) );

  $cmb_group->add_group_field( $group_field_id, array(
    'name' => 'Project Name',
    'id'   => 'project_name',
    'type' => 'text',
  ) );

  $cmb_group->add_group_field( $group_field_id, array(
    'name' => 'Project Description Paragraph',
    'desc' => 'A short paragraph describing the project',
    'id'   => 'project_description',
    'type' => 'wysiwyg',
    'options' => array(
      'textarea_rows' => 4,
    ),
  ) );

  return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', __NAMESPACE__ . '\metaboxes' );

/**
 * Get Project Blocks
 */
function get_project_blocks($post) {
  $output = '';
  $project_blocks = get_post_meta($post->ID, '_cmb2_tech_demo_project_blocks', true);
  if ($project_blocks) {
    foreach ($project_blocks as $project_block) {
      $output .= '<div class="project">';

      $output .= '<h3>'.$project_block['project_name'].'</h3>';
      $output .= '<p>'.$project_block['project_description'].'</p>';

      $output .= '</div>';
    }
  }
  return $output;
}