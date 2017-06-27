<?php

namespace Drupal\kalagraphs\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Routing\RouteMatchInterface;
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

    // Render links with a twig template.
    $value = array(
      '#theme' => "kalastatic__link",
      '#url' => $url->toString(),
      '#text' => $item->title,
      '#class' => [],
    );

    switch ($this->kalagraphsType) {
      case 'vertical_tabs':
        $value['#class'][] = 'tab';
        break;

      default:
        $value['#class'][] = 'button';
    }

    // Figure out if link is active
    if (!$url->isExternal()) {
      $link_path = $url->getInternalPath();
      $route_match = \Drupal::routeMatch();
      if ($route_match instanceof StackedRouteMatchInterface) {
        $route_match = $route_match->getMasterRouteMatch();
      }
      $current_path = $route_match->getRouteName() ? Url::fromRouteMatch($route_match)->getInternalPath() : '';
      $is_active = ($current_path == $link_path);
      
      if ($is_active) {
        $value['#class'][] = 'active';
        $value['#active'] = TRUE;
      }
    }
    
    return $value;
  }

}
