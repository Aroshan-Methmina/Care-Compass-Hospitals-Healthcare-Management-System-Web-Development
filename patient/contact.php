<?php
 
 if($_POST){
    
    include("../connection.php");
    $name=$_POST["name"];
    $email=$_POST["email"];
    $message =$_POST["message"];
    $sql="INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";
    $result= $database->query($sql);
    header("location: index.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
    
        if ($conn->query($sql) === TRUE) {
            echo "Your message has been sent successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
}


?>
