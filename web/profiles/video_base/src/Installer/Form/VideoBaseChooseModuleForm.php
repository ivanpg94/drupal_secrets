<?php

namespace Drupal\video_base\Installer\Form;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Extension\ModuleExtensionList;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements module form.
 *
 * Create a form to select  modules
 *
 */
class VideoBaseChooseModuleForm extends FormBase implements ContainerInjectionInterface {

  /**
   * @var \Drupal\Core\Extension\ModuleExtensionList
   */
  protected $moduleExtensionList;

  public function __construct(ModuleExtensionList $moduleInstaller) {
    $this->moduleExtensionList = $moduleInstaller;
  }

  /**
   * @param ContainerInterface $container
   * @return VideoBaseChooseModuleForm|static
   */
  public static function create(ContainerInterface $container): VideoBaseChooseModuleForm|static
  {
    return new static(
      $container->get('extension.list.module')
    );
  }

  /**
   * @inheritDoc
   */
  public function getFormId(): string {
    return 'video_base_choose_module_form';
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $form['#title'] = $this->t('aaiicc custom modules');

    // Container form
    $form['features'] = [
      '#type' => 'fieldset',
      '#title' => t('Selecciona los modulos que seran instalados'),
      '#description' => t('Features are small modules containing default configuration you can install now or at any point in the future.'),
      '#states' => [
        'visible' => [
          ':input[name="install_demo"]' => ['checked' => FALSE],
        ],
      ],
    ];

    // Checkbox to select all modules
    $form['features']['select_all'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Seleccionar todos los módulos'),
      '#attributes' => [
        'class' => ['select-all-modules'],
      ],
      '#ajax' => [
        'callback' => '::selectAllCheckboxCallback',
      ],
    ];

    // Creates a form element for each module in the folder
    $modules = $this->getModules();
    foreach ($modules as $module) {
      $form['features'][$module] = [
        '#type' => 'checkbox',
        '#title' => $module,
        '#default_value' => FALSE,
      ];
    }

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Continue installation'),
    ];

    return $form;
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array
   */
  public function selectAllCheckboxCallback(array &$form, FormStateInterface $form_state): array
  {
    // Get the value of the "Select All" checkbox.
    $select_all_value = $form_state->getValue('select_all');

    // Set the values of all other checkboxes based on the "Select All" checkbox.
    $modules = $this->getModules();
    foreach ($modules as $module) {
      $form_state->setValue($module, $select_all_value);
    }

    // Return the entire form.
    return $form;
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void
  {
    // Checks the form values and saves the selected ones in an array
    $selected_modules = [];
    $modules = $this->getModules();
    foreach ($modules as $module) {
      if ($form_state->getValue($module)) {
        $selected_modules[] = $module;
      }
    }

    $module_installer = \Drupal::service('module_installer');

    // Install the selected modules
    foreach ($selected_modules as $module) {
      try {
        $module_installer->install([$module], TRUE);
        if (!$module_installer->install([$module], TRUE)) {
          \Drupal::logger('custom_module')->error('Failed to install module: @module', ['@module' => $module]);
        }
      } catch (\Exception $e) {
        \Drupal::logger('custom_module')->error('Error installing module: @error', ['@error' => $e->getMessage()]);
      }
    }
    // Clear all caches.
    shell_exec('drush cr');
  }
  /**
   * Gets modules from folder path `web/modules`.
   *
   * @return array
   *   A list of module names.
   */
  private function getModules(): array
  {
    $path = \Drupal::root() . '/profiles/video_base/modules';
    $modules = array_filter(scandir($path), function ($item) {
      return $item[0] !== '.';
    });
    return $modules;
  }
}
