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
    switch ($this->kalagraphsType) {

      // Some items just need the value.
      case 'image_captioned':
      case 'small':
        return ['#markup' => $item->value];

      // Customise the header tag type for certain components.
      case 'nr004':
        $tag = 'h3';
        break;

      default:
        // Let the twig template define the default.
        $tag = NULL;
    }

    // Render titles with a twig template.
    return [
      '#theme' => "kalagraphs_title",
      '#title' => $item->value,
      '#tag' => $tag,
    ];
  }

}
