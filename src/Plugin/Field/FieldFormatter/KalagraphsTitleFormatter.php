<?php

namespace Drupal\kalagraphs\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;

/**
 * Base class for Kalagraphs title field formatter plugin implementations.
 *
 * @ingroup field_formatter
 */
abstract class KalagraphsTitleFormatter extends KalagraphsFieldFormatter {

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
