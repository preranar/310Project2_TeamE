<?php  
	require_once('app/Application.php');
	if (isset($_GET['query'])) {
		$query = $_GET['query'];
		if (isset($_SESSION['history'][$query])) {
			$WC = $_SESSION['history'][$query]['WC'];
		}
	} else if (isset($_SESSION['WC'])) {
		$WC = $_SESSION['WC'];
	}

	if (isset($WC)) {
		$query = $_GET['query'];

	}



	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title id="title-page"></title>
		<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
		<script src="assets/javascript/jquery.tablesorter.js"></script>
		<script src="assets/javascript/html2canvas.js" type="text/javascript"></script>
	    <script src="assets/javascript/sidebar.js"></script>
		<script>
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
				<div class="header cloud-title" id = "t2">
					<!-- <a href="./index.php"><img src="assets/images/home.png" height="35%" width="35%" /></a> -->
					

				</div>
				<div id="wordcloud">
					<?php
						if (isset($WC)) {
							try {
								echo $WC->generateWC();
							}
							catch (Exception $e) {
							}
						} else if (isset($query)) {
							// This is taken care of in javascript now...
						}

						echo '<script> document.getElementById("t2").innerHTML = "' . $query . '"</script>';
						echo '<script> document.getElementById("title-page").innerHTML = "' . $query . '"</script>';
					?>
				</div>
				<!-- <div>
					<input type="submit" value="View Research Paper Information" class="table-button" onclick="location.href = '/table.php?query=<?php echo $query ?>';">
				</div> -->
				<div>
					<button id="download_btn" onclick="download_wc()">Download Word Cloud</button>

				</div> 
			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
	<?php echo showHistoryScript(); ?>
	$(document).ready(function() {
		<?php if (!isset($WC) && isset($query)) { ?>
		$.get("app/ajax.php?query=<?php echo $query ?>", function(data) {
			$("#wordcloud").html(data);
		}).done(function() {
			$(".preloading").fadeOut("100");
		});
		<?php } else { ?>
		$(".preloading").fadeOut("100");
		<?php } ?>
	});
    var dataUrl;

    // document.getElementById("title-page").innerHTML = <?php echo $query ?>; 

    
    console.log("\"<?php echo $query ?>\"");
    
    // function downloadURI(uri, name) {
    //  	var link = document.createElement("a");
    //     link.download = name;
    //     link.href = uri;
    //     link.click();
    // }
   
    function download_wc() {
		// html2canvas(document.getElementById("wordcloud")).
		// then(function(canvas) {
  //           dataUrl = canvas.toDataURL(); //get's image string
  //           downloadURI(dataUrl, "worcloud.jpg");           
		// });

		document.getElementById("wordcloud").style.backgroundColor = "white"; 
		html2canvas(document.getElementById("wordcloud"), {
    		onrendered: function(canvas) {

    			console.log("entered inner part of fuction");
    			var dataURL = canvas.toDataURL('image/png');
    			console.log(dataURL);
    			var link = document.createElement("a");
    			link.download = "wordcloudimage.png";
    			link.href = dataURL;
    			document.body.appendChild(link);
    			link.click();
    			document.body.removeChild(link);
    			delete link; 
    			//var url = img.src.replace(/^data:image\/[^;]/, 'data:application/octet-stream');
    			//console.log(url);
    			//window.open(url);
    			console.log("window opened");  
    			// var ajax = new XMLHttpRequest();
    			// console.log("check 1");
    			// ajax.open("POST", 'testSave.php', true);
    			// console.log("check 2");
    			// ajax.setRequestHeader('Content-Type', 'application/upload');
    			// console.log("check 3");
    			// ajax.send(dataURL);
    		}
    	});
	}
</script>
