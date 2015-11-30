<?php
session_start();
require 'sql_pdo_rw.php';
$user_name = $_SESSION['uname'];
$chatmessage = filter_input(INPUT_POST, 'chatmessage');
$time = time();
$sql = "INSERT INTO chat
        SET name=?, message=?, time=? ";
$q = $dbh->prepare($sql);
$q->execute(array($user_name,$chatmessage,$time));
echo "<script language='Javascript'>document.location.href='index.php' ;</script>";
echo "succes";
