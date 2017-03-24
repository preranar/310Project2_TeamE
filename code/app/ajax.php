<?php

require_once('Application.php');
require_once('IEEE/IEEE_Wrapper.php');
require_once('search_IEEE.php');

if (isset($_GET['query'])) {
	$query = $_GET['query'];
}

$WC = new WordCloud($query);
$WC->generateCloud(new IEEE());
$_SESSION['history'][$query] = array( 
		'WC' 		=> $WC,
		'timestamp' => time(),
	);
if (count($_SESSION['history']) > 10) {
	removeOldestWC();
}
echo $WC->generateWC();

?>