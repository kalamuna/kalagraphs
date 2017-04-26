<?php

namespace Drupal\kalagraphs\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'kalagraphs' formatter.
 *
 * @FieldFormatter(
 *   id = "kalagraphs",
 *   label = @Translation("Kalagraphs"),
 *   field_types = {
 *     "link",
 *     "image"
 *   }
 * )
 */
class KalagraphsFieldFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Implement default settings.
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return [
      // Implement settings form.
    ] + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = "Kalagraphs";
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    $field = substr($items->getName(), 17);
    $kalagraphs_type = $items->getEntity()->field_kalagraphs_type->value;

    switch ($field) {
      case 'links':
        $custom_hook = &$info['subtemplates'][$field];
        $theme_hook = isset($custom_hook) ? $custom_hook : 'basic_link';
        foreach ($items as $delta => $item) {
          $elements[$delta] = [
            '#theme' => "kalagraphs_$theme_hook",
            '#href' => $item->uri,
            '#classList' => '',
            '#text' => $item->title,
          ];
        }
        break;

      case 'image':
        switch ($kalagraphs_type) {
          case 'section_header':
            $elements = $items->view(['type' => 'image_url']);
            break;

          default:
            foreach ($items as $delta => $item) {
              $elements[$delta] = [
                '#theme' => "kalagraphs_basic_image",
                '#src' => file_create_url($item->entity->getFileUri()),
                '#alt' => $item->alt,
                '#class' => '',
              ];
            }
        }
        break;
    }

    return $elements;
  }

}
