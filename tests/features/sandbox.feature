Feature: Sandbox App who says Hello World
  If i brows the site
  As a casual user
  I will greeted from the site after i say my name

  Scenario: The first Hello World
    Given I am on "http://localhost:8888"
    Then I should see "Hello World"

  #@javascript
  Scenario: I say my name on the site, it greets me with Hello Rico
    Given I am on "http://localhost:8888"
    When I fill in "Name" with "Rico"
      And I press "Senden"
    Then I should see "Hello Rico"

  Scenario: If i don't say my name, it greets whole world
    Given I am on "http://localhost:8888"
    When I press "Senden"
    Then I should see "Hello World"
