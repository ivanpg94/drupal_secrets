<?php

namespace Drupal\node_view_counter\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'node_view_counter_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "node_view_counter_formatter",
 *   label = @Translation("Node View Counter Formatter"),
 *   field_types = {
 *     "node_view_counter"
 *   }
 * )
 */
class NodeViewCounterFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#markup' => $this->t('@count', ['@count' => $item->value]),
      ];
    }
    return $elements;
  }

}
