<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>

<script src="js/search.js"> </script>


<head>
  <meta name="viewport" content="width=device-width"  initial-scale=1 />
  <title> Search </title>
    <link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="css/search_portrait.css">
    <link rel="stylesheet" type="text/css" media="screen and (min-width: 481px)" href="css/search_desktop.css">
      <link rel="icon" href="image/icon.jpg">
</head>

<body>
  <?php include 'php/menu.inc'; ?>


  <form class="modal-content"  style="background-color:rgba(215, 233, 248, 0.8)" name="form_registration" method="link" action="results_sample.php">
    <table>
      <tr>
        <td>
          <h1 class="heading1">
            Looking for a place near you? Try us.
          </h1>
        </td>
      </tr>
      <tr>
        <td><input class="textbox" type="textbox" name= "text_search" placeholder="Name a city..."  ></td>

			<tr>
        <input class="GPSSearch" type="button" name= "search_gps" value="Search Near Me" onclick="getLocation()"> </button>
        <!-- <td></td> -->
				<!-- <p id="your_location">Click the button to get your coordinates.</p> -->
			</tr>

      <tr>
			<td><input class="position" type="number" step="0.00000001" name="gps_lt" id= "latitude" placeholder="Latitude"  >
			<input class="position" type="number" step="0.00000001"   name="gps_lg" id= "longitude" placeholder="Longitude"  ></td>

		</tr>
	  <tr>
			<td>
			<div class="image_holder" id="mapholder"></div>
		</td>
		</tr>

      </tr>
        <tr>
        <td> <p class = "rating_above"> Rating must be above:
          <select class="rating_dropdown" name="min_rating">
             <option value="1">1</option>
             <option value="2">2</option>
             <option value="3">3</option>
             <option value="4">4</option>
             <option value="5">5</option>
           </select> </p>
        </td>
      </tr>


    </table>

    <button class="btnSubmit" ><span>  Search it up! </span> </button>


  </form>

</div>


</body>



</html>
