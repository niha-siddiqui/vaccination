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
    /* Styling for the banner container */
    /* Your existing styles */
    .banner {
      background-image: url('images/doctor.jpg');
      /* Replace with your image path */
      background-size: cover;
      background-position: center;
      height: 360px;
      /* Set your desired height */
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-align: center;
      position: relative;
      overflow: hidden;
      /* Ensures the overlay doesn't overflow */
      transition: background-image 0.5s ease-in-out;
      position: relative;
    }

    /* Style for the heading text */
    .banner h1 {
      font-size: 3.5em;
      margin-top: 90px;
      text-shadow: black 5px 5px 5px;
      transition: text-shadow 0.5s ease-in-out;
      /* Add transition for text-shadow */
    }

    /* Overlay with blackish shade */
    .banner::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      /* Adjust opacity for your shade */
      opacity: 0;
      /* Initially hidden */
      transition: opacity 0.5s ease-in-out;
      /* Add transition for the overlay */
    }

    /* Show overlay on hover */
    .banner:hover::before {
      opacity: 0.5;
    }

    /* Styling for the container of vaccine information */
    .info {
      display: flex;
      justify-content: space-around;
      margin: 20px 0;
    }

    /* Styling for individual vaccine sections */
    .vaccine {
      text-align: center;
      width: 30%;
      display: flex;
      flex-direction: column;
    }

    /* Styling for vaccine images */
    .vaccine img {
      width: 99%;
      height: 200px;
      /* Adjust this value as needed for the desired height */
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
      transition: transform 0.3s ease-in-out;
      /* Transition effect */
    }

    /* Hover effect for images */
    .vaccine img:hover {
      transform: scale(1.1);
      /* Increase size on hover (adjust as desired) */
    }

    /* Styling for vaccine headings */
    .vaccine h2 {
      font-size: 1.5em;
      margin-bottom: 5px;
    }

    /* Styling for vaccine descriptions */
    .vaccine p {
      font-size: 1em;
      line-height: 1.4;
    }

    /* Styling for vaccine paragraph */
    .vaccine-paragraph {
      font-size: 1.3em;
      line-height: 1.6;
      max-width: 70%;
      margin: 20px 0 0 200px;
      text-align: center;
    }

    .grid-container {

      display: grid;
      grid-template-columns: repeat(3, 1fr);
      /* Three columns */
      gap: 20px;
      /* Gap between grid items */
      padding: 20px;
    }

    .grid-item {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .info-heading,
    .vaccine-heading,
    .data {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .grid1 {
      background-color: #549895;
      border: 1px solid black;
    }

    .grid2 {
      background-color: #8EBCB1;
      border: 1px solid black;
    }

    .grid3 {
      background-color: #95C4B4;
      border: 1px solid black;
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


    <br>
    <div class="banner">
      <h1>Welcome to Hospital Portal</h1>
    </div>

    <br>
    <p class="vaccine-paragraph">Vaccination plays a crucial role in preventing infectious diseases, protecting
      individuals and communities from severe illnesses, and contributing to public health. It helps build immunity,
      reducing the spread of harmful viruses and ensuring a healthier future for everyone.</p>
    <br><br>

    <h1 class="info-heading">INFORMATION ABOUT HOSPITAL</h1>

    <div class="grid-container">
      <div class="grid-item">
        <div class="grid1">
          <br>
          <h3 class="data">Total Visitors:
            <?php echo $totalParents; ?>
          </h3>
          <br>
        </div>
      </div>

      <div class="grid-item">
        <div class="grid2">
          <br>
          <h3 class="data">
            <?php echo $user; ?> Patients:
            <?php echo $hospitalParents; ?>
          </h3>
          <br>
        </div>
      </div>

      <div class="grid-item">
        <div class="grid3">
          <br>
          <h3 class="data"> Vaccinated Patients:
            <?php echo $vaccinatedParents; ?>
          </h3>
          <br>
        </div>
      </div>
    </div>

    <h1 class="vaccine-heading">VACCINES</h1>
    <br>
    <div class="info">
      <div class="vaccine">
        <img src="images/polio-vaccine.webp" alt="Vaccine 1">
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo nobis repudiandae esse.</p>
      </div>

      <div class="vaccine">
        <img src="images/flu.jfif" alt="Vaccine 2">
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo nobis repudiandae esse.</p>
      </div>

      <div class="vaccine">
        <img src="images/images.jfif" alt="Vaccine 3">
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo nobis repudiandae esse.</p>
      </div>
    </div>

    <br><br><br><br><br><br><br><br>
    <?php
    include("footer.php");
    ?>
  </body>

  </html>
  <?php
}
;
?>