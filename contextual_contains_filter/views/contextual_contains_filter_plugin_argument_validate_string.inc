<?php

/**
 * @file
 * Contains the alphabetic argument string validator plugin.
 */

/**
 * Validate whether an argument is a string.
 *
 * @ingroup views_argument_validate_plugins
 */
class contextual_contains_filter_plugin_argument_validate_string extends views_plugin_argument_validate {

  function validate_argument($argument) {
    return check_plain($argument);
  }
}
