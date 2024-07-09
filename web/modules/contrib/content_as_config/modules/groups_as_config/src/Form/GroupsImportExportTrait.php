<?php

namespace Drupal\groups_as_config\Form;

use Drupal\groups_as_config\Controller\GroupsController;
use Drupal\content_as_config\Controller\EntityControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements ContentImportExportInterface for group content.
 */
trait GroupsImportExportTrait {

  /**
   * {@inheritdoc}
   */
  public function getController(ContainerInterface $container): EntityControllerBase {
    return GroupsController::create($container);
  }

  /**
   * {@inheritdoc}
   */
  public function getEntityType(): string {
    return 'group';
  }

  /**
   * {@inheritdoc}
   */
  public function getLabel(array $info): string {
    return $info['label'];
  }

}
