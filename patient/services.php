<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/services.css">
    <title>Services</title>
                    

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
        $userrow = $stmt->get_result();
        $userfetch=$userrow->fetch_assoc();

        $userid= $userfetch["pid"];
        $username=$userfetch["pname"];
    ?>

    <?php
    include("header.php");
    ?>
     
     <div class="container">
                    <style>
                        .box{
                            height: 350px;
                        }
                        </style>
               <ul>
            <li class="active" data-content="research" id="Specialist-Consultation">
                <img src="../img/s12.png" alt="research">
                <span>Specialist Consultation</span>
            </li>
            <li data-content="planning" id="Laboratory-Service">
                <img src="../img/s22.png" alt="planning">
                <span>Laboratory Service</span>
            </li>
            <li data-content="production">
                <img src="../img/s32.png" alt="production">
                <span>Health Check-ups</span>
            </li>
            <li data-content="testing">
                <img src="../img/s42.png" alt="testing">
                <span>Ambulance Service & Home Care</span>
            </li>
            <li data-content="result">
                <img src="../img/s52.png" alt="result">
                <span>Operation Theatre</span>
            </li>
            <li data-content="aa">
                <img src="../img/s62.png" alt="aa">
                <span>Inpatient Care</span>
            </li>
        </ul>
        <div class="content">
            <div class="box research" >
                <img src="../img/s13.png" alt="research">
                <div class="text">
                    <h3>Specialist Consultation</h3>
                    <p>

                    Our Specialist Consultation service is highly trusted for providing access to the top medical specialists in the country at affordable rates. This service covers all major specialties as well as a wide range of sub-specialties, with the expertise of over 350 highly experienced specialist consultants from leading hospitals across the country.
                    By bringing together a large number of the nation's top specialists, our hospitals ensure greater access to high-quality healthcare, especially in underserved regions..</p>
                </div>
            </div>
            <div class="box planning"id="laboratory-service-details">
                <img src="../img/s23.png" alt="planning">
                <div class="text">
                    <h3>Laboratory Service</h3>
                    <p>Care Compass Hospitals is a trusted name in Sri Lanka for high-quality medical laboratory services. With multiple fully automated labs and sample collection centers, we ensure accurate and timely diagnostics.
                    Our laboratories are SLAB-accredited for ISO 15189:2012, guaranteeing reliable test results. A team of skilled professionals and cutting-edge technology, including Fully Automated Biochemistry, Immunology, and Hematology Analyzers, ensures efficiency and precision.
                    We maintain global quality standards through rigorous internal controls and international quality assurance programs, delivering excellence in healthcare diagnostics.
                    </p>                    
                </div>
            </div>
            <div class="box production">
                <img src="../img/s33.png" alt="production">
                <div class="text">
                    <h3>Health Check-ups</h3>
                    <p>Care Compass Hospitals offers a variety of health screening and routine check-up services through our extensive branch network. Our services are organized into specialized packages at affordable rates, including Corporate Services, Heart Health, and a Senior Citizens package, catering to the unique health needs of all patients.
                    All laboratory testing is conducted at our ISO 9001:2015 accredited state-of-the-art facility. Each health package includes a comprehensive examination and review by a consultant doctor.</p>
                </div>
            </div>
            <div class="box testing">
                <img src="../img/s43.png" alt="testing">
                <div class="text">
                    <h3>Ambulance Service & Home Care</h3>
                    <p>Care Compass Hospitals is known for its reliable ambulance service and convenient home care visits. We offer quality healthcare across Sri Lanka with a modern ambulance fleet available 24/7, equipped with life-saving equipment to ensure patient safety and comfort during transport.
                    Our 24-hour emergency care is staffed by qualified doctors and experienced caregivers. We also provide ambulance pick-up for international patients and medical care for those traveling overseas, accompanied by a doctor and nurse. Our services meet international standards while remaining affordable and accessible.</p>
                </div>
            </div>
            <div class="box result">
                <img src="../img/s53.png" alt="result">
                <div class="text">
                    <h3>Operation Theatre</h3>
                    <p>LCare Compass Hospitals features two state-of-the-art surgical theaters, providing a private healthcare setting for various surgeries. We offer both major and minor surgeries under general, spinal, and local anesthesia.
                    Our specialized surgery packages ensure excellent value for money. Additionally, we are registered with all major insurance companies and support corporate medical schemes to help reimburse healthcare and surgery-related expenses.</p>
                </div>
            </div>

            <div class="box aa">
                <img src="../img/s63.png" alt="aa">
                <div class="text">
                    <h3>Inpatient Care</h3>
                    <p>Care Compass Hospitals is recognized for providing high-quality inpatient care. Our facilities offer a range of options, with four distinct room types from economical ward beds to private air-conditioned rooms with attached bathrooms.
                    Patients receive treatment under the supervision of specialist consultants, with round-the-clock care from our qualified medical officers and nurses. We are registered with major insurance companies and assist with corporate medical schemes to reimburse inpatient healthcare expenses.</p>
                </div>
            </div>
        </div>
    </div>
    
    <?php
    include("footer.php");
    ?>
    <script >
        document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll(".container ul li");
    const boxes = document.querySelectorAll(".container .content .box");

    tabs.forEach(tab => {
        tab.addEventListener("click", function() {
            const target = this.getAttribute("data-content");

            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove("active"));
            // Add active class to the clicked tab
            this.classList.add("active");

            // Hide all boxes
            boxes.forEach(box => box.style.display = "none");
            // Show the target box
            document.querySelector(`.box.${target}`).style.display = "flex";
        });
    });
});
    </script>
    
</body>

</html>