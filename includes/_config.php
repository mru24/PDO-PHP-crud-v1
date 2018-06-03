<?php

// Enter values

$dbhost = '';
$dbuser = '';
$dbpass = '';
$dbname = '';


try {
  $dbc = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
  $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Setting Error Mode as Exception
} catch(PDOException $e) {
    echo $e->getMessage();
}

?>
