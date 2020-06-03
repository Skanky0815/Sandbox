Feature: Sandbox App who says Hello World
  I will greeted from the site after i say my name
  As a casual user
  If i brows the site

  Scenario: The first Hello World
    Given I am on the homepage
    Then I should see "Hello World"

  @javascript
  Scenario: I say my name on the site, it greets me with Hello Rico
    Given I am on the homepage
    When I fill in "Name" with "Rico"
      And I press "Senden"
    Then I should see "Hello Rico"
    When I fill in "Name" with "Corvin"
      And I press "Senden"
    Then I should see "Hello Corvin"

  @javascript
  Scenario: If i don't say my name, it greets whole world
    Given I am on the homepage
    When I press "Senden"
    Then I should see "name is required!"

  @javascript
  Scenario: If i type only 2 chars
    Given I am on the homepage
    When I fill in "Name" with "Ri"
     And I press "Senden"
    Then I should see "name is too short!"

  @javascript
  Scenario: If i don't say and type spaces
    Given I am on the homepage
    When I fill in "Name" with "  "
     And I press "Senden"
    Then I should see "name is required!"

  @javascript
  Scenario: If i don't say and type numbers
    Given I am on the homepage
    When I fill in "Name" with "21314"
     And I press "Senden"
    Then I should see "name must be a string!"
