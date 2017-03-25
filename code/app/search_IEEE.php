<?php
require_once('IEEE/IEEE_Wrapper.php');
require_once('Paper.php');

/*
 * If you don't want to use your own IEEE
 * Ignore code coverage because of simplicity and output of external API is not in scope of tests 
 */
function getPaperResults($author, $keyword, $limit = 10) {
	$IEEE = new IEEE(); //@codeCoverageIgnore
	return getResults($author, $keyword, $IEEE, $limit); //@codeCoverageIgnore
}

//If you want to use your own IEEE
function getResults($author, $keyword, $IEEE, $limit = 10) {
	
	if ((!$author && !$keyword) || !$limit) return null;		
	
	if ($author){
		$results = $IEEE->param_q(array('au' => $author, 'hc' => $limit))->execute_request();
	}
	else {
		$results = $IEEE->param_q(array('querytext' => $keyword, 'hc' => $limit))->execute_request();
	}
	
	$papers = array();	
	if (!isset($results['document'])) {
		return $papers;
	}
	
	foreach ($results['document'] as $paper) {
		// if (!isset($paper['authors']) || 
		// 	!isset($paper['title']) || 
		// 	!isset($paper['pubtitle']) || 
		// 	!isset($paper['abstract']) || 
		// 	!isset($paper['pdf']))
		// 	continue;
		// $papers[] = array(
		// 	'authors' => array_map('trim', explode('; ', $paper['authors'])), //TODO: Turn this into an array of authors, probably. DONE, but maybe rename field?
		// 	'author' => $paper['authors'],
		// 	'title' => $paper['title'],
		// 	'source' => $paper['pubtitle'],
		// 	'text' => $paper['abstract'],
		// 	'pdf' => $paper['pdf']
		// );
		$paper['from'] = 'IEEE';
		$papers[] = $paper;
	}
	
	return $papers;
}

/*
 * If you don't want to use your own IEEE
 * Ignore code coverage for these two because they are currently unused
 */
function getPublicationResults($arnumber) {
	$IEEE = new IEEE(); //@codeCoverageIgnore
	return getPublication($arnumber, $IEEE); //@codeCoverageIgnore
}

function getPublication($arnumber, $IEEE) {
	return $IEEE->get_publication($arnumber); //@codeCoverageIgnore
}

/*
 * If you don't want to use your own IEEE
 */
function getSamePublication($pubtype, $punumber, $volume, $issue) {
	$IEEE = new IEEE(); //@codeCoverageIgnore
	return getSame($pubtype, $punumber, $volume, $issue, $IEEE); //@codeCoverageIgnore
}

function getSame($pubtype, $punumber, $volume, $issue, $IEEE) {
	$IEEE->param_q(array('hc' => 100));
	switch($pubtype) {
			case 'Conference Publications':
				$IEEE->param_q(array('pn' => $punumber));
				if (!empty($volume)) {
					$IEEE->param_q(array('querytext' => '"Volume":'.$volume));
				}
				break;
			case 'Books & eBooks':
				$IEEE->param_q(array('pn' => $punumber));
				break;
			case 'Journals & Magazines':
			case 'Early Access Articles':
				$IEEE->param_q(array('pn' => $punumber));
				if (!empty($volume) && !empty($issue)) {
					$IEEE->param_q(array('querytext' => '"Volume":'.$volume.' AND "Issue":'.$issue));
				}
				break;
			case 'Standards':
				$IEEE->param_q(array('pn' => $punumber));
				break;
			default:
				return null;
		}
	$results = $IEEE->execute_request();
	
	$papers = array();	
	if (!isset($results['document'])) {
		return $papers;
	}
	
	foreach ($results['document'] as $paper) {
		$paper['from'] = 'IEEE';
		$papers[] = $paper;
	}
	
	return $papers;
}

?>