<?php

namespace Drupal\testmodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class FruitForm extends FormBase {

  protected $accepted_domains = ['gmail.com', 'yahoo.com'];

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
      '#value' => $this->t('Submit!'),
    );

    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!filter_var($form_state->getValue('email_address'), FILTER_VALIDATE_EMAIL)) {
      $form_state->setError($form['email_address'], 'Email address is invalid.');
    }

    if (!$this->validEmailAddress($form_state->getValue('email_address'))) {
      $form_state->setError($form['email_address'], 'Sorry, we only accept Gmail or Yahoo email addresses at this time.');
    }
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message($this->t('@fruit! Wow! Nice choice! Thanks for telling us!', array('@fruit' => $form_state->getValue('favorite_fruit'))));
    $form_state->setRedirect('<front>');
  }

  /**
   * Check the supplied email address that it matches what we will accept.
   * @param $email_address
   * @return bool
   */
  protected function validEmailAddress($email_address) {
    $domain = explode('@', $email_address)[1];
    return in_array($domain, $this->accepted_domains);
  }
}