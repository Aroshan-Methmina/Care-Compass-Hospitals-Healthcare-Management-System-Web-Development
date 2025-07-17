<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Dashboard</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    
    
</head>
<body>
        <?php

        session_start();

        if(isset($_SESSION["user"])){
            if(($_SESSION["user"])=="" or $_SESSION['usertype']!='s'){
                header("location: ../login.php");
            }else{
                $useremail=$_SESSION["user"];
            }

        }else{
            header("location: ../login.php");
        }



        
         include("../connection.php");

         $sqlmain= "select * from staff where staemail=?";
         $stmt = $database->prepare($sqlmain);
         $stmt->bind_param("s",$useremail);
         $stmt->execute();
         $userrow = $stmt->get_result();
         $userfetch=$userrow->fetch_assoc();
 
         $userid= $userfetch["staid"];
         $username=$userfetch["staname"];
     

        ?>
        <?php
    include("header.php");
    ?>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="2" class="nav-bar" >
                                
                                <form action="doctors.php" method="post" class="header-search">
        
                                    <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email" list="doctors">&nbsp;&nbsp;
                                    
                                    <?php
                                        echo '<datalist id="doctors">';
                                        $list11 = $database->query("select  docname,docemail from  doctor;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $d=$row00["docname"];
                                            $c=$row00["docemail"];
                                            echo "<option value='$d'><br/>";
                                            echo "<option value='$c'><br/>";
                                        };
        
                                    echo ' </datalist>';
                                    ?>
                                    
                               
                                    <input type="Submit" value="Search" class="login-btn btn-primary-soft btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                
                                </form>
                                
                            </td>
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(4, 4, 4);padding: 0;margin: 0;text-align: right;">
                                    Today's Date
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Asia/Colombo');
        
                                $today = date('Y-m-d');
                                echo $today;


                                $patientrow = $database->query("select  * from  patient;");
                                $reporttrow = $database->query("select  * from  rappointment;");
                                $doctorrow = $database->query("select  * from  doctor;");
                                $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
                                $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");


                                ?>
                                </p>
                            </td>
                            <td width="5%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar1.svg" width="100%"></button>
                            </td>
        
        
                        </tr>
                <tr>
                    <td colspan="8">
                        
                        <center>
                        <table class="filter-container" style="border: none;" border="0">
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 25px;font-weight:600;padding-left: 12px;">Status</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style=" padding:20px;margin:auto;width:70%;display: flex; background-color: #1980E1;border: 2px solid black; ">
                                        <div>
                                                <div class="h3-dashboard" style=" margin-left: 50%;color:white;">
                                                    Doctors &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                                <div class="h1-dashboard" style=" margin-left: 70%; color:white;">
                                                    <?php    echo $doctorrow->num_rows  ?>
                                                </div><br>
                                                
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/doctor.svg');background-color: white;background-size: 60%; padding-left: 25%; margin-left:30%"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style=" padding:20px;margin:auto;width:70%;display: flex; background-color: #1980E1; margin-left: 10%; border: 2px solid black;">
                                        <div>
                                                <div class="h3-dashboard" style=" margin-left: 50%;color:white;">
                                                    Patients &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                                <div class="h1-dashboard" style=" margin-left: 70%; color:white;">
                                                    <?php    echo $patientrow->num_rows  ?>
                                                </div><br>
                                                
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/patient.svg');background-color: white;background-size: 60%; padding-left: 25%; margin-left:30%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:70%;display: flex; margin-Top: 10%; background-color: #1980E1;border: 2px solid black; ">
                                        <div>
                                                <div class="h3-dashboard" style=" margin-left: 50%;color:white;">
                                                    New Booking &nbsp;&nbsp;
                                                </div>
                                                <div class="h1-dashboard" style=" margin-left: 70%; color:white;">
                                                    <?php    echo $appointmentrow ->num_rows  ?>
                                                </div><br>
                                                
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/booking.svg');background-color: white;background-size: 60%; padding-left: 25%; margin-left:25%"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:70%;display: flex; margin-Top: 10%; background-color: #1980E1; margin-left: 10%;border: 2px solid black;">
                                        <div>
                                                <div class="h3-dashboard" style=" margin-left: 50%;color:white;">
                                                    New Report &nbsp;&nbsp;
                                                </div>
                                                <div class="h1-dashboard" style=" margin-left: 70%; color:white;">
                                                    <?php    echo $reporttrow ->num_rows  ?>
                                                </div><br>
                                                
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/report.svg');background-color: white;background-size: 60%; padding-left: 25%; margin-left:25%"></div>
                                    </div>
                                </td>
                                    </tr>
                                    <tr>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:70%;display: flex;margin-Top: 10%; background-color: #1980E1; margin-right: -30%;border: 2px solid black; ">
                                        <div>
                                                <div class="h3-dashboard" style=" margin-left: 50%;color:white;">
                                                    Today Sessions
                                                </div>
                                                <div class="h1-dashboard" style=" margin-left: 70%; color:white;">
                                                    <?php    echo $schedulerow ->num_rows  ?>
                                                </div><br>
                                                
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/schedul.svg');background-color: white;background-size: 60%; padding-left: 25%; margin-left:25%"></div>
                                    </div>
                                </td>
                                
                            </tr>
                        </table>
                    </center>
                    </td>
                </tr>






               
            </table>
        </div>
    </div>


</body>
</html>