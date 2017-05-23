<?php

namespace Drupal\kalagraphs\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;

/**
 * Plugin implementation of the 'kalagraphs_image' formatter.
 *
 * @FieldFormatter(
 *   id = "kalagraphs_image",
 *   label = @Translation("Kalagraphs Image"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class KalagraphsImageFormatter extends KalagraphsFieldFormatter {

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    return [t('Kalagraphs Image Field Formatter')];
  }

  /**
   * {@inheritdoc}
   */
  protected function viewValue(FieldItemInterface $item) {
    switch ($this->kalagraphsType) {

      // Some components just need the image URL for use as a background.
      case 'basic_hero':
      case 'section_header':
      case 'triangle_flow':
        return $item->view(['type' => 'image_url']);

      // Other components render images with a twig template.
      default:
        return [
          '#theme' => "kalagraphs_image",
          '#src' => file_create_url($item->entity->getFileUri()),
          '#alt' => $item->alt,
          '#title' => $item->title,
          '#class' => '',
        ];
    }
  }

}
