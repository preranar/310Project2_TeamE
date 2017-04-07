
<?php
/**
 * Created by PhpStorm.
 * User: Janet
 * Date: 4/27/2015
 * Time: 6:56 PM
 */

require 'PDFCrowd/pdfcrowd.php';

$url_param = $_GET['url'];
ini_set('display_errors', 1); 
error_reporting(E_ALL); 

function getPDF($url) {

	try {
		//create an API client instance
			$client = new Pdfcrowd("mkarmarkar", "cc4d1656385d3ac82ee10ae46c427bb7");
			$filename = explode("=", parse_url($url)['query'])[1];
			//convert a web page and store the generated pdf into a pdf variable
			// $html = file_get_contents("http://localhost/table.php?query=electrical");
			// echo $url;
			$html = file_get_contents($url);
			$out_file = fopen("../documents/fusion_$filename.pdf", "wb") or die ("not working :(");
			echo '<script> console.log("'. "OutFile: ".  $out_file . '"); </script>;'; 
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
		echo '<script> console.log("I am here"); </script>'; 
		echo "Pdfcrowd Error: " . $why;
	}
	
	return $pdf;

}

echo getPDF($url_param);