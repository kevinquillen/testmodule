<?php

/**
 * @file
 * Contains \Drupal\testmodule\Tests\FruitFormTest.
 */

namespace Drupal\testmodule\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provide some basic tests for our FruitForm form.
 * @group testmodule
 */
class FruitFormTest extends WebTestBase {

  /**
   * Modules to install.
   * @var array
   */
  public static $modules = ['node', 'testmodule'];

  /**
   * Tests that 'testmodule/ask-user' returns a 200.
   */
  public function testFruitFormRouterURLIsAccessible() {
    $this->drupalGet('testmodule/ask-user');
    $this->assertResponse(200, 'URL is accessible to anonymous user.');
  }

  /**
   * Tests that the form has a submit button to use.
   */
  public function testFruitFormSubmitButtonExists() {
    $this->drupalGet('testmodule/ask-user');
    $this->assertResponse(200);
    $this->assertFieldById('edit-submit', 'Submit!', 'User has a way to submit the form.');
  }

  /**
   * Tests that the form has an email field.
   */
  public function testFruitFormEmailFieldExists() {
    $this->drupalGet('testmodule/ask-user');
    $this->assertResponse(200, 'URL is accessible to anonymous user.');
    $this->assertFieldById('edit-email-address', NULL, 'Found email address field with the id #edit-email-address.');
  }

  /**
   * Test that the options we expect in the form are present.
   */
  public function testFruitFormFieldOptionsExist() {
    $this->drupalGet('testmodule/ask-user');
    $this->assertResponse(200, 'URL is accessible to anonymous user.');

    // check that our select field displays on the form
    $this->assertFieldByName('favorite_fruit');

    // check that all of our options are available
    $fruits = ['Apple', 'Banana', 'Blueberry', 'Grapes', 'Orange', 'Strawberry'];

    foreach ($fruits as $fruit) {
      $this->assertOption('edit-favorite-fruit', $fruit, t('@fruit option found.', ['@fruit' => $fruit]));
    }

    // check that Pizza is not an option. Sorry, pizza lovers.
    $this->assertNoOption('edit-favorite-fruit', 'Pizza', 'Pizza is not an option.');
  }

  /**
   * Test the submission of the form.
   * @throws \Exception
   */
  public function testFruitFormSubmit() {
    $this->drupalGet('testmodule/ask-user');
    $this->assertResponse(200, 'URL is accessible to anonymous user.');

    // submit the form with Blueberry as a value
    $this->drupalPostForm(
      'testmodule/ask-user',
      array(
        'favorite_fruit' => 'Blueberry',
        'email_address' => 'anonymous@example.com'
      ),
      t('Submit!')
    );

    // we should now be on the homepage, and see the right form success message
    $this->assertUrl('<front>');
    $this->assertText('Blueberry! Wow! Nice choice! Thanks for telling us!', 'The successful submission message was detected on the screen.');
  }
}