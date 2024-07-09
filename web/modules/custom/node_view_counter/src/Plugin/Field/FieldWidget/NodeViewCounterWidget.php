<?php
namespace Drupal\node_view_counter\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'node_view_counter_widget' widget.
 *
 * @FieldWidget(
 *   id = "node_view_counter_widget",
 *   label = @Translation("Node View Counter Widget"),
 *   field_types = {
 *     "integer"
 *   }
 * )
 */
class NodeViewCounterWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, Array $element, Array &$form, FormStateInterface $form_state) {
    $element['value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Node View Counter'),
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : -1,
      '#size' => 5,
      '#maxlength' => 9999999999,
      '#attributes' => ['readonly' => 'readonly'],
    ];

    return $element;
  }
}
