<?php

if (!function_exists('curl_init')) {
  throw new Exception('IEEE needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('IEEE needs the JSON PHP extension.');
}

/**
 * Handles API requests. Parametrization methods are chainable.
 * For further informatio, go to
 *  https://developer.musixmatch.com/documentation/
 *
 * @author Anderson Marques <http://twitter.com/cacovsky>
 */
class IEEE {
	/**
	 * Version.
	 */
	const VERSION = '0.0.1';

	/**
	 * Default options for curl.
	 */
	public static $CURL_OPTS = array(
		CURLOPT_CONNECTTIMEOUT => 10,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT		=> 60,
		CURLOPT_USERAGENT	  => 'IEEE-php-0.0.1',
	);

	public static $STATUS_CODES = array(
		200=>'The request was successful',
		400=>'The request had bad syntax or was inherently impossible to be satisfied',
		401=>'authentication failed, probably because of a bad API key',
		402=>'a limit was reached, either you exceeded per hour requests limits or your balance is insufficient.',
		403=>'You are not authorized to perform this operation / the api version you’re trying to use has been shut down.',
		404=>'requested resource was not found',
		405=>'requested method was not found',  
	);
	
	protected $_base_url = 'ieeexplore.ieee.org/gateway/ipsSearch.jsp';
	protected $_result   = '';
	protected $_use_ssl  = '';
	protected $_method   = '';
	public $_query_parameters = array();
	
	public function __construct() {
	
	}
	
	/**
	 * @return IEEE
	 * au author
	 * ti document title
	 * ab abstract
	 * doi DOI
	 * cs Affiliations
	 * jn Publication Title
	 * isbn ISBN
	 * issn ISSN
	 * py Publication Year
	 * thsrsterms Thesaurus Terms
	 * cntrlterms Controlled Terms
	 * idxterms Search Index Terms
	 * md search for in all configured metadata fields and abstract
	 * querytext search for in all configured metadata fields, abstract and document text
	 * ctype: Content Type
	 * hc: Number of records to fetch (Default: 25, Maximum: 1000)
	 * an: article number
	 * punumber: publisher number
	 *
	 */
	public function param_q($query) {
		foreach ($query as $key=>$value) {
			$this->_query_parameters[$key] = str_replace(' ', '+', $value);
		}
		return $this;
	}
	
	/**
	 * Resets parameters, except for the apikey
	 * @chainable
	 */
	public function reset_params() {
		$this->_query_parameters = array();
		return $this;
	}
	
	/**
	 * Executes the request and returns the result
	 * @param resource $ch a custom curl resource
	 */
	public function execute_request($ch = null) {
		$url = $this->build_query_url();
		
		if (!$ch) {
			$ch = curl_init($url);
			curl_setopt_array($ch, self::$CURL_OPTS);
		}
		
		$query_result = curl_exec($ch);
		
		curl_close($ch);
		
		$xml = simplexml_load_string($query_result, null, LIBXML_NOCDATA);
		$full_result = json_decode(json_encode($xml), true);
		
		return $this->_result = $full_result;
	}
	
	/**
	 * This is not used by us
	 * @codeCoverageIgnore
	 */
	public function get_publication($arnumber) {
		$url = "http://ieeexplore.ieee.org/xpl/articleDetails.jsp?reload=true&tp=&arnumber=".$arnumber."&contentType=Journals+&+Magazines";
		
		$ch = curl_init($url);
		curl_setopt_array($ch, self::$CURL_OPTS);
		
		$result = curl_exec($ch);
		
		curl_close($ch);
		
		$out = array();
		
		preg_match("/isnumber=[0-9]+/", $result, $out);
		return "http://ieeexplore.ieee.org/xpl/tocresult.jsp?" . $out[0];
	}
	
	/**
	 * This is not used by us
	 * @codeCoverageIgnore
	 */
	public function result() {
		return $this->result;
	}
	
	/**
	 * Uses the parameters and other stuff to build the query string
	 * @return string the url to be fetched
	 */
	public function build_query_url() {
		//protocol
		// $url =  $this->_use_ssl ? 'https://'  : 'http://';
		
		//base url
		$url = $this->_base_url;
		
		$url .= '?';
		
		foreach ($this->_query_parameters as $key=>$value) {
			$url.=$key.'='.$value.'&';
		}
		
		return $url;
	}

}

?>
