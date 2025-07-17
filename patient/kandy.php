<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/about.css">

    <title>Kandy</title>
   
        
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

    <div class="about" style="background: url('../img/kandy.jpg.jpg') no-repeat right;">
        
       <div class="inner-section">
            <center><h1>Care Compass Hospitals <br> Kandy Branch</h1></center>
            <p class="text">
            Welcome to the Care Compass Hospitals Kandy Branch, your trusted partner in healthcare, now proudly serving the beautiful city of Kandy. We are thrilled to bring you advanced medical expertise and compassionate care within a state-of-the-art facility designed to enhance your health and well-being.

At our Kandy branch, we provide comprehensive access to a variety of top specialists in a nurturing environment, ensuring your comfort and peace of mind. Our well-stocked pharmacy is your go-to destination for all pharmaceutical, medical consumable, and nutritional needs. From professional advice to essential health products, we are dedicated to supporting you at every step of your healthcare journey.

At Care Compass Hospitals, precision is at the core of everything we do. Utilizing cutting-edge technology and stringent quality control standards, our highly trained professionals deliver results that you can trust. Our international accreditations are a testament to our unwavering commitment to excellence in patient care.

Choose Care Compass Hospitals in Kandy for dependable accuracy and compassionate care throughout your healthcare experience. Visit us today and take the first step toward a healthier, happier you!</p>

                
        </div>     
       
    </div>
    <?php
    include("footer.php");
    ?>
</body>
</html>