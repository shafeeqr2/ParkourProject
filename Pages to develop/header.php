<?php
//Create session or reuse if it already exists.
session_start();

//Declare the Database instance, the Database name, the port number and the character set.
$dbhost = 'sfwreng4ww3.cqiijjv893t5.us-east-2.rds.amazonaws.com';
$dbport = '3306';
$dbname = 'siteDB';
$charset = 'utf8' ;

//Construct the connection message.
$connection = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";

//The following are the mysql server credentials.
$username = 'mysqluser';
$password = 'Abc123!!';

//Try to connect.
//try{

    //Declare PDO object.
    $dbh = new pdo( $connection,
                    $username,
                    $password,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  //  die(json_encode(array('outcome' => true)));
  echo 'connection successful<br>';
//}
//Catch exception and output to screen the message that the conneciton failed.
//catch(PDOException $ex){
//    die(json_encode(array('outcome' => false, 'message' => 'Unable to connect to database')));
//}

?>
