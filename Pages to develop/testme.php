<?php
$dbhost = $_SERVER['sfwreng4ww3'];
$dbport = $_SERVER['3306'];
$dbname = $_SERVER['siteDB'];
$charset = 'utf8' ;

$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
$username = $_SERVER['mysqluser'];
$password = $_SERVER[''];

$pdo = new PDO($dsn, $username, $password);


try{
    $dbh = new pdo( $dsn,
                    $username,
                    $password,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    die(json_encode(array('outcome' => true)));
}

catch(PDOException $ex){
    die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
}

?>
