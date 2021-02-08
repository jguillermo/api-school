Feature: put course
  As a user
  I want to create o update one course

  Scenario Outline: With course send correct data
    Given I send a PUT request to "/courses/<courseId>" with body:
    """
    {
      "name": "Mathematics"
    }
    """
    Then the response status code should be 201
    And the response should be empty
    And I send a GET request to "/courses/<courseId>"
    Then the response content should be:
    """
    {
      "id" : "<courseId>",
      "name" : "Mathematics"
    }
    """
    Then I send a DELETE request to "/courses/<courseId>"
    Examples: id
      | courseId |
      | b6bd4625-e893-4581-8ef4-8c357ab9468b |

