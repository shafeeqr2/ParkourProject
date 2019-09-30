<?php include 'php/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width"  initial-scale=1 />
  <title> Registration Page </title>
  <link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="css/register_portrait.css">
  <link rel="stylesheet" type="text/css" media="screen and (min-width: 481px)" href="css/register_desktop.css">
  <link rel="icon" href="image/icon.jpg">

  <script src="js/registration.js"> </script>

</head>
<body>
  <img class="parkour_guy"src="image/guy1.png" alt="Parkour guy"/>

  <?php include 'php/menu.inc'; ?>

  <div class="modal">

    <form class="modal-content"  style="background-color:rgba(215, 233, 248, 0.7)" name="form_login">
      <div class="container">
        <h1>
          Login
        </h1>
        <p>Enter your credentials below: </p>
        <input class="textbox" type="text" name= "username" placeholder="Username"  >
        <br>
        <input class="textbox" type="password" name="password" placeholder="Enter Password" >
        <br>
        <br>
        <button class="btnSubmit" type="button" onclick="return validate(form_registration);" ><span> Sign Me In! </span></button>
        <br>
        <p>New User? <a href="registration.php"> Register </a>
      </div>
    </form>
  </div>
  <?php include 'footer.php'; ?>
