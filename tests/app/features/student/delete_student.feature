Feature: delete student
  As a user
  I want to create o update one student

  Scenario Outline: With student send correct data
    Given I send a PUT request to "/students/<studentId>" with body:
    """
    {
      "name": "Thomas Autry"
    }
    """
    Given I send a DELETE request to "/students/<studentId>"
    Then the response status code should be 200
    And the response should be empty
    Given I send a GET request to "/students/<studentId>"
    Then the response content should be:
    """
    {
      "error": "Student not found"
    }
    """
    Examples: id
      | studentId |
      | 664444e6-9db5-4997-9138-d978ec0a4ecb |