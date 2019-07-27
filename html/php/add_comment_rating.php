<?php

$include('header.php');

$stmt = $dbh->prepare("SELECT * FROM siteDB.objects o WHERE o.location = ? AND
o.lat < cast(INT, ?) + 0.5 AND
o.lat > cast(INT, ?) - 0.5 AND
o.long < cast(INT, ?) + 0.5 AND
o.long > cast(INT, ?) - 0.5 AND
o.rating > cat (INT, ?)");

$location = $_GET['text_search'];
$latitude = $_GET['gps_lt'];
$longitude = $_GET['gps_lg'];
$rating = $GET['min_rating'];

$stmt -> bindParam(1, $location);
$stmt -> bindParam(2, $latitude);
$stmt -> bindParam(3, $latitude);
$stmt -> bindParam(4, $longitude);
$stmt -> bindParam(5, $longitude);
$stmt -> bindParam(6, $rating);

$return = $stmt->execute();

?>
