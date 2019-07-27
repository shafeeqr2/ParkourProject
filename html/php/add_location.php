<?php

include('header.php');
$_SESSION['loginId'] = 1;
$stmt = $dbh->prepare("INSERT INTO siteDB.objects (name, city, address, postal_code, description, longitude, latitude, owner_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bindParam(1, $name);
$stmt->bindParam(2, $city);
$stmt->bindParam(3, $street);
$stmt->bindParam(4, $postal_code);
$stmt->bindParam(5, $description);
$stmt->bindParam(6, $longitude);
$stmt->bindParam(7, $latitude);
$stmt->bindParam(8, $owner_id);

$name = $_POST['name'];
$city = $_POST['city'];
$street = $_POST['address'];
$postal_code = $_POST['postal_code'];
$description = $_POST['description'];
$longitude = $_POST['location_longitude'];
$latitude = $_POST['location_latitude'];
$owner_id = $_SESSION['loginId'];
$return = $stmt->execute();

?>
