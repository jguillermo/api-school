Feature: list all courses
  As a user
  I want to list all courses

  Scenario Outline: With course send correct data
    Given I send a DELETE request to "/courses/<courseId>"
    Given I send a PUT request to "/courses/<courseId>" with body:
    """
    {
      "name": "Mathematics"
    }
    """
    And I send a GET request to "/courses"
    Then the response content should be:
    """
    [{
      "id" : "<courseId>",
      "name" : "Mathematics"
    }]
    """
    Then I send a DELETE request to "/courses/<courseId>"
    Examples: id
      | courseId |
      | 8d71b5be-2e67-43de-9ac7-5e5f70763676 |