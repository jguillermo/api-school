Feature: Find course by id
  As a user
  I want to see the course

  Scenario: With course not exit
    Given I send a GET request to "/courses/64744dcc-fa7e-4c9b-8236-2141d8a5ecc7"
    Then the response content should be:
    """
    {
      "error": "Course not found"
    }
    """
