<?php

require_once('../../IEEE/IEEE_Wrapper.php');
use PHPUnit\Framework\TestCase;

class APITest extends TestCase
{	
	// public static $coverage;
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public static function setUpBeforeClass()
	// {
	// 	APITest::$coverage = new PHP_CodeCoverage();
	// }
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public function setUp()
	// {
	// 	APITest::$coverage->start($this);
	// }
	
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public function tearDown()
	// {
	// 	APITest::$coverage->stop();
	// }
	// /**
	//  * @codeCoverageIgnore
	//  */
	// public static function tearDownAfterClass()
	// {
	// 	$writer = new PHP_CodeCoverage_Report_Clover;
	// 	$writer->process(APITest::$coverage, 'coverage/APITest.xml');
		
	// 	$writer = new PHP_CodeCoverage_Report_HTML;
	// 	$writer->process(APITest::$coverage, 'coverage/APITest');
	// }

	public function testSanity()
	{
		$IEEE = new IEEE();
		
		$this->assertNotNull($IEEE);
		
		return $IEEE;
	}
	
	/**
	 * @depends testSanity
	 */
	public function testParams(IEEE $IEEE)
	{
		$this->assertEmpty($IEEE->_query_parameters);
		
		$key = "key";
		$value = "value";
		
		$query = array($key => $value);
		
		$IEEE->param_q($query);
		
		$this->assertNotEmpty($IEEE->_query_parameters);
		$this->assertArrayHasKey($key, $IEEE->_query_parameters);
		$this->assertEquals($value, $IEEE->_query_parameters[$key]);
		
		return $IEEE;
	}
	
	/**
	 * @depends testParams
	 */
	public function testQuery(IEEE $IEEE)
	{
		$key = "key";
		$value = "value";
		$expected = "ieeexplore.ieee.org/gateway/ipsSearch.jsp?".$key."=".$value."&";
		
		$actual = $IEEE->build_query_url();
		
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * @depends testParams
	 */
	public function testExecute(IEEE $IEEE)
	{
		$this->assertNotEmpty($IEEE->_query_parameters);
		
		$result = $IEEE->execute_request();
		
		$this->assertNotNull($result);
	}
	
	/**
	 * @depends testParams
	 */
	public function testReset(IEEE $IEEE)
	{
		$this->assertNotEmpty($IEEE->_query_parameters);
		
		$IEEE->reset_params();
		
		$this->assertEmpty($IEEE->_query_parameters);
	}
}

?>