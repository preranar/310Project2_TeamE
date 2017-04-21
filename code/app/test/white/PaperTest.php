<?php
require_once('../../Paper.php');
require_once('PaperList.php');
require_once('../../WordCloud.php'); 
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
	protected $conf = 'IEEE Annual 32nd conference'; 
	protected $relatedConferencePapers = array(
			0 => "A Genertic Algorithm based Heuristic Method for Test Set Genration in Reversible Circuits",
			1 => "A Mapping Methodology of Boolean Logic Circuits of Memristor Crossbar",
			2 => "Applying COmbinartoial Test to High-Speed Railway Track Circuit Receiver",
			3 => "Conception and Manufacturing of a Projectice-Drone Hybrid System",
			4 => "Drone-Assisted Public Safety Networks: The Security Aspect",
			5 => "A Confetti Drone: Exploring drone entertainment",
			6 => "Mobile network computer can better describe the furture of information society",
			7 => "What You See is What You Test",
			8 => "Authomated traffic monitoring system using computer vision", 
		);
	public $textfile = 'exportedtextfile.txt'; 
	public $pdffile = 'exportedpdffile.pdf'; 
	public $titleAbstract = "This is abstract here"; 
	public $query = 'halfond';
	public $bibtex = '@Article{simona2017on,
    title="On the Feasibility of Breast Cancer Imaging Systems at Millimeter-Waves Frequencies",
    author="Simona Di Meo; Pedro Fidel Espín-López; Andrea Martellosio; Marco Pasian; Giulia Matrone; Maurizio Bozzi; Giovanni Magenes; Andrea Mazzanti; Luca Perregrini; Francesco Svelto; Paul Eugene Summers; Giuseppe Renne; Lorenzo Preda; Massimo Bellomi",
    journal="IEEE Transactions on Microwave Theory and Techniques",
    year="2017",
    volume="PP",
    number="22",
    pages="1--12"'; 

	//public $halfondWordCloud ;//= new WordCloud($this->query); 
	//protected $conf = 'IEEE Annual 32nd conference'; 
	
	
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

	public function testPaperCreation2() {
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
	public function testMinimalPaperCreation2() {
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
	public function testGetWordCount2(Paper $paper) {
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
	public function testCountWord2(Paper $paper) {
		//Sanity check
		$this->assertEquals($this->abstract, $paper->text);
		
		$this->assertEquals(1, $paper->countWord('multiple'));
		$this->assertEquals(2, $paper->countWord('words'));
		$this->assertEquals(0, $paper->countWord('missing'));
	}

	public function testCorrectConference() {
		$article = array();

		//global $conf; 
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = $this->pubtype;
		$article['pubtitle'] = $this->pubtitle;
		$article['punumber'] = $this->punumber;
		$article['volume'] = $this->volume;
		$article['issue'] = $this->conf;
		$article['pdf'] = $this->pdf;
		$article['abstract'] = $this->abstract;
	
		$paper = new Paper($article);
		$this->assertEquals($article['issue'], $paper->getConference()); 
	}

	public function testCorrectListOfPapersGivenConference() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = $this->pubtype;
		$article['pubtitle'] = $this->pubtitle;
		$article['punumber'] = $this->punumber;
		$article['volume'] = $this->volume;
		$article['issue'] = $this->conf;
		$article['pdf'] = $this->pdf;
		$article['abstract'] = $this->abstract;

		$paper = new Paper($article);
		$this->assertEquals($this->relatedConferencePapers, $paper->getRelatedPaperList($paper->getConference())); 
	}

	public function testCorrectExportedTextFile() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = $this->pubtype;
		$article['pubtitle'] = $this->pubtitle;
		$article['punumber'] = $this->punumber;
		$article['volume'] = $this->volume;
		$article['issue'] = $this->conf;
		$article['pdf'] = $this->pdf;
		$article['abstract'] = $this->abstract;

		$paperlist = new PaperList($article);
		$this->assertEquals($this->textfile, $paperlist->getExportTextFile()); 
	}

	public function testCorrectExportedPDFFile() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = $this->pubtype;
		$article['pubtitle'] = $this->pubtitle;
		$article['punumber'] = $this->punumber;
		$article['volume'] = $this->volume;
		$article['issue'] = $this->conf;
		$article['pdf'] = $this->pdf;
		$article['abstract'] = $this->abstract;

		$paperlist = new PaperList($article);
		$this->assertEquals($this->pdffile, $paperlist->getExportPDFFile()); 
	}

	public function testAbstractIsAccurateWhenTitleIsClicked() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = $this->pubtype;
		$article['pubtitle'] = $this->pubtitle;
		$article['punumber'] = $this->punumber;
		$article['volume'] = $this->volume;
		$article['issue'] = $this->conf;
		$article['pdf'] = $this->pdf;
		$article['abstract'] = $this->abstract;

		$paper = new Paper($article);
		$this->assertEquals($this->titleAbstract, $paper->getAbstractToDisplayInPopup($paper->title)); 
	}

	public function testPDFIsAccurateInAbstractPopup() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = $this->pubtype;
		$article['pubtitle'] = $this->pubtitle;
		$article['punumber'] = $this->punumber;
		$article['volume'] = $this->volume;
		$article['issue'] = $this->conf;
		$article['pdf'] = $this->pdf;
		$article['abstract'] = $this->abstract;

		$paper = new Paper($article);
		$this->assertEquals($this->pdf, $paper->getPDFInAbstractPopup($paper->abstract)); 
	}

	public function testWordCloudIsCorrectWhenAuthorClicked() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = $this->pubtype;
		$article['pubtitle'] = $this->pubtitle;
		$article['punumber'] = $this->punumber;
		$article['volume'] = $this->volume;
		$article['issue'] = $this->conf;
		$article['pdf'] = $this->pdf;
		$article['abstract'] = $this->abstract;
		$author = 'halfond'; 

		$paper = new Paper($article);
		$halfond = new WordCloud($this->query); 
		$this->assertEquals($halfond, $paper->getAuthorWordCloud($author)); 
	}

	public function testCorrectBibTexForPaper() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = $this->pubtype;
		$article['pubtitle'] = $this->pubtitle;
		$article['punumber'] = $this->punumber;
		$article['volume'] = $this->volume;
		$article['issue'] = $this->conf;
		$article['pdf'] = $this->pdf;
		$article['abstract'] = $this->abstract;

		$paper = new Paper($article);
		$this->assertEquals($this->bibtex, $paper->getBibTex()); 
	}

	public function testCorrectPDFDownloadForPaper() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = $this->pubtype;
		$article['pubtitle'] = $this->pubtitle;
		$article['punumber'] = $this->punumber;
		$article['volume'] = $this->volume;
		$article['issue'] = $this->conf;
		$article['pdf'] = $this->pdf;
		$article['abstract'] = $this->abstract;

		$paper = new Paper($article);
		$this->assertEquals($this->pdf, $paper->getPDF()); 
	}

	public function testGettingCorrectSubset() {
		$article = array();
		
		$article['from'] = $this->from;
		$article['authors'] = $this->authors;
		$article['py'] = $this->py;
		$article['title'] = $this->title;
		$article['pubtype'] = $this->pubtype;
		$article['pubtitle'] = $this->pubtitle;
		$article['punumber'] = $this->punumber;
		$article['volume'] = $this->volume;
		$article['issue'] = $this->conf;
		$article['pdf'] = $this->pdf;
		$article['abstract'] = $this->abstract;

		$paper = new Paper($article);
		$array = array(
			0 => $this->relatedConferencePapers[0],
			1 => $this->relatedConferencePapers[1],
		);
		$this->assertEquals($array, $paper->getSubsetOfPapersWithTwoSelected(0, 1)); 

		$array2 = array(
			0 => $this->relatedConferencePapers[3],
			1 => $this->relatedConferencePapers[7],
		);
		$this->assertEquals($array2, $paper->getSubsetOfPapersWithTwoSelected(3, 7)); 


		$array3 = array(
			0 => $this->relatedConferencePapers[0],
			1 => $this->relatedConferencePapers[1],
			2 => $this->relatedConferencePapers[2],
			3 => $this->relatedConferencePapers[3],
		);

		$this->assertEquals($array3, $paper->getSubsetOfPapersWithFourSelected(0, 1, 2, 3)); 

		$array4 = array(
			0 => $this->relatedConferencePapers[2],
			1 => $this->relatedConferencePapers[3],
			2 => $this->relatedConferencePapers[6],
			3 => $this->relatedConferencePapers[8],
		);

		$this->assertEquals($array4, $paper->getSubsetOfPapersWithFourSelected(2, 3, 6, 8)); 
	}



}
?>