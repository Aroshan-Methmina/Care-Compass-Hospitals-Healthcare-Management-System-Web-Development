<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/home.css">

        
    <title>Care-Compass-Hospitals</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table,.anime{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    
    
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
    <!-- header section ended -->

    <!-- Home section started -->

    <div class="main-home">

            <div class="home">
                <div class="home-left-content">
                    <span>Welcome To Care Compass Hospitals</span>
                    <h2>We take care our<br> Patients Healths</h2>
                    <p class="lorem">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Possimus numquam veniam porro eius, fugiat vero ut ipsum libero</p>
                
                        <div class="home-btn">
                            <a href="about.php">Read More</a>
                            <a class="homebtnsec" href="schedule.php">Appointment</a>
                        </div>
                        
                    </div>

                <div class="home-right-content">
                    
                </div>
            </div>
            </div>




        <div class="technology">
            <div class="main-technology">
                    
                    <div class="inner-technology">
                        <span></span>
                        <a href="hospitals.php">
                        <center><img src="../img/hospital.svg" style="width: 100px; height: auto;"></i></center>
                        <center><h2 style="color: black;">Find Hospital</h2></center>
                        <p style="color: black;">Care Compass Hospitals provide comprehensive healthcare services with fully-equipped facilities, ensuring a range of medical needs are met under one roof. </p></a>
                        </div>

                    <div class="inner-technology" >
                        <span></span>
                        <a href="doctors.php">
                        <center><img src="../img/doctor.svg" style="width: 100px; height: auto;"></i></center>
                        <center><h2  style="color: black;">Find Doctor</h2></center>
                        <p style="color: black;"> You can search for specialists by expertise, location, and availability, ensuring you connect with qualified professionals quickly and easily.</p></a>
                </div>

                    <div class="inner-technology">
                        <span></span>
                        <a href="report.php">
                        <center><img src="../img/lab.svg" style="width: 100px; height: auto;"></i></center>
                        <center><h2 style="color: black;">Book Health Check-up</h2></center>
                        <p style="color: black;"> You can easily schedule an appointment for comprehensive health screenings tailored to your needs, ensuring timely and thorough evaluations of your health.</p></a>
                    </div>
                </div>
        </div>

    <!-- home section ends -->

    <!-- About us section started -->

        <div class="main-about">

            <div class="about-heading">About Us</div>

            <div class="inner-main-about">
                <div class="about-inner-content-left">
                    <img src="../img/a2.jpg" alt="">
                </div>

                <div class="about-inner-content">
                    <div class="about-right-content">
                    <h2>Setting Standards in Research <br> and Clinical Care.</h2>
                        <p>At Care Compass Hospitals, we are committed to setting the highest standards in both research and clinical care. Our comprehensive medical services ensure that everyone has the opportunity to receive high-quality healthcare tailored to their needs.</p>
                        
                            <a href="about.php"><button class="aboutbtn">Read More</button></a>
                    </div>
                </div>
            </div>
        </div>

    <!-- About us section ends -->

     <!-- our services -->

     <div class="our-service">
            <div class="service-heading">
                    <h2>Our Services</h2>
                </div>

                <div class="main-services">
            <div class="inner-services">
                <a href="services.php#specialist-consultation">
                <div class="service-icon">
                <center><img src="../img/s11.svg" style="width: 80px; height: auto; margin-Top:9px; margin-left:6px;"></i></center>
                </div>
                <h3 style="color:black;">Specialist Consultation</h3>
                <p style="color:black;">Care Compass Hospitals provides access to top medical specialists at affordable rates, covering major and sub-specialties with over 350 experienced consultants.
                    We enhance access to quality healthcare, especially in underserved areas.</p>
                </a>
            </div>

            <div class="inner-services" >
                <a href="services.php#Laboratory-Service">
                <div class="service-icon">
                <center><img src="../img/s21.svg" style="width: 75px; height: auto; margin-Top:11px; margin-left:11px;" ></i>
                </div>
                <h3 style="color:black;">Laboratory Service </h3>
                <p style="color:black;">Care Compass Hospitals offers reliable and accurate lab services with fully automated technology and expert professionals. Our SLAB-accredited labs ensure high-quality diagnostics with global standards.</p>
                </a>
            </div>
            

            <div class="inner-services">
            <a href="services.php">
                <div class="service-icon">
                <center><img src="../img/s31.svg" style="width: 75px; height: auto; margin-Top:9px; margin-left:2px;"></i>
                </div>
                <h3 style="color:black;">Health Check-ups</h3>
                <p style="color:black;">Care Compass Hospitals provides a range of health screening and routine check-up services across our branch network. We offer specialized packages at affordable rates, Heart Health, and Senior Citizens programs, tailored to meet the unique health needs of all patients.</p>
                </a>
            </div>

            <div class="inner-services">
            <a href="services.php">
                <div class="service-icon">
                <center><img src="../img/s41.svg" style="width: 75px; height: auto; margin-Top:9px; margin-left:3px;"></i></center>
                </div>
                <h3 style="color:black;">Ambulance Service & Home Care</h3>
                <p style="color:black;">We provide 24-hour emergency care with qualified doctors and experienced caregivers. Our services include ambulance pick-up for international patients and medical care for those traveling abroad, accompanied by a doctor and nurse. We prioritize quality healthcare at affordable rates, making it accessible to all.</p>
                </a>
            </div>

            <div class="inner-services">
            <a href="services.php">
                <div class="service-icon">
                <center><img src="../img/s51.svg" style="width: 70px; height: auto; margin-Top:9px; margin-left:1px;"></i></center>
                </div>
                <h3 style="color:black;">Operation Theatre</h3>
                <p style="color:black;">Our specialized packages deliver great value, and we are registered with major insurance companies to assist with reimbursement for healthcare and surgical expenses.</p>
                </a>
            </div>

            <div class="inner-services">
            <a href="services.php">
                <div class="service-icon">
                <center><img src="../img/s61.svg" style="width: 70px; height: auto; margin-Top:11px; margin-left:3px;"></i></center>
                </div>
                <h3 style="color:black;">Inpatient Care</h3>
                <p style="color:black;">Patients are treated under the supervision of specialist consultants and receive 24/7 care from our qualified medical staff. We are registered with major insurance companies and support corporate medical schemes for reimbursement of inpatient expenses.</p>
                </a>
            </div>
        </div>
    </div>
    <!-- our services ended -->

    


    <?php
    include("footer.php");
    ?>



</body>
</html>