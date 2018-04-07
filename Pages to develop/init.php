<?php

//We start off by declaring variables that will be used in our connection.
//servername is localhost as the mysql server is on the same machine as the site.
$servername = 'localhost';

//The following are the mysql server credentials.
$username = 'mysqluser';
$password = 'Abc123!!';

//Name of the mysql server
$dbname = 'siteDB';

//Create PDO
//$conn = new msqli($servername, $username,$password, $dbname);

$credentials = 'mysql:host=';
$credentials = . $servername;
$credentials = . ';dbname=';
$credentials = . $dbname;

print $credentials;

try {
  $dbhandler = new PDO($credentials, $username, $password);
  $statement = $dbhandler->prepare('SELECT * FROM  users');
  //Wait for connection to come through
  sleep(5);

  $statement -> execute();

  foreach ($statement as $row) {
    echo $row[name];
  }


} catch (PDOException $e) {
  print "Error";

}

?>
