<?php
session_start();
require 'sql_pdo_r.php';
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$sql= "SELECT password,name,canupload,canadduser,superuser FROM admin WHERE email = :email"; 
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR); 
$stmt->execute();
$obj = $stmt->fetchObject();
$pass = $obj->password;
$user = $obj->name;
$canadduser = $obj->canadduser;
$canupload = $obj->canupload;
$superuser = $obj->superuser;
if (password_verify($password,$pass)) {
    $_SESSION["login"] = "granted";
    $_SESSION["uname"] = $user;
    if ($canadduser == 1) { $_SESSION["edit"] = 1; }
    if ($canupload == 1) { $_SESSION["upload"] = 1; }
    if ($superuser == 1) { $_SESSION["superuser"] = 1; }
    echo "Successfull login";
    echo "<script language='Javascript'>document.location.href='index.php' ;</script>";
} else { echo "wrong email/pass"; }
?>
