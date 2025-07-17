
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Schedule</title>
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
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    

    include("../connection.php");
    include("header.php");

    
    ?>
    
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="result.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Report Result Manager</p>
                                           
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(1, 1, 1);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                        date_default_timezone_set('Asia/Colombo');

                        $today = date('Y-m-d');
                        echo $today;

                        $list110 = $database->query("select  * from  result;");

                        ?>
                        </p>
                    </td>
                    <td width="5%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar1.svg" width="100%"></button>
                    </td>


                </tr>
               
                <tr>
                    <td colspan="4" >
                        <div style="display: flex;margin-top: 40px;">
                        <div class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">result</div>
                        <a href="?action=add-session&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="margin-left:25px;background-image: url('../img/add.svg');background-size: 13%;">Add a result</font></button>
                        </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Sessions (<?php echo $list110->num_rows; ?>)</p>
                    </td>
                    
                </tr>
               
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0" style=" margin-top:20px; background-color: #FFFFFF;">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    
                                
                                    Patient Name
                                
                                </th>

                                <th class="table-headin">
                                    Report Name
                                </th>
                                
                                <th class="table-headin">
                                    Result
                                </th>
                               

                                
                                <th class="table-headin">
                                    
                                    Events
                                    
                                </tr>
                        </thead>
                        <tbody>
                        
                        <?php
                            $result = mysqli_query($database, 
                                "SELECT result.resultid, result.image, patient.pname ,report.rname
                                FROM result 
                                JOIN patient ON result.pid = patient.pid
                                JOIN report ON result.reportid = report.reportid 
                                ORDER BY result.resultid DESC"
                            );

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
                                    $imagePath = "img/" . htmlspecialchars($row["image"]);

                                    echo '<tr>
                                            <td>' . substr($pname, 0, 20) . '</td>
                                            <td>' . substr($rname, 0, 20) . '</td>
                                            <td style="text-align:center;">
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
        if($action=='add-session'){

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup" style="background-color: #006dd3; border-radius:30px; margin-Top:3%;">
                    <center>
                    
                    
                        <a class="close" href="result.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0" style="font-size: 17px; background-color:rgb(252, 252, 252);">
                        <tr>
                                <td class="label-td" colspan="2">'.
                                   ""
                                
                                .'</td>
                            </tr>

                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New result.</p><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <form action="add-result.php" method="POST" class="add-new-form" autocomplete="off" enctype="multipart/form-data">
                                    <label for="title" class="form-label">Session Title : </label>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Select p: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="name" id="name" class="box" >
                                    <option value="name" disabled selected hidden>Choose Doctor Name from the list</option><br/>';
                                        
        
                                        $list11 = $database->query("select  * from  patient order by pname asc;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $sn=$row00["pname"];
                                            $id00=$row00["pid"];
                                            echo "<option value=".$id00.">$sn</option><br/>";
                                        };
        
        
        
                                        
                        echo     '       </select><br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="name1" id="name1" class="box" >
                                    <option value="name1" disabled selected hidden>Choose Doctor Name from the list</option><br/>';
                                        
        
                                        $list11 = $database->query("select  * from  report order by rname asc;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $sn=$row00["rname"];
                                            $id00=$row00["reportid"];
                                            echo "<option value=".$id00.">$sn</option><br/>";
                                        };
        
        
        
                                        
                        echo     '       </select><br><br>
                                </td>
                            </tr>


                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="image" class="form-label">Numbe: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="file" name="image" class="input-text" id="image" accept=".jpg, .jpeg, .png" value=""><br>
                                </td>
                            </tr>
                            

                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    <input type="submit" value="Place this Session" class="login-btn btn-primary btn" name="submit">
                                </td>
                
                            </tr>
                           
                            </form>
                            </tr>
                        </table>
                        </div>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }elseif($action=='session-added'){
            $pname = $row["pname"]; 
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br>
                        <h2>Report Add.</h2>
                        <a class="close" href="result.php">&times;</a>
                        <div class="content">
                        '.substr($pname,0,40).'.<br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        
                        <a href="result.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        <br><br><br><br>
                        </div>
                    </center>
            </div>
            </div>
            ';
        }elseif($action=='drop'){
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