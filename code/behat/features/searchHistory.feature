Feature: Search History Features
	This feature file test the search history feature.

Scenario: Can view previous search history
	Given that the user has searched an author or a key phrase before
	Then the user should be able to use previous search history

Scenario: Can view history on search page
	Given that the user is currently on search pages
	Then the user can view previous history

Scenario: Can view history on word cloud page
	Given that the user is currently on cloud pages
	Then the user can view previous history

Scenario: Can view history on paper list page
	Given that the user is currently on paper list pages
	Then the user can view previous history