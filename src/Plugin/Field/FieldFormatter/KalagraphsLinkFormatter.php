<?php

namespace Drupal\kalagraphs\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Routing\StackedRouteMatchInterface;
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
    $url = $item->getUrl();

    // Fill in some default values for sub-classes.
    $value = [
      '#url'   => $url,
      '#text'  => $item->title,
      '#class' => [],
    ];

    // Determine if link is active.
    if (!$url->isExternal()) {

      // @todo Indicate from where this code was copied (core system.module?)
      $route_match = \Drupal::routeMatch();
      if ($route_match instanceof StackedRouteMatchInterface) {
        $route_match = $route_match->getMasterRouteMatch();
      }
      $current_path = $route_match->getRouteName()
        ? Url::fromRouteMatch($route_match)->getInternalPath() : '';

      // @todo Fix this logic to accommodate the "<front>" route.
      if ($current_path === $url->getInternalPath()) {
        $value['#class'][] = 'active';
        $value['#active'] = TRUE;
      }
    }

    return $value;
  }

}
