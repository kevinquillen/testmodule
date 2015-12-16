<?php

namespace Drupal\testmodule\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provide some basic tests for our FruitForm form.
 * @group testmodule
 */
class FruitFormTest extends WebTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
  public static $modules = ['node', 'testmodule'];

  /**
   * Tests that '/testmodule/ask-user' returns a 200.
   */
  public function testFruitFormExists() {
    $this->drupalGet('testmodule/ask-user');
    $this->assertResponse(200);
  }

  /**
   * Test the various fields in the form.
   */
  public function testFruitFormFields() {
    $this->drupalGet('testmodule/ask-user');
    $this->assertResponse(200);

    // check that our select field displays on the form
    $this->assertFieldByName('favorite_fruit');

    // check that the user has a way to submit the form
    $this->assertFieldById('edit-submit');

    // check that all of our options are available
    $fruits = ['Apple', 'Banana', 'Blueberry', 'Grapes', 'Orange', 'Strawberry'];

    foreach ($fruits as $fruit) {
      $this->assertOption('edit-favorite-fruit', $fruit);
    }

    // check that Pizza is not an option. Sorry, pizza lovers.
    $this->assertNoOption('edit-favorite-fruit', 'Pizza');
  }

  /**
   * Test the submission of the form.
   * @throws \Exception
   */
  public function testFruitFormSubmit() {
    $this->drupalGet('testmodule/ask-user');
    $this->assertResponse(200);

    // submit the form with Blueberry as a value
    $this->drupalPostForm(
      'testmodule/ask-user',
      array(
        'favorite_fruit' => 'Blueberry'
      ),
      t('Submit!')
    );

    // we should now be on the homepage, and see the right form success message
    $this->assertUrl('<front>');
    $this->assertText('Blueberry! Wow! Nice choice! Thanks for telling us!', 'The successful submission message was detected on the screen.');
  }
}