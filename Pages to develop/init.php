<?php
include('header.php');


try {
  //Drop all prexisting TABLES
  $sql_drop_users = "drop table if exists siteDB.users cascade";
  $sql_drop_objects = "drop table if exists siteDB.objects cascade";

  //We have to drop the ojbects table before the users table because there exists the foreign key of the users lies in the objects table.
  $dbh ->  exec($sql_drop_objects);
  $dbh ->  exec($sql_drop_users);



  //Create SQL statements to create tables.
  //Users Table
  $sql_users = "CREATE TABLE users (
  id INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(30) NOT NULL,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL,
  password TEXT NOT NULL,
  reg_date TIMESTAMP,
  primary key(id),
  unique (email)
  )";

  //Objects Table
  $sql_objects = "CREATE TABLE objects (
  name VARCHAR(50) NOT NULL,
  city VARCHAR(50) NOT NULL,
  address VARCHAR(50) NOT NULL,
  postal_code VARCHAR(50) NOT NULL,
  description VARCHAR(50) NOT NULL,
  latitude DECIMAL(10, 8) NOT NULL,
  longitude DECIMAL(11, 8) NOT NULL,
  object_id INT(9) UNSIGNED NOT NULL,
  owner_id INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
  primary key(object_id),
  foreign key(owner_id) references users(id)
  )";

  $dbh -> exec($sql_users);

  $dbh -> exec($sql_objects);

  echo "success in creating tables.<br>";

//add data to TABLES
$stmt = $dbh->prepare("INSERT INTO users (username, firstname, lastname, email, password) VALUES (?, ?, ?, ?, ?)");
$dbh->bindParam(1, 'testuser1');
$password = password_hash('Abc123!!', PASSWORD_BCRYPT);
$dbh->bindParam(2, 'john');
$dbh->bindParam(3, 'smith');
$dbh->bindParam(4, 'test@gmail.com');
$dbh->bindParam(5, $password);
$return = $dbh->execute();


$stmt = $dbh->prepare("INSERT INTO objects (name, city, address, postal_code, description, rating, longitude, latitude, ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
$stmt->bindParam(1, 'McMaster University');
$stmt->bindParam(2, 'Hamilton');
$stmt->bindParam(3, '1280 Main Street West');
$stmt->bindParam(4, 'L8S 1B3');
$stmt->bindParam(5, 'Wonderful place!');
$stmt->bindParam(6, 5);
$longitude = 43.2575;
$latitude = -79.9168;
$stmt->bindParam(7, $longitude);
$stmt->bindParam(8, $latitude);
$owner = 1;
$stmt->bindParam(9,$owner);
$return = $stmt->execute();


} catch(PDOException $ex){
    die(json_encode(array('outcome' => false, 'message' => $ex->getMessage())));
}

echo "<br>";
echo $dbname;
echo "<br>";

$sql_list = "SHOW TABLES FROM $dbname";

$stmt = $dbh -> prepare($sql_list);
$result = $stmt ->  execute();

if (!$result) {
    echo mysql_error();
} else {

  echo $result;
}

$tables = $result->fetch_assoc();
foreach($tables as $tablename)
{
    echo "$tablename <br>";
}

while ($row = mysql_fetch_row($result)) {
    echo "Table: {$row[0]}\n";
}

$result = null;

?>
