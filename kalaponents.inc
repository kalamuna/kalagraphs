<?php

/**
 * @file
 * Utility functions to support Kalaponents functionality.
 */

/**
 * Reverts the "Kalaponent" Paragraphs bundle's fields to default state.
 */
function _kalaponents_revert_fields() {
  module_load_include('field.inc', 'kalaponents');

  // Revert the field bases.
  foreach (_kalaponents_field_bases() as $name => $base) {

    // See if the field base already exists.
    $operation = field_info_field($name)
      ? 'field_update_field'
      : 'field_create_field';

    // Create or update the field base.
    $operation($base);
  }

  // Revert the field instances.
  foreach (_kalaponents_field_instances() as $instance) {

    // Although Features is the preferred method for generating the field export
    // code, it can also be done via Bundle Copy. The latter adds an extra
    // nested array in the field instance info that must be removed here.
    if (count($instance) === 1) {
      $instance = reset($instance);
    }

    // See if the field instance already exists.
    $name      = $instance['field_name'];
    $operation = field_info_instance('paragraphs_item', $name, 'kalaponent')
      ? 'field_update_instance'
      : 'field_create_instance';

    // Create or update the field instance.
    $operation($instance);
  }
}

/**
 * Returns the list of kalaponents composite variables.
 */
function _kalaponents_get_composite_variables() {
  static $composites;
  if (!isset($composites)) {
    $composites = array();
    module_load_include('inc', 'variable');
    foreach (variable_list_module('kalaponents') as $variable => $info) {
      if (isset($info['kalaponents composite'])) {
        $composites[$variable] = $info['kalaponents composite'];
      }
    }
  }
  return $composites;
}
