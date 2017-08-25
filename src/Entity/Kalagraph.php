<?php

namespace Drupal\kalagraphs\Entity;

use Drupal\paragraphs\Entity\Paragraph;

/**
 * Overrides the Paragraphs module entity to facilitate various tweaks.
 */
class Kalagraph extends Paragraph {

  /**
   * {@inheritdoc}
   */
  public function label() {
    static $bricks, $delta, $layout, $regions;

    // Keep track of where we are in the list of bricks.
    if (!isset($delta)) {
      $delta = -1;
    }
    $delta++;
    switch ($this->bundle()) {

      // No label for layouts; just display the Bricks options dropdown.
      case 'layout':
        return;

      // @TODO Move this entire function's logic to the widget form alter or
      // somewhere like that; this approach is pretty messy/hacky and doesn't
      // work when creating new nodes (i.e., before the node has been saved).
      case 'kalagraphs_region':

        // Get access to the page's layout and bricks.
        if (!isset($bricks, $layout)) {
          if (!($node = $this->getParentEntity())) {
            return parent::label();
          }
          $bricks = $node->field_bricks;
          if (empty($bricks[0]->options['layout'])) {
            return parent::label();
          }
          $layout_id = $bricks[0]->options['layout'];
          $layout_plugin_manager = \Drupal::service('plugin.manager.core.layout');
          $layout = $layout_plugin_manager->getDefinition($layout_id);
        }

        // Janky way to get the brick associated with this paragraph. Account
        // for the fact that sometimes it loops over all the bricks twice.
        if (count($bricks) >= $delta) {
          $delta -= count($bricks);
        }
        $brick = $bricks[$delta];

        // Make sure we only target top-level wrappers.
        if (1 != $brick->depth) {
          return parent::label();
        }

        // Sometimes it loops over the list of items more than once. When that
        // happens, we just restart the regions back at the start.
        if (empty($regions)) {
          $regions = $layout->getRegions();
        }
        $region = array_shift($regions)['label'];
        return "<strong>$region region</strong>";

      case 'kalagraphs_component':
        $config = $this->getFieldDefinition('field_kalagraphs_type')->getFieldStorageDefinition();
        $options = options_allowed_values($config, $this);
        $type = $this->field_kalagraphs_type->value;
        $name = empty($type) ? $options['hidden'] : $options[$type];
        $label = "<em>$name:</em> ";
        foreach (['title', 'text', 'subtitle', 'image', 'links'] as $name) {
          $field = "field_kalagraphs_$name";
          if ($this->hasField($field) && !empty($this->$field->value)) {
            $label .= $this->$field->value;
          }
        }
        return $label;

      default:
        return parent::label();
    }
  }

}
