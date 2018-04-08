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

  //Use prepare statement to write out SQL querry before execution. Use execute() to execute;
  $stmt = $dbh -> prepare($sql_users);
  $resut = $stmt -> execute();
  echo $result;
  $stmt = $dbh -> prepare($sql_objects);
  $result = $stmt -> execute();
  echo $result;
  echo "success";


} catch(PDOException $ex){
    die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
}

?>
