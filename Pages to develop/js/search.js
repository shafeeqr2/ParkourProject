
//The functions here were taken from the instructor's example content titled: javascript Geolocation example.
//Slight modifications have been made to make the content fit appropriately on the search.html webpage.

//This function uses the Geolocation API to retrieve the current location of the person.
function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else {
		document.getElementById("your_location").value ="Geolocation is not supported by this browser.";
	}
}

//the position latitude and longitude are saved in the respective elements.
function showPosition(position) {

	document.getElementById("latitude").value = parseFloat(position.coords.latitude.toFixed(4));
	document.getElementById("longitude").value = parseFloat(position.coords.longitude.toFixed(4));

	// display on a map
	var latlon = parseFloat(position.coords.latitude.toFixed(4)) + "," + parseFloat(position.coords.longitude.toFixed(4));

	var img_url = "http://maps.googleapis.com/maps/api/staticmap?center="+latlon+"&zoom=14&size=400x300&sensor=false";
	//The map is loaded from the URL given above.
	document.getElementById("mapholder").innerHTML = "<img src='"+img_url+"'>";

}

//In the event that the map cannot be loaded, the approprate error message is displayed into the search fields.
function showError(error) {
	var msg = "";
	switch(error.code) {
		case error.PERMISSION_DENIED:
			msg = "User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			msg = "Location information is unavailable."
			break;
		case error.TIMEOUT:
			msg = "The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			msg = "An unknown error occurred."
			break;
	}
	document.getElementById("latitude").value = msg;
	document.getElementById("longitude").value = msg;
}
