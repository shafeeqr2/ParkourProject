

/*
Function taken from StackOverFlow: https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
Purpose of function is to retreive data from the URL.
*/
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

//The map is loaded by getting the latitude and longitude from the URL.
function loadMap(position) {

  var latitude = getParameterByName("gps_lt");
  var longitude = getParameterByName("gps_lg");
	// display on a map

  var latlon = latitude + "," + longitude;

  console.log(latlon);

}
