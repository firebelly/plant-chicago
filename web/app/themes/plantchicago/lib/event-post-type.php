<?php
/**
 * Event post type
 */

namespace Firebelly\PostTypes\Event;

// Custom image size for post type?
// add_image_size( 'event-thumb', 350, null, null );

/**
 * Register Custom Post Type
 */
function post_type() {

  $labels = array(
    'name'                => 'Events',
    'singular_name'       => 'Event',
    'menu_name'           => 'Events',
    'parent_item_colon'   => '',
    'all_items'           => 'All Events',
    'view_item'           => 'View Event',
    'add_new_item'        => 'Add New Event',
    'add_new'             => 'Add New',
    'edit_item'           => 'Edit Event',
    'update_item'         => 'Update Event',
    'search_items'        => 'Search Events',
    'not_found'           => 'Not found',
    'not_found_in_trash'  => 'Not found in Trash',
  );
  $rewrite = array(
    'slug'                => 'events',
    'with_front'          => false,
    'pages'               => true,
    'feeds'               => true,
  );
  $args = array(
    'label'               => 'event',
    'description'         => 'Events',
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'thumbnail', ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 20,
    'menu_icon'           => 'dashicons-admin-post',
    'can_export'          => false,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'rewrite'             => $rewrite,
    'capability_type'     => 'event',
    'map_meta_cap'        => true
  );
  register_post_type( 'event', $args );

}
add_action( 'init', __NAMESPACE__ . '\post_type', 0 );

/**
 * Add capabilities to control permissions of Post Type via roles
 */
function add_capabilities() {
  $role_admin = get_role('administrator');
  $role_admin->add_cap('edit_event');
  $role_admin->add_cap('read_event');
  $role_admin->add_cap('delete_event');
  $role_admin->add_cap('edit_events');
  $role_admin->add_cap('edit_others_events');
  $role_admin->add_cap('publish_events');
  $role_admin->add_cap('read_private_events');
  $role_admin->add_cap('delete_events');
  $role_admin->add_cap('delete_private_events');
  $role_admin->add_cap('delete_published_events');
  $role_admin->add_cap('delete_others_events');
  $role_admin->add_cap('edit_private_events');
  $role_admin->add_cap('edit_published_events');
  $role_admin->add_cap('create_events');
}
add_action('switch_theme', __NAMESPACE__ . 'add_capabilities');

/**
 * Custom admin columns for post type
 */
function edit_columns($columns){
  $columns = array(
    'cb' => '<input type="checkbox" />',
    'title' => 'Title',
    'event_dates' => 'Date',
    '_cmb2_venue' => 'Venue',
  );
  return $columns;
}
add_filter('manage_event_posts_columns', __NAMESPACE__ . '\edit_columns');

function custom_columns($column){
  global $post;
  if ( $post->post_type == 'event' ) {
    $custom = get_post_custom();
    if ( $column == 'featured_image' )
      echo the_post_thumbnail( 'event-thumb' );
    elseif ( $column == 'event_dates' ) {
      $timestamp_start = $custom['_cmb2_event_start'][0];
      $timestamp_end = !empty($custom['_cmb2_event_end'][0]) ? $custom['_cmb2_event_end'][0] : $timestamp_start;
      if ($timestamp_end != $timestamp_start) {
        $date_txt = date('m/d/Y g:iA', $timestamp_start) . ' – ' . date('m/d/Y g:iA', $timestamp_end);
      } else {
        $date_txt = date('m/d/Y g:iA', $timestamp_start);
      }
      echo $date_txt . ($timestamp_end < current_time('timestamp') ? ' - <strong class="post-state">Past Event</strong>' : '');
    } else {
      if (array_key_exists($column, $custom))
        echo $custom[$column][0];
    }
  }
}
add_action('manage_posts_custom_column',  __NAMESPACE__ . '\custom_columns');

/**
 * CMB2 custom fields
 */
