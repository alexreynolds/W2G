<?php

	/* newevent.php
	
	Author: Alex Reynolds (c) 2013

	Validates the input of the Add Event form. If input is valid,
	adds a new event to the pending database table. Form is submitted via addevent.php.
	Event must be approved before it is moved from the pending table to the relevant city table.

	TODO:
	- Make it possible to upload images for events. Add relevant image URL in mysql query.
	- Once in-app purchases are possible, update ticket_buy variable to reflect this in query.
	- Validate postcode against street address
	- Validate Facebook URL

	*** REDIRECT TO A CLEARER SUCCESS LOCATION

	*/




/* Connect to database */
require('common.php');

/* FOR VALIDATING INPUT
	from http://www.w3schools.com/php/php_form_validation.asp */

// Define variables and set to empty values
$name = $city = $date = $startdate = $enddate = $province = $street = $housenr = $postcode = $inout = $starttime = $endtime = $price = $siteURL = $fbURL = $desc = $cat = "";
$nameErr = $cityErr = $dateErr = $startdateErr = $enddateErr = $provinceErr = $streetErr = $housenrErr = $postcodeErr = $inoutErr = $starttimeErr = $endtimeErr = $siteURLErr = $fbURLErr = $descErr = $catErr = "";

$isMultiday = $isFree = false;

// Binary variables for database insertion
$multiday = $indoors = $outdoors = $nature = $food = $art = $expo = $theme = $culture = $festival = $theater = $market = 0;

// Checks that the form was submitted and php script was not directly called
// If properly submitted, check validity of form inputs
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	// Converts new line characters (\n) in the text area into HTML line breaks (<br />)
	$_POST['desc'] = nl2br($_POST['desc']);

	// Event name
	if (empty($_POST["name"])) {
		$nameErr = "Event name is required";
	} else {
		$name = test_input($_POST['name']);
	}

	// Event city
	if (empty($_POST['city'])) {
		$cityErr = "Please select a city";
	} else {
		$city = test_input($_POST['city']);
	}

	// Date
	if (empty($_POST['date'])) {
		
		// If it is a multi-day event, validate start and end date
		if (isset($_POST['multiday'])) {

			$isMultiday = true;

			// Starting date
			if (empty($_POST['startdate'])) {
				$startdateErr = "Please select a starting date";
			} else {
				$startdate = test_input($_POST['startdate']);
			}

			// Ending date
			if (empty($_POST['enddate'])) {
				$enddateErr = "Please select an ending date";
			} else {
				$enddate = test_input($_POST['enddate']);
			}

		} else {
			// If it is not a multi-day event, date must be submitted
			$dateErr = "Please select an event date";
		}

	} else {
		$date = test_input($_POST['date']);
	}

	// Province
	if (empty($_POST['province'])) {
		$provinceErr = "Please select a province";
	} else {
		$province = test_input($_POST['province']);
	}

	// Street address
	if (empty($_POST['street'])) {
		$streetErr = "Street address is required";
	} else {
		$street = test_input($_POST['street']);
	}

	// House number
	if (empty($_POST['housenr'])) {
		$housenrErr = "House number is required";
	} else {
		$housenr = test_input($_POST['housenr']);
	}

	// Postcode
	if (empty($_POST['postcode'])) {
		$postcodeErr = "Postcode is required";
	} else {
		$postcode = test_input($_POST['postcode']);
	}

	// Indoors & outdoors
	if (empty($_POST['inout[]'])) {
		$inoutErr = "Please select at least one option";
	} else {
		$inout = test_input($_POST['inout[]']);
		
	}

	// Start time
	if (empty($_POST['starttime'])) {
		$starttimeErr = "A starting time is required";
	} else {
		$starttime = test_input($_POST['starttime']);
	}

	// End time
	if (empty($_POST['endtime'])) {
		$endtimeErr = "An ending time is required";
	} else {
		$endtime = test_input($_POST['endtime']);
	}

	// Ticket price
	if (empty($_POST['price'])) {
		$price = "";
	} else {
		$price = test_input($_POST['price']);
	}

	// Free entry
	if (empty($_POST['free'])) {
		// Do nothing, event isn't free.
	} else {
		// Ticket price is 0
		$price = 0;
		$isFree = true;
	}

	// Site URL
	if (empty($_POST['siteURL'])) {
		$siteURL = "";
	} else {
		$siteURL = test_input($_POST['siteURL']);
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website))
		  {
		  	$siteURLErr = "Invalid URL"; 
		  }
	}

	// Facebook URL
	if (empty($_POST['fbURL'])) {
		$fbURL = "";
	} else {
		$fbURL = test_input($_POST['fbURL']);
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website))
		  {
		  	$fbURLErr = "Invalid URL"; 
		  }
	}

	// Event description
	if (empty($_POST['desc'])) {
		$descErr = "An event description is required";
	} else {
		$desc = test_input($_POST['desc']);
	}

	// Event categories
	if (empty($_POST['categories[]'])) {
		$catErr = "Please select at least one category";
	} else {
		$cat = test_input($_POST['categories[]']);
	}



}

// Function to test input validity
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Submit the event to the pending events table

// Connect to database
$con = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Formatting variables for database submission
	  if ($isMultiday) {
	  	$date = $startdate;
	  	$multiday = 1;
	  } else {
	  	// Starting date is $date
	  	// $multiday initialized to 0
	  	// End date is same as start date
	  	$enddate = $date;
	  }
	  // Address is street concatenated with house number
	  $address = $street . " " . $housenr;
	  // Image URL is "" for now (until images can be uploaded)
	  $imgURL = "";

	  	// Updates in/outdoors binary variables as needed
	  	if (isset($_POST['inout'])) {
		  	foreach ($_POST['inout'] as $val) {
				if ($val == 'in') { $indoors = 1; }
				if ($val == 'out') { $outdoors = 1; }
			}
		}

		// Updates category binary variables as needed
		if (isset($_POST['categories'])) { 
			foreach ($_POST['categories'] as $val) {
				if ($val == 'nature') { $nature = 1; }
				if ($val == 'food') { $food = 1; }
				if ($val == 'art') { $art = 1; }
				if ($val == 'expo') { $expo = 1; }
				if ($val == 'theme') { $theme = 1; }
				if ($val == 'culture') { $culture = 1; }
				if ($val == 'festival') { $festival = 1; }
				if ($val == 'theater') { $theater = 1; }
				if ($val == 'market') { $market = 1; }
			}
		}

// Building query for submission

	  /* NOTE: VALUE FOR TICKET BUY BINARY IS 0 UNTIL IN-APP PURCHASES ARE ENABLED */

  $sql = "INSERT INTO pending 
  		(city, name, date, multi_day, end_date, province, address, postcode, indoors, outdoors, start_time, end_time, ticket_buy, ticket_price, site_URL, fb_URL, description, img_URL, nature, food, art, expo, themepark, culture, festival, theater, market) 
  		VALUES ('$city', '$name', '$date', '$multiday', '$enddate', '$province', '$address', '$postcode', '$indoors', '$outdoors', '$starttime', '$endtime', 0, '$price', '$siteURL', '$fbURL', '$desc', '$imgURL', '$nature', '$food', '$art', '$expo', '$theme', '$culture', '$festival', '$theater', '$market')";


if (!mysqli_query($con, $sql)) {
	die('Error: ' . mysqli_error($con));
}

mysqli_close($con);

// Redirect to control panel page
header('location: ../controlpanel.php');
die();

