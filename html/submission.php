<?php include 'php/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

  <meta name="viewport" content="width=device-width"  initial-scale=1 />
  <title>
    Add Place
  </title>

  <link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="css/add_portrait.css">
  <link rel="stylesheet" type="text/css" media="screen and (min-width: 481px)" href="css/add_desktop.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
  integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
  crossorigin=""/>

  <link rel="icon" href="image/icon.jpg">


  <script src="js/submission.js"></script>

  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>


</head>
<body>

  <?php include 'php/menu.inc'; ?>

  <div class="modal">

    <form class="modal-content"  style="background-color:rgba(215, 233, 248, 0.7)" method="post" action="php/add_location.php"  id="add_location" name="form_submission" >
      <div class="container">
        <h1>
          Know of a cool place to parkour? Share it with the community!
        </h1>
        <!-- <p>Please fill out your details in the form below </p> -->
        <input class="textbox" type="text" name= "name" placeholder="What's it called?"  >
        <br>
        <input class="textbox_num" type="text" name="city" placeholder="City" >
        <input class="textbox_num"  type="text" name="address" placeholder="Address" >
        <br>
        <input class="textbox" type="text" pattern="[A-Za-z]\d[A-Za-z] ?\d[A-Za-z]\d" name= "postal_code" placeholder="Postal Code"  required>
        <br>

        <input class="textbox_num" type="number" step="0.00000001"  id="location_latitude" name="location_latitude" placeholder="Latitude" >

        <input class="textbox_num" type="number" step="0.00000001"  id="location_longitude" name="location_longitude" placeholder="Longitude" >
        <br>
        <input class= "checkbox" type="checkbox" name="checkbox"><span>Use GPS Location</span> </input>
        <br>

        <textarea class="textarea" name= "description" placeholder="Have you been there? What's it like? Describe it!"  ></textarea>

        <p class = "rating_above"> Give it a rating:
        <select class="rating_dropdown" name="min_rating">
           <option value="1">1</option>
           <option value="2">2</option>
           <option value="3">3</option>
           <option value="4">4</option>
           <option value="5">5</option>
         </select> </p>

        <p > Upload Image (PNG, JPG): <input name="place_image" class="file" type="file"></p>
        <br>

        <div class="map_frame" id="mapid"></div>
        <br>

        <input class="btnSubmit" name="submit" type="submit" onclick="return validate(form_submission);" value = "Upload" >


        <br>
      </div>
    </form>


  </div>
  <div id="msg"></div>
  <br>

  <script>
//  <input class="btnSubmit" type="submit" onclick="return validate(form_submission);"><span> Upload </span></button>
  // Declare Map. The lattitude and longitude are taken from the location placeholders.
  // In the final submission they may be taken from the server.
  var mymap = L.map('mapid').setView([document.getElementById("location_latitude").value , document.getElementById("location_longitude").value ], 15);

  //A marker is put on the center of the map.
  var marker = L.marker(mymap.getCenter()).addTo(mymap);

  //Title layer is created and added to the map.
 L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
  maxZoom: 18,
  attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
    '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
    'Imagery © <a href="http://mapbox.com">Mapbox</a>',
  id: 'mapbox.streets'
}).addTo(mymap);


// This function is used upon clicking the "Use GPS Location" checkbox.
//This function reloads the map upon clicking on a location on it.
// The marker is set to the location and the map is centered again.
  function reloadMap(position) {


    mymap.panTo(new L.LatLng( parseFloat(position.coords.latitude.toFixed(4)), parseFloat(position.coords.longitude.toFixed(4))));
    marker.setLatLng([parseFloat(position.coords.latitude.toFixed(4)), parseFloat(position.coords.longitude.toFixed(4))]).update();
  }

  // Checkbox Listener
  //If the chekcbox is filled, run the reloadMap function.
  //If the checkbox is cleared, run the clear textboxes function. The textboxes will be cleared.
  document.addEventListener("DOMContentLoaded", function (event) {
      var _selector = document.querySelector('input[name=checkbox]');
      _selector.addEventListener('change', function (event) {
          if (_selector.checked) {
              getLocation();
              navigator.geolocation.getCurrentPosition(reloadMap, null);
          } else {
              // do something else otherwise
              clearTextBoxes();
          }
      });
  });

  //This function reloads the map upon clicking on a location on it.
  // The marker is set to the location and the map is centered again.
  //Answer is given to 5 dp.
  mymap.on('click', function(e) {
    marker.setLatLng(e.latlng);
    marker.addTo(mymap);
    console.log(e.latlng);

    document.getElementById("location_latitude").value = parseFloat(e.latlng.lat.toFixed(4));
    document.getElementById("location_longitude").value = parseFloat(e.latlng.lng.toFixed(4));
  });

  </script>

  <?php include 'php/footer.php'; ?>
