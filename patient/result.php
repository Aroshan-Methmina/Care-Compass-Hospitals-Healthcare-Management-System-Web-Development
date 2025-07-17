<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Result</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
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
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    include("../connection.php");
    $userrow = $database->query("select * from patient where pemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];
    ?>
    
    <div class="container" >
    <style>
                    body {
                                background-image: url('../img/b6.png');
                                background-repeat: no-repeat;
                                background-attachment: fixed;
                                background-size: 100% 100%;
                                }
        </style> 
        
        <div class="menu">
        <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2" >
                        <table border="0" class="profile-container" >
                            <tr>
                                <td width="40%" style="padding-left:20px" >
                                    <img src="../img/user1.svg" alt="" width="100%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?></p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
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
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-appoinment  ">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Bookings</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-report">
                        <a href="ra.php" class="non-style-link-menu"><div><p class="menu-text">My Report</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-result  menu-active menu-icon-result-active">
                        <a href="result.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">My Report Result</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="index.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">My Report Result history</p>
                                           
                    </td>
                    <td width="30%">
                        <p style="font-size: 14px;color: rgb(8, 8, 8);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                        date_default_timezone_set('Asia/Colombo');

                        $today = date('Y-m-d');
                        echo $today;
                        $list110 = $database->query("select  * from  result where pid=$userid;");
                        
                        ?>
                        </p>
                    </td>
                    <td width="5%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar1.svg" width="100%"></button>
                    </td>


                </tr>
               
                
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">My Result (<?php echo $list110->num_rows; ?>) </p>
                    </td>
                    
                </tr>
                
                <?php

                        $sqlmain = "SELECT result.resultid, result.image, patient.pname, patient.pid, report.reportid, report.rname
                                    FROM result 
                                    JOIN report ON result.reportid = report.reportid 
                                    INNER JOIN patient ON result.pid = patient.pid 
                                    WHERE patient.pid = $userid";
                        $result = $database->query($sqlmain);

                        if ($result === false) {
                            die("Query failed: " . $database->error);
                        }

                        
                        if ($result->num_rows == 0) {
                            echo '<tr>
                                    <td colspan="4">
                                        <br><br><br><br>
                                        <center>
                                            <img src="../img/not-found.svg" width="25%">
                                            <br>
                                            <p class="heading-main12" style="margin-left: 45px; font-size:20px; color:rgb(49, 49, 49)">
                                                We couldn\'t find anything related to your keywords!
                                            </p>
                                        </center>
                                        <br><br><br><br>
                                    </td>
                                </tr>';
                        } else {
                            while ($row = $result->fetch_assoc()) {
                                $resultid = $row["resultid"];
                                $pname = $row["pname"]; 
                                $rname = $row["rname"]; 
                                $imagePath = "../admin/img/" . htmlspecialchars($row["image"]);

                                echo '<tr lass="sub-table scrolldown" style=" margin-top:20px; background-color:rgb(104, 190, 243);">
                                       
                                        <td style="padding-left: 5%;">' . substr($rname, 0, 20) . '</td>
                                        <td style="padding-left: 15%; padding-top: 1%; padding-bottom: 1%;">
                                            <img src="' . $imagePath . '" width="100" title="' . htmlspecialchars($row["image"]) . '">
                                        </td>
                                        <td>
                                            <div style="display:flex; justify-content: center;">
                                                <button class="btn-primary-soft btn button-icon btn-view" onclick="openPopup(\'' . $imagePath . '\')" style="padding-left: 40px; padding-top: 12px; padding-bottom: 12px; margin-top: 10px;">
                                                    <font class="tn-in-text">View</font>
                                                </button>
                                                &nbsp;&nbsp;&nbsp;
                                                <a href="?action=drop&id=' . $resultid . '&name=' . urlencode($pname) . '" class="non-style-link">
                                                    <button class="btn-primary-soft btn button-icon btn-delete" style="padding-left: 40px; padding-top: 12px; padding-bottom: 12px; margin-top: 10px;">
                                                        <font class="tn-in-text">Remove</font>
                                                    </button>
                                                </a>              
                                            </div>
                                        </td>
                                    </tr>';
                            }
                        }
                        ?>

                        <div id="imagePopup" class="popup-container" style="display:none;">
                            <div class="popup-content">
                                <span class="close-btn" onclick="closePopup()">&times;</span>
                                <img id="popupImage" src="" alt="Result Image">
                            </div>
                        </div>
                        <script>
                        function openPopup(imageSrc) {
                            document.getElementById("popupImage").src = imageSrc;
                            document.getElementById("imagePopup").style.display = "flex";
                        }

                        function closePopup() {
                            document.getElementById("imagePopup").style.display = "none";
                        }
                        </script>






                        </tbody>

                        </table>
                        </div>
                        </center>
                        </td> 
                        </tr>



                        </table>
                        </div>
                        </div>
                        <?php

                        if($_GET){
                        $id=$_GET["id"];
                        $action=$_GET["action"];
                        if($action=='drop'){
                        $nameget=$_GET["name"];
                        echo '
                        <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="result.php">&times;</a>
                        <div class="content">
                        You want to delete this record<br>('.substr($nameget,0,40).').

                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-result.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="result.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                        </center>
                        </div>
                        </div>
                        '; 
}
}
?>
    </div>

</body>
</html>
