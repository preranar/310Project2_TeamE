<?php

require_once('Bibliography.php');

class Paper {
	public $title;
	public $authors = array();
	public $author_string;
	public $source;
	public $pdf;
	public $abstract;
	public $text;
	public $pubtype;
	public $punumber;
	public $volume;
	public $issue;
	public $wordCount = array();
	public $bibtex;

	function __construct($paper) {
		// echo json_encode($paper['authors']);
		$this->authors = array_map('trim', explode('; ', $paper['authors'])); // array of authors in order
		$this->author_string = $paper['authors'];
		$this->title = $paper['title'];
		$this->source = $paper['pubtitle'];
		$this->abstract = $paper['abstract'];
		$this->pdf = $paper['pdf'];
		$this->text = $paper['abstract'];
		
		$this->pubtype = $paper['pubtype'];
		if (isset($paper['punumber'])) {
			$this->punumber = $paper['punumber'];
		}
		if (isset($paper['volume'])) {
			$this->volume = $paper['volume'];
		}
		if (isset($paper['issue'])) {
			$this->issue = $paper['issue'];
		}
		
		$this->bibtex = new Bibliography($paper);
	}


	// Returns a key value pair list of words
	// and their frequency in the song
	function getWordCount() {
		if (!empty($this->wordCount)) return $this->wordCount;
		$this->text = preg_replace('/\[([^\[\]]++|(?R))*+\]/', '', $this->text);
		$words = preg_split('/((^\p{P}+)|(\p{P}*\s+\p{P}*)|(\p{P}+$))/', $this->text, -1, PREG_SPLIT_NO_EMPTY);
		foreach ($words as $word) {
			$word = strtolower($word);
			if (isset($this->wordCount[$word])) {
				$this->wordCount[$word] += 1;
			} else {
				$this->wordCount[$word] = 1;
			} 
		}
		return $this->wordCount;
	}

	function countWord($word) {
		$wordCount = $this->getWordCount();
		if (isset($wordCount[$word])) {
			return $wordCount[$word];
		}
		return 0;
	}
}

?>