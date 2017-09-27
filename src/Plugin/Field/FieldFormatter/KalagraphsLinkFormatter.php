<?php

namespace Drupal\kalagraphs\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Url;
use Drupal\media\Entity\Media;

/**
 * Base class for Kalagraphs link field formatter plugin implementations.
 *
 * @ingroup field_formatter
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
    if ($url->isRouted()) {

      // Empty string as internal path indicates user entered "/" or "<front>".
      $link_path = $url->getInternalPath();
      if ('' === $link_path) {

        // Find out if we're currently on the frontpage. We can't rely on the
        // "current path" as calculated below; it always returns the node ID.
        $path_matcher = \Drupal::service('path.matcher');
        if ($path_matcher->isFrontPage()) {
          self::setActive($url, $value);
        }
      }

      // For all non-homepage paths, compare the link's URL to the current page.
      else {
        $current_path = Url::fromRoute('<current>')->getInternalPath();
        if ($current_path === $link_path) {
          self::setActive($url, $value);
        }

        // Make Media entities point directly to their file's URL.
        if ($url->getRouteName() === 'entity.media.canonical') {
          $params = $url->getRouteParameters();
          if (!empty($params['media'])) {
            $media = Media::load($params['media']);
            if (!empty($media->field_media_file[0]->entity)) {
              $file = $media->field_media_file[0]->entity;
              $value['#url'] = $file->url();
            }
          }
        }
      }
    }

    return $value;
  }

  /**
   * Helper function to set the active class and variable on a link item.
   *
   * @param \Drupal\Core\Url $url
   *   The Url object from the field item.
   * @param array $value
   *   The field item's render array.
   */
  private static function setActive(Url $url, array &$value) {
    // Don't show links to named anchors within the page as active.
    if (empty($url->getOptions()['fragment'])) {
      $value['#class'][] = 'active';
      $value['#active'] = TRUE;
    }
  }

}
