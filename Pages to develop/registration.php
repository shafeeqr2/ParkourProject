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

  <?php include 'php/menu.inc'; ?>

  <div class="modal">
   <?php
   if (($_SESSION['username']) == null) {
    ?>
    <form class="modal-content"  style="background-color:rgba(215, 233, 248, 0.7)" name="form_registration" id = "add_users" method="post" action="php/add_user.php">
      <div class="container">
        <h1>
          Hi, this is a registration page.
        </h1>
        <p>Please fill out your details in the form below </p>
        <input class="textbox" type="text" name= "username" placeholder="Username"  >
        <br>
        <input class="textbox" type="text" name= "firstname" placeholder="First Name"  >
        <br>
        <input class="textbox" type="text" name="lastname" placeholder="Last Name" >
        <br>
        <input class="textbox" type="email" name="email" placeholder="Email Address" >
        <br>
        <input class="textbox" type="password" name="password" placeholder="Choose Password" >
        <br>
        <input class="textbox" type="password" name="password_confirm" placeholder="Confirm Password" >
        <br>
        <input class="checkbox" type="checkbox" name="checkbox"> I agree with the <a href="URL_TO_TERMS_AND_CONDITIONS" style="color:0a14ff"> Terms of Service</a>. </input>
        <br>
        <br>
        <input class="btnSubmit" type="submit" onclick="return validate(form_registration);" value="Let's Parkour!" ></input>
        <br>
        <p>Already an existing user? <a href="login.php"> Sign In </a>
        <br>
      </div>
    </form>

<?php } else {?>
  <h1>
    You are already logged in.
  </h1>
<?php }?>

  </div>

  <img class="parkour_guy"src="image/guy1.png" alt="Parkour guy"/>
  <?php include 'php/footer.php'; ?>
