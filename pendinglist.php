<?php require("bin/private.php") ?>

<!-- pendinglist.php

	Author: Alex Reynolds (c)

	For administrators to view all events pending insertion into city databases.

	TO DO:
	- Style each listing like it's shown in the main app (maybe)
	- Add buttons to add each event
	- Make listing expandable - initially shown as compressed list with option to expand event for more details
	- Add filter options
	- Search function
	- Alternate colors of event listing rows

-->

<html>

<head>

	<!-- Fits view to device screen width -->
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- Google Fonts import -->
	<link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>

	<!-- Style -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/controlstyle.css">
	<link rel="stylesheet" type="text/css" href="css/liststyle.css">

	<!-- Javascript -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/list.js"></script>
	

</head>


<body>

<div class="headerbar"><img src="images/wheretogo.png" class="wordmark">

<div id="adminlogoutlink" class="topright">Hello <i><?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></i> !<br>
		<a href="logout.php">Logout</a></div>

</div>

<!-- Navigation for control panel -->
<div class="controlnav">
<ul>
<li><a href="eventlist.php">Events list</a></li>
<li><a href="addevent.php">Add new event</a></li>
<li class="active"><a href="pendinglist.php">Pending events</a></li>
<li>App analytics</li>
<li>User permissions</li>
</ul>
</div>


<div class="wrapper">
<div class="content">

<?php

	// Connect to the database
	$con = mysql_connect($host,$username,$password);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db($dbname, $con);

// Retrieves entries from pending table, ordered by date
$result = mysql_query("SELECT * FROM pending ORDER BY date ASC");

