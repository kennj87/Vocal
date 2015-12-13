<?php include 'controller.php';session_start();
if (isset($_SESSION['login']) && ($_SESSION['edit'] == '1')) {
    require 'sql_pdo_rw.php';
    $id = filter_input(INPUT_GET, 'id');
    $stmt = $dbh->prepare('DELETE FROM member WHERE ID = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    echo "<script language='Javascript'>document.location.href='createuser.php' ;</script>";
}
?>
