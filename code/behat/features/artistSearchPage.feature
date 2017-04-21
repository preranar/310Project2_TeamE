Feature: Search
In order to user the website in passive mode
I can't have anything happen when I press the search button

Scenario: Pressing Search with no text does nothing
	Given visit the website
	And I have not entered any text in the "Artist Search Bar"
	When I press the "Search Button"
	Then I should not see any change