@javascript
Feature: Test the Fruit Form
  In order to submit my favorite fruit and email address
  As a visitor
  I need to be able to use the fruit form

  Background:
    Given I am on "/testmodule/ask-user"

  Scenario: Visiting "/testmodule/ask-user" displays the fruit form
    Then I should see the heading "Fruit Form"

  Scenario: The fruit form displays a select field for favorite fruit
    Then I should see an "#edit-favorite-fruit" element

  Scenario: The fruit form displays an email address field
    Then I should see an "#edit-email-address" element

  Scenario: The fruit form question field has all of the options we expect
    When I go to "/testmodule/ask-user"
    Then I should see "Apple" in the "#edit-favorite-fruit" element
      And I should see "Banana" in the "#edit-favorite-fruit" element
      And I should see "Blueberry" in the "#edit-favorite-fruit" element
      And I should see "Grapes" in the "#edit-favorite-fruit" element
      And I should see "Orange" in the "#edit-favorite-fruit" element
      And I should see "Strawberry" in the "#edit-favorite-fruit" element

  Scenario: The fruit form displays a submit button
    Then I should see the button "Submit!"

  Scenario: User sees successful message on the homepage after submitting
    When I enter "Blueberry" for "edit-favorite-fruit"
      And I enter "anonymous@example.com" for "edit-email-address"
      And I press the "Submit!" button
    Then I should see the text "Blueberry! Wow! Nice choice! Thanks for telling us!" in the "highlighted" region
      And I should be on the homepage