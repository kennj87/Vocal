<?php
    session_start();
    session_destroy();
    echo "<script language='Javascript'>document.location.href='index.php' ;</script>";
?>
