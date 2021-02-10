Feature: put grade.
  As a user
  I want to create o update grades by students y course enrollments

  Scenario Outline: With student send correct data
    Given I send a DELETE request to "/students/<studentId>"
    Given I send a DELETE request to "/courses/<courseId>"
    Given I send a PUT request to "/students/<studentId>" with body:
    """
    {
      "name": "Ardith Savary"
    }
    """
    Given I send a PUT request to "/courses/<courseId>" with body:
    """
    {
      "name": "Language"
    }
    """
    Given I send a PUT request to "/courses/<courseId>/exams/<examId>" with body:
    """
    {
      "title": "First exam"
    }
    """
    Then I send a GET request to "/students/<studentId>/grades"
    Then the response content should be:
    """
    [{
      "grade":16,
      "studentId":"<studentId>",
      "courseId":"<courseId>",
      "examId":"<examId>"
    }]
    """
    Then I send a DELETE request to "/students/<studentId>"
    Then I send a DELETE request to "/courses/<courseId>"

    Examples: id
      | studentId | courseId | examId |
      | ee492a1a-4b86-41df-9229-9bbd03326841 | 1d437e9d-1305-4df8-84c3-954b31be4cb4 | 757b5995-83d7-4561-a1a6-ce6fef9e652c |

