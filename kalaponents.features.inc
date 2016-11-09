<?php
/**
 * @file
 * kalaponents.features.inc
 */

/**
 * Implements hook_paragraphs_info().
 */
function kalaponents_paragraphs_info() {
  $items = array(
    'component' => array(
      'name' => 'Component',
      'bundle' => 'component',
      'locked' => '1',
    ),
  );
  return $items;
}
