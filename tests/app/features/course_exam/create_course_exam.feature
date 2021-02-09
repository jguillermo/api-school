Feature: put exam by course
  As a user
  I want to create o update one course

  Scenario Outline: With course not exit
    Given I send a PUT request to "/courses/<courseId>/exams/<examId>" with body:
    """
    {
      "title": "Final exam"
    }
    """
    Then the response content should be:
    """
    {
      "error": "Course not found"
    }
    """
    Examples: id
      | courseId | examId |
      | 7c36e2ec-03ce-497a-80f4-c0db116a8779 | 8322193c-c246-41db-b1fb-5df588180a1d |

  Scenario Outline: With course send correct data
    Given I send a PUT request to "/courses/<courseId>" with body:
    """
    {
      "name": "Mathematics"
    }
    """
    Given I send a PUT request to "/courses/<courseId>/exams/<examId>" with body:
    """
    {
      "title": "Final exam"
    }
    """
    Then the response status code should be 201
    And the response should be empty
    And I send a GET request to "/courses/<courseId>/exams/<examId>"
    Then the response content should be:
    """
    {
      "id" : "<examId>",
      "title" : "Final exam"
    }
    """
    Then I send a DELETE request to "/courses/<courseId>"
    Examples: id
      | courseId | examId |
      | b6bd4625-e893-4581-8ef4-8c357ab9468b | 096de9d9-acb2-4d83-b3e9-11d5b86e05f8 |

