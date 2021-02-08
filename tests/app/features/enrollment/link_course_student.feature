Feature: Link course and student
  As a user
  I want to enrollment student when course is created

  Scenario Outline: With course create and student exist
    Given I send a PUT request to "/students/<studentId>" with body:
    """
    {
      "name": "Kathy Decker"
    }
    """
    And I send a PUT request to "/courses/<courseId>" with body:
    """
    {
      "name": "Physics"
    }
    """
    And I send a GET request to "/students/<studentId>/enrollments"
    Then the response content should be:
    """
    [{
      "courseName" : "Physics",
      "courseId" : "<courseId>"
    }]
    """
    Then I send a DELETE request to "/courses/<courseId>"
    Then I send a DELETE request to "/students/<studentId>"
    Examples: id
      | courseId | studentId |
      | 6f86ef90-0d13-40aa-a651-6dfa782caf43 | 1fd5050a-781c-48ce-bf74-21a956e0e9d3 |

