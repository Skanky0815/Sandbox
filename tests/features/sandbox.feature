Feature: Sandbox App
  If the app runs, it should output the string "Hello World" or "Hello $Name" if you fill it in the from

  Scenario: Run the Application
    Given I am on "http://localhost:8888"
    Then I should see "Hello World"

  Scenario: Run the application and fill in my name
    Given I am on "http://localhost:8888"
      And I fill in "Name" with "Rico"
      And I press "Senden"
    Then I should see "Hello Rico"

  Scenario: Run the application and send without fill in my name
    Given I am on "http://localhost:8888"
      And I press "Senden"
    Then I should see "Hello World"
