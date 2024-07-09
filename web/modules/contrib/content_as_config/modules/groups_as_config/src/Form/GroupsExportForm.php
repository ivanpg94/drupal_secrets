<?php

namespace Drupal\groups_as_config\Form;

use Drupal\content_as_config\Form\ExportBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Exports group content to configuration.
 */
class GroupsExportForm extends ExportBase {
  use GroupsImportExportTrait;

  /**
   * {@inheritdoc}
   */
  protected function getListElements(): array {
    $export_list = [];
    $entities = $this->entityTypeManager->getStorage('group_type')
      ->loadMultiple();
    foreach ($entities as $entity) {
      $export_list[$entity->id()] = $entity->label();
    }
    return $export_list;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $form['export_list']['#title'] = $this->t('Export groups of these types:');
    return $form;
  }

}
