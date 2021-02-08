Feature: delete course
  As a user
  I want to create o update one course

  Scenario Outline: With course send correct data
    Given I send a PUT request to "/courses/<courseId>" with body:
    """
    {
      "name": "Mathematics"
    }
    """
    Given I send a DELETE request to "/courses/<courseId>"
    Then the response status code should be 200
    And the response should be empty
    Given I send a GET request to "/courses/<courseId>"
    Then the response content should be:
    """
    {
      "error": "Course not found"
    }
    """
    Examples: id
      | courseId |
      | 7dc672c8-e7d9-4107-a6e8-4f1211175d36 |