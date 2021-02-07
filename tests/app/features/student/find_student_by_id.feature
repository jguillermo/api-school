Feature: Find student by id
  As a user
  I want to see the student

  Scenario: With student not exit
    Given I send a GET request to "/students/1ee043c1-e657-4c66-b71a-f9ed0e45feb3"
    Then the response content should be:
    """
    {
      "error": "Student not found"
    }
    """
