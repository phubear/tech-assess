<?php

namespace Drupal\bad_module_name\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class BadConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'bad_module_name_bad_config_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'bad_module_name.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('bad_module_name.settings');
    $form['bad_api_header'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Auth Header'),
      '#default_value' => $config->get('bad_api_header') ?: 'AOaxT3DBGfyXtR68PgFzcZma4bfzLeuLFaLuX9jGHC', // Set default value so I can get this working for you at least.
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('bad_module_name.settings')
      ->set('bad_api_header', $form_state->getValue('bad_api_header'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
