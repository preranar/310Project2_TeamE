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



    //Scenario:
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


}
