<?php

namespace Drupal\kalagraphs\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;

/**
 * Plugin implementation of the 'kalagraphs_link' formatter.
 *
 * @FieldFormatter(
 *   id = "kalagraphs_link",
 *   label = @Translation("Kalagraphs Link"),
 *   field_types = {
 *     "link"
 *   }
 * )
 */
class KalagraphsLinkFormatter extends KalagraphsFieldFormatter {

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    return [t('Kalagraphs Link Field Formatter')];
  }

  /**
   * {@inheritdoc}
   */
  protected function viewValue(FieldItemInterface $item) {
    // Render links with a twig template.
    return [
      '#theme' => "kalagraphs_basic_link",
      '#href' => $item->uri,
      '#classList' => 'link__default',
      '#text' => $item->title,
    ];
  }

}
