<?php

namespace Drupal\node_view_counter\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'node_view_counter' field type.
 *
 * @FieldType(
 *   id = "node_view_counter",
 *   label = @Translation("Node View Counter"),
 *   description = @Translation("Field type to count node views."),
 *   category = @Translation("Custom"),
 *   default_widget = "node_view_counter_widget",
 *   default_formatter = "node_view_counter_formatter"
 * )
 */
class NodeViewCounterField extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'type' => 'int',
          'default' => 0,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('integer')
      ->setLabel(t('Node View Counter'));

    return $properties;
  }
}

