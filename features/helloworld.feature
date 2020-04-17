Feature: Sandbox App
  If the app runs, it should output the string "Hello World"

  Scenario: Run the Application
    Given the Sandbox app
    And run them
    Then it returns "Hello World"
