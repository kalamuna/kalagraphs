<?php

namespace Drupal\kalagraphs\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;

/**
 * Plugin implementation of the 'kalagraphs_title' formatter.
 *
 * @FieldFormatter(
 *   id = "kalagraphs_title",
 *   label = @Translation("Kalagraphs Title"),
 *   field_types = {
 *     "string",
 *   }
 * )
 */
class KalagraphsTitleFormatter extends KalagraphsFieldFormatter {

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    return [t('Kalagraphs Title Field Formatter')];
  }

  /**
   * {@inheritdoc}
   */
  protected function viewValue(FieldItemInterface $item) {

    // Fill in some default values for sub-classes.
    return ['#title' => $item->value];
  }

}
