<?php

namespace Drupal\groups_as_config\Controller;

use Drupal\content_as_config\Controller\EntityControllerBase;

/**
 * Controller for syncing groups.
 */
class GroupsController extends EntityControllerBase {

  /**
   * {@inheritdoc}
   */
  public static function entityTypeName(): string {
    return 'group';
  }

  /**
   * {@inheritdoc}
   */
  public static function fieldNames(): array {
    return [
      'id',
      'type',
      'label',
      'status',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function hasPath(): bool {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  protected function getExportableEntities(?array $export_list): array {
    $entities = [];
    $storage = $this->entityTypeManager->getStorage('group');
    if (isset($export_list)) {
      $export_list = array_filter($export_list, 'is_string');
      if (!empty($export_list)) {
        $entities = $storage->loadByProperties(['type' => $export_list]);
      }
    }
    else {
      $entities = $storage->loadMultiple();
    }
    return $entities;
  }


}
