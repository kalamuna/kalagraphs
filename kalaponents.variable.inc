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
    'title' => t('Component Types', array(), $options),
    'description' => t('Enter one component per line in the format "machine_name|Display name"', array(), $options),
    'type' => 'text',
  );

  // This multi-variable* holds paths to the icon/image for each component type.
  $variable['kalaponents_icon_[type]'] = array(
    'kalaponents composite' => 'kalaponents_icons',
    'type' => 'multiple',
    'multiple callback' => 'kalaponents_get_types',
    'title' => t('Icons', array(), $options),
    'description' => t('Icons for each component type.', array(), $options),
    'access' => 'administer themes',
    'repeat' => array(
      'type' => 'drupal_path',
    ),
    'localize' => FALSE,
  );

  // This multi-variable* holds the list of fields on each component type.
  $variable['kalaponents_fieldlist_[type]'] = array(
    'kalaponents composite' => 'kalaponents_fieldlists',
    'type' => 'multiple',
    'multiple callback' => 'kalaponents_get_types',
    'title' => t('Fields', array(), $options),
    'description' => t('Fields used in each component type, and their corresponding template variable names.', array(), $options),
    'access' => 'administer themes',
    'repeat' => array(
      'type' => 'options',
      'options callback' => 'kalaponents_get_available_fields',
    ),
    'localize' => FALSE,
  );

  // This multi-variable* holds the template paths for each component type.
  $variable['kalaponents_templatepath_[type]'] = array(
    'kalaponents composite' => 'kalaponents_templatepaths',
    'type' => 'multiple',
    'multiple callback' => 'kalaponents_get_types',
    'title' => t('Template Paths', array(), $options),
    'description' => t('Template paths for each component type.
                        <p>Please enter the full template path including the file name without the <em>.html.twig</em> extension.<br/>
                        <em>Example:</em> For the <em>components/tout/tout.html.twig</em> template file you should enter <em>components/tout/tout</em></p>',
                        array(), $options),
    'access' => 'administer themes',
    'repeat' => array(
      'type' => 'string',
    ),
    'localize' => FALSE,
  );

  return $variable;
}

/**
 * Returns the list of component types keyed by machine name.
 *
 * Removes empty rows and trims whitespace from the beginnings and ends of both
 * machine names and display names.
 */
function kalaponents_get_types() {
  static $types;
  if (!isset($types)) {
    $types = array();
    $rows  = explode(PHP_EOL, variable_get('kalaponents_types', ''));
    foreach (array_filter($rows) as $row) {
      $columns = explode('|', $row);
      $types[trim(reset($columns))] = trim(next($columns));
    }
  }
  return $types;
}

/**
 * Returns the list of available component fields, keyed by machine name.
 */
function kalaponents_get_available_fields() {
  static $fields;
  if (!isset($fields)) {
    $fields  = array();
    $weights = array();
    foreach (field_info_instances('paragraphs_item', 'kalaponent') as $field => $info) {

      // Skip meta / non-content fields.
      if ($field === 'field_kalaponents_type'||
          $field === 'field_kalaponents_label') {
        continue;
      }

      // Get the edit form weight for this field.
      $weight = &$info['display']['default']['weight'];
      $weights[$field] = empty($weight) ? 0 : $weight;

      // Include the machine name in display.
      $template_variable_name = substr($field, 18);
      $fields[$field] = "{$info['label']} ($template_variable_name)";
    }
    // Sort fields by position on the edit form.
    array_multisort($weights, SORT_ASC, $fields);
  }
  return $fields;
}
