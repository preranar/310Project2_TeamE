<?php
require_once('../../Paper.php');
use PHPUnit\Framework\TestCase;
 
class PaperTest extends TestCase {	
	public static $coverage;
	
	protected $title = 'title';
	protected $authors = 'First, Author; Second, Author';
	protected $pubtitle = 'pubtitle';
	protected $pdf = 'pdf';
	protected $abstract = 'multiple words Words';
	protected $pubtype = 'Article';
	protected $punumber = 'punumber';
	protected $volume = 'volume';
	protected $issue = 'issue';
	protected $from = 'IEEE';
	protected $py = 'py';
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public static function setUpBeforeClass() {
	// 	PaperTest::$coverage = new PHP_CodeCoverage();
	// }
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public function setUp() {
	// 	PaperTest::$coverage->start($this);
	// }
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public function tearDown() {
	// 	PaperTest::$coverage->stop();
	// }
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public static function tearDownAfterClass() {
	// 	$writer = new PHP_CodeCoverage_Report_Clover;
	// 	$writer->process(PaperTest::$coverage, 'coverage/PaperTest.xml');
		
	// 	$writer = new PHP_CodeCoverage_Report_HTML;
	// 	$writer->process(PaperTest::$coverage, 'coverage/PaperTest');
	// }
	
	/**
	 * Test creation of a paper
	 */
	public function testPaperCreation() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = $this->pubtype;
		$article['pubtitle'] = $this->pubtitle;
		$article['punumber'] = $this->punumber;
		$article['volume'] = $this->volume;
		$article['issue'] = $this->issue;
		$article['pdf'] = $this->pdf;
		$article['abstract'] = $this->abstract;
	
		$paper = new Paper($article);
		
		$this->assertNotNull($paper);
		
		$this->assertEquals($this->title, $paper->title);
		$this->assertEquals($this->authors, $paper->author_string);
		$authors = array('First, Author', 'Second, Author');
		$this->assertEquals($authors, $paper->authors);
		$this->assertEquals($this->pubtitle, $paper->source);
		$this->assertEquals($this->abstract, $paper->abstract);
		$this->assertEquals($this->pdf, $paper->pdf);
		$this->assertEquals($this->abstract, $paper->text);
		$this->assertEquals($this->pubtype, $paper->pubtype);
		$this->assertEquals($this->punumber, $paper->punumber);
		$this->assertEquals($this->volume, $paper->volume);
		$this->assertEquals($this->issue, $paper->issue);
		
		$this->assertNotNull($paper->bibtex);
		
		return $paper;
	}
	
	/**
	 * Test minimal creation of a paper
	 */
	public function testMinimalPaperCreation() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = $this->pubtype;
		$article['pubtitle'] = $this->pubtitle;
		$article['pdf'] = $this->pdf;
		$article['abstract'] = $this->abstract;
	
		$paper = new Paper($article);
		
		$this->assertNotNull($paper);
		
		$this->assertEquals($this->title, $paper->title);
		$this->assertEquals($this->authors, $paper->author_string);
		$authors = array('First, Author', 'Second, Author');
		$this->assertEquals($authors, $paper->authors);
		$this->assertEquals($this->pubtitle, $paper->source);
		$this->assertEquals($this->abstract, $paper->abstract);
		$this->assertEquals($this->pdf, $paper->pdf);
		$this->assertEquals($this->abstract, $paper->text);
		$this->assertEquals($this->pubtype, $paper->pubtype);
		
		$this->assertNull($paper->punumber);
		$this->assertNull($paper->volume);
		$this->assertNull($paper->issue);
		
		$this->assertNotNull($paper->bibtex);
		
		return $paper;
	}
	
	/**
	 * Tests the getWordCount function
	 * @depends testPaperCreation
	 */
	public function testGetWordCount(Paper $paper) {
		//Sanity check
		$this->assertEquals($this->abstract, $paper->text);
		
		$wordcount = $paper->getWordCount();
		$this->assertEquals(1, $wordcount['multiple']);
		$this->assertEquals(2, $wordcount['words']);
		$this->assertEquals(2, count($wordcount));
		$this->assertArrayNotHasKey('missing', $wordcount);
		
		return $paper;
	}
	
	/**
	 * Tests the countWord function
	 * @depends testGetWordCount
	 */
	public function testCountWord(Paper $paper) {
		//Sanity check
		$this->assertEquals($this->abstract, $paper->text);
		
		$this->assertEquals(1, $paper->countWord('multiple'));
		$this->assertEquals(2, $paper->countWord('words'));
		$this->assertEquals(0, $paper->countWord('missing'));
	}
}
?>