/* indexjs.js

	Author: Alex Reynolds

	JavaScript/jQuery functions for the index of the Where to Go web application

*/

$(document).ready(function() {

	// Hides the error messages of the various forms
	 $('.error').hide(); 

	// When admin login link is clicked
	$('#adminloginlink').click(function(){
		// Show login div
		$('#adminlogin').show(500);

	});

	// When exit icon on admin login popup is clicked
	$('#iconquit').click(function() {
		// Hide login div
		$('#adminlogin').hide(500);
	});

	// When the submit button for login form is clicked
	/*
	$(".submit").click(function() {  

    	// Validate and process form

    	$('.error').hide();  
		var username = $("input#username").val();  
		    if (username == "") {  
		      $("label#username_error").show();  
		      $("input#username").focus();  
		      return false;  
		    }

        var password = $("input#password").val();  
        if (password == "") {  
		      $("label#password_error").show();  
		      $("input#password").focus();  
		      return false;  
		    }

		// Submit the data to PHP script via AJAX

		var dataString = 'username='+ username + '&password=' + password;  
		//alert (dataString);return false;  
		$.ajax({  
		  type: "POST",  
		  url: "bin/login.php",
		  data: dataString,  
		  success: function() {  
		    $('#contact_form').html("<div id='message'></div>");  
		    $('#message').html("<h2>Contact Form Submitted!</h2>")  
		    .append("<p>We will be in touch soon.</p>")  
		    .hide()  
		    .fadeIn(1500, function() {  
		      $('#message').append("<img id='checkmark' src='images/check.png' />");  
		    });  
		  }  
		});  
		return false;
  	});  
*/

});