<?php include 'controller.php';session_start();
if (isset($_SESSION['login']) && ($_SESSION['edit'] == '1')) {
    require 'sql_pdo_rw.php';
    $name = filter_input(INPUT_POST, 'name');
    $type = filter_input(INPUT_POST, 'type');
    $stmt = $dbh->prepare('SELECT name FROM member WHERE name= :name');
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$row) {
        if ($type == "Soprano" || $type == "Mezzo-soprano" || $type == "Contralo") { $gender = female; } else { $gender = Male; }
        $sql = "INSERT INTO member
                SET name= :name, type= :type, gender= :gender ";
        $stmt1 = $dbh->prepare($sql);
        $stmt1->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt1->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt1->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt1->execute();
        echo "<script language='Javascript'>document.location.href='createsinger.php' ;</script>";
        echo "succes";
    } else { echo "email already exists"; }
}
?>
