<?php
include('header.php');


try {
  //Drop all prexisting TABLES
  $sql_drop_users = "drop table if exists siteDB.users cascade";
  $sql_drop_objects = "drop table if exists siteDB.objects cascade";
  $sql_drop_ratings = "drop table if exists siteDB.ratings cascade";
  $sql_drop_comments = "drop table if exists siteDB.comments_and_ratings cascade";

  //We have to drop the ojbects table before the users table because there exists the foreign key of the users lies in the objects table.
  $dbh ->  exec($sql_drop_comments);
  $dbh ->  exec($sql_drop_ratings);
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
  longitude DECIMAL(11, 8) NOT NULL,
  latitude DECIMAL(10, 8) NOT NULL,
  ratings_count INT DEFAULT 0,
  object_id INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
  owner_id INT(9) UNSIGNED NOT NULL,
  primary key(object_id),
  foreign key(owner_id) references users(id)
  )";

  $sql_ratings = "CREATE TABLE siteDB.ratings (
    object_id INT(9) UNSIGNED NOT NULL,
    owner_id INT(9)  UNSIGNED NOT NULL,
    rating int not null,
    foreign key(object_id) references objects(object_id),
    foreign key(owner_id) references users(id)
  )";


  $sql_comments = "CREATE TABLE siteDB.comments_and_ratings (
    object_id INT(9) UNSIGNED NOT NULL,
    owner_id INT(9)  UNSIGNED NOT NULL,
    comment text not null,
    rating int not null,
    foreign key(object_id) references objects(object_id),
    foreign key(owner_id) references users(id)
  )";

  $dbh -> exec($sql_users);
  $dbh -> exec($sql_objects);
  $dbh -> exec($sql_ratings);
  $dbh -> exec($sql_comments);

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

$username ='testuser2';
$firstname = 'john';
$lastname = 'smith';
$email = 'test2@gmail.com';
$password = password_hash('Abc123!!', PASSWORD_BCRYPT);
$time = strtotime(time,now);
$return = $stmt->execute();


$stmt = $dbh->prepare("INSERT INTO siteDB.objects (name, city, address, postal_code, description, longitude, latitude, owner_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bindParam(1, $name);
$stmt->bindParam(2, $city);
$stmt->bindParam(3, $street);
$stmt->bindParam(4, $postal_code);
$stmt->bindParam(5, $description);
$stmt->bindParam(6, $longitude);
$stmt->bindParam(7, $latitude);
$stmt->bindParam(8, $owner_id);

$name = 'McMaster University';
$city = 'Hamilton';
$street = '1280 Main Street West';
$postal_code = 'L8S 1B3';
$description = 'Wonderful place!';
$latitude = 43.2575;
$longitude= -79.9168;
$ratings_count = 15;
$owner_id = 1;
$return = $stmt->execute();


$name = 'York University';
$city = 'Toronto';
$street = '123 Street';
$postal_code = 'L8S 1B7';
$description = 'Lots to learn from here.';
$latitude = 43.2575;
$longitude = -79.9168;
$ratings_count = 0;
$owner_id = 2;
$return = $stmt->execute();

$name = 'Kowloon City';
$city = 'Tokyo';
$street = '456 Address Street';
$postal_code = 'L79 2B7';
$description = 'Quite a densely populated area.';
$latitude = 40.2575;
$longitude = -71.9168;
$ratings_count = 4;
$owner_id = 2;
$return = $stmt->execute();


$stmt = $dbh->prepare("INSERT INTO siteDB.ratings (object_id, owner_id, rating) VALUES (?, ?, ?)");
$stmt->bindParam(1, $object_id);
$stmt->bindParam(2, $owner_id);
$stmt->bindParam(3, $rating);


$object_id = 1;
$owner_id = 1;
$rating = 4;
$return = $stmt->execute();

$stmt = $dbh->prepare("INSERT INTO siteDB.comments_and_ratings (object_id, owner_id, comment, rating) VALUES (?, ?, ?, ?)");
$stmt->bindParam(1, $object_id);
$stmt->bindParam(2, $owner_id);
$stmt->bindParam(3, $comment);
$stmt->bindParam(4, $rating);

$object_id = 1;
$owner_id = 1;
$comment = "awesome place! awesome rating 1";
$rating = 4;
$return = $stmt->execute();

//------------------------------------------------------
$stmt = $dbh->prepare('SELECT * FROM siteDB.users');
$return = $stmt -> execute();


if ($return) {
  while ($row = $stmt->fetch()) {
    print_r($row);
  }
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
