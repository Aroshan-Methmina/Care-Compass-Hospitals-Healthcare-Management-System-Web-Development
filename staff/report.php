<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Report</title>
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
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='s'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
 
    include("../connection.php");
    include("header.php");

    
    ?>
        <div class="dash-body" >
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; " >
           
                <tr >
                    <td width="13%">
                        <a href="report.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        
                        <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search report name " list="report">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="report">';
                                $list11 = $database->query("select  rname from  report;");

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
                        <p style="font-size: 14px;color: rgb(6, 6, 6);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                        date_default_timezone_set('Asia/Colombo');

                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                        </p>
                    </td>
                    <td width="5%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar1.svg" width="100%"></button>
                    </td>


                </tr>
               
                
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Report (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <?php
                    if($_POST){
                        $keyword=$_POST["search"];
                        
                        $sqlmain= "select * from report where rname='$keyword'  or rname like '$keyword%' or rname like '%$keyword' or rname like '%$keyword%'";
                    }else{
                        $sqlmain= "select * from report order by reportid desc";

                    }



                ?>
                  
                <tr>
                   <td colspan="5">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    
                                
                                    Report Name
                                
                                </th>
                                <th class="table-headin">
                                    Discription
                                </th>
                                <th class="table-headin">
                                    
                                    Price
                                    
                                </th>
                                <th class="table-headin">
                                    
                                    Events
                                    
                                </tr>
                               
                        </thead>
                        <tbody>
                        
                        <?php
                            $result = $database->query($sqlmain);

                            if ($result->num_rows == 0) {
                                echo '<tr>
                                        <td colspan="4">
                                            <br><br><br><br>
                                            <center>
                                                <img src="../img/not-found.svg" width="25%">
                                                <br>
                                                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldn\'t find anything related to your keywords!</p>
                                            </center>
                                            <br><br><br><br>
                                        </td>
                                    </tr>';
                            } else {
                                for ($x = 0; $x < $result->num_rows; $x++) {
                                    $row = $result->fetch_assoc();
                                    $reportid = $row["reportid"];
                                    $rname = $row["rname"];
                                    $discription = $row["discription"];
                                    $price = $row["price"];

                                    echo '<tr>
                                            <td> &nbsp;' . substr($rname, 0, 30) . '</td>
                                            <td>' . substr($discription, 0, 20) . '....</td>
                                            <td>' . substr($price, 0, 20) . '</td>
                                            <td>
                                                <div style="display:flex;justify-content: center;">
                                                    
                                                    <a href="?action=view&id=' . $reportid . '" class="non-style-link"><button class="btn-primary-soft btn button-icon btn-view" style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                                    &nbsp;&nbsp;&nbsp;
                                                    </div>
                                            </td>
                                        </tr>';
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
                    <div class="popup" style="background-color: #006dd3; border-radius:30px; margin-Top:0.5%;">
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
        } ;
    };

?>
</div>

</body>
</html>