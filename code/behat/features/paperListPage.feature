Feature: Paper List Page
	The user is shown a list of papers containing the word from the word cloud that was clicked. It also
	shows for each paper the author, the frequency of the word, the conference name, the link to the 
	bibliography and pdf of the document.

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

Scenario: The user can click on the author and generate a new word cloud 
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

Scenario: Clicking on the title in the Paper list page shows the abstract
	Given user is on the paper list page
	And the user clicks on the title of a paper
	Then the user is shown the abstract of the paper

Scenario: Clicking on the export to text file button
	Given a user is on the paper list page
	And the user clicks on the export to text file button
	Then the user should view the table in a text file

Scenario: Clicking on export to pdf
	Given user two is on the paper list page
	And the user clicks on the export to pdf button
	Then the user should view the paper as a pdf

Scenario: Title column is sortable alphabetically
	Given user three is on the paper list page
	Then the user should be able to sort the title column alphabetically

Scenario: Author column is sortable alphabetically
	Given user four is on the paper list page
	Then the user should be able to sort the author column alphabetically

Scenario: Conference column is sortable alphabetically
	Given user five is on the paper list page
	Then the user should be able to sort the conference column alphabetically

Scenario: Frequency column is sortable numerically
	Given user six is on the paper list page
	Then the user should be able to sort the frequency column numerically

Scenario: The status bar appears during loading 
	Given user seven is on the paper list page
	And the user clicks on an author
	Then the user should see the status bar

Scenario: The sidebar previous search history appears
	Given user eight is on the paper list page
	Then the user should see the sidebar

Scenario: The user can click on a subset of papers to form a word cloud
	Given user nine is on the paper list page
	When the user clicks on a subset of papers
	Then a new word cloud should be generated
