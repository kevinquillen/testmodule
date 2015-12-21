<?php

namespace Drupal\testmodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class FruitForm extends FormBase {
  /**
   * {@inheritDoc}
   */
  public function getFormId() {
    return 'fruitform';
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $fruits = ['Apple', 'Banana', 'Blueberry', 'Grapes', 'Orange', 'Strawberry'];

    $form['favorite_fruit'] = array(
      '#type' => 'select',
      '#title' => $this->t('Tell us your favorite fruit.'),
      '#required' => true,
      '#options' => array_combine($fruits, $fruits)
    );

    $form['email_address'] = array(
      '#type' => 'email',
      '#title' => $this->t('What is your email address?'),
      '#required' => true,
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit!')
    );

    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement validateForm() method.
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message($this->t('@fruit! Wow! Nice choice! Thanks for telling us!', array('@fruit' => $form_state->getValue('favorite_fruit'))));
    $form_state->setRedirect('<front>');
  }
}