<?php
require_once('../../Bibliography.php');
use PHPUnit\Framework\TestCase;

class BibliographyTest extends TestCase {	
	public static $coverage;
	
	protected $from = 'IEEE';
	protected $authors = 'First, Author; Second, Author';
	protected $py = 'py';
	protected $title = 'title';
	protected $volume = 'volume';
	protected $issue = 'issue';
	protected $pubtitle = 'pubtitle';
	protected $punumber = 'punumber';
	protected $spage = 'spage';
	protected $epage = 'epage';
	protected $affiliations = 'affiliations';
	protected $publisher = 'publisher';
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public static function setUpBeforeClass() {
	// 	BibliographyTest::$coverage = new PHP_CodeCoverage();
	// }
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public function setUp() {
	// 	BibliographyTest::$coverage->start($this);
	// }
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public function tearDown() {
	// 	BibliographyTest::$coverage->stop();
	// }
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public static function tearDownAfterClass() {
	// 	$writer = new PHP_CodeCoverage_Report_Clover;
	// 	$writer->process(BibliographyTest::$coverage, 'coverage/BibliographyTest.xml');
		
	// 	$writer = new PHP_CodeCoverage_Report_HTML;
	// 	$writer->process(BibliographyTest::$coverage, 'coverage/BibliographyTest');
	// }
	
	/**
	 * Sanity check
	 */
	public function testNullResultFromGenerateBibTexGeneral() {
		$paper = array('Nonexistent' => 'Paper');
		
		$result = Bibliography::generateBibTexGeneral($paper);
		
		$this->assertNull($result);
	}
	
	/**
	 * Check proper generation of BibTex for Conference
	 */
	public function testBibTexIEEEConference() {
		$conference = array();
		
		$conference['from'] = $this->from;
		$conference['authors'] = $this->authors;
		$conference['py'] = $this->py;
		$conference['title'] = $this->title;
		$conference['pubtype'] = "Conference";
		$conference['pubtitle'] = $this->pubtitle;
		$conference['volume'] = $this->volume;
		$conference['issue'] = $this->issue;
		$conference['spage'] = $this->spage;
		$conference['epage'] = $this->epage;
		$conference['affiliations'] = $this->affiliations;
		$conference['publisher'] = $this->publisher;
		
		$result = Bibliography::generateBibTexIEEE($conference);
		$this->assertNotNull($result);
		$this->assertEquals($result, "@Conference{firstpytitle,<br/>&emsp;&emsp;&emsp;&emsp;title=\"title\",<br/>&emsp;&emsp;&emsp;&emsp;author=\"First, Author; Second, Author\",<br/>&emsp;&emsp;&emsp;&emsp;booktitle=\"pubtitle\",<br/>&emsp;&emsp;&emsp;&emsp;year=\"py\",<br/>&emsp;&emsp;&emsp;&emsp;volume=\"volume\",<br/>&emsp;&emsp;&emsp;&emsp;number=\"issue\",<br/>&emsp;&emsp;&emsp;&emsp;pages=\"spage--epage\",<br/>&emsp;&emsp;&emsp;&emsp;organization=\"affiliations\",<br/>&emsp;&emsp;&emsp;&emsp;publisher=\"publisher\"<br/>}");
	}
	
	/**
	 * Check proper generation of BibTex for Conference
	 */
	public function testBibTexIEEEConferencePUNumber() {
		$conference = array();
		
		$conference['from'] = $this->from;
		$conference['authors'] = $this->authors;
		$conference['py'] = $this->py;
		$conference['title'] = $this->title;
		$conference['pubtype'] = "Conference";
		$conference['pubtitle'] = $this->pubtitle;
		$conference['volume'] = $this->volume;
		$conference['punumber'] = $this->punumber;
		$conference['spage'] = $this->spage;
		$conference['epage'] = $this->epage;
		$conference['affiliations'] = $this->affiliations;
		$conference['publisher'] = $this->publisher;
		
		$result = Bibliography::generateBibTexIEEE($conference);
		$this->assertNotNull($result);
		$this->assertEquals($result, "@Conference{firstpytitle,<br/>&emsp;&emsp;&emsp;&emsp;title=\"title\",<br/>&emsp;&emsp;&emsp;&emsp;author=\"First, Author; Second, Author\",<br/>&emsp;&emsp;&emsp;&emsp;booktitle=\"pubtitle\",<br/>&emsp;&emsp;&emsp;&emsp;year=\"py\",<br/>&emsp;&emsp;&emsp;&emsp;volume=\"volume\",<br/>&emsp;&emsp;&emsp;&emsp;number=\"punumber\",<br/>&emsp;&emsp;&emsp;&emsp;pages=\"spage--epage\",<br/>&emsp;&emsp;&emsp;&emsp;organization=\"affiliations\",<br/>&emsp;&emsp;&emsp;&emsp;publisher=\"publisher\"<br/>}");
	}
	
	/**
	 * Check proper handling of empty elements of Conference
	 */
	public function testEmptyConference() {
		$conference = array();
		
		$conference['from'] = $this->from;
		$conference['authors'] = $this->authors;
		$conference['py'] = $this->py;
		$conference['title'] = $this->title;
		$conference['pubtype'] = "Conference Publications";
		
		$result = Bibliography::generateBibTexIEEE($conference);
		$this->assertNotNull($result);
		$this->assertEquals($result, "@Conference{firstpytitle,<br/>&emsp;&emsp;&emsp;&emsp;title=\"title\",<br/>&emsp;&emsp;&emsp;&emsp;author=\"First, Author; Second, Author\",<br/>&emsp;&emsp;&emsp;&emsp;year=\"py\"<br/>}");
	}
	
	/**
	 * Check proper generation of BibTex for Book
	 */
	public function testBibTexIEEEBook() {
		$book = array();
		
		$book['from'] = $this->from;
		$book['authors'] = $this->authors;
		$book['py'] = $this->py;
		$book['title'] = $this->title;
		$book['pubtype'] = "Books";
		$book['publisher'] = $this->publisher;
		$book['volume'] = $this->volume;
		$book['issue'] = $this->issue;
		
		$result = Bibliography::generateBibTexIEEE($book);
		$this->assertNotNull($result);
		$this->assertEquals($result, "@Book{firstpytitle,<br/>&emsp;&emsp;&emsp;&emsp;title=\"title\",<br/>&emsp;&emsp;&emsp;&emsp;author=\"First, Author; Second, Author\",<br/>&emsp;&emsp;&emsp;&emsp;publisher=\"publisher\",<br/>&emsp;&emsp;&emsp;&emsp;year=\"py\",<br/>&emsp;&emsp;&emsp;&emsp;volume=\"volume\",<br/>&emsp;&emsp;&emsp;&emsp;number=\"issue\"<br/>}");
	}
	
	/**
	 * Check proper generation of BibTex for Book
	 */
	public function testBibTexIEEEBookPUNumber() {
		$book = array();
		
		$book['from'] = $this->from;
		$book['authors'] = $this->authors;
		$book['py'] = $this->py;
		$book['title'] = $this->title;
		$book['pubtype'] = "Books";
		$book['publisher'] = $this->publisher;
		$book['volume'] = $this->volume;
		$book['punumber'] = $this->punumber;
		
		$result = Bibliography::generateBibTexIEEE($book);
		$this->assertNotNull($result);
		$this->assertEquals($result, "@Book{firstpytitle,<br/>&emsp;&emsp;&emsp;&emsp;title=\"title\",<br/>&emsp;&emsp;&emsp;&emsp;author=\"First, Author; Second, Author\",<br/>&emsp;&emsp;&emsp;&emsp;publisher=\"publisher\",<br/>&emsp;&emsp;&emsp;&emsp;year=\"py\",<br/>&emsp;&emsp;&emsp;&emsp;volume=\"volume\",<br/>&emsp;&emsp;&emsp;&emsp;number=\"punumber\"<br/>}");
	}
	
	/**
	 * Check proper handling of empty elements of Book
	 */
	public function testEmptyBook() {
		$book = array();
		
		$book['from'] = $this->from;
		$book['authors'] = $this->authors;
		$book['py'] = $this->py;
		$book['title'] = $this->title;
		$book['pubtype'] = "Books";
		
		$result = Bibliography::generateBibTexIEEE($book);
		$this->assertNotNull($result);
		$this->assertEquals($result, "@Book{firstpytitle,<br/>&emsp;&emsp;&emsp;&emsp;title=\"title\",<br/>&emsp;&emsp;&emsp;&emsp;author=\"First, Author; Second, Author\",<br/>&emsp;&emsp;&emsp;&emsp;year=\"py\"<br/>}");
	}
	
	/**
	 * Check proper generation of BibTex for Article
	 */
	public function testBibTexIEEEArticle() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = "Article";
		$article['pubtitle'] = $this->pubtitle;
		$article['publisher'] = $this->publisher;
		$article['volume'] = $this->volume;
		$article['issue'] = $this->issue;
		$article['spage'] = $this->spage;
		$article['epage'] = $this->epage;
		
		$result = Bibliography::generateBibTexIEEE($article);
		$this->assertNotNull($result);
		$this->assertEquals($result, "@Article{firstpytitle,<br/>&emsp;&emsp;&emsp;&emsp;title=\"title\",<br/>&emsp;&emsp;&emsp;&emsp;author=\"First, Author; Second, Author\",<br/>&emsp;&emsp;&emsp;&emsp;journal=\"pubtitle\",<br/>&emsp;&emsp;&emsp;&emsp;year=\"py\",<br/>&emsp;&emsp;&emsp;&emsp;volume=\"volume\",<br/>&emsp;&emsp;&emsp;&emsp;number=\"issue\",<br/>&emsp;&emsp;&emsp;&emsp;pages=\"spage--epage\"<br/>}");
		
		return $result;
	}
	
	/**
	 * Check proper generation of BibTex for Article
	 */
	public function testBibTexIEEEArticlePUNumber() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = "Article";
		$article['pubtitle'] = $this->pubtitle;
		$article['publisher'] = $this->publisher;
		$article['volume'] = $this->volume;
		$article['punumber'] = $this->punumber;
		$article['spage'] = $this->spage;
		$article['epage'] = $this->epage;
		
		$result = Bibliography::generateBibTexIEEE($article);
		$this->assertNotNull($result);
		$this->assertEquals($result, "@Article{firstpytitle,<br/>&emsp;&emsp;&emsp;&emsp;title=\"title\",<br/>&emsp;&emsp;&emsp;&emsp;author=\"First, Author; Second, Author\",<br/>&emsp;&emsp;&emsp;&emsp;journal=\"pubtitle\",<br/>&emsp;&emsp;&emsp;&emsp;year=\"py\",<br/>&emsp;&emsp;&emsp;&emsp;volume=\"volume\",<br/>&emsp;&emsp;&emsp;&emsp;number=\"punumber\",<br/>&emsp;&emsp;&emsp;&emsp;pages=\"spage--epage\"<br/>}");
	}
	
	/**
	 * Check proper handling of empty elements of Article
	 */
	public function testEmptyArticle() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = "Article";
		
		$result = Bibliography::generateBibTexIEEE($article);
		$this->assertNotNull($result);
		$this->assertEquals($result, "@Article{firstpytitle,<br/>&emsp;&emsp;&emsp;&emsp;title=\"title\",<br/>&emsp;&emsp;&emsp;&emsp;author=\"First, Author; Second, Author\",<br/>&emsp;&emsp;&emsp;&emsp;year=\"py\"<br/>}");
	}
	
	/**
	 * Check that Bibliography gets created
	 */
	public function testCreateBibliography() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = "Article";
		$article['pubtitle'] = $this->pubtitle;
		$article['publisher'] = $this->publisher;
		$article['volume'] = $this->volume;
		$article['issue'] = $this->issue;
		$article['spage'] = $this->spage;
		$article['epage'] = $this->epage;
		
		$result2 = new Bibliography($article);
		
		$this->assertNotNull($result2);
		$this->assertNotNull($result2->bibtex);
		
		return $result2;
	}
	
	/**
	 * Check that Bibliography generates proper BibTex
	 * @depends testBibTexIEEEArticle
	 * @depends testCreateBibliography
	 */
	public function testGenerateBibTexIEEE($result1, $result2) {
		$this->assertEquals($result1, $result2->bibtex);
	}
	
	
	/**
	 * Check that null BibTex will be created on receiving unknown source
	 * @depends testNullResultFromGenerateBibTexGeneral
	 */
	public function testGenerateEmptyBibTex($result1) {
		$paper = array('from' => 'Nowhere');
		
		$result2 = new Bibliography($paper);
		
		$this->assertNotNull($result2);
		$this->assertEquals($result1, $result2->bibtex);
	}
}
?>