function metaboxes( array $meta_boxes ) {
  $prefix = '_cmb2_'; // Start with underscore to hide from custom fields list

  $meta_boxes['event_summary'] = array(
    'id'            => 'event_summary',
    'title'         => __( 'Event Summary', 'cmb2' ),
    'object_types'  => array( 'event', ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'required'      => 'required',
    'show_names'    => false, // Show field names on the left
    'fields'        => array(
      array(
          'name'    => 'Summary',
          'id'      => $prefix . 'event_summary',
          'type'    => 'textarea',
      )
    ),
  );

  $meta_boxes['event_when'] = array(
    'id'            => 'event_when',
    'title'         => __( 'Event When', 'cmb2' ),
    'object_types'  => array( 'event', ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'required'      => 'required',
    'show_names'    => true, // Show field names on the left
    'fields'        => array(
      array(
          'name'    => 'Start Date',
          'id'      => $prefix . 'event_start',
          'type'    => 'text_datetime_timestamp',
      ),
      array(
          'name'    => 'End Date',
          'desc'    => 'This must be filled — if a single day event, choose the same date as the start date.',
          'id'      => $prefix . 'event_end',
          'type'    => 'text_datetime_timestamp',
      ),
    ),
  );

  $meta_boxes['event_where'] = array(
    'id'            => 'event_where',
    'title'         => __( 'Event Where', 'cmb2' ),
    'object_types'  => array( 'event', ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
    'fields'        => array(
      array(
          'name'    => 'Venue',
          'id'      => $prefix . 'venue',
          'type'    => 'text',
      ),
      array(
          'name'    => 'Address',
          'id'      => $prefix . 'address',
          'type'    => 'address',
      ),
      // array(
      //     'name'    => 'Lat',
      //     'id'      => $prefix . 'lat',
      //     'type'    => 'text_small',
      // ),
      // array(
      //     'name'    => 'Lng',
      //     'id'      => $prefix . 'lng',
      //     'type'    => 'text_small',
      // ),
    ),
  );

  $meta_boxes['event_registration'] = array(
    'id'            => 'event_registration',
    'title'         => __( 'Event Registration', 'cmb2' ),
    'object_types'  => array( 'event', ), // Post type
    'context'       => 'normal',
    'priority'      => 'high',
    'show_names'    => true, // Show field names on the left
    'fields'        => array(
      array(
          'name'    => 'Price',
          'id'      => $prefix . 'price',
          'type'    => 'text',
      ),
      array(
          'name'    => 'Registration Link',
          'id'      => $prefix . 'registration_url',
          'type'    => 'text',
      )
    ),
  );

  return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', __NAMESPACE__ . '\metaboxes' );

/**
 * Get Events
 */
function get_events($options=[]) {
  if (empty($options['num_posts'])) $options['num_posts'] = get_option('posts_per_page');
  if (!empty($_REQUEST['past_events'])) $options['past_events'] = 1;
  $args = [
    'numberposts' => $options['num_posts'],
    'post_type' => 'event',
    'meta_key' => '_cmb2_event_start',
    'orderby' => 'meta_value_num',
  ];
  // Make sure we're only pulling upcoming or past events
  $args['order'] = !empty($options['past_events']) ? 'DESC' : 'ASC';
  $args['meta_query'] = [
    [
      'key' => '_cmb2_event_end',
      'value' => current_time('timestamp'),
      'compare' => (!empty($options['past_events']) ? '<=' : '>')
    ]
  ];

  // Display all matching events using article-event.php
  $event_posts = get_posts($args);
  if (!$event_posts) return false;
  $output = '';
  foreach ($event_posts as $event_post):
    ob_start();
    include(locate_template('templates/article-event.php'));
    $output .= ob_get_clean();
  endforeach;
  return $output;
}

/**
 * Geocode address for event and save in custom fields
 */
function geocode_address($post_id, $post='') {
  $address = get_post_meta($post_id, '_cmb2_address', 1);
  $address = wp_parse_args($address, array(
      'address-1' => '',
      'address-2' => '',
      'city'      => '',
      'state'     => '',
      'zip'       => '',
   ));

  if (!empty($address['address-1'])):
    $address_combined = $address['address-1'] . ' ' . $address['address-1'] . ' ' . $address['city'] . ', ' . $address['state'] . ' ' . $address['zip'];
    $request_url = "http://maps.google.com/maps/api/geocode/xml?sensor=false&address=" . urlencode($address_combined);

    $xml = simplexml_load_file($request_url);
    $status = $xml->status;
    if(strcmp($status, 'OK')===0):
        $lat = $xml->result->geometry->location->lat;
        $lng = $xml->result->geometry->location->lng;
        update_post_meta($post_id, '_cmb2_lat', (string)$lat);
        update_post_meta($post_id, '_cmb2_lng', (string)$lng);
    endif;
  endif;
}
add_action('save_post_event', __NAMESPACE__ . '\\geocode_address', 20, 2);

/**
 * Add query vars for events
 */
function add_query_vars_filter($vars){
  $vars[] = "past_events";
  return $vars;
}
add_filter( 'query_vars', __NAMESPACE__ . '\\add_query_vars_filter' );

/**
 * Helper function to populate event object for listings & single view
 */
function get_event_details($post) {
  $event = [
    'ID' => $post->ID,
    'title' => $post->post_title,
    'body' => apply_filters('the_content', $post->post_content),
    'price' => get_post_meta($post->ID, '_cmb2_price', true),
    'event_summary' => get_post_meta($post->ID, '_cmb2_event_summary', true),
    'event_start' => get_post_meta($post->ID, '_cmb2_event_start', true),
    'event_end' => get_post_meta( $post->ID, '_cmb2_event_end', true),
    'venue' => get_post_meta($post->ID, '_cmb2_venue', true),
    'lat' => get_post_meta($post->ID, '_cmb2_lat', true),
    'lng' => get_post_meta($post->ID, '_cmb2_lng', true),
    'registration_url' => get_post_meta($post->ID, '_cmb2_registration_url', true),
  ];
  // Is this event multiple days?
  $event['multiple_days'] = (date('Y-m-d', $event['event_start']) != date('Y-m-d', $event['event_end']));
  $event['start_time'] = date('g:iA', $event['event_start']);
  $event['end_time'] = date('g:iA', $event['event_end']);
  if ($event['start_time'] != $event['end_time']) {
    $event['time_txt'] = $event['start_time'] . '–' . $event['end_time'];
  } else {
    $event['time_txt'] = $event['start_time'];
  }
  
  $event['archived'] = empty($event['event_end']) ? ($event['event_start'] < current_time('timestamp')) : ($event['event_end'] < current_time('timestamp'));
  $event['desc'] = date('M d, Y @ ', $event['event_start']) . $event['time_txt']; // used in map pins
  $event['year'] = date('Y', $event['event_start']);

  $address = get_post_meta($post->ID, '_cmb2_address', true);
  $event['address'] = wp_parse_args($address, array(
      'address-1' => '',
      'address-2' => '',
      'city'      => '',
      'state'     => '',
      'zip'       => '',
   ));
  return (object)$event;
}