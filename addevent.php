<?php require("bin/private.php"); ?>

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
		- Screen in between submission and insertion to view entry and clarify/edit

-->

<html>

<head>

	<!-- Fits view to device screen width -->
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- Google Fonts import -->
	<link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>

	<!-- Style -->
	<link rel="stylesheet" href="css/normalize.css">
  	<link rel="stylesheet" href="css/foundation.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/controlstyle.css">
	<link rel="stylesheet" href="css/formstyle.css">

	

</head>


<body>
<div class="headerbar"><img src="images/wheretogo.png" class="wordmark">

<div id="adminlogoutlink" class="topright">Hello <i><?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></i> !<br>
		<a href="logout.php">Logout</a></div>

</div>

<div class="wrapper">
<div class="content">

<!-- Navigation for control panel -->
<div class="controlnav">
<ul>
<li><a href="eventlist.php">Events list</a></li>
<li class="active"><a href="addevent.php">Add new event</a></li>
<li><a href="pendinglist.php">Pending events</a></li>
<li>App analytics</li>
<li>User permissions</li>
</ul>
</div>


<!-- Form to enter a new event -->
<div class="form" id="neweventform">

  <h2>Add event</h2>
  Fill out this form to submit a new event to the database.<br><br>

	<form method="post" action="bin/newevent.php">
	<label for="name">Event name</label><input type="text" name="name" maxlength="255" placeholder="Event name"><span class="error"> * <?php echo $nameErr;?></span><br>
	<label for="city">City</label><select name="city" id="selectcity">
			<option value="select" disabled>Select a city</option>
			<option value="haarlem">Haarlem</option>
			<option value="hoofddorp">Hoofddorp</option>
			<option value="leiden">Leiden</option>
			</select>
			<span class="error"> * <?php echo $cityErr;?></span>
			<br>
	<label for="date">Event date</label><input type="date" name="date"><br>
	<label for="multiday">Multi-day event?</label><input type="checkbox" name="multiday"><br>
		  <!-- Div to input more information if the event will take several days -->
		  <div class="moreoptions" id="multidayinfo">
		  <label for="startdate">Start date</label><input type="date" name="startdate"><span class="error"> * <?php echo $startdateErr;?></span><br>
		  <label for="enddate">End date</label><input type="date" name="enddate"><span class="error"> * <?php echo $enddateErr;?></span>
		  </div>
	<label for="province">Province</label><select name="province" id="selectprovince">
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
	<div class="inputblock"><label for="street">Street address</label><input type="text" name="street" maxlength="30"><span class="error"> * <?php echo $streetErr;?></span></div>
	<div class="inputblock"><label for="housenr">House number</label><input type="text" name="housenr" maxlength="10" size="5"><span class="error"> * <?php echo $housenrErr;?></span></div><br>
	<label for="postcode">Postcode</label><input type="text" name="postcode" maxlength="6" size="6"><span class="error"> * <?php echo $housenrErr;?></span><br>
	<div class="inputblock"><label>Indoors</label><input type="checkbox" name="inout[]" value="in"></div>
	<div class="inputblock"><label>Outdoors</label><input type="checkbox" name="inout[]" value="out"></div><span class="error"> * <?php echo $inoutErr;?></span><br>
	<div class="inputblock"><label for="starttime">Start time</label><input type="text" name="starttime" maxlength="5" placeholder="12:00" size="5"><span class="error"> * <?php echo $starttimeErr;?></span></div>
	<div class="inputblock"><label for="endtime">End time</label><input type="text" name="endtime" maxlength="5"  size="5" placeholder="12:00"><span class="error"> * <?php echo $endtimeErr;?></span></div><br>
	<!-- EVENTUALLY ADD OPTION FOR TICKETS THROUGH APP (checkbox) -->
	<div class="inputblock"><div id="priceinfo"><label for="price">Ticket price (€)</label><input type="text" name="price" placeholder="5.00" maxlength="5"></div></div>
	<div class="inputblock"><label for="free">It's free!</label><input type="checkbox" name="free"></div><br>
	<label for="siteURL">Event website</label><input type="text" name="siteURL" maxlength="255" placeholder="URL"><span class="error"> <?php echo $siteURLErr;?></span><br>
	<label for="fbURL">Event Facebook</label><input type="text" name="fbURL" maxlength="255" placeholder="URL"><span class="error"> <?php echo $fbURLErr;?></span><br>
	<label for="desc">Event description</label><textarea name="desc" rows=3 cols=15 maxlength="250"></textarea><span class="error"> * <?php echo $descErr;?></span><br>
	What categories does this event fall under? <i>Check all that apply, please select at least one.</i><span class="error"> * <?php echo $catErr;?></span><br>

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


	<!-- Javascript -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/forms.js"></script>
	<script src="js/vendor/jquery.js"></script>
	<script src="js/foundation.min.js"></script>
	<script>
	   $(document).foundation();
	</script>
</body>

</html>