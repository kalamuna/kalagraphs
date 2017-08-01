<?php

namespace Drupal\kalagraphs\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemInterface;

/**
 * Base class for Kalagraphs field formatter plugin implementations.
 *
 * @ingroup field_formatter
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
    $bundle = $entity->bundle();

    // Allow non-Kalagraphs fields to leverage these formatters.
    $this->kalagraphsType = strpos($bundle, 'kalagraphs_') === 0
      ? $entity->field_kalagraphs_type->value
      : $entity->getEntityTypeId() . '__' . $bundle;

    // Allow each subclass define how it renders each item.
    foreach ($items as $delta => $item) {
      $elements[$delta] = $this->viewValue($item);
    }

    // Return an array of render arrays for printing by Twig.
    return $elements;
  }

  /**
   * Generates the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return array
   *   A render array for printing in the parent component's twig template.
   */
  abstract protected function viewValue(FieldItemInterface $item);

}
