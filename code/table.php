<?php  
	require_once('app/Application.php');
	$WC = $_SESSION['WC'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Fusion - Report Table</title>
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="assets/javascript/jquery-latest.js"></script>
		<script src="assets/javascript/jquery.tablesorter.js"></script>
	    <script src="assets/javascript/sidebar.js"></script>		
		<script>
			$(window).load(function() {
				$(".preloading").fadeOut("100");;
			});
		    $(document).ready(function() { 
		        $("#tftable").tablesorter( {sortList: [[0,1]]} ); 
		    });
		</script>
		<link rel="stylesheet" type="text/css" href="assets/stylesheets/main.css">
		<meta charset="utf-8">	
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="preloading"></div>
		<div id="sidebar">
		  <div class="sidebar-toggle"></div>
		</div>
		<div class="container">			
			<div class="wrapper">
				<div class="header">
					<a href="./index.php"><img src="assets/images/home.png" height="35%" width="35%" /></a>
				</div>
				<?php

					if (isset($WC)) { 
						// try {
						// 	$WC->generateWC();
						// }
						// catch (Exception $e) {
						// }
						$query = $_GET['query'];

						try {
							$WC = new WordCloud($query);
							
							 $WC->generateCloud(new IEEE());
							 $_SESSION['WC'] = $WC;
							 $WC->generateWC();
						}
						catch (Exception $e) {
						}
					} else if (isset($_GET['query'])) {
					    $query = $_GET['query'];
						try {
							$WC = new WordCloud($query);
							$WC->generateCloud(new IEEE());
							$_SESSION['WC'] = $WC;
							$WC->generateWC();
						}
						catch (Exception $e) {
						}
					}
				?>
				<div id="search_info">
					<table class="tablesorter" id="tftable" border="1">
						<thead>
							<tr>
								<th>Frequency</th>
								<th>Title</th>
								<th>Author</th>
								<th>Source</th>
								<th>Bibliographic</th>
								<th>Link</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$papers = $WC->getPapers(new IEEE());
							foreach($papers as $paper) {
								$p = implode('|', $paper); 
									echo '<script> console.log("Paper title: ' . $p . '"); </script> ';
									
							}
						foreach ($WC->papers as $key => $paper) {
							$WC->query = $_GET['query'];
							echo '<script> console.log("Abstract: ' . $paper->abstract . '"); </script> ';
							$ab = $paper->abstract;
							echo '<script> console.log("Abs: ' . $ab . '"); </script> ';
							echo '<tr><td>'.$paper->countWord($WC->query).'</td>';
							echo '<td>';
							//$title_words = explode(' ', $paper->title);
							//foreach ($title_words as $title_word) {
							//	echo '<a href="cloud.php?query='.preg_replace('/[^a-z0-9]+/i', '', $title_word).'">'.$title_word.' </a>';
							//}
							echo '<link href="assets/stylesheets/modal.css" rel="stylesheet">';
							// $abstract_words = explode(' ', $paper->abstract); 
							// $updated_abstract = "";
							// foreach ($abstract_words as $abstract_word) {
							// 	if ($abstract_word === 'the') {
							// 		//alert("the"); 
							// 		$abstract_word = '<span class="highlight">' . $abstract_word . '</span>';  
							// 		//$abstract_word = $abstract_word . '\u0332'; 
							// 	}//$updated_abstract 
							// 	$updated_abstract = $updated_abstract . $abstract_word . " "; 
							// }

							$beg = substr($paper->pdf, 0, 26); 
							$end = substr($paper->pdf, 26); 
							$good = $beg . '.libproxy2.usc.edu' . $end; 
							
							echo '<!-- The Modal -->
								<div id=' . "\"myModal" . $ab . "\"" . 'class="modal">

								  <!-- Modal content -->
								  <div class="modal-content">
								    <span id='. "\"close" . $ab . "\"" . ' class = "close">&times;</span>
								    <p id='. "\"abstract_section" . $ab . "\"" . '>' . $ab . '</p>
								    <button id='. "\"pdfdownload" . $ab . "\"" . ' onclick="openPDF()">'.$good . '</button>
								  </div>

								</div>';
							echo '<script> 
								var modal = document.getElementById(' . "\"myModal" . $ab . "\"" . '); 
								var span = document.getElementById('. "\"close" . $ab . "\"" . '); 
								span.onclick = function() {
									var m = document.getElementById(' . "\"myModal" . $ab . "\"" . '); 
									m.style.display = "none"; 
								}

								window.onclick = function(event) {
									if (event.target == modal) {
										modal.style.display = "none"; 
									}
								}

								function openPDF() {
									var link = document.createElement("a");
									link.download = "test.jsp";
									link.target = "_blank";
									link.href = document.getElementById('. "\"pdfdownload" . $ab . "\"" . ' ).innerHTML;
									document.body.appendChild(link);
									link.click();
									document.body.removeChild(link);
									delete link; 
								}



							</script>'; 
							
							echo '<button id='. "\"button" . $ab . "\"" . '>'.$paper->title.'</button>';
							echo '<script> 
							var b = document.getElementById('. "\"button" . $ab . "\"" . ');

							b.onclick = function() 
								{
									var m = document.getElementById(' . "\"myModal" . $ab . "\"" . '); 
									m.style.display = "block";
									var abstractSection = document.getElementById('. "\"abstract_section" . $ab . "\"" . ');
									console.log("This is the abstract: " + abstractSection.innerHTML); 
									var updated_abstract = "";
									var unedittedAbstract = abstractSection.innerHTML;
									var explodedStr = unedittedAbstract.split(" ");
									for (var word in explodedStr) {
										var w = explodedStr[word];
										if (w.indexOf('."\"". $query . "\"".') != -1) {
										//if (explodedStr[word] === '."\"". $query . "\"".') {
											updated_abstract = updated_abstract;
											updated_abstract += "<span class=\'highlight\'>";
											updated_abstract += explodedStr[word];
											updated_abstract += "</span>";
											updated_abstract += " "; 
										} else {
											updated_abstract = updated_abstract + explodedStr[word] + " ";
										}
									 	
									}
									console.log(updated_abstract); 
									abstractSection.innerHTML = updated_abstract;  
								} 

								</script>'; 
							//echo '<div>'.$paper->title.' </div>'; 
							echo '</td>';
							echo '<td>';
							//echo $paper->authors;
							//echo implode(" ", $paper->authors); 
							$author_words = preg_split('/([;])/', $paper->author_string, -1, PREG_SPLIT_DELIM_CAPTURE);
							foreach ($author_words as $author_word) {
								if ($author_word!==';') {
									echo '<a href="cloud.php?query='.urlencode($author_word).'">'.$author_word.'</a>';
								} else {
									echo $author_word;
								}
							}
							echo '</td>';
							$params = array();
							$params[] = 'query='.$WC->query;
							if(isset($paper->pubtype)) {
								$params[] = 'pubtype='.urlencode($paper->pubtype);
							}
							if(isset($paper->punumber)) {
								$params[] = 'punumber='.urlencode($paper->punumber);
							}
							if(isset($paper->volume)) {
								$params[] = 'volume='.urlencode($paper->volume);
							}
							if(isset($paper->issue)) {
								$params[] = 'issue='.urlencode($paper->issue);
							}
							$params = implode('&', $params);
							echo '<td><a href="/source.php?'.$params.'">'.$paper->source.'</a></td>';
							echo "<td><p><a href='javascript:void(0)' onclick=\"document.getElementById('bib-light-".$key."').style.display='block';".
							"document.getElementById('bib-fade-".$key."').style.display='block'\">Bibliography</a></p><div id='bib-light-".$key."' ".
							"class='white_content light'>".$paper->bibtex->bibtex."<a class='close_link' href='javascript:void(0)' ".
							"onclick=\"document.getElementById('bib-light-".$key."').style.display='none';".
							"document.getElementById('bib-fade-".$key."').style.display='none'\">Close</a></div><div id='bib-fade-".$key."' class='black_overlay'></div></td>";
							 
							$pattern = '/org//';
							$replacement = 'org.libproxy2.usc.edu/';
							$replaced = preg_replace($pattern, $replacement, $string); 
							echo '<td><a href="'.$good.'" target=\'_blank\'"> PDF </a></td></tr>';
							//echo '<td><a href="'.$good.'" download>PDF</a></td></tr>';
							//echo '<td><a href="https://www.w3schools.com/css/trolltunga.jpg" download>PDF</a></td></tr>';
						}
						?>
						</tbody>
					</table>
					<div class="table-button">
						<a type="submit" class="table-button" value="Export '<?php echo strtolower($query) ?>' to PDF" target="_blank" href="./app/PDFconverter.php?url=<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" ><span class="a-button">ᴇxᴘᴏʀᴛ</span></a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
	<?php echo showHistoryScript(); ?>
</script>