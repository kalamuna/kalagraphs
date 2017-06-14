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

    // Determine which Twig template to use.
    switch ($this->kalagraphsType) {

      case 'basic_hero':
        $theme_hook = 'kalagraphs_cta_link';
        break;

      default:
        $theme_hook = 'kalagraphs_basic_link';
    }

    // Determine the links' classes.
    switch ($this->kalagraphsType) {

      case 'dropdown':
      case 'jumpnav':
      case 'subnav':
        $class_list = [];
        break;

      default:
        $class_list = ['link__default'];
    }

    // Return a render array which, when printed in the component's twig
    // template, will call the appropriate link atom twig template.
    return [
      '#theme'     => $theme_hook,
      '#href'      => $item->getUrl(),
      '#classList' => implode(' ', $class_list),
      '#text'      => $item->title,
    ];
  }

}
