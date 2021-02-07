Feature: put student
  As a user
  I want to create o update one student

  Scenario: With student send correct data
    Given I send a PUT request to "/student/b5e242bb-89be-4933-a803-d4557ee9eb37" with body:
    """
    {
      "name": "Thomas Autry"
    }
    """
    And I send a GET request to "/student"
    Then the response content should be:
    """
    [{
      "id" : "b5e242bb-89be-4933-a803-d4557ee9eb37",
      "name" : "Thomas Autry"
    }]
    """
    Then I send a DELETE request to "/student/b5e242bb-89be-4933-a803-d4557ee9eb37"