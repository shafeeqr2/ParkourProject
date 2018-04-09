<?php include 'php/header.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width"  initial-scale=1 />
  <title> Search Results </title>

    <link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="css/results_portrait.css">
    <link rel="stylesheet" type="text/css" media="screen and (min-width: 481px)" href="css/results_desktop.css">
    <link rel="icon" href="image/icon.jpg">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>

    <script src = "js/search_results.js"></script>
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>


</head>

<body>

  <?php include 'php/menu.inc'; ?>


    <form>
      <br>
      <p class="para1" > Search for : <input class="textbox" type="text" name="search_for" > <button class="btnSubmit" ><span> Search it up! </span></button> </p>
      <br>
    </form>

    <p class="para2"> Found locations near you. </p>

		<!-- <div class="image_holder" id="mapholder"></div> -->
  <!-- <div class="map_frame" id="mapholder"> </div> -->

 <div class="map_frame" id="mapid"></div>


 <script>

    var latitude = getParameterByName("gps_lt");
    var longitude = getParameterByName("gps_lg");

    var positionArray =
    [
      [latitude,longitude],
      [Number(latitude) + Number(0.002),Number(longitude) + Number(0.002)],
      [Number(latitude) + Number(0.004),Number(longitude) + Number(0.004)]
    ];

    // var mymap = L.map('mapid').setView([51.505, -0.09], 13);
    var mymap = L.map('mapid').setView([latitude, longitude], 15);

   L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="http://mapbox.com">Mapbox</a>',
		id: 'mapbox.streets'
	}).addTo(mymap);


  positionArray.forEach( function (x) {

    L.marker([x[0], x[1]]).addTo(mymap);

  });

	// // display on a map
  	// L.marker([latitude, longitude]).addTo(mymap);

 </script>

  <br>



  <?php
  include('header.php');

  $sql_statement = "SELECT * FROM siteDB.objects
   WHERE siteDB.objects.city like ?
   AND siteDB.objects.latitude > ?
   AND siteDB.objects.latitude < ?
   AND siteDB.objects.longitude > ?
   AND siteDB.objects.longitude < ?";

  $stmt = $dbh->prepare($sql_statement);


  $location = $_GET['text_search'];
  $latitude_low = floatval($_GET['gps_lt']) - 0.5;
  $latitude_high = floatval($_GET['gps_lt']) + 0.5;
  $longitude_low = floatval($_GET['gps_lg']) - 0.5;
  $longitude_high = floatval($_GET['gps_lg']) + 0.5;


  $stmt -> bindParam(1, $location);
  $stmt -> bindParam(2, $latitude_low);
  $stmt -> bindParam(3, $latitude_high);
  $stmt -> bindParam(4, $longitude_low);
  $stmt -> bindParam(5, $longitude_high);

  $return = $stmt->execute();

  if ($return) {
    while ($row = $stmt->fetch()) {

  ?>
  <div class="card">
    <div class="container">
      <!-- <div style="display:inline-block; min-width:20cm; height:3.8cm; align: center;vertical-align: middle;" > -->
      <div class="card_images">
        <a href = "individual_sample.php"><img src="image/park1.jpg" class="card_images"></a>
      </div>
      <div class="vertical_line"></div>
    <div class="card_text">

    <a href = "individual_sample.php"><b><?php echo $row['name'] ?></b></a>
      <?php echo "<p>".$row['city']."</p>" ?>
      <?php echo "<p>".$row['address']."</p>" ?>
      <?php echo "<p>".$row['rating']."</p>" ?>


    </div>


  </div>
</div>
<?php
      }
    }
?>


<?php include 'php/footer.php'; ?>
