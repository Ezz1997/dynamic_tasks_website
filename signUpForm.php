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
    <title>SignUp</title>
  </head>
  <body class="p-3 mb-2 bg-dark text-white">
    <!-- <header>
      <h2 id="logo">EZM</h2>
    </header> -->

    <form method="POST">
      <div class="container">
        <h1 id="signUp">SignUp</h1>
      </div>

      <div class="container">
        <input type="text" placeholder="Username" id="userName" name="regUserName" required />
        <input type="email" placeholder="Email" id="register_email" name="register_email" required />
        <span id="invalid_email"></span>
        <input
          type="email"
          placeholder="Confirm Email"
          id="confirm_email"
          name="confirm_email"
          required
        />
        <span id="invalid_conf_mail"></span>

        <input
          type="password"
          placeholder="Password"
          id="register_pw"
          name="register_pw"
          required
        />
        <span id="invalid_pw"></span>

        <input
          type="password"
          placeholder="Confirm Password"
          id="confirm_pw"
          name="confirm_pw"
          required
        />
        <span id="invalid_conf_pw"></span>

        <button type="submit" id="registerBtn">Register</button>
      </div>
    </form>

    <!-- <footer>&copy; Copyright 2021 EZM Inc. All Rights Reserved.</footer> -->

    <script src="js/signUp.js" type="text/javascript"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

<?php
require_once("db.php");

if(isset($_POST['regUserName']) && isset($_POST['register_email']) && isset($_POST['confirm_email']) &&
isset($_POST['register_pw']) && isset($_POST['confirm_pw']))
{
  $reg_userName = $_POST['regUserName'];
  $reg_email = $_POST['register_email'];
  $conf_email = $_POST['confirm_email'];
  $reg_pw = $_POST['register_pw'];
  $conf_pw = $_POST['confirm_pw'];
  
  $sql = "SELECT * FROM accounts";
  $result = $conn->query($sql);
  $accounts = array();
  while($row = $result->fetch_assoc()){
  $accounts[]=$row;
  }
  // $conn->close();
  
  $email_exists = false;
  
  if(($reg_email == $conf_email) && ($reg_pw == $conf_pw))
  {
      foreach ($accounts as $account){
          if($account['email'] == $reg_email)
          {  
              $email_exists = true;
              break;
          }
      }
  
      if($email_exists == true)
      {
          $message = "Email Already Exists!";
          echo "<script type='text/javascript'>alert('$message');</script>";      
      }else{
          $sql = "INSERT INTO `accounts`( `userName`, `email`, `pw`)
          VALUES ('$reg_userName','$reg_email','$reg_pw')";
          if ($conn->query($sql)===TRUE) {
          $last_id = $conn->insert_id;
          // echo json_encode(array('success' => 1,"id"=>$last_id));
          $message = "Account Created Successfully!";
          echo "<script type='text/javascript'>alert('$message');</script>";  
          // header('Location: signInForm.php');
          // exit;
          }else {
          // echo json_encode(array('success' => 0));
          echo "Something went wrong";
          // header('Location: signUpForm.php');
          // exit;
  
          }
  
          $conn->close();
      }
  
  }else{
      if($reg_email != $conf_email)
      {
          $message = "Emails don't match";
          echo "<script type='text/javascript'>alert('$message');</script>";
      }
  
      if($reg_pw != $conf_pw)
      {
          $message = "Passwords don't match";
          echo "<script type='text/javascript'>alert('$message');</script>"; 
      }
  
      header('Location: signUpForm.php');
      exit;
  }
}

?>

<?php require_once("footer.php");?>
