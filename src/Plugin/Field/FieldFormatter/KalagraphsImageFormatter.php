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
abstract class KalagraphsImageFormatter extends KalagraphsFieldFormatter {

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

    // Fill in some default values for sub-classes.
    return [
      '#uri'     => file_create_url($item->entity->getFileUri()),
      '#alt'     => $item->alt,
      '#title'   => $item->title,
      '#width'   => $item->width,
      '#height'  => $item->height,
      '#classes' => [],
    ];
  }

}
