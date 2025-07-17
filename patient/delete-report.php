<?php

session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION['usertype'] != 'p') {
    header("location: ../login.php");
    exit(); 
}

if (isset($_GET['id'])) {
    include("../connection.php");

    $id = intval($_GET["id"]);

    $sql = "DELETE FROM rappointment WHERE rappoid = ?";
    $stmt = $database->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } else {
        die("Error preparing statement: " . $database->error);
    }

    header("location: ra.php");
    exit(); 
} else {
    
    die("Invalid request.");
}

?>