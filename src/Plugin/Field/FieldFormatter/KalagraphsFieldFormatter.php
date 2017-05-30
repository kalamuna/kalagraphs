<?php

namespace Drupal\kalagraphs\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemInterface;

/**
 * Plugin implementation of the 'kalagraphs' formatter.
 *
 * @FieldFormatter(
 *   id = "kalagraphs",
 *   label = @Translation("Kalagraphs"),
 *   field_types = {
 *   }
 * )
 */
abstract class KalagraphsFieldFormatter extends FormatterBase {

  /**
   * The kalagraphs component type.
   *
   * @var string
   */
  protected $kalagraphsType;

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    return [t('Kalagraphs Base Field Formatter')];
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    $entity = $items->getEntity();
    if ($entity->bundle() == 'kalagraphs_component') {
      $this->kalagraphsType = $items->getEntity()->field_kalagraphs_type->value;
    } else {
      $this->kalagraphsType = $entity->getEntityTypeId() . '__' . $entity->bundle();
    }

    foreach ($items as $delta => $item) {
      $elements[$delta] = $this->viewValue($item);
    }

    return $elements;
  }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return string
   *   The textual output generated.
   */
  abstract protected function viewValue(FieldItemInterface $item);

}
