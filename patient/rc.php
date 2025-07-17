<?php
    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    include("../connection.php");
    $sqlmain= "select * from patient where pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];

    if($_POST){
        if(isset($_POST["booknow2"])){
            if (isset($_POST["reportid"])) {
                $reportid = $_POST["reportid"];
            } else {
                die("Error: Report ID is missing.");
            }
            $date = $_POST["date"];
            $sql2 = "INSERT INTO rappointment (pid, reportid, appodate) VALUES (?, ?, ?)";
            $stmt2 = $database->prepare($sql2);
            $stmt2->bind_param("iis", $userid, $reportid, $date);
            $stmt2->execute();
    
            if ($stmt2->affected_rows > 0) {
                header("location: ra.php?action=booking-added&id=".$reportid."&titleget=none");
            } else {
                echo "Error: Could not insert appointment.";
            }
        }
    }
    

   
    
    
 ?>