<?php
require 'sql_pdo_rw.php';
$user_name = filter_input(INPUT_POST, 'name');
$user_password = filter_input(INPUT_POST, 'password');
$password_hash = password_hash($user_password, PASSWORD_DEFAULT);
$user_email = filter_input(INPUT_POST, 'email');
$stmt = $dbh->prepare('SELECT email FROM admin WHERE email= :email');
$stmt->bindParam(':email', $user_email, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!isset($_POST['upload'])) { $canupload = 0; } else { $canupload = 1; }
if (!isset($_POST['superuser'])) { $superuser = 0; } else { $superuser = 1; }
if (!isset($_POST['edit'])) { $canadduser = 0; } else { $canadduser = 1; }
$recovery = 0;
if(!$row) {
    $sql = "INSERT INTO admin
            SET name=?, email=?, password=?, canupload=?, canadduser=?, superuser=?, recovery=? ";
    $q = $dbh->prepare($sql);
    $q->execute(array($user_name,$user_email,$password_hash,$canupload,$canadduser,$superuser,$recovery));
    echo "<script language='Javascript'>document.location.href='index.php' ;</script>";
    echo "succes";
} else { echo "email already exists"; }
?>
