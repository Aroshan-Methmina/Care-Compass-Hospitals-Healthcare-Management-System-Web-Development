<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/admin.css">
        
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


    
    include("connection.php");
  
    
    date_default_timezone_set('Asia/colombo');

    $today = date('Y-m-d');

 ?>
    <?php
    include("header.php");
    ?>
            <?php

                $sqlmain= "select * from report order by reportid desc";
                $sqlpt1="";
                $insertkey="";
                $q='';
                $searchtype="All";
                        if($_POST){
                        
                        if(!empty($_POST["search"])){
                            $keyword=$_POST["search"];
                            $sqlmain= "select * from report where rname='$keyword'  or rname like '$keyword%' or rname like '%$keyword' or rname like '%$keyword%'";
                            
                            $insertkey=$keyword;
                            $searchtype="Search Result : ";
                            $q='"';
                        }

                    }


                $result= $database->query($sqlmain)


            ?>
                  
        <div class="dash-body">
        <style>
                    body {
                                background-image: url('img/bb2.png');
                                background-repeat: no-repeat;
                                background-attachment: fixed;
                                background-size: 100% 100%;
                                }
                                </style> 
            <table border="0" width="126%" style=" border-spacing: 0;margin:0;padding:0;margin-top:100px;">
                <tr >
                    <td width="13%" >
                    <a href="report.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px;font-size: 22px;"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td >
                            <form action="" method="post" class="header-search" >

                                        <input type="search" name="search" style="font-size: 20px;" class="input-text header-searchbar" placeholder="Search report name " list="doctors" value="<?php  echo $insertkey ?>">&nbsp;&nbsp;
                                        
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
                        <p style="font-size: 18px;color: rgb(10, 10, 10);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                                
                                echo $today;

                                

                        ?>
                        </p>
                    </td>
                    <td width="5%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="img/calendar1.svg" width="100%"></button>
                    </td>


                </tr>
                
                
                <tr>
                    <td colspan="4" style="padding-top:30px;width: 100%;" >
                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)"><?php echo $searchtype." report"."(".$result->num_rows.")"; ?> </p>
                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)"><?php echo $q.$insertkey.$q ; ?> </p>
                    </td>
                    
                </tr>
                
                
                
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                            
                        
                        
                            <?php

                                
                                

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="img/not-found.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                            
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                    if ($result->num_rows > 0) {
                                        echo "<tr>";
                                        $count = 0;
                                    
                                        while ($row = $result->fetch_assoc()) {
                                            $reportid = $row["reportid"];
                                            $rname = $row["rname"];
                                            $discription = $row["discription"];
                                            $price = $row["price"];
                                    
                                            echo '
                                            <td style="width: 25%;">
                                                <div class="dashboard-items search-items" style="background-color: #FFFFFF;">
                                                    <div style="width:100%">
                                                        <div class="h1-search">
                                                            '.substr($rname, 0, 21).'
                                                        </div><br>
                                                        <div class="h3-search">
                                                            '.substr($discription, 0, 30).'...
                                                        </div><br>
                                                        <div class="h3-search">
                                                            <br>Price: <b>'.substr($price, 0, 30).'</b>
                                                        </div>
                                                        <br>
                                                        <a href="?action=view&id=' . $reportid . '" >
                                                            <button class="login-btn btn-primary-soft btn" style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                <font class="tn-in-text">View Now</font>
                                                            </button>
                                                        </a>
                                                        <br><br>
                                                        <a href="login.php?id='.$reportid.'">
                                                            <button class="login-btn btn-primary-soft btn" style="padding-top:11px;padding-bottom:11px;width:100%">
                                                                <font class="tn-in-text">Book Now</font>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>';
                                    
                                            $count++;
                                    
                                            
                                            if ($count % 3 == 0) {
                                                echo "</tr><tr>";
                                            }
                                        }
                                        echo "</tr>";
                                    } else {
                                        echo '<tr><td colspan="3" style="text-align:center;">No reports found.</td></tr>';
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
        if ($_GET) {
        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'view') {
            $sqlmain = "SELECT * FROM report WHERE reportid='$id'";
            $result = $database->query($sqlmain);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $reportid = $row["reportid"];
                $rname = $row["rname"];
                $discription = $row["discription"];
                $price = $row["price"];
    
                echo '
                <div id="popup1" class="overlay">
                        <div class="popup" style="background-color: #006dd3; border-radius:30px; margin-Top:6%;">
                        <center>
                            <h2></h2>
                            <a class="close" href="report.php">&times;</a>
                            <div class="content" style="color:rgb(252, 252, 252); font-size: 20px;">
                                Care Compass Hospital<br>
                            </div>
                            <div style="display: flex;justify-content: center;">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0" style="font-size: 17px; background-color:rgb(252, 252, 252);">
                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="rname" class="form-label">Report Name: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        ' . $rname . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="discription" class="form-label">Description: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        ' . $discription . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="price" class="form-label">Price: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                     Rs.' . $price . '<br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <a href="report.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn"></a>
                                    </td>
                                </tr>
                            </table>
                            </div>
                        </center>
                        <br><br>
                </div>
                </div>
    
                ';
            }
            }
        }
            ?>

    <?php
    include("footer.php");
    ?>
            
</body>
</html>
