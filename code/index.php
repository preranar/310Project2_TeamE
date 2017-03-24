<?php
	require_once('app/Application.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Fusion - Home</title>
		<link rel="stylesheet" type="text/css" href="assets/stylesheets/main.css">
		<meta charset="utf-8">	
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	    <script src="assets/javascript/sidebar.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	</head>
	<body>
		<div id="sidebar">
		  <div class="sidebar-toggle"></div>
		</div>
		<div class="container">			
			<div class="wrapper" id="home-wrapper">
				<div class="header">
					<a href="#"><img src="assets/images/fusion.png" height="35%" width="35%" /></a>
				</div>
				<form  id="fusion_search_form" action="./cloud.php">	
					<div>
						<input id="search-box" form="fusion_search_form" type="search" name="query" autofocus required placeholder="Search">
						<select class="search-filter" id="autkey-box">
							<option value="keyword">Keyword</option>
							<option value="author">Author</option>
						</select>
						<input id="number-box" type="number" min="1" max ="100" value="1" autofocus required>
					</div>
					<div class="inner-wrap">
					   <button class="button" type="submit" class="Submit">ǫᴜᴇʀʏ</button>		
					</div>
				</form>

			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
	<?php echo showHistoryScript(); ?>
	var googleAutoComplete = function(req, res) {
        $.getJSON("http://suggestqueries.google.com/complete/search?callback=?",
			{ "q":req.term,
              "client":"firefox" }
        , function (data) {
	        var suggestions = [];
	        $.each(data[1], function(key, val) {
	            suggestions.push(val);
	        });
	        suggestions.length = 5;
	        console.log(suggestions);
			res(suggestions);
	    });
	}
	$(document).ready(function () {
	    $("#search-box").autocomplete({
	        source: googleAutoComplete,
	        messages: {
		        noResults: '',
		        results: function() {}
		    }
		});
	});
</script>