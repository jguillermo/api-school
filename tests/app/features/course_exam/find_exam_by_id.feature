Feature: Find exam by id
  As a user
  I want to see the course

  Scenario: With course not exit
    Given I send a GET request to "/courses/0a462c4d-1485-4f42-9278-a5edc5532993/exams/43395e55-24bc-432a-9f31-806561ac8fdb"
    Then the response content should be:
    """
    {
      "error": "Course not found"
    }
    """

  Scenario Outline: With course exit and exam not exit
    Given I send a PUT request to "/courses/<courseId>" with body:
    """
    {
      "name": "Mathematics"
    }
    """
    Given I send a GET request to "/courses/<courseId>/exams/ef2029e2-d9ae-45b2-b296-c7b4fc6b4db3"
    Then the response content should be:
    """
    {
      "error": "Exam not found"
    }
    """
    Then I send a DELETE request to "/courses/<courseId>"
    Examples: id
      | courseId |
      | b6bd4625-e893-4581-8ef4-8c357ab9468b |


