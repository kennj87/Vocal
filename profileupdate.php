<!DOCTYPE html>
<?php include 'sql_pdo_rw.php';include 'controller.php';session_start();
if (isset($_SESSION['login'])) {
    $name = $_SESSION['uname'];
    if ($_POST['email'] != null) {
        $email = filter_input(INPUT_POST, 'email');
        $sql = "UPDATE admin SET email = :email WHERE name='$name'";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        echo "Email updated <br>";
        echo "<script language='Javascript'>document.location.href='profile.php' ;</script>";
    }
    if ($_POST['oldpassword'] != null && $_POST['password'] != null) {
        $oldpass = filter_input(INPUT_POST, 'oldpassword');
        $password = filter_input(INPUT_POST, 'password');
        $newpass =filter_input(INPUT_POST, 'repassword');
        if ($password == $newpass) {
            $sql= "SELECT password FROM admin WHERE name = :name"; 
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR); 
            $stmt->execute();
            $obj = $stmt->fetchObject();
            $pass = $obj->password;
            if (password_verify($oldpass,$pass)){
                $password_hash = password_hash($newpass, PASSWORD_DEFAULT);
                $email = filter_input(INPUT_POST, 'email');
                $sql = "UPDATE admin SET password = :password WHERE name='$name'";
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(':password', $password_hash, PDO::PARAM_STR);
                $stmt->execute();
                echo "password updated";
                echo "<script language='Javascript'>document.location.href='profile.php' ;</script>";
            } else { echo "wrong old password"; }  
        } else { echo "password didnt match"; }
    }
}
else { header("Location: index.php"); }
