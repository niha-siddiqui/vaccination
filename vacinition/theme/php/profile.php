<?php
include ('connection.php');

session_start();
$new = $_SESSION['name'];
$query = "Select * from hospital where user_name = '$new' ";
$result = mysqli_query($connection, $query );



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <?php
if ($result) {
  $row = mysqli_fetch_assoc($result);
} else {
  $vaccinatedParents = 0; 
}
?>
 <h3 class="hospital-data"> Hospital id : <?php echo $row['hospital_id']?></h3>
 <h3 class="hospital-data"> Hospital Name : <?php echo $row['user_name']?></h3>
 <h3 class="hospital-data"> Location : <?php echo $row['hospital_location']?></h3>
 <h3 class="hospital-data"> Contact Number : <?php echo $row['hospital_number']?></h3>
 <h3 class="hospital-data"> Number Of Departments : <?php echo $row['number_of_departments']?></h3>
 <h3 class="hospital-data"> Email Address : <?php echo $row['user_email']?></h3>

</body>
</html>