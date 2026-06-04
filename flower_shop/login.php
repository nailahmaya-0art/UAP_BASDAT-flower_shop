<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,
    "SELECT * FROM admin
    WHERE email='$email'
    AND password='$password'");

    if(mysqli_num_rows($query) > 0){

        $_SESSION['login'] = true;
        header("Location: dashboard.php");
        exit;

    }else{
        echo "<script>alert('Email atau Password salah!')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Admin</title>

<style>
body{
    font-family: Arial;
    background:#fff5f8;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.login-box{
    background:white;
    padding:30px;
    border-radius:15px;
    width:350px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

h2{
    text-align:center;
    color:#d63384;
}

input{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
}

button{
    width:100%;
    padding:10px;
    background:#ff69b4;
    color:white;
    border:none;
    border-radius:5px;
}
</style>
</head>

<body>

<div class="login-box">

<h2> Login Admin </h2>

<form method="POST">

Email
<input type="email" name="email" required>

Password
<input type="password" name="password" required>

<button name="login">Login</button>

</form>

</div>

</body>
</html>