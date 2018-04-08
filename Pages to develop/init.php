<?php
include('header.php');



try {

  //Create SQL statements to create tables.
  //Users Table
  $sql_users = "CREATE TABLE users (
  id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
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
  lat DECIMAL(10, 8) NOT NULL,
  long DECIMAL(11, 8) NOT NULL,
  object_id INT(9) UNSIGNED,
  owner_id INT(9) UNSIGNED,
  primary key(object_id),
  foreign key(owner_id) references users(id)
  )";

  $dbh -> exec($sql_users);

  $dbh -> exec($sql_objects);

  echo "success in creating tables.\n";


} catch(PDOException $ex){
    die(json_encode(array('outcome' => false, 'message' => $e->getMessage())));
}

$sql_list = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {
    echo "Table: {$row[0]}\n";
}

mysql_free_result($result);

?>
