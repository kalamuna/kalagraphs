<?php

/**
 * @file
 * Variable declarations for the Kalamuna Components project.
 */

/**
 * Implements hook_variable_info().
 *
 * *Note use of the custom array element "kalaponents composite" in each of the
 * "multple" type variables. This element indicates the "composite variable"
 * name used to combine all the multi-values into one composite varible.*
 */
function kalaponents_variable_info($options = array()) {

  // This variable holds the component type machine names and titles.
  $variable['kalaponents_types'] = array(
    'title' => t('Kalamuna Component Types', array(), $options),
    'description' => t('Enter one component per line in the format "machine name|Display name"', array(), $options),
    'type' => 'text',
  );

  // This multi-variable* holds paths to the icon/image for each component type.
  $variable['kalaponents_icon_[type]'] = array(
    'kalaponents composite' => 'kalaponents_composite_icons',
    'type' => 'multiple',
    'multiple callback' => 'kalaponents_get_types',
    'title' => t('Kalamuna Component Icons', array(), $options),
    'description' => t('Icons for each component type.', array(), $options),
    'access' => 'administer themes',
    'repeat' => array(
      'type' => 'drupal_path',
      'default' => 'sites/all/themes/...',
    ),
    'localize' => FALSE,
  );

  // This multi-variable* holds the list of fields on each component type.
  $variable['kalaponents_fields_[type]'] = array(
    'kalaponents composite' => 'kalaponents_composite_fields',
    'type' => 'multiple',
    'multiple callback' => 'kalaponents_get_types',
    'title' => t('Kalamuna Component Fields', array(), $options),
    'description' => t('Fields used in each component type (corresponding template variable names in parentheses).', array(), $options),
    'access' => 'administer themes',
    'repeat' => array(
      'type' => 'options',
      'options callback' => 'kalaponents_get_available_fields',
    ),
    'localize' => FALSE,
  );

  return $variable;
}
