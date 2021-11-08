<?php
session_start();

include('connection.php');

if(isset($_POST['submit'])){

    $username = $_POST['user'];  
    $password = $_POST['pass'];
    //to prevent from mysqli injection  
    $username = stripcslashes($username);  
    $password = stripcslashes($password);  
    $username = mysqli_real_escape_string($con, $username);  
    $password = mysqli_real_escape_string($con, $password);  
  
    $sql = "SELECT * from pass where UserName = '$username' and Password = '$password'";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_assoc($result);  
    $count = mysqli_num_rows($result);  
    
    if($count == 1 and $username=="Tarun Singh"){
        $_SESSION['user']=$row['UserName'];
        $_SESSION['id']=$row['ID']; 
        if ($password=='cyrus@1234') {
            header("location: changepass.php?");
            //echo "loged in successfully" ;       
        }else{
         header("location: home.php");
       }
    }else{  
        echo '<script>alert("Invalid Username or Password")</script>';
    } 
}

?>



<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Anant Singh Suryavanshi">
        <title>Login</title>
        <link rel="icon" href="cyrus logo.png" type="image/icon type">
        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/index.css" rel="stylesheet">
    </head>
    <body class="text-center">
        <main class="form-signin">
            <form method="POST" accept="">
                <img class="mb-4" src="cyrus logo.png" alt="" width="72" height="100">
                <h1 class="h3 mb-3 fw-normal" align="center">Welcome to Cyrus</h1>
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                <label for="inputEmail" class="visually-hidden">User Name</label>
                <input type="text" id="username" class="form-control" placeholder="User Name" required="" autofocus="" name="user">
                <label for="inputPassword" class="visually-hidden">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="pass">
                <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign in</button>
                <p class="mt-5 mb-3 text-muted">2021 © Cyrus Electronics Pvt. Ltd.</p>
            </form>
        </main>
        <script src="assets/js/popper.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
