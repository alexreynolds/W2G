<html>

<head>
	<title>Where to Go</title>
	<meta name="description" content="Where to Go helps you figure out exactly that.">
	<!-- Fits view to device screen width -->
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- Google Fonts import -->
	<link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>

	<!-- Style -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/indexstyle.css">

	<!-- Javascript -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/indexjs.js"></script>

</head>

<body>

<div id="adminarea" class="topright">
	<?php
		if (empty($_SESSION['user'])) {
			echo '<a href="#" id="adminloginlink">Admin login</a>';
		}
		else if (isset($_SESSION['user'])){
			echo 'Hello ';
			echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');
			echo ' | <a href="controlpanel.php">Control Panel</a> | <a href="logout.php">Logout</a>';
		}
		else {
			print('weird shit with users right now.');
		}
	?>
</div>

	<!-- Popup div for admin login -->
	<div id="adminlogin" class="loginpopup">

	<!-- Button to close window -->
	<img src="images/icon_x.png" id="iconquit">

	<h1>Speak, friend, and enter.</h1> 
	<!-- Login script -->
	<?php require("login.php") ?>
	<form action="" method="post"> 
	    <input type="text" name="username" value="<?php echo $submitted_username; ?>" placeholder="Username"/> 
	    <br />
	    <input type="password" name="password" value="" placeholder="Password"/> 
	    <br />
	    <input type="submit" value="Login" /> 
	</form> 
	Don't have an account yet? <a href="register.php">Register now</a>.

	</div> <!-- End admin login div -->


<div class="wrapper">
<div class="content">

<h1>Where the fuck<br>are we going?</h1>


</div> <!-- End content -->
</div> <!-- End wrapper -->

</body>


</html>