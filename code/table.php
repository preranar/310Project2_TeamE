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
						try {
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
						<?php foreach ($WC->papers as $key => $paper) {
							echo '<tr><td>'.$paper->countWord($WC->query).'</td>';
							echo '<td>';
							$title_words = explode(' ', $paper->title);
							foreach ($title_words as $title_word) {
								echo '<a href="cloud.php?query='.preg_replace('/[^a-z0-9]+/i', '', $title_word).'">'.$title_word.' </a>';
							}
							echo '</td>';
							echo '<td>';
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
							echo '<td><a href="'.$paper->pdf.'" target=\'_blank\'">PDF</a></td></tr>';
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