<?php
	require_once('WordCloud.php');
	session_start();
	$GLOBALS['ALERT'] = (isset($_SESSION['ALERT']) ? $_SESSION['ALERT'] : []);

	function timestamp($a, $b) {
	    if ($a['timestamp'] == $b['timestamp']) {
	        return 0;
	    }
	    return ($a['timestamp'] < $b['timestamp']) ? -1 : 1;
	}

	function removeOldestWC() {
		if (isset($_SESSION['history'])) {
			uasort($_SESSION['history'], 'timestamp');
			array_shift($_SESSION['history']);
		}
	}

	function showHistoryScript() {
		$script = 'var hist = ';
		$history = (isset($_SESSION['history']) ? $_SESSION['history'] : array()); 
		if (isset($_SESSION['history'])) {
			uasort($history, 'timestamp');
			foreach ($history as $query) {
				unset($history[$query]['WC']);
			}
		}
		$script .= json_encode(array_keys($history)).";\n";
		$script .= "$('#sidebar').append('<ul class=\"sidebar-list\">');\n";
		$script .= "for (var i=0;i<hist.length;i++) {\n";
		$script .= "\t$('#sidebar ul').append('<li><a href=\"/cloud.php?query=' + hist[i] + '\">' + hist[i] + '</a></li>');\n";
		$script .= "}\n";
		return $script;
	}