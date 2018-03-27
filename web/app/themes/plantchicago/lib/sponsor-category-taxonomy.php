<?php
/**
 * Sponsor Category taxonomy
 */

namespace Firebelly\PostTypes\SponsorCategory;

/**
 * Add capabilities to control permissions of Taxonomy via roles
 */
function add_capabilities() {
  $role_admin = get_role('administrator');
  $role_admin->add_cap('manage_sponsor_categories');
  $role_admin->add_cap('edit_sponsor_categories');
  $role_admin->add_cap('delete_sponsor_categories');
  $role_admin->add_cap('assign_sponsor_categories');
}
add_action('init', __NAMESPACE__ . '\add_capabilities');

// Custom taxonomy Sponsor Categories
register_taxonomy( 'sponsor_category', 
  array('sponsor'),
  array('hierarchical' => true, // if this is true, it acts like categories
    'labels' => array(
      'name' => 'Sponsor Categories',
      'singular_name' => 'Sponsor Category',
      'search_items' =>  'Search Sponsor Categories',
      'all_items' => 'All Sponsor Categories',
      'parent_item' => 'Parent Sponsor Category',
      'parent_item_colon' => 'Parent Sponsor Category:',
      'edit_item' => 'Edit Sponsor Category',
      'update_item' => 'Update Sponsor Category',
      'add_new_item' => 'Add New Sponsor Category',
      'new_item_name' => 'New Sponsor Category',
    ),
    'show_admin_column' => true, 
    'show_ui' => true,
    'query_var' => true,
    'capabilities' => array(
        'manage_terms' => 'manage_sponsor_categories',
        'edit_terms' => 'edit_sponsor_categories',
        'delete_terms' => 'delete_sponsor_categories',
        'assign_terms' => 'assign_sponsor_categories'
    ),
    'rewrite' => array( 
      'slug' => 'sponsor-category',
      'with_front' => false 
    ),
  )
);
