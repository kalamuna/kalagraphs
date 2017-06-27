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
    $classes = [];
    switch ($this->kalagraphsType) {
      case 'vertical_tabs':
        $classes[] = 'tab';
        break;

      default:
        $classes[] = 'button';
    }
    // Render links with a twig template.
    return [
      '#theme' => "kalastatic__link",
      '#url' => $item->getUrl(),
      '#text' => $item->title,
      // @todo Make the class variable.
      '#class' => $classes,
    ];
  }

}
