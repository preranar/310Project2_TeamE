<?php

class Bibliography {
	public $bibtex;

	function __construct($paper) {
		$this->bibtex = $this->generateBibTex($paper);
	}

	function generateBibTex($paper) {
		switch($paper['from']) {
			case 'IEEE': return $this->generateBibTexIEEE($paper);
				break;
			default: return $this->generateBibTexGeneral($paper);
		}
	}

	function generateBibTexIEEE($paper) {
		$bibtex = '';
		$type = '';
        $authors = empty($paper['authors']) ? 'N/A' : $paper['authors'];
		$year = $paper['py'];
		$title = $paper['title'];
		switch($paper['pubtype']) {
			case 'Conference':
			case 'Conference Publications':
				$type = 'Conference';
				break;
			case 'Books':
				$type = 'Book';
				break;
			default: 
				$type = 'Article';
				break;
		}
		$uid = strtolower(str_replace(',', '', explode(' ', $authors)[0])).$year.strtolower(str_replace(',', '', explode(' ', $title)[0]));
		$bibtex .= '@'.$type.'{'.$uid.",<br/>";
		$bibtex .= "&emsp;&emsp;&emsp;&emsp;title=\"".$title."\",<br/>";
		$bibtex .= "&emsp;&emsp;&emsp;&emsp;author=\"".$authors."\",<br/>";
		switch($type) {
			case 'Article':
				// Required fields: author, title, journal, year, volume
				if(isset($paper['pubtitle'])) {
					$bibtex .= "&emsp;&emsp;&emsp;&emsp;journal=\"".$paper['pubtitle']."\",<br/>";
				}
				if(isset($paper['py'])) {
					$bibtex .= "&emsp;&emsp;&emsp;&emsp;year=\"".$paper['py']."\",<br/>";
				}
				if(isset($paper['volume'])) {
					$bibtex .= "&emsp;&emsp;&emsp;&emsp;volume=\"".$paper['volume']."\",<br/>";
				}
				// Optional fields: number, pages, month, note, key
				if(isset($paper['punumber']) || isset($paper['issue'])) {
					if(isset($paper['punumber'])) {
						$bibtex .= "&emsp;&emsp;&emsp;&emsp;number=\"".$paper['punumber']."\",<br/>";
					}
					else {
						$bibtex .= "&emsp;&emsp;&emsp;&emsp;number=\"".$paper['issue']."\",<br/>";
					}
				}
				if(isset($paper['spage']) && isset($paper['epage'])) {
					$bibtex .= "&emsp;&emsp;&emsp;&emsp;pages=\"".$paper['spage'].'--'.$paper['epage']."\",<br/>";
				}
				break;
			case 'Book':
				// Required fields: author/editor, title, publisher, year
				if(isset($paper['publisher'])) {
					$bibtex .= "&emsp;&emsp;&emsp;&emsp;publisher=\"".$paper['publisher']."\",<br/>";
				}
				if(isset($paper['py'])) {
					$bibtex .= "&emsp;&emsp;&emsp;&emsp;year=\"".$paper['py']."\",<br/>";
				}
				// Optional fields: volume/number, series, address, edition, month, note, key
				if(isset($paper['volume'])) {
					$bibtex .= "&emsp;&emsp;&emsp;&emsp;volume=\"".$paper['volume']."\",<br/>";
				}
				if(isset($paper['punumber']) || isset($paper['issue'])) {
					if(isset($paper['punumber'])) {
						$bibtex .= "&emsp;&emsp;&emsp;&emsp;number=\"".$paper['punumber']."\",<br/>";
					}
					else {
						$bibtex .= "&emsp;&emsp;&emsp;&emsp;number=\"".$paper['issue']."\",<br/>";
					}
				}
				break;
			case 'Conference':
				// Required fields: author, title, booktitle, year
				if(isset($paper['pubtitle'])) {
					$bibtex .= "&emsp;&emsp;&emsp;&emsp;booktitle=\"".$paper['pubtitle']."\",<br/>";
				}
				if(isset($paper['py'])) {
					$bibtex .= "&emsp;&emsp;&emsp;&emsp;year=\"".$paper['py']."\",<br/>";
				}
				// Optional fields: editor, volume/number, series, pages, address, month, organization, publisher, note, key
				if(isset($paper['volume'])) {
					$bibtex .= "&emsp;&emsp;&emsp;&emsp;volume=\"".$paper['volume']."\",<br/>";
				}
				if(isset($paper['punumber']) || isset($paper['issue'])) {
					if(isset($paper['punumber'])) {
						$bibtex .= "&emsp;&emsp;&emsp;&emsp;number=\"".$paper['punumber']."\",<br/>";
					}
					else {
						$bibtex .= "&emsp;&emsp;&emsp;&emsp;number=\"".$paper['issue']."\",<br/>";
					}
				}
				if(isset($paper['spage']) && isset($paper['epage'])) {
					$bibtex .= "&emsp;&emsp;&emsp;&emsp;pages=\"".$paper['spage'].'--'.$paper['epage']."\",<br/>";
				}
				if(isset($paper['affiliations'])) {
					$bibtex .= "&emsp;&emsp;&emsp;&emsp;organization=\"".$paper['affiliations']."\",<br/>";
				}
				if(isset($paper['publisher'])) {
					$bibtex .= "&emsp;&emsp;&emsp;&emsp;publisher=\"".$paper['publisher']."\",<br/>";
				}
				break;
		}
		$bibtex = substr($bibtex, 0, -6);
		$bibtex .= "<br/>}";
		return $bibtex;
	}

	function generateBibTexGeneral($paper) {
		return null;
	}
}