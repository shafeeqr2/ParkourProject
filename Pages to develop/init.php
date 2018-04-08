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
  reg_date TIMESTAMP NOT NULL,
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
$stmt = $dbh->prepare('INSERT INTO siteDB.users (username, firstname, lastname, email, password, reg_date) VALUES (?, ?, ?, ?, ?, ?)');


$stmt->bindParam(1, $username);
$stmt->bindParam(2, $firstname);
$stmt->bindParam(3, $lastname);
$stmt->bindParam(4, $email);
$stmt->bindParam(5, $password);
$stmt->bindParam(6, $time);

$username ='testuser1';
$firstname = 'john';
$lastname = 'smith';
$email = 'test@gmail.com';
$password = password_hash('Abc123!!', PASSWORD_BCRYPT);
$time = strtotime(time,now);
$return = $stmt->execute();


$stmt = $dbh->prepare("INSERT INTO siteDB.objects (name, city, address, postal_code, description, longitude, latitude, rating, owner_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bindParam(1, $name);
$stmt->bindParam(2, $city);
$stmt->bindParam(3, $street);
$stmt->bindParam(4, $postal_code);
$stmt->bindParam(5, $description);
$stmt->bindParam(6, $longitude);
$stmt->bindParam(7, $latitude);
$stmt->bindParam(8, $rating);
$stmt->bindParam(9,$owner_id);

$name = 'McMaster University';
$city = 'Hamilton';
$street = '1280 Main Street West';
$postal_code = 'L8S 1B3';
$description = 'Wonderful place!';
$longitude = 43.2575;
$latitude = -79.9168;
$rating = 5;
$owner_id = 1;

$return = $stmt->execute();


$stmt = $dbh->prepare('SELECT * FROM siteDB.users');
$return = $stmt -> execute();

while($row = mysql_fetch_array($return)) {
echo $row['username'].'<br>';
echo $row['firstname']. '<br>';
echo $row['lastname']. '<br>';
echo $row['email']. '<br>';

}

echo $return;



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
