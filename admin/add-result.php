<?php
require '../connection.php';  

if (!isset($database)) {
    die("Database connection failed: Connection variable is not set.");
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $name1 = $_POST["name1"];
    if ($_FILES["image"]["error"] == 4) {
        echo "<script>alert('Image Does Not Exist');</script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Invalid Image Extension');</script>";
        } elseif ($fileSize > 1000000) {
            echo "<script>alert('Image Size Is Too Large');</script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            $imageFolder = 'img/';

            if (!is_dir($imageFolder)) {
                mkdir($imageFolder, 0777, true);
            }

            if (move_uploaded_file($tmpName, $imageFolder . $newImageName)) {
                $query = "INSERT INTO result ( pid, reportid, image) VALUES ('$name','$name1', '$newImageName')";
                
                if (mysqli_query($database, $query)) {
                    header("location: schedule.php?action=session-added&title=$title");
                } else {
                    echo "<script>alert('Database Error: " . mysqli_error($database) . "');</script>";
                }
            } else {
                echo "<script>alert('Failed to move the uploaded file');</script>";
            }
        }
    }
}
?>