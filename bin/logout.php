<?php 

	/* logout.php

		Author: Alex Reynolds

		Script run when a user wants to log out
		Redirects the user to the login page

	*/

    // Connects to database and starts session
    require("common.php"); 
     
    // Removes user's data from the session
    unset($_SESSION['user']); 
     
    // Redirects to login page
    header("Location: login.php"); 
    die("Redirecting to: login.php");