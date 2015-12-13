<?php
include 'sql_pdo_rw.php';
$target_dir = "/upload/final/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$ext = pathinfo($target_file,PATHINFO_EXTENSION);

$sql= "SELECT * FROM main ORDER BY ID desc LIMIT 1"; 
$stmt = $dbh->prepare($sql);
$stmt->execute();
$obj = $stmt->fetchObject();
$amount = $obj->ID +1;

$sql= "SELECT COUNT(*) AS files FROM sound"; 
$stmt = $dbh->prepare($sql);
$stmt->execute();
$obj = $stmt->fetchObject();

$member = filter_input(INPUT_POST, 'member');
$note = filter_input(INPUT_POST, 'note');
$tone = filter_input(INPUT_POST, 'tone');
$velocity = filter_input(INPUT_POST, 'velocity');        
$connection = filter_input(INPUT_POST, 'connection');  
$key = 0; 

 $sql = "INSERT INTO main
                SET ID= :id, sound= :sound, choir_member= :choir_member, connection_type= :connection_type, tone= :tone, velocity= :velocity, type= :type, note= :note ";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $amount, PDO::PARAM_STR);
        $stmt->bindParam('sound', $key, PDO::PARAM_STR);
        $stmt->bindParam('choir_member', $member, PDO::PARAM_STR);
        $stmt->bindParam('connection_type', $connection, PDO::PARAM_STR);
        $stmt->bindParam('tone', $tone, PDO::PARAM_STR);
        $stmt->bindParam('velocity', $velocity, PDO::PARAM_STR);
        $stmt->bindParam('type', $key, PDO::PARAM_STR);
        $stmt->bindParam(':note', $note, PDO::PARAM_STR);
        $stmt->execute();

 $sql = "INSERT INTO sound
                SET ID= :id, file_name= :name, choir_member= :member ";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $amount, PDO::PARAM_STR);
        $stmt->bindParam(':name', $amount, PDO::PARAM_STR);
        $stmt->bindParam(':member', $member, PDO::PARAM_STR);
        $stmt->execute();

$sql1 = "INSERT INTO single_sound
                SET  
                ID= :id, 
                vocal= :tone, 
                velocity= :velocity, 
                vibratio= :vibratio, 
                type= :type, 
                frequency= :frequency, 
                start_marker1= :start_marker1, 
                start_marker2= :start_marker2, 
                end_marker1= :end_marker1, 
                end_marker2= :end_marker2 ";
        $stmt1 = $dbh->prepare($sql1);
        $stmt1->bindParam(':id', $amount, PDO::PARAM_INT);
        $stmt1->bindParam(':tone', $tone, PDO::PARAM_INT);
        $stmt1->bindParam(':velocity', $velocity, PDO::PARAM_INT);
        $stmt1->bindParam(':vibratio', $key, PDO::PARAM_INT);
        $stmt1->bindParam(':type', $key, PDO::PARAM_INT);
        $stmt1->bindParam(':frequency', $key, PDO::PARAM_INT);
        $stmt1->bindParam(':start_marker1', $key, PDO::PARAM_INT);
        $stmt1->bindParam(':start_marker2', $key, PDO::PARAM_INT);
        $stmt1->bindParam(':end_marker1', $key, PDO::PARAM_INT);
        $stmt1->bindParam(':end_marker2', $key, PDO::PARAM_INT);
        $stmt1->execute();

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
if ($_FILES["file"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $amount . "." . $ext)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
