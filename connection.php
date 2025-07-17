<?php

    $database= new mysqli("localhost","root","","cch");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>