<?php

/**
 * @file
 * API file for the Kalaponents project, demonstrating hook usage.
 */

/**
 * Modify components' markup before output.
 *
 * @param string $markup
 *   The markup rendered by Twig.
 * @param string $component_type
 *   The Kalaponent component type.
 */
function hook_kalaponents_markup_alter(&$markup, $component_type) {
  //  Add the appropriate wrapper for the component type.
  $prefix = $suffix = '';
  switch ($component_type) {

    case 'tout__hero':
      break;

    case 'location_map':
      $prefix = '<section>';
      $suffix = '</section>';
      break;

    default:
      $prefix = '<section class="container">';
      $suffix = '</section>';
  }
  $markup = $prefix . $markup . $suffix;
}
