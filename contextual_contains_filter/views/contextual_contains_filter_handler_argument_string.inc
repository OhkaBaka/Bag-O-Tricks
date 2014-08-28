<?php

/**
 * @file
 * Definition of contextual_contains_filter_handler_argument_string.
 */

/**
 * Argument handler to implement contains arguments.
 *
 * @ingroup views_argument_handlers
 */
class contextual_contains_filter_handler_argument_string extends views_handler_argument_string {

  function option_definition() {
    $options = parent::option_definition();
    $options['not'] = array('default' => FALSE, 'bool' => TRUE);
    return $options;
  }

  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);
    $form['more']['#collapsed'] = FALSE;

    $form['break_phrase']['#title'] = t('Allow multiple alphabetic search strings');
    $form['break_phrase']['#description'] = t('If selected, multiple search terms may be specified by stringing them together with plus signs. Example: <strong>this+that</strong>');

    $form['not'] = array(
      '#type' => 'checkbox',
      '#title' => t('Exclude'),
      '#description' => t('Negate the search term. If selected, output matching the specified search term(s) will be excluded, rather than included.'),
      '#default_value' => !empty($this->options['not']),
      '#fieldset' => 'more',
    );
  }

  /**
   * Build the query.
   */
  function query($group_by = FALSE) {
    $argument = $this->argument;

    if (!empty($this->options['break_phrase'])) {
      views_break_phrase_string($argument, $this);
    }
    else {
      $this->value = array($argument);
    }
    $this->ensure_my_table();

    if (!empty($this->definition['many to one'])) {
      if (!empty($this->options['glossary'])) {
        $this->helper->formula = TRUE;
      }
      $this->helper->ensure_my_table();
      $this->helper->add_filter();
      return;
    }

    if (empty($this->options['glossary'])) {
      $field = "$this->table_alias.$this->real_field";
    }
    else {
      $field = $this->get_formula();
    }
    contextual_contains_filter_build_contains_query($this, $field);
  }
}
