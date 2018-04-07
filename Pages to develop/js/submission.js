




//The functions here were taken from the instructor's example content titled: javascript Geolocation example.
//Slight modifications have been made to make the content fit appropriately on the search.html webpage.

//This function uses the Geolocation API to retrieve the current location of the person.

function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(postLocation, showError);
	}
}


//the position latitude and longitude are saved in the respective elements.

function postLocation(position) {

	document.getElementById("location_latitude").value = parseFloat(position.coords.latitude.toFixed(4));
	document.getElementById("location_longitude").value = parseFloat(position.coords.longitude.toFixed(4));

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

//this function clears textboxes.
function clearTextBoxes() {

  document.getElementById("location_latitude").value = "";
	document.getElementById("location_longitude").value = "";

}

//This function checks each of  the fields in the form for null values.
function checkNulls(form) {
  var message = "";
  var form_valid = true;

  if (form.name.value == "") {
      form_valid = false;
      message = " Name";
  }

  if (form.city.value == "") {
    form_valid = false;
    message += " City";
  }

  if (form.address.value == "") {
    form_valid = false;
    message += " Street Address";
  }


  if (form.postal_code.value == "") {
    form_valid = false;
    message += " Postal Code";
  }


  if (form.location_latitude.value == "") {
    form_valid = false;
    message += " Latitude";
  }

  if (form.location_longitude.value == "") {
    form_valid = false;
    message += " Longitude";
  }


	if (form.description.value == "") {
    form_valid = false;
    message += " Description";
  }


	if (form.min_rating.value == "") {
		form_valid = false;
		message += " Minimum Rating";
	}

if (form.place_image.value == "") {
	form_valid = false;
	message += " Place image";
}

  if (!form_valid) {
    window.alert("The following fields are null: " + message);
    return false;
  }

  return true;

}

//This function ensures the validity of the Postal Code to be of the format A0A 0A0.
function checkPostalCodeValidity(form) {
// Taken from URL: https://stackoverflow.com/questions/15774555/efficient-regex-for-canadian-postal-code-function/26788801
	var value = form.postal_code.value;
	var regex = /^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/;
  var match = regex.exec(value);
  if (match){
      if ( (value.indexOf("-") !== -1 || value.indexOf(" ") !== -1 ) && value.length == 7 ) {
          return true;
      } else if ( (value.indexOf("-") == -1 || value.indexOf(" ") == -1 ) && value.length == 6 ) {
          return true;
      }
  } else {
		    window.alert("Postal code must be in the format A0A 0A0.");
          return false;
  }

}

//The validate function runs all the checks above one by one. Should any of the checks fail, an alert pops up informing what the error is.
function validate(form) {

  if (!checkNulls(form)) {
    return false;
  }

  if (!checkPostalCodeValidity(form)) {
    return false;
  }

	console.log("hi");

  return true;

}
