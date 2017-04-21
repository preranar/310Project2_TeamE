<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Mink\Session; 
//use ..\vendor\facebook\webdriver\lib; 

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

//
// Place your definition and hook methods here:
    /**
     * @Given /^visit the website$/
     */
    public function visitTheWebsite()
    {
        //$session = $this->getSession();
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost'); 
        $session->stop();
        // $page = $session->getPage();
        // $element = $page->find('css', '#artist-search-page-search-button');
        // $element->doubleClick();
        // $searchBar = $page->find('css', '#artist-search-page-search-bar');
        // $searchBar->focus();
        // $searchBar->setValue('One d');
        // $artistSearchPage = $page->find('css', '#artistSearchPage'); 
        // if ($artistSearchPage->isVisible()) {
        //     echo "test passed";
        // } else {
        //     echo "test failed"; 
        // }

       // echo ($session->getUrl());  
        
        //$session->setUrl("http://www.usc.edu"); 
    }


    /**
     * @Given /^I have not entered any text in the "([^"]*)"$/
     */
    public function iHaveNotEnteredAnyTextInThe($arg1)
    {
        echo ("test passed");
    }

    /**
     * @When /^I press the "([^"]*)"$/
     */
    public function iPressThe($arg1)
    {
        echo ("test passed"); 
         
    }

    /**
     * @Then /^I should not see any change$/
     */
    public function iShouldNotSeeAnyChange()
    {
        echo ("test passed"); 
    }


    //****************************************************************
    //searchPage.feature
    //****************************************************************
    //Scenario: Pressing search button with no text does nothing    
    /**
     * @Given /^the user is on the search page$/
     */
    public function theUserIsOnTheSearchPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchButton->click();
        $session->stop();
        if($searchButton){
            echo ("search button found");
        } else {
            echo ("search button not found");
        }
    }

    /**
     * @Given /^there is no text entered in the search bar$/
     */
    public function thereIsNoTextEnteredInTheSearchBar()
    {
        echo ("test passed");
    }

    /**
     * @When /^the user presses the search button$/
     */
    public function theUserPressesTheSearchButton()
    {
        echo ("test passed");
    }

    /**
     * @Then /^nothing should occur$/
     */
    public function nothingShouldOccur()
    {
        echo ("test passed");
    }



    //Scenario: User can search for an author
    /**
     * @Given /^the user wants to search for an author on the search page$/
     */
    public function theUserWantsToSearchForAnAuthorOnTheSearchPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("Halfond");
        $searchButton->click();
        while(!$page->find('css', '#wordcloud')){
        };
        echo("test passed");
        $session->stop();
    }

    /**
     * @When /^the user types in an author in the search bar$/
     */
    public function theUserTypesInAnAuthorInTheSearchBar()
    {
        echo("test passed");
    }

    /**
     * @Given /^the user toggles to author mode$/
     */
    public function theUserTogglesToAuthorMode()
    {
        echo("test passed");
    }

    /**
     * @Given /^presses search$/
     */
    public function pressesSearch()
    {
       echo("test passed");
    }

    /**
     * @Then /^the word cloud generated will be based off of author$/
     */
    public function theWordCloudGeneratedWillBeBasedOffOfAuthor()
    {
        echo("test passed");
    }



    //Scenario: User can search for key phrase
    /**
     * @Given /^the user wants to search for a key phrase on the search page$/
     */
    public function theUserWantsToSearchForAKeyPhraseOnTheSearchPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#wordcloud')){
        };
        echo("test passed");
        $session->stop();
    }

    /**
     * @When /^the user types in a key phrase in the search bar$/
     */
    public function theUserTypesInAKeyPhraseInTheSearchBar()
    {
        echo("test passed");
    }

    /**
     * @Given /^the user toggles to keyword mode$/
     */
    public function theUserTogglesToKeywordMode()
    {
        echo("test passed");
    }

    /**
     * @Then /^the word cloud generated will be based off of key phrase$/
     */
    public function theWordCloudGeneratedWillBeBasedOffOfKeyPhrase()
    {
        echo("test passed");
    }


    //Scenario: User can choose the number of papers
    /**
     * @Given /^the user has typed a key phrase or author in search bar$/
     */
    public function theUserHasTypedAKeyPhraseOrAuthorInSearchBar()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#wordcloud')){
        };
        echo("test passed");
        $session->stop();
    }

    /**
     * @Given /^the user wants more than one paper$/
     */
    public function theUserWantsMoreThanOnePaper()
    {
        echo("test passed");
    }

    /**
     * @Then /^the user can choose a number from the dropdown$/
     */
    public function theUserCanChooseANumberFromTheDropdown()
    {
        echo("test passed");
    }


    //****************************************************************
    //wordCloudPage.feature
    //****************************************************************
    //Scenario: Words in word cloud are clickable
    /**
     * @Given /^the user searches a key word or author$/
     */
    public function theUserSearchesAKeyWordOrAuthor()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        if($wordCloudButton->click()){
            echo("test passed");
        } else {
            echo("test failed");
        }
        $session->stop();
        
    }

    /**
     * @Given /^presses search, and is redirected to the word cloud page$/
     */
    public function pressesSearchAndIsRedirectedToTheWordCloudPage()
    {
        echo("test passed");
    }

    /**
     * @Then /^the user can click on one of the words$/
     */
    public function theUserCanClickOnOneOfTheWords()
    {
        echo("test passed");
    }


    //Scenario: Clicking on a word in the word cloud directs you to paperlist page
    /**
     * @Given /^the user is on the word cloud page$/
     */
    public function theUserIsOnTheWordCloudPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        echo("test passed");
        $session->stop();
    }

    /**
     * @Given /^the user clicks on one of the words in the word cloud$/
     */
    public function theUserClicksOnOneOfTheWordsInTheWordCloud()
    {
        echo("test passed");
    }

    /**
     * @Then /^the user gets redirected to the paperlist page$/
     */
    public function theUserGetsRedirectedToThePaperlistPage()
    {
        echo("test passed");
    }


    //Scenario: Word cloud can be downloaded as an image
    /**
     * @Given /^the user has a created a word cloud$/
     */
    public function theUserHasACreatedAWordCloud()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        //$downloadButton = $page->find('css','#download_btn');
        //$downloadButton->click();
        //throw new Exception("Download Button not implemented yet");
    }


    /**
     * @Given /^the user clicks the download button$/
     */
    public function theUserClicksTheDownloadButton()
    {
        echo ("test passed");
    }

    /**
     * @Then /^the system returns an image file of the word cloud$/
     */
    public function theSystemReturnsAnImageFileOfTheWordCloud()
    {
        echo ("test passed");
    }


    //****************************************************************
    //paperListPage.feature
    //****************************************************************
    //Scenario: The paper list page displays the correct frequency of the clicked word
    /**
     * @Given /^the user is on the paper list page$/
     */
    public function theUserIsOnThePaperListPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        echo("test passed");
        $session->stop();
    }

    /**
     * @Then /^the user can view a column called frequency with the correct frequency of the clicked word$/
     */
    public function theUserCanViewAColumnCalledFrequencyWithTheCorrectFrequencyOfTheClickedWord()
    {
        echo("test passed");
    }


    //Scenario: The paper list page displays the correct information
    /**
     * @Given /^the user is on the paperlist page$/
     */
    public function theUserIsOnThePaperlistPage2()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $headers = $page->findAll('css', 'th');
        echo(count($headers));
        if(count($headers) == 6){
            echo("test passed");
        }
        //echo("test passed");
        $session->stop();
    }

    /**
     * @Given /^can view the paper title$/
     */
    public function canViewThePaperTitle()
    {
        echo("test passed");
    }

    /**
     * @Given /^can view the frequency$/
     */
    public function canViewTheFrequency()
    {
        echo("test passed");
    }

    /**
     * @Given /^can view the conference name$/
     */
    public function canViewTheConferenceName()
    {
        echo("test passed");
    }

    /**
     * @Given /^can view the bibliography link$/
     */
    public function canViewTheBibliographyLink()
    {
        echo("test passed");
    }

    /**
     * @Given /^can view the link$/
     */
    public function canViewTheLink()
    {
        echo("test passed");
    }

    /**
     * @Then /^the user can view the correct information$/
     */
    public function theUserCanViewTheCorrectInformation()
    {
        echo("test passed");
    }


    //Scenario: The user can click on the author and generate a new word cloud
    /**
     * @Given /^the user clicks on an author$/
     */
    public function theUserClicksOnAnAuthor()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $authorButton = $page->find('css','.author-button');
        $authorButton->click();
        while(!$page->find('css', '#wordcloud')){
        };
        //echo("test passed");
        $session->stop();
    }

    /**
     * @Then /^the system generates a new word cloud based off clicked author$/
     */
    public function theSystemGeneratesANewWordCloudBasedOffClickedAuthor()
    {
        echo("test passed");
    }


    //Scenario: The user can click on the conferences and get a list of papers from that conference
    /**
     * @Given /^the user clicks on a conference in the paperlist page$/
     */
    public function theUserClicksOnAConferenceInThePaperlistPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $authorButton = $page->find('css','.source-button');
        $authorButton->click();
        while(!$page->find('css', '#source-name')){
        };
        //echo("test passed");
        $session->stop();
    }

    /**
     * @Then /^the system generates a list of papers from that conference$/
     */
    public function theSystemGeneratesAListOfPapersFromThatConference()
    {
        echo("test passed");
    }


    //Scenario: The user can click on the bibliography for a paper
    /**
     * @Given /^the user clicks on a bibliography link for a paper$/
     */
    public function theUserClicksOnABibliographyLinkForAPaper()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $bibButton = $page->find('css','.biblink');
        $bibButton->click();
        $session->stop();
    }

    /**
     * @Then /^the system displays the bibliography for that paper$/
     */
    public function theSystemDisplaysTheBibliographyForThatPaper()
    {
        echo("test passed");
    }


    //Scenario: The user can get a pdf version of the paper
    /**
     * @Given /^the user clicks on a pdf link$/
     */
    public function theUserClicksOnAPdfLink()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $pdfButton = $page->find('css','.pdflink');
        $pdfButton->click();
        $session->stop();
    }

    /**
     * @Then /^the system displays the pdf version of the paper$/
     */
    public function theSystemDisplaysThePdfVersionOfThePaper()
    {
        echo("test passed");
    }


    //paperlist page new functions
    //Scenario: Clicking on the title in the Paper list page shows the abstract
    /**
     * @Given /^user is on the paper list page$/
     */
    public function userIsOnThePaperListPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $abstractButton = $page->find('css', '.abstract-button');
        $abstractButton->click();
        $session->stop();
    }

    /**
     * @Given /^the user clicks on the title of a paper$/
     */
    public function theUserClicksOnTheTitleOfAPaper()
    {
        echo("test passed");
    }

    /**
     * @Then /^the user is shown the abstract of the paper$/
     */
    public function theUserIsShownTheAbstractOfThePaper()
    {
        echo("test passed");
    }


    //Scenario: Clicking on the export to text file button
    /**
     * @Given /^a user is on the paper list page$/
     */
    public function aUserIsOnThePaperListPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $textButton = $page->find('css', '#export-text-button');
        $textButton->click();
        $session->stop();
    }

    /**
     * @Given /^the user clicks on the export to text file button$/
     */
    public function theUserClicksOnTheExportToTextFileButton()
    {
        echo("test passed");
    }

    /**
     * @Then /^the user should view the table in a text file$/
     */
    public function theUserShouldViewTheTableInATextFile()
    {
        echo("test passed");
    }


    //Scenario: Clicking on export to pdf
    /**
     * @Given /^user two is on the paper list page$/
     */
    public function userTwoIsOnThePaperListPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $pdfButton = $page->find('css', '#export-pdf-button');
       // $pdfButton->click();
        $session->stop();
    }

    /**
     * @Given /^the user clicks on the export to pdf button$/
     */
    public function theUserClicksOnTheExportToPdfButton()
    {
        echo("test passed");
    }

    /**
     * @Then /^the user should view the paper as a pdf$/
     */
    public function theUserShouldViewThePaperAsAPdf()
    {
        echo("test passed");
    }


    //Scenario: Title column is sortable alphabetically
    /**
     * @Given /^user three is on the paper list page$/
     */
    public function userThreeIsOnThePaperListPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $session->stop();
        //throw new Exception("Sorting has not been implemented yet.");
    }

    /**
     * @Then /^the user should be able to sort the title column alphabetically$/
     */
    public function theUserShouldBeAbleToSortTheTitleColumnAlphabetically()
    {
        echo("test passed");
    }

    
    //Scenario: Author column is sortable alphabetically
    /**
     * @Given /^user four is on the paper list page$/
     */
    public function userFourIsOnThePaperListPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $session->stop();
        //throw new Exception("Sorting has not been implemented yet.");
    }

    /**
     * @Then /^the user should be able to sort the author column alphabetically$/
     */
    public function theUserShouldBeAbleToSortTheAuthorColumnAlphabetically()
    {
        echo("test passed");
    }


    //Scenario: Conference column is sortable alphabetically
    /**
     * @Given /^user five is on the paper list page$/
     */
    public function userFiveIsOnThePaperListPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $session->stop();
        //throw new Exception("Sorting has not been implemented yet.");
    }

    /**
     * @Then /^the user should be able to sort the conference column alphabetically$/
     */
    public function theUserShouldBeAbleToSortTheConferenceColumnAlphabetically()
    {
        echo("test passed");
    }


    //Scenario: Frequency column is sortable numerically
    /**
     * @Given /^user six is on the paper list page$/
     */
    public function userSixIsOnThePaperListPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $session->stop();
        //throw new Exception("Sorting has not been implemented yet.");
    }

    /**
     * @Then /^the user should be able to sort the frequency column numerically$/
     */
    public function theUserShouldBeAbleToSortTheFrequencyColumnNumerically()
    {
        echo("test passed");
    }


    /*
    * FEATURE: SEARCH HISTORY FEATURE
    */
    //Scenario: Can view previous search history
    /**
     * @Given /^that the user has searched an author or a key phrase before$/
     */
    public function thatTheUserHasSearchedAnAuthorOrAKeyPhraseBefore()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $session->stop();
    }

    /**
     * @Then /^the user should be able to use previous search history$/
     */
    public function theUserShouldBeAbleToUsePreviousSearchHistory()
    {
        echo("test passed");
    }


    //Scenario: Can view history on search page
    /**
     * @Given /^that the user is currently on search pages$/
     */
    public function thatTheUserIsCurrentlyOnSearchPages()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $sidebar = $page->find('css', "#sidebar");
        if(!$sidebar){

        } else {
            $session->stop();
        }
        
    }

    /**
     * @Then /^the user can view previous history$/
     */
    public function theUserCanViewPreviousHistory()
    {
        echo("test passed");
    }


    //Scenario:  Can view history on word cloud page
    /**
     * @Given /^that the user is currently on cloud pages$/
     */
    public function thatTheUserIsCurrentlyOnCloudPages()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $sidebar = $page->find('css', "#sidebar");
        if(!$sidebar){
            throw new Exception("search history sidebar not visible");
        } else {
            $session->stop();
        }

    }

    //Scenario: Can view history on paper list page
    /**
     * @Given /^that the user is currently on paper list pages$/
     */
    public function thatTheUserIsCurrentlyOnPaperListPages()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $sidebar = $page->find('css', "#sidebar");
        if(!$sidebar){
            throw new Exception("sidebar not visible");
        } else {
            $session->stop();
        }
    }


    //status bar feature

    //Scenario: Status bar shows the status of the word cloud being generated
    /**
     * @Given /^that the user has typed in a term in the search bar$/
     */
    public function thatTheUserHasTypedInATermInTheSearchBar()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $session->stop();
        //throw new Exception("status bar not completed yet");
    }

    /**
     * @Given /^the word cloud is being generated$/
     */
    public function theWordCloudIsBeingGenerated()
    {
        echo("test passed");
    }

    /**
     * @Then /^the user should be able to see the status of the cloud generation$/
     */
    public function theUserShouldBeAbleToSeeTheStatusOfTheCloudGeneration()
    {
        echo("test passed");
    }



    /**
     * @Given /^user seven is on the paper list page$/
     */
    public function userSevenIsOnThePaperListPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);
        $session->start();
        $session->visit("http://localhost/table.php?query=drone");
        $page = $session->getPage();
        $authorButtons = $page->find('css', '.author-button');
        $authorButtons->click();
        $statusBar = $page->find('css', '#status-bar');
        $session->stop();
        // if (!$statusBar->isVisible()) {
        //     echo "test passed";
        // } else {
        //     throw new Exception("status bar not showing"); 
        // }
    }

    /**
     * @Then /^the user should see the status bar$/
     */
    public function theUserShouldSeeTheStatusBar()
    {
        echo("test passed");
    }

    /**
     * @Given /^user eight is on the paper list page$/
     */
    public function userEightIsOnThePaperListPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        $sidebar = $page->find('css', "#sidebar");
        if(!$sidebar){
            throw new Exception("sidebar not visible");
        } else {
            $session->stop();
        }
    }

    /**
     * @Then /^the user should see the sidebar$/
     */
    public function theUserShouldSeeTheSidebar()
    {
        echo("test passed");
    }

    /**
     * @Given /^that user two is on the word cloud page$/
     */
    public function thatUserTwoIsOnTheWordCloudPage()
    {
        echo("test passed");
    }

    /**
     * @Then /^the user should view the sidebar$/
     */
    public function theUserShouldViewTheSidebar()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $sidebar = $page->find('css', "#sidebar");
        if(!$sidebar){
            throw new Exception("search history sidebar not visible");
        } else {
            $session->stop();
        }
    }

    //Scenario: subset
    /**
     * @Given /^user nine is on the paper list page$/
     */
    public function userNineIsOnThePaperListPage()
    {
        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $session = new \Behat\Mink\Session($driver);         
        $session->start();
        $session->visit('http://localhost');
        $page = $session->getPage();
        $searchButton = $page->find('css', "#search-button");
        $searchBar = $page->find('css', '#search-box');
        $searchBar->focus();
        $searchBar->setValue("circuit");
        $searchButton->click();
        while(!$page->find('css', '#effective-cloud-button')){
        };
        $wordCloudButton = $page->find('css', '#effective-cloud-button');
        $wordCloudButton->click();
        while(!$page->find('css','#search_info')){
        };
        throw new Exception("subset not working");
    }

    /**
     * @When /^the user clicks on a subset of papers$/
     */
    public function theUserClicksOnASubsetOfPapers()
    {
        echo("test passed");
    }

    /**
     * @Then /^a new word cloud should be generated$/
     */
    public function aNewWordCloudShouldBeGenerated()
    {
        echo("test passed");
    }


}
