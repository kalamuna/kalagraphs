<?php

/**
 * @file
 * Hook definitions for the Kalagraphs project.
 */

/**
 * Allows customization of the "Kalagraphs Type" options list.
 *
 * @param array $options
 *   List of options for the Kalagraphs Type ("Display as") selector.
 * @param array $widget
 *   Bricks field widget.
 */
function hook_kalagraphs_options_alter(array &$options, array $widget) {
  // On "My Bundle" nodes, replace the "text" component with "text__no_wrapper".
  if ($widget['#entity_type'] == 'node' && $widget['#bundle'] == 'my_bundle') {
    $i = array_search('text', array_keys($options));
    $options = array_slice($options, 0, $i, TRUE) +
               ['text__no_wrapper' => 'Simple Text'] +
               array_slice($options, $i, NULL, TRUE);
    unset($options['text']);
  }
}
