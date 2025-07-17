<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>header</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<?php

     

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
<body>
       
    <div class="container">
    <style>
                    body {
                                background-image: url('../img/b7.png');
                                background-repeat: no-repeat;
                                background-attachment: fixed;
                                background-size: 100% 100%;
                                }
                                </style> 
        <div class="menu">
            <table class="menu-container" border="0"  style=" background-color:  #1980E1 ;">
                <tr>
                    <td style="padding:10px" colspan="2" >
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="40%" style="padding-left:20px" >
                                    <img src="../img/staff.svg" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,20)  ?></p>
                                    <p class="profile-subtitle" style="color:white;"><?php echo substr($useremail,0,20)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                
                </tr>
                <tr class="menu-row"  >
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text" >Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="doctors.php" class="non-style-link-menu "><div><p class="menu-text">Doctors</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule ">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-report">
                        <a href="report.php" class="non-style-link-menu"><div><p class="menu-text">Report</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-breport">
                        <a href="ra.php" class="non-style-link-menu"><div><p class="menu-text">Appointment-Report</p></a></div>
                    </td>
                </tr>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>
                </tr>
                

            </table>
        </div>
</body>
</html>