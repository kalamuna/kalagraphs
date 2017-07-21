<?php

namespace Drupal\kalagraphs\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Url;

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
abstract class KalagraphsLinkFormatter extends KalagraphsFieldFormatter {

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

    // Fill in some default values for sub-classes.
    $url = $item->getUrl();
    $value = [
      '#url'   => $url,
      '#text'  => $item->title,
      '#class' => [],
    ];

    // Determine if link is active.
    if (!$url->isExternal()) {

      // Empty string as internal path indicates user entered "/" or "<front>".
      $link_path = $url->getInternalPath();
      if ('' === $link_path) {

        // Find out if we're currently on the frontpage. We can't rely on the
        // "current path" as calculated below; it always returns the node ID.
        $path_matcher = \Drupal::service('path.matcher');
        if ($path_matcher->isFrontPage()) {
          self::setActive($value);
        }
      }

      // For all non-homepage paths, compare the link's URL to the current page.
      else {
        $current_path = Url::fromRoute('<current>')->getInternalPath();
        if ($current_path === $link_path) {
          self::setActive($value);
        }
      }
    }

    return $value;
  }

  /**
   * Helper function to set the active class and variable on a link item.
   *
   * @param array $value
   *   The field item's render array.
   */
  private static function setActive(array &$value) {
    $value['#class'][] = 'active';
    $value['#active'] = TRUE;
  }

}
