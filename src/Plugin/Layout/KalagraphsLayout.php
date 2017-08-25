<?php

namespace Drupal\kalagraphs\Plugin\Layout;

use Drupal\Core\Layout\LayoutDefault;

/**
 * A layout from our flexible layout builder.
 *
 * @Layout(
 *   id = "kalagraphs",
 *   deriver = "Drupal\kalagraphs\Plugin\Deriver\KalagraphsLayoutDeriver"
 * )
 */
class KalagraphsLayout extends LayoutDefault {}
