<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/home.css">
    <title>header</title>
</head>
<body>
<header>
        
        <div class="logo"><img src="../img/logo2.png"  alt="" style="width: 100px; height: auto;"></div>
           

            <nav class="navbar">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="services.php">Service</a>
                <a href="doctors.php">Doctors</a>
                <a href="schedule.php">Session</a>
                <a href="report.php">Check-Up</a>
            </nav>
            
           <a href="appointment.php"><div class="right-icons">
               <div id="menu-bars" class="fas fa-bars"></div>
               <div style="font-size: 18px; border-radius: 10%;" class="login-btn btn-primary btn-user" ><p><?php echo substr($username,0,20)  ?></p>
               </div>
           </div></a>
   
   
       </header>
</body>
</html>