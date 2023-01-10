<?php require_once("header.php");?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/style.css" />
    <title>SignIn</title>
  </head>
  <body class="p-3 mb-2 bg-dark text-white">
    <!-- <header>
      <h2 id="logo">EZM</h2>
    </header> -->

    <form method="POST">
      <div class="container">
        <h1 id="signIn">Sign In</h1>
      </div>

      <div class="container">
        <input
          type="email"
          placeholder="Email"
          name="uname"
          id="email_input"
          required
        />

        <span id="invalid_email" style="color:red;"> </span>

        <input
          type="password"
          placeholder="Password"
          name="psw"
          id="pw_input"
          required
        />

        <span id="invalid_pw" style="color:red;"> </span>

        <button type="submit" id="loginBtn" name="login">Login</button>
        <button type="button" onclick="location.href='signUpForm.php'">
          Sign Up
        </button>

        <input type="checkbox" id="remember" name="remember">
        <label for="remember"> Remember me</label><br>

        <span class="psw"> <a href="pwReset.php"> Forgot password?</a></span>
      </div>
    </form>

    <!-- <footer>&copy; Copyright 2021 EZM Inc. All Rights Reserved.</footer> -->

    <!-- <script src="js/signIn.js" type="text/javascript"></script> -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

<?php

if(isset($_POST['login']))
{
require_once("db.php");
$email = $_POST['uname'];
$pw = $_POST['psw'];

$sql = "SELECT * FROM accounts";
$result = $conn->query($sql);
$accounts = array();
while($row = $result->fetch_assoc()){
$accounts[]=$row;
}
$conn->close();


foreach ($accounts as $account){
    if($account['email'] == $email && $account['pw'] == $pw)
    {  
        if(isset($_POST['remember'])){
            setCookie('email', $email, strtotime("+1 day"));
            setCookie('pw', $pw, strtotime("+1 day"));

        }

        session_start();
        $_SESSION['email'] = $email;
        header('Location: taskList.php');
        exit;
    }
}

$message = "Invalid Email or Password";
echo "<script type='text/javascript'>alert('$message');</script>";
}


if(isset($_COOKIE['email']) and isset($_COOKIE['pw']))
{
  $email = $_COOKIE['email'];
  $pw = $_COOKIE['pw'];
  echo "<script>
  document.getElementById('email_input').value = '$email';
  document.getElementById('pw_input').value = '$pw'; 
  </script>";
}


?>

<?php require_once("footer.php");?>
