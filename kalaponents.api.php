<?php

/**
 * @file
 * API file for the Kalaponents project, demonstrating hook usage.
 */

/**
 * Modify components' template data before rendering.
 *
 * @param array $data
 *   The array of template variables to be passed into `twigshim_render()`.
 * @param string $component_type
 *   The Kalaponent component type.
 * @param EntityDrupalWrapper $paragraph
 *   An EntityMetadataWrapper for the paragraph entity being rendered.
 */
function hook_kalaponents_data_alter(array &$data, $component_type, EntityDrupalWrapper $paragraph) {
  switch ($component_type) {

    // Rename the link text to "scrolltext" for use in the hero template.
    case 'hero__homepage':
      $data['scrolltext'] = $data['link']['text'];
      break;
  }
}

/**
 * Modify components' markup before output.
 *
 * @param string $markup
 *   The markup rendered by Twig.
 * @param string $component_type
 *   The Kalaponent component type.
 * @param EntityDrupalWrapper $paragraph
 *   An EntityMetadataWrapper for the paragraph entity that was rendered.
 */
function hook_kalaponents_markup_alter(&$markup, $component_type, EntityDrupalWrapper $paragraph) {
  // Add the appropriate wrapper for the component type.
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
  $markup = render(array(
    '#prefix' => $prefix,
    '#markup' => $markup,
    '#suffix' => $suffix,
  ));

}
