<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/about.css">

    <title>about</title>
   
        
</head>
<body>

        <?php

        //learn from w3schools.com

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


        //import database
        include("../connection.php");

        $sqlmain= "select * from patient where pemail=?";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("s",$useremail);
        $stmt->execute();
        $userrow = $stmt->get_result();
        $userfetch=$userrow->fetch_assoc();

        $userid= $userfetch["pid"];
        $username=$userfetch["pname"];


        //echo $userid;
        //echo $username;

        ?>

    
<?php
   include("header.php");
   ?>

    <div class="about" style="background: url('../img/about.Jpg') no-repeat right;">
    <div class="inner-section">
        
    
        <h1>About Us</h1>
        <p class="text">
            Welcome to <strong>Care Compass Hospitals</strong>, one of Sri Lanka's top private healthcare providers committed to delivering exceptional medical care with compassion and quality. Our hospital network, registered with the Ministry of Health (MoH), operates in three prestigious locations: <strong>Kandy, Colombo, and Kurunegala</strong>, ensuring that everyone has access to high-quality healthcare.
        </p>

        <h2>Our Objective</h2>
        <p class="text">
            To provide comprehensive, patient-centered healthcare using state-of-the-art equipment, highly qualified professionals, and a commitment to continuous innovation.
        </p>

        <h2>Our Goal</h2>
        <p class="text">
            To be Sri Lanka’s most trusted and innovative private hospital network, setting new standards for patient safety, medical care, and service quality.
        </p>

        <h2>Why Choose Care Compass Hospitals?</h2>
        <div class="features">
            <ul>
                <li>Cutting-Edge Facilities: Equipped with advanced medical technology.</li>
                <li>Highly Qualified Medical Experts: A team of experienced doctors, specialists, and medical staff.</li>
                <li>Comprehensive Medical Services: Covering emergency care, diagnostics, channeling, and specialized treatments.</li>
                <li>Patient-Centric Approach: Personalized treatment plans with 24/7 medical support.</li>
                <li>Seamless Digital Experience: Easy online appointment booking, medical record access, and payment facilities.</li>
            </ul>
        </div>

        <div class="footer">
            💙 Care Compass Hospitals: Helping You Achieve Better Health!
        </div>
    </div>
            
    </div>   
    <?php
    include("footer.php");
    ?>
</body>
</html>