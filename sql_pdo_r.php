<?php
$hostname = 'localhost';
$username = '';
$password = '';
try {
    $dbh = new PDO("mysql:host=$hostname;dbname=", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>
