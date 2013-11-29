/* list.js

	Author: Alex Reynolds

	Handles event list functionality as necessary

*/

$(document).ready(function(e){

   $('.toggle').on('click',function(e){
   		var divId = $(this).val();
   		console.log("div to toggle: " + divId);
   		divId = "#" + divId;
      $(divId).slideToggle();

      //$('.eventpreview').slideToggle();
      $(this).text(function(i, text){
      	return text === "+" ? "-" : "+";
  		})
   });

})