<?php
include("../connection.php");

if ($_POST) {
    $id = $_POST['id00']; 
    $rname = $_POST['rname'];
    $discription = $_POST['discription'];
    $price = $_POST['price'];

    $result = $database->query("SELECT * FROM report WHERE reportid='$id'");
    
    if ($result->num_rows == 1) {
        
        $sql = "UPDATE report SET rname='$rname', discription='$discription', price='$price' WHERE reportid='$id'";
        if ($database->query($sql)) {
            $error = '4'; 
        } else {
            $error = '1';
        }
    } else {
        $error = '3';
    }
} else {
    $error = '3'; 
}

header("location: report.php?action=edit&error=" . $error . "&id=" . $id);
exit();
?>
