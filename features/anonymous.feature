@javascript
Feature: Test the Fruit Form
  In order to prove Drupal serves up an example form asking about your favorite fruit
  As a developer
  I need to use the step definitions of this context

  Scenario: Visiting "/testmodule/ask-user" displays the fruit form
    When I go to "/testmodule/ask-user"
    Then I should see the heading "Fruit Form"

  Scenario: The fruit form displays the question
    When I go to "/testmodule/ask-user"
    Then I should see the text "Tell us your favorite fruit"

  Scenario: The fruit form question field has all of the options we expect, and not Pizza
    When I go to "/testmodule/ask-user"
    Then I should see "Apple" in the "#edit-favorite-fruit" element
    And I should see "Banana" in the "#edit-favorite-fruit" element
    And I should see "Blueberry" in the "#edit-favorite-fruit" element
    And I should see "Grapes" in the "#edit-favorite-fruit" element
    And I should see "Orange" in the "#edit-favorite-fruit" element
    And I should see "Strawberry" in the "#edit-favorite-fruit" element
    And I should not see "Pizza" in the "#edit-favorite-fruit" element

  Scenario: The fruit form displays a submit button
    When I go to "/testmodule/ask-user"
    Then I should see the button "Submit!"

  Scenario: User sees successful message on the homepage after submitting
    When I go to "/testmodule/ask-user"
    And I enter "Blueberry" for "edit-favorite-fruit"
    And I enter "anonymous@example.com" for "edit-email-address"
    And I press the "Submit!" button
    Then I should see the text "Blueberry! Wow! Nice choice! Thanks for telling us!" in the "highlighted" region
    And I should be on the homepage