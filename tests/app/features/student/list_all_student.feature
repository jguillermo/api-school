Feature: list all student
  As a user
  I want to create o update one student

  Scenario Outline: With student send correct data
    Given I send a DELETE request to "/students/<studentId>"
    Given I send a PUT request to "/students/<studentId>" with body:
    """
    {
      "name": "Thomas Autry"
    }
    """
    And I send a GET request to "/students"
    Then the response content should be:
    """
    [{
      "id" : "<studentId>",
      "name" : "Thomas Autry"
    }]
    """
    Then I send a DELETE request to "/students/<studentId>"
    Examples: id
      | studentId |
      | b5e242bb-89be-4933-a803-d4557ee9eb37 |