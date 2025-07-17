<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/about.css">

    <title>Colombo</title>
   
        
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

    <div class="about" style="background: url('../img/colombo .jpg.jpg') no-repeat right;">
        
       <div class="inner-section">
            <center><h1>Care Compass Hospitals <br> Colombo Branch</h1></center>
            <p class="text">
            Welcome to the Care Compass Hospitals Colombo Branch, your trusted partner in healthcare, now open in the heart of Colombo 7. We are excited to bring you cutting-edge medical expertise and compassionate care in a state-of-the-art facility designed to prioritize your health and well-being.

At our Colombo branch, we offer comprehensive access to a wide range of top specialists in a supportive and caring environment, ensuring that your worries are eased and your spirit uplifted. Our in-house pharmacy provides a one-stop shop for all your pharmaceutical, medical consumable, and nutritional needs. From expert advice to essential everyday items, we are here to support you at every step.

At Care Compass Hospitals, precision is not just a promise—it's the foundation of every test we conduct. With advanced technology, stringent quality control standards, and a team of highly trained professionals, we deliver results with unparalleled accuracy and reliability. Our international accreditations reflect our unwavering commitment to excellence in healthcare.

Choose Care Compass Hospitals for accurate diagnoses and compassionate care every step of the way. Visit us today and embark on your journey to a healthier you!</p>

                
        </div>     
       
    </div>
    <?php
    include("footer.php");
    ?>
</body>
</html>