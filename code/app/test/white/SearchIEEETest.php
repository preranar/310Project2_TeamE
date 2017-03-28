<?php

require_once('../../search_IEEE.php');
use PHPUnit\Framework\TestCase;

class MockIEEE extends IEEE
{
	public function execute_request($ch = null) {
		$query_result = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>

		<root>

		<totalfound>95144</totalfound>

		<totalsearched>3969131</totalsearched>

		<document>

		<rank>1</rank>

		<title><![CDATA[Developing Java Web Applications to Access Databases]]></title>

		<authors><![CDATA[Bai, Y.]]></authors>

		<pubtitle><![CDATA[Practical Database Programming with Java]]></pubtitle>

		<punumber><![CDATA[5988888]]></punumber>

		<pubtype><![CDATA[Books & eBooks]]></pubtype>

		<publisher><![CDATA[Wiley-IEEE Press]]></publisher>

		<py><![CDATA[2011]]></py>

		<spage><![CDATA[555]]></spage>

		<epage><![CDATA[767]]></epage>

		<abstract><![CDATA[This chapter contains sections titled: <br> A Historical Review about Java Web Application Development <br> Java EE Web Application Model <br> The Architecture and Components of Java Web Applications <br> Getting Started with Java Web Applications Using NetBeans IDE <br> Build Java Web Project to Access SQL Server Database <br> Build Java Web Project to Access and Manipulate Oracle Database <br> Chapter Summary <br> Homework]]></abstract>

		<isbn><![CDATA[9781118104651]]></isbn>

		<arnumber><![CDATA[5989215]]></arnumber>

		<doi><![CDATA[10.1002/9781118104651.ch8]]></doi>

		<publicationId><![CDATA[5989215]]></publicationId>

		<mdurl><![CDATA[http://ieeexplore.ieee.org/xpl/articleDetails.jsp?tp=&arnumber=5989215&contentType=Books+%26+eBooks]]></mdurl>

		<pdf><![CDATA[http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=5989215]]></pdf>

		</document>

		<document>

		<rank>2</rank>

		<title><![CDATA[Developing Java Web Services to Access Databases]]></title>

		<authors><![CDATA[Bai, Y.]]></authors>

		<pubtitle><![CDATA[Practical Database Programming with Java]]></pubtitle>

		<punumber><![CDATA[5988888]]></punumber>

		<pubtype><![CDATA[Books & eBooks]]></pubtype>

		<publisher><![CDATA[Wiley-IEEE Press]]></publisher>

		<py><![CDATA[2011]]></py>

		<spage><![CDATA[769]]></spage>

		<epage><![CDATA[907]]></epage>

		<abstract><![CDATA[This chapter contains sections titled: <br> Introduction to Java Web Services <br> The Structure and Components of SOAP-Based Web Services <br> The Procedure of Building a Typical SOAP-Based Web Service Project <br> Getting Started with Java Web Services Using NetBeans IDE <br> Build Java Web Service Projects to Access SQL Server Database <br> Build a Windows-Based Web Client Project to Consume the Web Service <br> Build a Web-Based Client Project to Consume the Web Service <br> Build Java Web Service to Insert Data into the SQL Server Database <br> Build a Windows-Based Web Client Project to Consume the Web Service <br> Build a Web-Based Client Project to Consume the Web Service <br> Build Java Web Service to Update and Delete Data from the SQL Server Database <br> Build a Windows-Based Web Client Project to Consume the Web Service <br> Build a Web-Based Client Project to Consume the Web Service <br> Build Java Web Service Projects to Access Oracle Databases <br> Build a Windows-Based Web Client Project to Consume the Web Service <br> Build a Web-Based Web Client Project to Consume the Web Service <br> Chapter Summary <br> Homework]]></abstract>

		<isbn><![CDATA[9781118104651]]></isbn>

		<arnumber><![CDATA[5989214]]></arnumber>

		<doi><![CDATA[10.1002/9781118104651.ch9]]></doi>

		<publicationId><![CDATA[5989214]]></publicationId>

		<mdurl><![CDATA[http://ieeexplore.ieee.org/xpl/articleDetails.jsp?tp=&arnumber=5989214&contentType=Books+%26+eBooks]]></mdurl>

		<pdf><![CDATA[http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=5989214]]></pdf>

		</document>

		</root>
		";
		
		$xml = simplexml_load_string($query_result, null, LIBXML_NOCDATA);
		$full_result = json_decode(json_encode($xml), true);
		return $this->_result = $full_result;   
	}

}

class EmptyIEEE extends IEEE
{
	public function execute_request($ch = null) {
		return array();
	}
}

class SearchIEEETest extends TestCase
{
	// public static $coverage;
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public static function setUpBeforeClass() {
	// 	SearchIEEETest::$coverage = new PHP_CodeCoverage();
	// }
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public function setUp() {
	// 	SearchIEEETest::$coverage->start($this);
	// }
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public function tearDown() {
	// 	SearchIEEETest::$coverage->stop();
	// }
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public static function tearDownAfterClass() {
	// 	$writer = new PHP_CodeCoverage_Report_Clover;
	// 	$writer->process(SearchIEEETest::$coverage, 'coverage/SearchIEEETest.xml');
		
	// 	$writer = new PHP_CodeCoverage_Report_HTML;
	// 	$writer->process(SearchIEEETest::$coverage, 'coverage/SearchIEEETest');
	// }
	
	/**
	 * Test getResults
	 */
	public function testSearch() {
		$IEEE = new MockIEEE();
		
		$query = "Java";
		
		$result = getResults(null, $query, $IEEE);
		$authors = "Bai, Y.";
		$title = "Developing Java Web Applications to Access Databases";
		$pdf = "http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=5989215";
		$this->assertNotEmpty($result[0]['authors']);
		$this->assertEquals($authors, $result[0]['authors']);
		$this->assertEquals($title, $result[0]['title']);
		//$this->assertContains("Practical Database", $result[0]['pubtitle']);
		//$this->assertNotContains("Happiness", $result[0]['pubtitle']);
		$this->assertEquals($pdf, $result[0]['pdf']);
		//$this->assertContains("Components", $result[0]['abstract']);
		//$this->assertNotContains("Happiness", $result[0]['abstract']);
		$this->assertArrayHasKey("from", $result[0]);
		$this->assertEquals("IEEE", $result[0]['from']);
	}
	
	/**
	 * Test handling of unresponsive API
	 */
	public function testEmptySearch() {
		$IEEE = new EmptyIEEE();
		$author = "Bill Nye";
		
		$result = getResults($author, null, $IEEE);
		$this->assertEmpty($result);
	}
	
	/**
	 * Test getting results from the same conference
	 */
	public function testGetSameConference() {
		$IEEE = new MockIEEE();
		$pubtype = "Conference Publications";
		$punumber = "punumber";
		$volume = "volume";
		$issue = "issue";
		
		$result = getSame($pubtype, $punumber, $volume, $issue, $IEEE);
		
		$authors = "Bai, Y.";
		$title = "Developing Java Web Applications to Access Databases";
		$pdf = "http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=5989215";
		$this->assertNotEmpty($result[0]['authors']);
		$this->assertEquals($authors, $result[0]['authors']);
		$this->assertEquals($title, $result[0]['title']);
		//$this->assertContains("Practical Database", $result[0]['pubtitle']);
		//$this->assertNotContains("Happiness", $result[0]['pubtitle']);
		$this->assertEquals($pdf, $result[0]['pdf']);
		//$this->assertContains("Components", $result[0]['abstract']);
		//$this->assertNotContains("Happiness", $result[0]['abstract']);
		$this->assertArrayHasKey("from", $result[0]);
		$this->assertEquals("IEEE", $result[0]['from']);
		
		$this->assertEquals($IEEE->build_query_url(), "ieeexplore.ieee.org/gateway/ipsSearch.jsp?hc=100&pn=punumber&querytext=\"Volume\":volume&");
	}
	
	/**
	 * Test getting results from the same book
	 */
	public function testGetSameBook() {
		$IEEE = new MockIEEE();
		$pubtype = "Books & eBooks";
		$punumber = "punumber";
		$volume = "volume";
		$issue = "issue";
		
		$result = getSame($pubtype, $punumber, $volume, $issue, $IEEE);
		
		$authors = "Bai, Y.";
		$title = "Developing Java Web Applications to Access Databases";
		$pdf = "http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=5989215";
		$this->assertNotEmpty($result[0]['authors']);
		$this->assertEquals($authors, $result[0]['authors']);
		$this->assertEquals($title, $result[0]['title']);
		//$this->assertContains("Practical Database", $result[0]['pubtitle']);
		//$this->assertNotContains("Happiness", $result[0]['pubtitle']);
		$this->assertEquals($pdf, $result[0]['pdf']);
		//$this->assertContains("Components", $result[0]['abstract']);
		//$this->assertNotContains("Happiness", $result[0]['abstract']);
		$this->assertArrayHasKey("from", $result[0]);
		$this->assertEquals("IEEE", $result[0]['from']);
		
		$this->assertEquals($IEEE->build_query_url(), "ieeexplore.ieee.org/gateway/ipsSearch.jsp?hc=100&pn=punumber&");
	}
	
	/**
	 * Test getting results from the same article
	 */
	public function testGetSameArticle() {
		$IEEE = new MockIEEE();
		$pubtype = "Journals & Magazines";
		$punumber = "punumber";
		$volume = "volume";
		$issue = "issue";
		
		$result = getSame($pubtype, $punumber, $volume, $issue, $IEEE);
		
		$authors = "Bai, Y.";
		$title = "Developing Java Web Applications to Access Databases";
		$pdf = "http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=5989215";
		$this->assertNotEmpty($result[0]['authors']);
		$this->assertEquals($authors, $result[0]['authors']);
		$this->assertEquals($title, $result[0]['title']);
		//$this->assertContains("Practical Database", $result[0]['pubtitle']);
		//$this->assertNotContains("Happiness", $result[0]['pubtitle']);
		$this->assertEquals($pdf, $result[0]['pdf']);
		//$this->assertContains("Components", $result[0]['abstract']);
		//$this->assertNotContains("Happiness", $result[0]['abstract']);
		$this->assertArrayHasKey("from", $result[0]);
		$this->assertEquals("IEEE", $result[0]['from']);
		
		$this->assertEquals($IEEE->build_query_url(), "ieeexplore.ieee.org/gateway/ipsSearch.jsp?hc=100&pn=punumber&querytext=\"Volume\":volume+AND+\"Issue\":issue&");
	}
	
	/**
	 * Test getting results from the same standard
	 */
	public function testGetSameStandard() {
		$IEEE = new MockIEEE();
		$pubtype = "Standards";
		$punumber = "punumber";
		$volume = "volume";
		$issue = "issue";
		
		$result = getSame($pubtype, $punumber, $volume, $issue, $IEEE);
		
		$authors = "Bai, Y.";
		$title = "Developing Java Web Applications to Access Databases";
		$pdf = "http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=5989215";
		$this->assertNotEmpty($result[0]['authors']);
		$this->assertEquals($authors, $result[0]['authors']);
		$this->assertEquals($title, $result[0]['title']);
		//$this->assertContains("Practical Database", $result[0]['pubtitle']);
		//$this->assertNotContains("Happiness", $result[0]['pubtitle']);
		$this->assertEquals($pdf, $result[0]['pdf']);
		//$this->assertContains("Components", $result[0]['abstract']);
		//$this->assertNotContains("Happiness", $result[0]['abstract']);
		$this->assertArrayHasKey("from", $result[0]);
		$this->assertEquals("IEEE", $result[0]['from']);
		
		$this->assertEquals($IEEE->build_query_url(), "ieeexplore.ieee.org/gateway/ipsSearch.jsp?hc=100&pn=punumber&");
	}
	
	/**
	 * Test getting null results from any other kind of pubtype
	 */
	public function testGetSameNull() {
		$IEEE = new MockIEEE();
		$pubtype = "null";
		$punumber = "punumber";
		$volume = "volume";
		$issue = "issue";
		
		$result = getSame($pubtype, $punumber, $volume, $issue, $IEEE);
		
		$this->assertNull($result);
	}
	
	/**
	 * Test getting empty array from unresponsive API
	 */
	public function testGetSameEmpty() {
		$IEEE = new EmptyIEEE();
		$pubtype = "Standards";
		$punumber = "punumber";
		$volume = "volume";
		$issue = "issue";
		
		$result = getSame($pubtype, $punumber, $volume, $issue, $IEEE);
		
		$this->assertEmpty($result);
	}
}
?>