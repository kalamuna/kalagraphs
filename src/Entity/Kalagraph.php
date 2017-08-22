<?php

namespace Drupal\kalagraphs\Entity;

use Drupal\paragraphs\Entity\Paragraph;

/**
 * Overrides the Paragraphs module entity to facilitate various tweaks.
 */
class Kalagraph extends Paragraph {

  /**
   * {@inheritdoc}
   */
  public function label() {
    foreach (['title', 'text', 'subtitle', 'image', 'links'] as $name) {
      $field = "field_kalagraphs_$name";
      if ($this->hasField($field) && !empty($this->$field->value)) {
        return $this->$field->value;
      }
    }
    if ($this->bundle() !== 'layout') {
      return parent::label();
    }
  }

}
