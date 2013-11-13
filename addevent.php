<!-- addevent.php

	Author: Alex Reynolds

	For administrators to submit events for list approval

	TO DO:
		- Make list of cities dynamically updating based on tables in database (or list somewhere else)
		- Dynamically updating preview image of event entry on right?
		- ** PLACE TO UPLOAD IMAGE FOR EVENT ***
		- Check to ensure that at least one category checkbox has been checked
		- Add required error messages to inputs
		- Add indicator of which user submitted the event

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

  <!-- php to process the form -->
  <?php require('scripts/newevent.php') ?>

  <h2>Add event</h2>
  Fill out this form to submit a new event to the database.<br>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	Event name <input type="text" name="name" maxlength="255" placeholder="Event name"><span class="error"> * <?php echo $nameErr;?></span><br>
	City <select name="city" id="selectcity" onChange="getSelValue()">
			<option value="select" disabled>Select a city</option>
			<option value="haarlem">Haarlem</option>
			<option value="hoofddorp">Hoofddorp</option>
			<option value="leiden">Leiden</option>
			</select>
			<span class="error"> * <?php echo $cityErr;?></span>
			<br>
	Event date <input type="date" name="date"><br>
		Multi-day event <input type="checkbox" name="multiday"><br>
		  <!-- Div to input more information if the event will take several days -->
		  <div class="moreoptions" id="multidayinfo">
		  Start date <input type="date" name="startdate"><span class="error"> * <?php echo $startdateErr;?></span><br>
		  End date <input type="date" name="enddate"><span class="error"> * <?php echo $enddateErr;?></span>
		  </div>
	Province <select name="province" id="selectprovince">
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
			<span class="error"> * <?php echo $provinceErr;?></span>
			<br>
	Street address <input type="text" name="street" maxlength="30"><span class="error"> * <?php echo $streetErr;?></span>  House number <input type="text" name="housenr" maxlength="10" size="5"><span class="error"> * <?php echo $housenrErr;?></span><br>
	Postcode <input type="text" name="postcode" maxlength="6" size="6"><br>
	Indoors <input type="checkbox" name="inout[]" value="in"> Outdoors <input type="checkbox" name="inout[]" value="out"><span class="error"> * <?php echo $inoutErr;?></span><br>
	Start time <input type="text" name="starttime" maxlength="5" placeholder="12:00"><span class="error"> * <?php echo $starttimeErr;?></span> End time <input type="text" name="endtime" maxlength="5" placeholder="12:00"><span class="error"> * <?php echo $endtimeErr;?></span><br>
	<!-- EVENTUALLY ADD OPTION FOR TICKETS THROUGH APP (checkbox) -->
	<div id="priceinfo">Ticket price (€) <input type="text" name="price" placeholder="5.00" maxlength="5"></div> It's free! <input type="checkbox" name="free"><br>
	Event website <input type="text" name="siteURL" maxlength="255" placeholder="URL"><span class="error"> <?php echo $siteURLErr;?></span><br>
	Event Facebook <input type="text" name="fbURL" maxlength="255" placeholder="URL"><span class="error"> <?php echo $fbURLErr;?></span><br>
	Event description <textarea name="desc" rows=3 cols=15 maxlength="250"></textarea><span class="error"> * <?php echo $descErr;?></span><br>
	What categories does this event fall under? (Check all that apply, please select at least one)<span class="error"> * <?php echo $catErr;?></span><br>

		<table id="categorytable"><tr>
		<td>Nature<br><input type="checkbox" name="categories[]" value="nature"></td>
		<td>Food<br><input type="checkbox" name="categories[]" value="food"></td>
		<td>Art<br><input type="checkbox" name="categories[]" value="art"></td>
		</tr><tr>
		<td>Exposition<br><input type="checkbox" name="categories[]" value="expo"></td>
		<td>Theme Parks<br><input type="checkbox" name="categories[]" value="theme"></td>
		<td>Culture<br><input type="checkbox" name="categories[]" value="culture"></td>
		</tr><tr>
		<td>Festival<br><input type="checkbox" name="categories[]" value="festival"></td>
		<td>Theater<br><input type="checkbox" name="categories[]" value="theater"></td>
		<td>Market<br><input type="checkbox" name="categories[]" value="market"></td>
		</tr></table>

	<br><br>
	<input type="submit" value="Add event"><br />
	</form>


</div> <!-- End form div -->

</div> <!-- End content div -->
</div> <!-- End wrapper div -->




</body>

</html>