Feature: Search Page
The user can type in an author or key phrase as well as the number of 
papers that the word cloud should have. Once the user presses search, 
a word cloud containing the papers with the searched term should display.

Scenario: Pressing search button with no text does nothing
	Given the user is on the search page
	And there is no text entered in the search bar
	When the user presses the search button
	Then nothing should occur

Scenario: User can search for an author
	Given the user wants to search for an author on the search page
	When the user types in an author in the search bar
	And the user toggles to author mode
	And presses search
	Then the word cloud generated will be based off of author

Scenario: User can search for key phrase
	Given the user wants to search for a key phrase on the search page
	When the user types in a key phrase in the search bar
	And the user toggles to keyword mode
	And presses search
	Then the word cloud generated will be based off of key phrase

Scenario: User can choose the number of papers
	Given the user has typed a key phrase or author in search bar
	And the user wants more than one paper
	Then the user can choose a number from the dropdown


