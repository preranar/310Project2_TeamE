Feature: Word Cloud Page
This page displays the word cloud in which the words a clickable and redirect to the paper list page.
The user should also be able to download the word cloud from this page.

Scenario: Words in word cloud are clickable
	Given the user searches a key word or author
	And presses search, and is redirected to the word cloud page
	Then the user can click on one of the words 

Scenario: Clicking on a word in the word cloud directs you to paperlist page
	Given the user is on the word cloud page
	And the user clicks on one of the words in the word cloud
	Then the user gets redirected to the paperlist page

Scenario: Word cloud can be downloaded as an image
	Given the user has a created a word cloud
	And the user clicks the download button
	Then the system returns an image file of the word cloud

Scenario: The previous search history is visible on the word cloud page
	Given that user two is on the word cloud page
	Then the user should view the sidebar