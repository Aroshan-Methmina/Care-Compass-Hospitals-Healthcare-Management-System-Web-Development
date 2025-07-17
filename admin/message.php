<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Message</title>
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
        <div class="dash-body" >
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; " >
           
                <tr >
                    <td width="13%">
                        <a href="message.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                    <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search name or Email" list="message">&nbsp;&nbsp;

                    <?php
                                echo '<datalist id="message">';
                                $list11 = $database->query("select  name from  contacts;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["name"];
                                    $c=$row00["email"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                                };

                            echo ' </datalist>';
                            
?>
                            
                       
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                        
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(0, 0, 0);padding: 0;margin: 0;text-align: right;">
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
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Message (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <?php
                    if($_POST){
                        $keyword=$_POST["search"];
                        
                        $sqlmain= "select * from contacts where email='$keyword' or name='$keyword' or name like '$keyword%' or name like '%$keyword' or name like '%$keyword%'";
                    }else{
                        $sqlmain= "select * from contacts order by id desc";

                    }



                ?>
                
                  
                <tr>
                   <td colspan="5">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0" >
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    
                                
                                     Name
                                
                                </th>
                                <th class="table-headin">
                                    Email
                                </th>
                                <th class="table-headin">
                                    
                                    Message
                                    
                                </th>
                                <th class="table-headin">
                                    
                                    Date & Time
                                    
                                </th>
                                <th class="table-headin">
                                    
                                    Events
                                    
                                </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                                $sqlmain = "SELECT id, name, email, message, created_at FROM contacts"; 
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/not-found.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                   
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $id=$row["id"];
                                    $name=$row["name"];
                                    $email=$row["email"];
                                    $msg=$row["message"];
                                    $date=$row["created_at"];


                                    echo '<tr>
                                        <td> &nbsp;'.
                                        substr($name,0,30)
                                        .'</td>
                                        <td>
                                        '.substr($email,0,20).'
                                        </td>
                                        <td>
                                            '.substr($msg,0,20).'
                                        </td>
                                        <td>
                                            '.substr($date,0,20).'
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                    
                                        <a href="?action=view&id='.$id.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id='.$id.'&name='.$name.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Remove</font></button></a>
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
                        <a class="close" href="message.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>('.substr($nameget,0,40).').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-message.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="message.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        }elseif($action=='view'){
            $sqlmain= "select * from contacts where id='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $name=$row["name"];
            $email=$row["email"];
            $msg=$row["message"];
            $date=$row["created_at"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup" style="background-color: #006dd3; border-radius:30px; margin-Top:0.5%;">
                    <center>
                        <h2></h2>
                        <a class="close" href="message.php">&times;</a>
                        <div class="content" style = "color:rgb(252, 252, 252); font-size: 20px;">
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
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$name.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$email.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">Message : </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$msg.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Date & Time: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$date.'<br><br>
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <td colspan="2">
                                    <a href="message.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
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
    };

?>
</div>

</body>
</html>