Feature: put student.
  As a user
  I want to create o update one student

  Scenario Outline: With student send correct data
    Given I send a PUT request to "/students/<studentId>" with body:
    """
    {
      "name": "Thomas Autry"
    }
    """
    Then the response status code should be 201
    And the response should be empty
    And I send a GET request to "/students/<studentId>"
    Then the response content should be:
    """
    {
      "id" : "<studentId>",
      "name" : "Thomas Autry"
    }
    """
    Then I send a DELETE request to "/students/<studentId>"

    Examples: id
      | studentId |
      | 18c410f8-162a-40c5-9ded-f21d5bc70cbf |

