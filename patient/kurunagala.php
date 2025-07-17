<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/about.css">

    <title>kurunagala</title>
   
        
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

    <div class="about" style="background: url('../img/kurunagala.jpg.jpg') no-repeat right;">
        
       <div class="inner-section">
            <center><h1>Care Compass Hospitals <br> Kurunegala Branch</h1></center>
            <p class="text">
            Welcome to the Care Compass Hospitals Kurunegala Branch, your trusted partner in healthcare, now open in the vibrant city of Kurunegala. We are excited to provide you with advanced medical expertise and compassionate care in a state-of-the-art facility focused on your health and well-being.

At our Kurunegala branch, we offer comprehensive access to a diverse range of top specialists, all within a welcoming environment designed to ease your concerns and enhance your healthcare experience. Our dedicated pharmacy serves as your one-stop shop for all pharmaceutical, medical consumable, and nutritional requirements. Whether you need expert guidance or everyday health products, we are here to support you at every step.

At Care Compass Hospitals, precision is the foundation of our practice. With the latest technology and rigorous quality control measures, our highly trained professionals deliver reliable results that you can trust. Our international accreditations stand as a testament to our commitment to providing exceptional patient care.

Choose Care Compass Hospitals in Kurunegala for trustworthy accuracy and compassionate support throughout your healthcare journey. Visit us today and take the first step towards achieving better health!</p>

                
        </div>     
       
    </div>
    <?php
    include("footer.php");
    ?>
</body>
</html>