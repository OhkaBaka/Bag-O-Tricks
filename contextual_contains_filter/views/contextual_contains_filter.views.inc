<?php
/**
 * @file
 * contextual_contains_filter_views.inc
 *
 * Defines the Contextual Contains Filters plugins and hooks.
 */

/**
 * Implements hook_views_data_alter().
 *
 * Changes argument handlers to corresponding contains argument handlers.
 *
 * This function finds all field and property argument handlers.
 */
function contextual_contains_filter_views_data_alter(&$data) {

  $string_field_names  = array_filter(variable_get('contextual_contains_filter_string_field_names', array()));
  if (!empty($numeric_field_names) || !empty($string_field_names) || !empty($list_field_names)) {

    foreach ($data as $table_name => $table_data) {
      foreach ($table_data as $field_name => $field_data) {
        if (isset($field_data['argument']['handler'])) {
          // If listed on the configuration page, only function if we're working with strings
          $full_name = "$table_name:$field_name";
          if (in_array($full_name, $string_field_names)) {
            $data[$table_name][$field_name]['argument']['handler'] = 'contextual_contains_filter_handler_argument_string';
          }
        }
      }
    }
  }
}

/**
 * Build a LIKE query based on the terms passed in.
 */
function contextual_contains_filter_build_contains_query($views_handler_argument, $field = NULL) {

  if (!isset($views_handler_argument) || $views_handler_argument->value === FALSE) {
    return;
  }
  if (!isset($field)) {
    $field = "$views_handler_argument->table_alias.$views_handler_argument->real_field"; // e.g. field_datafield_price.field_price_value
  }
  $is_not = !empty($views_handler_argument->options['not']); // from "Exclude: tickbox
  $null_check = $is_not ? "OR $field IS NULL" : '';

  // All WHERE clauses are OR-ed or AND-ed together in the same group.
  // Note: NOT (a OR b OR c) == (NOT a) AND (NOT b) AND (NOT c)
  $group = $views_handler_argument->query->set_where_group($is_not ? 'AND' : 'OR');

  foreach ($views_handler_argument->value as $containsthis) {

    $placeholder = $views_handler_argument->placeholder();

    $operator = $is_not ? 'NOT LIKE' : 'LIKE';

    $containsthis= '%'.$containsthis.'%';

    if( preg_match("/_/", $containsthis ) ){
      $containsthis=preg_replace("/_/", "\\\\_", $containsthis );
      $views_handler_argument->query->add_where_expression($group, "$field $operator $placeholder  ESCAPE '\\\\' $null_check", array($placeholder => $containsthis));
    } else {
      $views_handler_argument->query->add_where_expression($group, "$field $operator $placeholder $null_check", array($placeholder => $containsthis));
    }
  }
}

/**
 * Implements hook_field_views_data_alter().
 *
 * Called from field_views_data() (views/modules/field.views.inc), after
 * it sets $data = field_views_field_default_views_data($field).
 * This hook does not include plain properties like 'node:title'.
 *
function contextual_contains_filter_field_views_data_alter(&$data, $field) {
}
 */
