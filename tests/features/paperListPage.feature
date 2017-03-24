Feature: Paper List Page
The user is shown a list of papers containing the word from the word cloud that was clicked. It also
shows for each paper the author, the frequency of the word, the conference name, 
the link to the bibliography and pdf of the document.

Scenario: The paper list page displays the correct frequency of the clicked word
	Given the user is on the paper list page
	Then the user can view a column called frequency with the correct frequency of the clicked word

Scenario: The paper list page displays the correct information
	Given the user is on the paperlist page
	And can view the paper title
	And can view the frequency 
	And can view the conference name
	And can view the bibliography link
	And can view the link
	Then the user can view the correct information

Scenario; The user can click on the author and generate a new word cloud 
	Given the user clicks on an author
	Then the system generates a new word cloud based off clicked author

Scenario: The user can click on the conferences and get a list of papers from that conference
	Given the user clicks on a conference in the paperlist page
	Then the system generates a list of papers from that conference

Scenario: The user can click on the bibliography for a paper
	Given the user clicks on a bibliography link for a paper
	Then the system displays the bibliography for that paper

Scenario: The user can get a pdf version of the paper
	Given the user clicks on a pdf link
	Then the system displays the pdf version of the paper