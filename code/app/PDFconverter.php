
<?php
/**
 * Created by PhpStorm.
 * User: Janet
 * Date: 4/27/2015
 * Time: 6:56 PM
 */

require 'PDFCrowd/pdfcrowd.php';

$url_param = $_GET['url'];

function getPDF($url) {

	try {
		//create an API client instance
		$client = new Pdfcrowd("fusion11", "7403af807d1dc87221f662e7becf7243");
		$filename = explode("=", parse_url($url)['query'])[1];
		//convert a web page and store the generated pdf into a pdf variable
		// $html = file_get_contents("http://localhost/table.php?query=electrical");
		// echo $url;	
		$html = file_get_contents($url);
		$out_file = fopen("../documents/fusion_$filename.pdf", "wb");
		$pdf = $client->convertHTML($html, $out_file);
		fclose($out_file);
		$pdf = file_get_contents("../documents/fusion_$filename.pdf");


		// set HTTP response headers
		header("Content-Type: application/pdf");
		header("Cache-Control: max-age=0");
		header("Accept-Ranges: none");
		header("Content-Disposition: attachment; filename=\"fusion_$filename.pdf\"");
	
	}
	catch(PdfcrowdEsception $why) {
		echo "Pdfcrowd Error: " . $why;
	}
	
	return $pdf;

}

echo getPDF($url_param);