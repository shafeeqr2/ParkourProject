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
  $sql_users = "CREATE TABLE siteDB.users (
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
  $sql_objects = "CREATE TABLE siteDB.objects (
  name VARCHAR(50) NOT NULL,
  city VARCHAR(50) NOT NULL,
  address VARCHAR(50) NOT NULL,
  postal_code VARCHAR(50) NOT NULL,
  description VARCHAR(50) NOT NULL,
  latitude DECIMAL(10, 8) NOT NULL,
  longitude DECIMAL(11, 8) NOT NULL,
  rating INT NOT NULL,
  object_id INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
  owner_id INT(9) UNSIGNED NOT NULL,
  primary key(object_id),
  foreign key(owner_id) references users(id)
  )";

  $dbh -> exec($sql_users);

  $dbh -> exec($sql_objects);

  echo "success in creating tables.<br>";

//add data to TABLES
$stmt = $dbh->prepare("INSERT INTO users (username, firstname, lastname, email, password, reg_date) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param(1, 'testuser1');
$stmt->bind_param(2, 'john');
$stmt->bind_param(3, 'smith');
$stmt->bind_param(4, 'test@gmail.com');
$password = password_hash('Abc123!!', PASSWORD_BCRYPT);
$stmt->bind_param(5, $password);
$time = strtotime(time,now);
$stmt->bind_param(6, $time);
$return = $stmt->execute();


$stmt = $dbh->prepare("INSERT INTO objects (name, city, address, postal_code, description, longitude, latitude, rating, owner_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param(1, 'McMaster University');
$stmt->bind_param(2, 'Hamilton');
$stmt->bind_param(3, '1280 Main Street West');
$stmt->bind_param(4, 'L8S 1B3');
$stmt->bind_param(5, 'Wonderful place!');
$longitude = 43.2575;
$latitude = -79.9168;
$stmt->bind_param(6, $longitude);
$stmt->bind_param(7, $latitude);
$owner_id = 1;
$stmt->binbind_paramdParam(8, 5);
$stmt->bind_param(9,$owner_id);
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
