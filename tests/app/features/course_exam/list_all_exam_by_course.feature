Feature: list all exams by course
  As a user
  I want to list all courses

  Scenario Outline: With course not exit
    Given I send a GET request to "/courses/<courseId>/exams"
    Then the response content should be:
    """
    {
      "error": "Course not found"
    }
    """
    Examples: id
      | courseId |
      | 3533468d-b7c7-48d8-926a-d8c66c16fd3d |


  Scenario Outline: With course send correct data
    Given I send a PUT request to "/courses/<courseId>" with body:
    """
    {
      "name": "Mathematics 2"
    }
    """
    Given I send a PUT request to "/courses/<courseId>/exams/<examId>" with body:
    """
    {
      "title": "Partial exam"
    }
    """
    And I send a GET request to "/courses/<courseId>/exams"
    Then the response content should be:
    """
    [{
      "id" : "<examId>",
      "title" : "Partial exam"
    }]
    """
    Then I send a DELETE request to "/courses/<courseId>"
    Examples: id
      | courseId | examId |
      | 082150b3-7bac-4016-9519-d6d5996f0f72 | da9f98f5-f761-466e-be43-a4397b7cf2da |