Feature: delete once course
  As a user
  I want to create o update one course

  Scenario Outline: With course not exit
    Given I send a DELETE request to "/courses/<courseId>/exams/<examId>"
    Then the response content should be:
    """
    {
      "error": "Course not found"
    }
    """
    Examples: id
      | courseId | examId |
      | bf647061-5d93-4f04-903b-ed473e81c623 | de90916d-fd26-4c01-b413-a9d5cca4ba28 |

  Scenario Outline: With course send correct data
    Given I send a PUT request to "/courses/<courseId>" with body:
    """
    {
      "name": "Mathematics 3"
    }
    """
    Given I send a PUT request to "/courses/<courseId>/exams/<examId>" with body:
    """
    {
      "title": "Final exam"
    }
    """
    Given I send a DELETE request to "/courses/<courseId>/exams/<examId>"
    Then the response status code should be 200
    And the response should be empty
    Given I send a GET request to "/courses/<courseId>/exams/<examId>"
    Then the response content should be:
    """
    {
      "error": "Exam not found"
    }
    """
    Then I send a DELETE request to "/courses/<courseId>"
    Examples: id
      | courseId | examId |
      | c871b3f2-f20e-4d8c-b5a2-de3ff51f805f | 491761cd-1b12-4f68-beea-64ea53b218ea |