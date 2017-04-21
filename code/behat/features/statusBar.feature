Feature: Status Bar
	This tests the status bar.

Scenario: Status bar shows the status of the word cloud being generated
	Given that the user has typed in a term in the search bar
	And the word cloud is being generated
	Then the user should be able to see the status of the cloud generation