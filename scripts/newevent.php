<!-- newevent.php
	
	Author: Alex Reynolds (c) 2013

	Adds a new event to the pending database table. Form is submitted via addevent.php.
	Event must be approved before it is moved from the pending table to the relevant city table.

-->

<?php

/* Connect to database */
require('common.php');

/* FOR VALIDATING INPUT
	from http://www.w3schools.com/php/php_form_validation.asp */

		// Define variables and set to empty values
		$name = $city = $date = $startdate = $enddate = $province = $street = $housenr = $postcode = $inout = $starttime = $endtime = $siteURL = $fbURL = $desc = $cat = "";
		$nameErr = $cityErr = $dateErr = $startdateErr = $enddateErr = $provinceErr = $streetErr = $housenrErr = $postcodeErr = $inoutErr = $starttimeErr = $endtimeErr = $descErr = $catErr = "";

		$isMultiday = $isFree = false;

		// Checks that the form was submitted and php script was not directly called
		// If properly submitted, check validity of form inputs
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			// Converts new line characters (\n) in the text area into HTML line breaks (<br />)
			$_POST['desc'] = nl2br($_POST['desc']);

			// Event name
			if (empty($_POST["name"])) {
				$nameErr = " * Event name is required";
			} else {
				$name = test_input($_POST['name']);
			}

			// Event city
			if (empty($_POST['city'])) {
				$cityErr = " * Please select a city";
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
						$startdateErr = " * Please select a starting date";
					} else {
						$startdate = test_input($_POST['startdate']);
					}

					// Ending date
					if (empty($_POST['enddate'])) {
						$enddateErr = " * Please select an ending date";
					} else {
						$enddate = test_input($_POST['enddate']);
					}

				} else {
					// If it is not a multi-day event, date must be submitted
					$dateErr = " * Please select an event date";
				}

			} else {
				$date = test_input($_POST['date']);
			}

			// Province
			if (empty($_POST['province'])) {
				$provinceErr = " * Please select a province";
			} else {
				$province = test_input($_POST['province']);
			}

			// Street address
			if (empty($_POST['street'])) {
				$streetErr = " * Street address is required";
			} else {
				$street = test_input($_POST['street']);
			}

			// House number
			if (empty($_POST['housenr'])) {
				$housenrErr = " * House number is required";
			} else {
				$housenr = test_input($_POST['housenr']);
			}

			// Postcode
			if (empty($_POST['postcode'])) {
				$postcodeErr = " * Postcode is required";
			} else {
				$postcode = test_input($_POST['postcode']);
			}

			// Indoors & outdoors
			if (empty($_POST['inout[]'])) {
				$inoutErr = " * Please select at least one option";
			} else {
				$inout = test_input($_POST['inout[]']);
			}

			// Start time
			if (empty($_POST['starttime'])) {
				$starttimeErr = " * A starting time is required";
			} else {
				$starttime = test_input($_POST['starttime']);
			}

			// End time
			if (empty($_POST['endtime'])) {
				$endtimeErr = " * An ending time is required";
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
			}

			// Facebook URL
			if (empty($_POST['fbURL'])) {
				$fbURL = "";
			} else {
				$fbURL = test_input($_POST['fbURL']);
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