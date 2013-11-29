<?php 

    /* private.php

        Author: Alex Reynolds

        Used on pages that require secure login to view

    */

    // First we execute our common code to connection to the database and start the session 
    require("bin/common.php"); 
     
    // At the top of the page we check to see whether the user is logged in or not 
    if(empty($_SESSION['user'])) 
    { 
        // If they are not, we redirect them to the login page. 
        header("Location: bin/login.php"); 
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to bin/login.php"); 
    }