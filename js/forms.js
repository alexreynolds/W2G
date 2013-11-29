/* forms.js

	Author: Alex Reynolds, (c) 2013

	Contains all of the necessary functions for form submission for Where to Go

*/

$(document).ready(function() {

	// When multi-day checkbox is checked
	$('input[name=multiday]').change(function() {
		console.log('multiday');
        $('#multidayinfo').toggle();
        $('input[name=date]').toggle();
        $('label[for=date]').toggle();
	})

	// When a city is selected
	$('#selectcity').change(function() {
	    var city = getSelValue(this);
	    console.log('City selected: ' + city);
	})

	// When a province is selected
	$('#selectprovince').change(function() {
	    var prov = getSelValue(this);
	    console.log('Province selected: ' + prov);
	})

	// If the event is free
	// When multi-day checkbox is checked
	$('input[name=free]').change(function() {
		console.log('free event');
        $('#priceinfo').toggle();
	})


// Gets the value of the selected item in a dropdown menu
  function getSelValue(element)
  {
    return element.value;
  }

});

