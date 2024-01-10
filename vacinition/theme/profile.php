<?php
include ('connection.php');

session_start();
$new = $_SESSION['name'];
$query = "Select * from hospital where user_name = '$new' ";
$result = mysqli_query($connection, $query );


if(!isset($_SESSION['name'])){
  header("location:login.php");
};

include("header.php");
 
if(isset($_POST['logout'])){
  session_destroy();
  header("location:login.php");


}
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
<div class="center" style= "position: absolute;top:150px; left:400px; background-color:#012f5ddf;width: 40%; height: 450px;margin-right:;50px; box-shadow:8px 8px 8px black;color:white;">
 
<br><br>
 <h3 class="hospital-data text-center"> Hospital id : <?php echo $row['hospital_id']?></h3><br>
 <h3 class="hospital-data text-center"> Hospital Name : <?php echo $row['user_name']?></h3><br>
 <h3 class="hospital-data text-center"> Location : <?php echo $row['hospital_location']?></h3><br>
 <h3 class="hospital-data text-center"> Contact Number : <?php echo $row['hospital_number']?></h3><br>
 <h3 class="hospital-data text-center"> Number Of Departments : <?php echo $row['number_of_departments']?></h3><br>
 <h3 class="hospital-data text-center"> Email Address : <?php echo $row['user_email']?></h3><br>
</div>
<br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br>
<?php
include("footer.php");?>
</body>
</html>