// Iterates through entries list and displays on screen
while($row = mysql_fetch_array($result)) {
	printEvent($row);
}

	// Function that echos HTML formatting for given event
	function printEvent($entry) {

		$cityname = $ticketstatus = $internetstatus = $facebookstatus = "";

		$ticketsrc = "images/icon_tickets_";
		$indoorsrc = "images/icon_indoors_";
		$outdoorsrc = "images/icon_outdoors_";
		$internetsrc = "images/icon_internet_";
		$facebooksrc = "images/icon_facebook_";
		$naturesrc = "images/icon_nature_";
		$foodsrc = "images/icon_food_";
		$artsrc = "images/icon_art_";
		$exposrc = "images/icon_expo_";
		$themesrc = "images/icon_theme_";
		$culturesrc = "images/icon_culture_";
		$festivalsrc = "images/icon_festival_";
		$theatersrc = "images/icon_theater_";
		$marketsrc = "images/icon_market_";


		// Capitalizes city name for further use
		$cityname = ucfirst($entry['city']);

		// Determines if tickets can be bought online and selects appropriate img src
		if ($entry['ticket_buy'] == 1) {
			$ticketsrc .= "black.png";
			$ticketstatus = "Online tickets available";
		} else {
			$ticketsrc .= "grey.png";
			$ticketstatus = "Online tickets not available";
		}

		// Selects appropriate indoors/outdoors icon src
		if ($entry['indoors'] == 1) { $indoorsrc .= "black.png"; }
		else { $indoorsrc .= "grey.png"; }
		if ($entry['outdoors'] == 1) { $outdoorsrc .= "black.png"; }
		else { $outdoorsrc .= "grey.png"; }

		// Selects appropriate internet & facebook icon src
		if ($entry['site_URL'] == "") {
			$internetsrc .= "grey.png";
			$internetstatus = "No website listed";
		} else {
			$internetsrc .= "black.png";
			$internetstatus = $entry['site_URL'];
		}
		if ($entry['fb_URL'] == "") {
			$facebooksrc .= "grey.png";
			$facebookstatus = "No Facebook listed";
		} else {
			$facebooksrc .= "black.png";
			$facebookstatus = $entry['fb_URL'];
		}

		// Selects appropriate category icon src
		if ($entry['nature'] == 0) { $naturesrc .= "grey.png"; }
		else { $naturesrc .= "black.png"; }

		if ($entry['food'] == 0) { $foodsrc .= "grey.png"; }
		else { $foodsrc .= "black.png"; }

		if ($entry['art'] == 0) { $artsrc .= "grey.png"; }
		else { $artsrc .= "black.png"; }

		if ($entry['expo'] == 0) { $exposrc .= "grey.png"; }
		else { $exposrc .= "black.png"; }

		if ($entry['themepark'] == 0) { $themesrc .= "grey.png"; }
		else { $themesrc .= "black.png"; }

		if ($entry['culture'] == 0) { $culturesrc .= "grey.png"; }
		else { $culturesrc .= "black.png"; }

		if ($entry['festival'] == 0) { $festivalsrc .= "grey.png"; }
		else { $festivalsrc .= "black.png"; }

		if ($entry['theater'] == 0) { $theatersrc .= "grey.png"; }
		else { $theatersrc .= "black.png"; }

		if ($entry['market'] == 0) { $marketsrc .= "grey.png"; }
		else { $marketsrc .= "black.png"; }

		// Print out event preview bar
		echo "<div class=\"eventpreview\">
				<div class=\"grid_left\"><span class=\"altfont\">";
		echo $cityname;	// Capitalizes first letter of city
		echo ", ";
		echo $entry['province'];		// Event province
		echo "</span></div>
				<div class=\"grid_center\">";
		echo $entry['name'];			// Event name
		echo "</div>
				<div class=\"grid_right\">";
		echo $entry['date'] . " - " . $entry['end_date'];	// Event dates
		echo "</div>
				<div class=\"grid_buttons\"><button class=\"toggle\" value=\"" . $entry['id'] . "\">+</button>
				</div>";	// Button value is equivalent to event ID
		echo "</div>";

		// Print out event details
		echo "<div class=\"event\" id=\"" . $entry['id'] . "\">";	// Div id is event ID number

		### LEFT GRID
		echo "<div class=\"grid_left\">";
		// ** EVENTUALLY CHANGE TO REFLECT REAL IMAGE **/
		echo "<img src=\"images/sampleimg.jpg\" class=\"eventimg\"><br><br>";
		echo "<span class=\"altfont\">" . $cityname . ", " . $entry['province'] . "</span><br><br>";
		echo "<button>Edit image</button><br><br>";
		if ($entry['ticket_price'] == 0) {
			echo "<h2>Free</h2><br><br>";	// If event is free
		} else {
			echo "<h2>&euro;" . $entry['ticket_price'] . "</h2>per ticket<br><br>"; 	// If tickets cost
		}
		echo "<img src=\"" . $ticketsrc . "\" class=\"icon\"> " . $ticketstatus . "</div>";

		### CENTER GRID
		echo "<div class=\"grid_center\">";
		echo "<h1>" . $entry['name'] . "</h1>";		// Event name
		echo "<div class=\"inline\">
				<span class=\"altfont\">STARTS</span><br>";
		echo "<span class=\"date\">" . $entry['date'] . "</span><br>";		// Start date
		echo $entry['start_time'] . "</div>";			// Start time
		echo "<div class=\"inline\">
				<span class=\"altfont\">ENDS</span><br>";
		echo "<span class=\"date\">" . $entry['end_date'] . "</span><br>";		// End date
		echo $entry['end_time'] . "</div><br><br>";			// End time
		echo "<span class=\"altfont\">Address</span><br>";
		echo "<span class=\"text\">" . $entry['address'] . "<br>" . $entry['postcode'] . " " . $cityname . "</span><br><br>";	// Street address
		echo "<div class=\"inline\">";
		echo "<img src=\"" . $indoorsrc . "\" class=\"icon\">INDOORS</div>";	// Indoors?
		echo "<div class=\"inline\">";
		echo "<img src=\"" . $outdoorsrc . "\" class=\"icon\">OUTDOORS</div>";	// Outdoors?
		echo "<br><br>";
		echo "<img src=\"" . $internetsrc . "\" class=\"icon\"> <a href=\"" . $entry['site_URL'] . "\">" . $internetstatus . "</a><br><br>";	// Website info
		echo "<img src=\"" . $facebooksrc . "\" class=\"icon\"> <a href=\"" . $entry['fb_URL'] . "\">" . $facebookstatus . "</a><br><br>";		// Facebook info
		echo "<span class=\"altfont\">Description</span><br>" . $entry['description'] . "<br>";
		echo "</div>";

		### RIGHT GRID
		echo "<div class=\"grid_right\">";
		echo "<span class=\"altfont\">Categories</span><br>";
		echo "<div class=\"cat\"><img src=\"" . $naturesrc . "\"><br>Nature</div>";
		echo "<div class=\"cat\"><img src=\"" . $foodsrc . "\"><br>Food</div><br>";
		echo "<div class=\"cat\"><img src=\"" . $artsrc . "\"><br>Art</div>";
		echo "<div class=\"cat\"><img src=\"" . $exposrc . "\"><br>Exposition</div><br>";
		echo "<div class=\"cat\"><img src=\"" . $themesrc . "\"><br>Theme Park</div>";
		echo "<div class=\"cat\"><img src=\"" . $culturesrc . "\"><br>Culture</div><br>";
		echo "<div class=\"cat\"><img src=\"" . $festivalsrc . "\"><br>Festival</div>";
		echo "<div class=\"cat\"><img src=\"" . $theatersrc . "\"><br>Theater</div><br>";
		echo "<div class=\"cat\"><img src=\"" . $marketsrc . "\"><br>Market</div>";
		echo "</div>";

		### BUTTONS GRID
		echo "<div class=\"grid_buttons\">";
		// ADD MORE INFO FOR BUTTONS EVENTUALLY
		echo "<button>Edit</button><br>";
		echo "<button>Approve</button><br>";
		echo "<button>Remove</button><br>";
		echo "</div>";

		// End of event div
		echo "</div>";

	}

?>


<!-- End content div -->
</div>
<!-- End wrapper div -->
</div>

</body>

</html>