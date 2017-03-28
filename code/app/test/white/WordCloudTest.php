<?php
require_once('../../WordCloud.php');
require_once('SearchIEEETest.php');
use PHPUnit\Framework\TestCase;

class WordCloudTest extends TestCase {	
	//public static $coverage;
	
	protected $query = 'java';
	protected $IEEE;
	protected $papers;
	protected $paper1;
	protected $paper2;
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	public function __construct() {
		$this->IEEE = new MockIEEE();
		$this->papers = getResults(null, $this->query, $this->IEEE);
		$this->paper1 = new Paper($this->papers[0]);
		$this->paper2 = new Paper($this->papers[1]);
	}
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public static function setUpBeforeClass() {
	// 	WordCloudTest::$coverage = new PHP_CodeCoverage();
	// }
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public function setUp() {
	// 	WordCloudTest::$coverage->start($this);
	// }
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public function tearDown() {
	// 	WordCloudTest::$coverage->stop();
	// }
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public static function tearDownAfterClass() {
	// 	$writer = new PHP_CodeCoverage_Report_Clover;
	// 	$writer->process(WordCloudTest::$coverage, 'coverage/WordCloudTest.xml');
		
	// 	$writer = new PHP_CodeCoverage_Report_HTML;
	// 	$writer->process(WordCloudTest::$coverage, 'coverage/WordCloudTest');
	// }
	
	
	/**
	 * Call protected/private method of a class.
	 * @codeCoverageIgnore
	 * 
	 * @param object &$object    Instantiated object that we will run method on.
	 * @param string $methodName Method name to call
	 * @param array  $parameters Array of parameters to pass into method.
	 *
	 * @return mixed Method return.
	 */
	public function invokeMethod(&$object, $methodName, array $parameters = array())
	{
		$reflection = new \ReflectionClass(get_class($object));
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);

		return $method->invokeArgs($object, $parameters);
	}
	
	/**
	 * Test the creation of a WordCloud
	 */
	public function testWordCloudCreation() {
		$wordcloud = new WordCloud($this->query);
		
		$this->assertNotNull($wordcloud);
		$this->assertNotEmpty($wordcloud->stopwords);
		$this->assertEmpty($wordcloud->papers);
		$this->assertEmpty($wordcloud->words);
		$this->assertEquals($this->query, $wordcloud->query);
		
		return $wordcloud;
	}
	
	/**
	 * Test the generation of Meta URL
	 * @depends testWordCloudCreation
	 */
	public function testMetaURL($wordcloud) {
		$result = $this->invokeMethod($wordcloud, 'getMetaUrl');
		$expected = "query=".$this->query;
		
		$this->assertNotNull($result);
		$this->assertEquals($expected, $result);
	}
	
	/**
	 * Test the mergeData function of WordCloud
	 */
	public function testMergeData() {
		$wordcloud = new WordCloud($this->query);
		
		$this->assertEmpty($wordcloud->papers);
		
		$wordcloud->mergeData($this->papers);
		
		$this->assertNotEmpty($wordcloud->papers);
		$this->assertCount(2, $wordcloud->papers);
		
		$this->assertEquals($this->paper1, $wordcloud->papers[0]);
		$this->assertEquals($this->paper2, $wordcloud->papers[1]);
	}
	
	/**
	 * Test the mergeWordCount function of WordCloud
	 * @depends testMergeData
	 */
	public function testMergeWordCount() {
		$wordcloud = new WordCloud($this->query);
		$wordcloud->mergeData($this->papers);
		
		$this->assertEmpty($wordcloud->words);
		
		$wordcount1 = $this->paper1->getWordCount();
    	$wordcloud->mergeWordCount($wordcount1);
    	
		$this->assertNotEmpty($wordcloud->words);
		$this->assertArrayHasKey('components', $wordcloud->words);
		$this->assertEquals(1, $wordcloud->words['components']->freq);
		
		//Ensure word count goes up
		$wordcount2 = $this->paper2->getWordCount();
    	$wordcloud->mergeWordCount($wordcount2);
    	
		$this->assertNotEmpty($wordcloud->words);
		$this->assertArrayHasKey('components', $wordcloud->words);
		$this->assertEquals(2, $wordcloud->words['components']->freq);
		$this->assertEquals('components', $wordcloud->words['components']->word);
		//Check for removal of stopwords
		$this->assertArrayNotHasKey('contains', $wordcloud->words);
		
		return $wordcloud;
	}
	
	/**
	 *Assert the equality of two arrays of words, minus the color which is random
	 */
	public function assertWordEquality($words1, $words2)
	{
		//Assert there are no elements in words1 not in words2 that do not have the same word & freq
		foreach($words1 as $name => $word)
		{
			$this->assertArrayHasKey($name, $words2);
			$this->assertEquals($word->word, $words2[$name]->word);
			$this->assertEquals($word->freq, $words2[$name]->freq);
		}
		//Assert there are no elements in words2 not in words1
		foreach($words2 as $name => $word)
		{
			$this->assertArrayHasKey($name, $words1);
		}
	}
	
	/**
	 * Tests the countWordFreq function of WordCloud
	 * @depends testMergeWordCount
	 */
	public function testCountWordFreq(WordCloud $wordcloud2) {
		$wordcloud1 = new WordCloud($this->query);
		$wordcloud1->mergeData($this->papers);
		
		$this->assertEmpty($wordcloud1->words);
		
		$wordcloud1->countWordFreq();
		
		$this->assertNotEmpty($wordcloud1->words);
		$this->assertWordEquality($wordcloud1->words, $wordcloud2->words);
		
		return $wordcloud1;
	}
	
	/**
	 * Test the generation of the frequency array
	 * @depends testCountWordFreq
	 */
	public function testFrequencyArray(Wordcloud $wordcloud) {
		$this->assertArrayHasKey('components', $wordcloud->words);
		$this->assertArrayNotHasKey('contains', $wordcloud->words);
		
		//Insert artifical stopword to ensure removal
		$wordcloud->words['contains'] = new WC_Word('contains', '1');
		
		$this->assertArrayHasKey('contains', $wordcloud->words);
		
		$words = $wordcloud->getFreqArray($wordcloud->words);
		
		$this->assertArrayHasKey('components', $words);
		$this->assertArrayNotHasKey('contains', $words);
		
		return $words;
	}
	
	/**
	 * Test creation of member data for WordCloud.
	 * Tests both generateCloud and generate because the two are closely linked
	 * and should be considered for combining.
	 */
	public function testGenerateCloud() {
		//1 is generateCloud; 2 is each step manually
		$wordcloud1 = new WordCloud($this->query);
		$wordcloud2 = new WordCloud($this->query);
		
		$wordcloud1->generateCloud($this->IEEE);
		
		//We know these steps individually work because of the other tests
    	$wordcloud2->mergeData($this->papers);
		$wordcloud2->countWordFreq();
		
		$this->assertEquals($wordcloud1->papers, $wordcloud2->papers);
		$this->assertWordEquality($wordcloud1->words, $wordcloud2->words);
		
		return $wordcloud1;
	}
	
	/**
	 * Test the GenerateWC function of WordCloud
	 * @depends testGenerateCloud
	 * @depends testFrequencyArray
	 */
	// public function testGenerateWC($wordcloud, $words) {
	// 	$cloud = $wordcloud->generateWC();
		
	// 	// foreach($words as $word => $frq)
	// 	// {
	// 	// 	if ($word != "<br>") {
	// 	// 		//Assert words, colors exist in cloud 
	// 	// 		$this->assertContains($wordcloud->words[$word]->color, $cloud);
	// 	// 		$this->assertContains($word, $cloud);
	// 	// 		$this->assertContains($wordcloud->words[$word]->color . ";\">" . $word, $cloud);
	// 	// 	}
	// 	// }
	// }
	
	// /**
	//  * Test that the WordCloud will remove the less frequent words
	//  */
	// public function testGenerateWCManyWords() {
	// 	$words = "";
	// 	for($i = 11; $i < 300; $i++)
	// 	{
	// 		$words .= $i . " ";
	// 		//Adjust frequency slightly
	// 		if ($i <= 260)
	// 		{
	// 			$words .= $i . " ";
	// 		}
	// 	}
		
	// 	$data = array('Bill Nye' => array(
	// 			'authors' => 'Bill Nye',
	// 			'title' => 'I am the science guy',
	// 			'from' => 'IEEE',
	// 			'abstract' => $words,
	// 			'pubtitle' => 'pubtitle',
	// 			'pdf' => 'pdf',
	// 			'pubtype' => 'pubtype',
	// 			'py' => 'py'
	// 			)
	// 	);
	// 	$wordcloud = new WordCloud($this->query);
	// 	$wordcloud->generate($data);
		
	// 	$cloud = $wordcloud->generateWC();
	// 	// for ($word = 11; $word <= 260; $word++)
	// 	// {
	// 	// 	//Assert words exist in cloud
	// 	// 	$this->assertContains($word . "", $cloud);
	// 	// }
		
	// 	// for ($word = 261; $word < 300; $word++)
	// 	// {
	// 	// 	//Assert less popular words not in cloud
	// 	// 	$this->assertNotContains($word . "", $cloud);
	// 	// }
	// }
	
	/**
	 * Test that the WordCloud will safely handle having zero words
	 */
	public function testEmptyWC() {
		$wordcloud = new WordCloud($this->query);
		$cloud = $wordcloud->generateWC();
		
		$this->assertEmpty($cloud);
	}
	
	/**
	 * Test that the WordCloud removes any tags and other nonwords from the cloud
	 * @depends testGenerateCloud
	 */
	public function testStripsTags($wordcloud) {
		$cloud = $wordcloud->generateWC();
		
		$this->assertNotEmpty($cloud);
		//$this->assertNotContains("<br>", $cloud);
	}
}
?>