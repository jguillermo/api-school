Feature: put student
  As a user
  I want to create o update one student

  Scenario: With student send correct data
    Given I send a PUT request to "/student/f927465f-c78e-4529-8057-48bfd8f73544" with body:
    """
    {
      "name": "Thomas Autry"
    }
    """
    Then the response status code should be 201
    And the response should be empty