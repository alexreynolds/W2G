/* indexjs.js

	Author: Alex Reynolds

	JavaScript/jQuery functions for the index of the Where to Go web application

*/

$(document).ready(function() {

	// When admin login link is clicked
	$('#adminloginlink').click(function(){
		// Show login div
		$('#adminlogin').show(500);

	})

	// When exit icon on admin login popup is clicked
	$('#iconquit').click(function() {
		// Hide login div
		$('#adminlogin').hide(500);
	})

});