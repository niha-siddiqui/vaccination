<?php 
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body style="background-color: rgb(228, 247, 248);">
    <!-- image -->
<img src="pictures/thinking1.png" height="77%" width="33%" style="position: fixed;top: 10%; right: 60%;">
<!-- form -->
<div class="login-box" style="width: 350px;position: fixed;top: 30%; left: 56%;height: 500px;" >

    <form action="" method="post">
    <h3 style="position: fixed;top:20%; left: 59%;"> LOG-IN YOURSELF !</h3>
        <input type="text" class="form-control mt-1" name="user" placeholder="user_name" required >
      
        <input type="password"class="form-control mt-1" name ="pass" placeholder="password" required >
        <br><br>
        <button type= "submit" name="login" class="form-control mt-1 btn-warning"> log-in</button>
    </form>
    <p style="font-size: 16px; margin-top: 20px;">Don't Have An Account?<a href="index.php"> SIGN-UP</a> Now..</p>
    <br>
</div>
    <?php
    session_start();
    if(isset($_POST['login'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $query = mysqli_query ($connection , "select * from hospital where user_name = '$user' AND user_password = '$pass'");

     if($query-> num_rows >0){
        echo "hello";
        $_SESSION['name'] = $user;
        header("Location:hospital.php");

     }  
     else{
        echo"login failed";
     } 
    }
 
    
    ?>
    
</body>
</html>