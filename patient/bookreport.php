<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Sessions</title>
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

    $sqlmain= "select * from patient where pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $result = $stmt->get_result();
    $userfetch = $result->fetch_assoc(); 
    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];

    date_default_timezone_set('Asia/Colombo');

    $today = date('Y-m-d');


 ?>
    <?php
    include("header.php");
    ?>

 <div class="container">
        <div class="dash-body">
        <style>
                    body {
                                background-image: url('../img/bb2.png');
                                background-repeat: no-repeat;
                                background-attachment: fixed;
                                background-size: 100% 100%;
                                }
                                </style> 
            <table border="0" width="126%" style=" border-spacing: 0;margin:0;padding:0;margin-top:100px; ">
                <tr >
                    <td width="13%" >
                    <a href="report.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td >
                            <form action="report.php" method="post" class="header-search">

                                        <input type="search" name="search" class="input-text header-searchbar"style="font-size: 18px;" placeholder="Search Report name " list="report" >&nbsp;&nbsp;
                                        
                                        <?php
                                            echo '<datalist id="report">';
                                            $list11 = $database->query("select DISTINCT * from  report;");
                                            

                                            


                                            for ($y=0;$y<$list11->num_rows;$y++){
                                                $row00=$list11->fetch_assoc();
                                                $d=$row00["rname"];
                                               
                                                echo "<option value='$d'><br/>";
                                               
                                            };



                                        echo ' </datalist>';
            ?>
                                        
                                
                                        <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                        </form>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(7, 7, 7);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                                
                                echo $today;

                                

                        ?>
                        </p>
                    </td>
                    <td width="5%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar1.svg" width="100%"></button>
                    </td>


                </tr>
                
                
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                        
                    </td>
                    
                </tr>
                
                
                
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                            
                        <tbody>
                        
                            <?php
                            
                            if(($_GET)){
                                
                                
                                if(isset($_GET["id"])){
                                    

                                    $id=$_GET["id"];

                                    $sqlmain="SELECT * FROM report WHERE reportid = ? ORDER BY reportid DESC";
                                    $stmt = $database->prepare($sqlmain);
                                    $stmt->bind_param("i", $id);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $row=$result->fetch_assoc();
                                    $reportid=$row["reportid"];
                                    $rname=$row["rname"];
                                    $discription=$row["discription"];
                                    $price=$row["price"];
                                    
                                    echo '
                                        <form action="rc.php" method="post">
                                            <input type="hidden" name="reportid" value="'.$reportid.'" >
                                            <input type="hidden" name="date" value="'.$today.'" >

                                        
                                    
                                    ';
                                     

                                    echo '
                                    <td style="width: 50%;" rowspan="2">
                                            <div  class="dashboard-items search-items" style="background-color:#FFFFFF;" >
                                            
                                                <div style="width:100%">
                                                        <div class="h1-search" style="font-size:25px;">
                                                            Report Details
                                                        </div><br><br>
                                                        <div class="h3-search" style="font-size:18px;line-height:30px">
                                                            Report name:  &nbsp;&nbsp;<b>'.$rname.'</b><br>
                                                        </div>
                                                        <div class="h3-search" style="font-size:18px;">
                                                          
                                                        </div><br>
                                                        <div class="h3-search" style="font-size:18px;">
                                                            Session Title: '.$discription.'<br>
                                                            Channeling fee : '.$price.' 

                                                        </div>
                                                        
                                                        <br>
                                                        <input type="Submit" class=" btn-primary btn-pay1" style="margin-left:10px;padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;width:95%;text-align: center;"  value="Pay now" name="booknow2"></button>
                                                        </form>
                                      
                                                        <br>
                                                        
                                                </div>
                                                        
                                            </div>
                                        </td>
                                        
                                        '; 

                                }

                            }
                            
                            ?>
 
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
    include("footer.php");
    ?>
    
</body>
</html>