<?php

namespace Drupal\groups_as_config\Form;

use Drupal\content_as_config\Form\ImportBase;

/**
 * Exports group content to configuration.
 */
class GroupsImportForm extends ImportBase {
  use GroupsImportExportTrait;

}
