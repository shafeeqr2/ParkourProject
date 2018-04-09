<?php include 'php/header.php'; ?>

<!DOCTYPE html>
<html>
<head>

  <script src="js/comment_and_rating.js"></script>

  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

  <meta name="viewport" content="width=device-width"  initial-scale=1 />
  <title>
    Details Page
  </title>
  <link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="css/details_portrait.css">
  <link rel="stylesheet" type="text/css" media="screen and (min-width: 481px)" href="css/details_desktop.css">
  <link rel="icon" href="image/icon.jpg">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
  integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
  crossorigin=""/>



  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

</head>
<body>


  <?php include 'php/menu.inc'; ?>

  <div class="modal">

    <div class="modal-content"  style="background-color:rgba(215, 233, 248, 0.7)">
      <div class="container">
        <h1>
          Details about this awesome place.
        </h1>

        <table>
          <tr class="table_row">
            <div>
            <img class="map_frame" src="image/mcmaster_details.jpg"/>
            <br>
          </div>
          </tr>
          <col width="20%">
          <col width="80%">
          <tr class="table_row">
            <td>
              <para1 class="para1">It's called:</para1>
            </td>
            <td>
              <para3 class="para3">McMaster University</para3>
            </td>
          </tr>


          <tr class="table_row">
            <td>
              <para1 class="para1">City:</para1>
            </td>
            <td>
              <para3 class="para3">Hamilton</para3>
            </td>
          </tr>

          <tr class="table_row">
            <td>
              <para1 class="para1">Address:</para1>
            </td>
            <td>
              <para3 class="para3">1280 Main Street West</para3>
            </td>
          </tr>

          <tr class="table_row">
            <td>
              <para1 class="para1">It is at:</para1>
            </td>
            <td>
              <para3 id="location_latitude" class="para3">47.7731 </para3>
              <para3 id="location_longitude" class="para3">-80.335 </para3>

            </td>
          </tr>

          <col width="20%">
          <col width="80%">
          <tr class="table_row">

            <td>
              <para1 class="para1">Description:</para1>
            </td>
            <td>
              <para3 class="para3">It's an awesome place. There's lots of gothic archietecture! It really allows one to express themselves.</para3><br>
            </td>
          </tr>
        </table>

        <p><h2>Comments From other Users:</h2></p>
        <?php
        $_SESSION['loggedIn'] = true;
        if ($_SESSION['loggedIn'] == true) {?>

        <form id="add_comment_rating" class="modal-content" name="add_comment_rating" method="post" aciton="php/add_comment_rating.php" >

            <input class="textbox" type="text" name= "comment" placeholder="Add comments"  >
            <br>
            <p class = "post_rating"> Rating:
            <input list="ratings_list" class="rating_dropdown" name="rating" id="rating">
             <datalist id="ratings_list">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </datalist> </p>
            <br>
            <input type="submit" name="submit" class="btnSubmit" value="Submit" onclick="return validate(add_comment_rating);" >

        </form>


      <?php } else {?>

        <p>Please <a href = "login.php">Login</a> to post comments.</p>

      <?php } ?>

          <div id="msg"></div>

          <table id="listofcomments" style="width:100%">

          <tr class="table_row">

            <td class="td2">
              <para1 class="para1"> Username </para1>
            </td>
            <td class="td2">
              <para1 class="para1"> Comment Left by User </para1><br>
            </td>
            <td class="td2">
              <para1 class="para1"> Rating </para1><br>
            </td>
          </tr>


          <?php
          //Get Current object id
          $object_id = 1;

          $stmt = $dbh->prepare("SELECT siteDB.comments_and_ratings.comment, siteDB.comments_and_ratings.rating, siteDB.users.username
          FROM siteDB.comments_and_ratings, siteDB.users
          WHERE siteDB.users.id = siteDB.comments_and_ratings.owner_id");
          $return = $stmt -> execute();

          if ($return) {
            while ($row = $stmt->fetch()) {

            ?>
            <tr class="table_row">
              <td class="td2">
                <para1 class="para3">
                <?php  echo $row['username'] ?>
                </para1>
              </td>
              <td class="td2">
                <para3 class="para3">
                <?php echo $row['comment'] ?>
                </para3><br>
              </td>

              <td class="td2">
                <para3 class="para3">
                <?php echo $row['rating'] ?>
                </para3><br>
              </td>
            </tr>

            <?php
            }
          }

          ?>



        </table>

      </div>
                    <div class="map_frame2" id="mapid"></div>
    </div>
  </div>
  <script>

  // Declare Map. The lattitude and longitude are taken from the location placeholders.
  // In the final submission they may be taken from the server.
  var mymap = L.map('mapid').setView([document.getElementById("location_latitude").innerHTML , document.getElementById("location_longitude").innerHTML ], 15);

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



  </script>
  <?php include 'php/footer.php'; ?>
