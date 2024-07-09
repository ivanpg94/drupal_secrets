<?php

namespace Drupal\video_base\Installer\Form;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements theme form.
 *
 * Create a form to select a theme
 *
 */
class VideoBaseChooseThemeForm extends FormBase implements ContainerInjectionInterface {

  /**
   * @inheritDoc
   */
  public function getFormId(): string {
    return 'video_base_choose_theme_form';
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $form['#title'] = $this->t('portfolio select theme');

    $form['features'] = [
      '#type' => 'fieldset',
      '#title' => t('Select the theme to be installed'),
    ];
    $themes = $this->getThemes();
    $options = [];

    foreach ($themes as $theme) {
      $options[$theme['name']] = $theme['name'].'<br/><img src="' . $theme['image_path'] . '" alt="' . $theme['name'] . '">';
    }

    $form['features']['theme_radio'] = [
      '#type' => 'radios',
      '#title' => t('Select the theme'),
      '#options' => $options,
      '#default_value' => key($options),
      '#required' => TRUE,
    ];
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
   * @return void
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void
  {
    $theme = $form_state->getValue('theme_radio');
    try {
      \Drupal::configFactory()->getEditable('system.theme')->set('default', $theme)->save();
      \Drupal::configFactory()->getEditable('system.theme')->set('admin', 'claro')->save();
    } catch (\Exception $e) {
      \Drupal::logger('custom_theme')->error('Error installing theme: @error', ['@error' => $e->getMessage()]);
    }
  }
  /**
   * Gets themes from folder path `web/profiles/video_base/themes`.
   *
   * @return array
   *   A list of themes names.
   */
  private function getThemes(): array
  {
    $path = \Drupal::root() . '/profiles/video_base/themes';
    $themes = array_filter(scandir($path), function ($item) {
      return $item[0] !== '.';
    });
    $themesWithImages = [];
    foreach ($themes as $theme) {
      $themesWithImages[$theme] = [
        'name' => $theme,
        'image_path' => '/profiles/video_base/themes/' . $theme . '/screenshot.png',
      ];
    }

    return $themesWithImages;
  }
}
