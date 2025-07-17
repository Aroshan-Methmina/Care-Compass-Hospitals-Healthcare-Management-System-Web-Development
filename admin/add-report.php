<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_POST){
        include("../connection.php");
        $rname=$_POST["rname"];
        $discription=$_POST["descripshion"];
        $price=$_POST["price"];
        $sql="insert into report ( rname,discription,price) values ('$rname','$discription','$price');";
        $result= $database->query($sql);
        header("location: report.php?action=add&error=".$error);
        
    }


?>