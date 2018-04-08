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
  id INT(9) UNSIGNED AUTO_INCREMENT,
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
  owner_id INT(9) UNSIGNED NOT NULL,
  primary key(object_id),
  foreign key(owner_id) references users(id)
  )";

  $dbh -> exec($sql_users);

  $dbh -> exec($sql_objects);

  echo "success in creating tables.<br>";

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
    die();
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
