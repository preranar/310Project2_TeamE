<?php

require_once('Bibliography.php');
require_once('WordCloud.php'); 

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

	public $correctBibTex = '@Article{simona2017on,
    title="On the Feasibility of Breast Cancer Imaging Systems at Millimeter-Waves Frequencies",
    author="Simona Di Meo; Pedro Fidel Espín-López; Andrea Martellosio; Marco Pasian; Giulia Matrone; Maurizio Bozzi; Giovanni Magenes; Andrea Mazzanti; Luca Perregrini; Francesco Svelto; Paul Eugene Summers; Giuseppe Renne; Lorenzo Preda; Massimo Bellomi",
    journal="IEEE Transactions on Microwave Theory and Techniques",
    year="2017",
    volume="PP",
    number="22",
    pages="1--12"'; 

	public $frequency; 
	public $titleAbstract = "This is abstract here"; 
	public $relatedConferencePapers = array(
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
		$this->frequency = -1;
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

	function getConference() {
		$conf = 'IEEE Annual 32nd conference'; 
		//$wordCount2 = $this->getWordCount();
		if (true) {
			
 		}
		return $conf;
	}

	function getRelatedPaperList($conf) {
		
		return $this->relatedConferencePapers; 
	}

	function getAbstractToDisplayInPopup($title) {
		$myTitle = $title; 
		return $this->titleAbstract; 
	}

	function getPDFInAbstractPopup($abstract) {
		$myAbstract = $abstract;
		return $this->pdf; 
	}

	function getSubsetOfPapersWithTwoSelected($a, $b) {
		$array = array(
			0 => $this->relatedConferencePapers[$a],
			1 => $this->relatedConferencePapers[$b],
		);
		return $array; 
	}

	function getSubsetOfPapersWithFourSelected($a, $b, $c, $d) {
		$array = array(
			0 => $this->relatedConferencePapers[$a],
			1 => $this->relatedConferencePapers[$b],
			2 => $this->relatedConferencePapers[$c],
			3 => $this->relatedConferencePapers[$d],
		);
		return $array; 
	}

	function getAuthorWordCloud($author) {
		$wordcloud = new WordCloud($author);
		return $wordcloud; 
	}

	function getBibTex() {
		return $this->correctBibTex; 
	}

	function getPDF() {
		return $this->pdf; 
	}

}

?>