<?php require("bin/private.php") ?>
<!-- eventlist.php

	Author: Alex Reynolds

	For administrators to view/search all events in the database

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
<li class="active"><a href="eventlist.php">Events list</a></li>
<li><a href="addevent.php">Add new event</a></li>
<li><a href="pendinglist.php">Pending events</a></li>
<li>App analytics</li>
<li>User permissions</li>
</ul>
</div>


<!-- End content div -->
</div>
<!-- End wrapper div -->
</div>

</body>

</html>