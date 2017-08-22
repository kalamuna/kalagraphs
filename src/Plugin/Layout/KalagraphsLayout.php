<?php

namespace Drupal\kalagraphs\Plugin\Layout;

use Drupal\Core\Layout\LayoutDefault;

/**
 * A layout from our flexible layout builder.
 *
 * @Layout(
 *   id = "kalagraphs_layout",
 *   deriver = "Drupal\kalagraphs\Plugin\Deriver\KalagraphsLayoutDeriver"
 * )
 */
class KalagraphsLayout extends LayoutDefault {

}
