<?php

include('connection.php');
session_start();
$user = $_SESSION['name'];
$query_chk = mysqli_query($connection, "select status from hospital where user_name='$user'");
$data_chk = mysqli_fetch_assoc($query_chk);
if ($data_chk['status'] == 'pending') {
  header("location:pending.php");
} else {
  if (!isset($_SESSION['name'])) {
    header("location:login.php");
  };
  $query = "Select * from hospital ";
  $result = mysqli_query($connection, $query);

  $query1 = " select count(*) as total from parents p JOIN hospital h ON p.hospital_id = h.hospital_id ";
  $result1 = mysqli_query($connection, $query1);

  $query2 = " select count(*) as total, user_name from parents p JOIN hospital h ON p.hospital_id = h.hospital_id WHERE h.user_name = '$user'";
  $result2 = mysqli_query($connection, $query2);

  $query3 = " select count(*) as total from parents p JOIN hospital h ON p.hospital_id = h.hospital_id where status_id= 2 and  h.user_name = '$user' ";
  $result3 = mysqli_query($connection, $query3);


  ?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>
  <style>
   

    /* Styling for the container of vaccine information */
    .vaccine-heading {
            text-align: center;
            padding: 20px;
            background-color: #3498db;
            color: #fff;
            margin: 0;
        }

       
  
@keyframes slideIn {
    0% {
        opacity: 0;
        transform: translateY(-70px);
    }
    100% {
        opacity: 5;
        transform: translateY(0);
    }
}

.vaccine-paragraph {
    text-align: center;
    opacity: 2; /* Initially set opacity to 0 */
    animation: slideIn 5s ease-out forwards;
    font-size:20px;
}

/* Apply the transition effect on hover or active state */
.vaccine-paragraph:hover,
.vaccine-paragraph:active {
    opacity: 1;
}


.info-heading {
    background-color: transparent;
    color: black;
    padding: 10px;
    text-align: center;
    margin-bottom: 20px;
    transition: background-color 0.5s, color 0.5s;
    position: relative;
}

.info-heading::before {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #3498db;
    transform: scaleX(1); /* Initially set to full width */
    transform-origin: bottom left;
    transition: transform 0.3s ease-out;
}


        .info-heading:hover {
            background-color: #ffffff;
        }

        .grid-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            max-width: 900px;
            margin: 20px auto;
        }

        .grid-item {
            background-color: #fff;
            padding: 20px;
            text-align: center;
            margin: 10px;
           
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .grid-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.8);
        }

        .data {
            color: #333;
            font-size: 18px;
        }

  </style>

  <body>


    <?php



    if ($result1) {
      $row = mysqli_fetch_assoc($result1);
      $totalParents = $row['total'];
    } else {
      $totalParents = 0;
    }



    if ($result2) {
      $row2 = mysqli_fetch_assoc($result2);
      $hospitalParents = $row2['total'];
      $user = $row2['user_name'];
    } else {
      $hospitalParents = 0;
    }


    if ($result3) {
      $row3 = mysqli_fetch_assoc($result3);
      $vaccinatedParents = $row3['total'];
    } else {
      $vaccinatedParents = 0;
    }
    include("header.php");

    if (isset($_POST['logout'])) {
      session_destroy();
      header("location:login.php");


    }
    ?>

<div class="hero-slider">
  <!-- Slider Item -->
  <div class="slider-item slide1" style="background-image:url(images/doctor.jpg)">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Slide Content Start -->
          <div class="content style text-center">
            <h2 class="text-white text-bold mb-2" data-animation-in="slideInLeft">Welcome to Hospital Portal</h2>
            
          </div>
          <!-- Slide Content End -->
        </div>
      </div>
    </div>
  </div>
  <!-- Slider Item -->
  <div class="slider-item" style="background-image:url(images/slider/slidenew2.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Slide Content Start-->
          <div class="content style text-center">
            <h2 class="text-white" data-animation-in="slideInRight">"Medicines cure diseases, but only doctors can cure patients."</h2>
          </div>
          <!-- Slide Content End-->
        </div>
      </div>
    </div>
  </div>
  <!-- Slider Item -->
  <div class="slider-item" style="background-image:url(images/slider/slidenew1.jpg)">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Slide Content Start -->
          <div class="content text-center style">
            <h2 class="text-white text-bold mb-2" data-animation-in="slideInRight">Our Best Doctors</h2>
          </div>
          <!-- Slide Content End -->
        </div>
      </div>
    </div>
  </div>
</div>
<br>
 
    <p class="vaccine-paragraph text-center"><b>Vaccination plays a crucial role in preventing infectious diseases, protecting
      individuals and communities from severe illnesses, and contributing to public health. It helps build immunity,
      reducing the spread of harmful viruses and ensuring a healthier future for everyone.</b></p>
    <br><br>

   <h1 class="info-heading">INFORMATION ABOUT HOSPITAL</h1>
<br>
<div class="grid-container">
    <div class="grid-item">
        <div class="grid1">
            <h3 class="data">Total Visitors: <?php echo $totalParents; ?></h3>
        </div>
    </div>

    <div class="grid-item">
        <div class="grid2">
            <h3 class="data"><?php echo $user; ?> Patients: <?php echo $hospitalParents; ?></h3>
        </div>
    </div>

    <div class="grid-item">
        <div class="grid3">
            <h3 class="data">Vaccinated Patients: <?php echo $vaccinatedParents; ?></h3>
        </div>
    </div>
</div>

<section class="gallery bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title text-center">
          <h3>Vaccination Shots
            <span>of Our Hospitals</span>
          </h3>
          <p>Leverage agile frameworks to provide a robust synopsis for high level overv-
            <br>iews. Iterative approaches to corporate strategy...</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="gallery-item">
          <img loading="lazy" src="images/gallery/gallery1.jpg" class="img-fluid" alt="gallery-image">
          <a data-fancybox="images" href="images/gallery/gallery1.jpg"></a>
          <h3>Facility 01</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, in.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="gallery-item">
          <img loading="lazy" src="images/gallery/gallery2.jpg" class="img-fluid" alt="gallery-image">
          <a data-fancybox="images" href="images/gallery/gallery2.jpg"></a>
          <h3>Facility 02</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, in.</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="gallery-item">
          <img loading="lazy" src="images/gallery/gallery3.jpg" class="img-fluid" alt="gallery-image">
          <a data-fancybox="images" href="images/gallery/gallery3.jpg"></a>
          <h3>Facility 03</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, in.</p>
        </div>
      </div>
   
    </div>
  </div>
</section>



    <br><br>
    <?php
    include("footer.php");
    ?>
  </body>

  </html>
  <?php
}
;
?>