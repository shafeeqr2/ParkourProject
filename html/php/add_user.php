<?php

include('header.php');

$stmt = $dbh->prepare('INSERT INTO siteDB.users (username, firstname, lastname, email, password, reg_date) VALUES (?, ?, ?, ?, ?, ?)');
$stmt->bindParam(1, $username);
$stmt->bindParam(2, $firstname);
$stmt->bindParam(3, $lastname);
$stmt->bindParam(4, $email);
$stmt->bindParam(5, $password);
$stmt->bindParam(6, $time);

$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$time = time();
$return = $stmt->execute();

?>
