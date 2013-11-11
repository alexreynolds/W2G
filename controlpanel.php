<!-- controlpanel.php
		
		Author: Alex Reynolds

		The home of the administrator app control panel

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

<div class="user_credentials">
User <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>
</div>


</div> <!-- End content div -->
</div> <!-- End wrapper div -->

</body>