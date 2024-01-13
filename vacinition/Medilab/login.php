<?php
include('config.php');
session_start();
if (isset($_POST['login'])) {
    $email=$_POST['email'];
    $pass=$_POST['pass'];

    $query = mysqli_query($connection, "select * from parents where email ='$email' and password =  '$pass'");
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['parent'] = $data['parent_id'];
        header("location:index.php");
    } else {
        echo "<script>alert('Email or password is incorrect')</script>";
    }
}
?>
<div class="container d-flex justif-content-center align-items-center">
    <form action="#" class="form-control" method="post">
        <input type="emial" name="email" placeholder="enter your email" required class="form-control mt-3">
        <input type="password" min="8" name="pass" placeholder="enter your password" required
            class="form-control mt-3">
        <input type="submit" value="Login" name="login" class="btn btn-success mt-3">
    </form>
</div>