<!-- addevent.php

	Author: Alex Reynolds

	For administrators to submit events for list approval

	TO DO:
		- Make list of cities dynamically updating based on tables in database (or list somewhere else)
		- Dynamically updating preview image of event entry on right?

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

	<!-- Javascript -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/forms.js"></script>

	<!-- Login requiured for this page -->
	<?php require("scripts/private.php") ?>

</head>


<body>

<div id="adminlogoutlink" class="topright">Hello <i><?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></i> ! | <a href="logout.php">Logout</a></div>

<div class="wrapper">
<div class="content">

<!-- Navigation for control panel -->
<div id="controlnav">
<ul>
<li><a href="eventlist.php">Events list</a></li>
<li><a href="addevent.php">Add new event</a></li>
<li>Pending events</li>
<li>App analytics</li>
<li>User permissions</li>
</ul>
</div>


<!-- Form to enter a new event -->
<div class="form" id="neweventform">

  <h2>Add event</h2>
  Fill out this form to submit a new event to the database.<br>

	<form action="??" method="post">
	Event name <input type="text" name="name" maxlength="255" placeholder="Event name"><br>
	City <select name="city" id="selectcity" onChange="getSelValue()" required>
			<option value="select" disabled>Select a city</option>
			<option value="haarlem">Haarlem</option>
			<option value="hoofddorp">Hoofddorp</option>
			<option value="leiden">Leiden</option>
			</select>
			<br>
	Event date <input type="date" name="date"> Multi-day event <input type="checkbox" name="multiday"><br>
		  <!-- Div to input more information if the event will take several days -->
		  <div class="moreoptions" id="multidayinfo">
		  Start date <input type="date" name="startdate">
		  End date <input type="date" name="enddate">
		  </div>
	Province <select name="province" id="selectprovince" required>
			<option value="select" disabled>Select a province</option>
			<option value="DR">Drenthe</option>
			<option value="FL">Flevoland</option>
			<option value="FR">Friesland</option>
			<option value="GE">Gelderland</option>
			<option value="GR">Groningen</option>
			<option value="LI">Limburg</option>
			<option value="NH">Noord Holland</option>
			<option value="NB">Noord Brabant</option>
			<option value="OV">Overijssel</option>
			<option value="UT">Utrecht</option>
			<option value="ZE">Zeeland</option>
			<option value="ZH">Zuid Holland</option>
			</select>
			<br>
	Address <input type="text" name="street" maxlength="30">  House number <input type="text" name="housenr" maxlength="10"><br>
	Postcode <input type="text" name="postcode" maxlength="6"><br>
	Indoors <input type="checkbox" name="indoors"> Outdoors <input type="checkbox" name="outdoors"><br>
	Start time <input type="text" name="starttime" maxlength="5" placeholder="12:00"> End time <input type="text" name="endtime" maxlength="5" placeholder="12:00"><br>
	<div id="priceinfo">Ticket price (€) <input type="text" name="price" placeholder="5.00" maxlength="5"></div> It's free! <input type="checkbox" name="free"><br>
	Category<br />
	<select name="category" id="category" onChange="getCategory()" required>
	<option value="select" disabled>Select a type</option>
	<option value="drink">Drink</option>
	<option value="appetizer">Appetizer</option>
	<option value="salad">Salad</option>
	<option value="main">Main</option>
	<option value="dessert">Dessert</option>
	</select>
	<br /><br />
	Vegetarian?<br />
	<select name="veg" id="vegadd" onChange="getCategory(vegadd)" required>
	<option value="select" disabled>Select</option>
	<option value="1">Yes</option>
	<option value="0">No</option>
	</select>
	<br /><br />
	Description
	<input type="text" id="desc" name="desc" maxlength="250"><br />

	<br /><br />

	<input type="submit" value="Add item"><br />

	</form>

</div> <!-- End form div -->

</div> <!-- End content div -->
</div> <!-- End wrapper div -->




</body>

</html>