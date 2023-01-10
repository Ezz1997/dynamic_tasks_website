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
    <title>Password Reset</title>
  </head>
  <body class="p-3 mb-2 bg-dark text-white">
    <!-- <header>
      <h2 id="logo">EZM</h2>
    </header> -->

    <form method="POST">
      <div class="container">
        <h1 id="resetPw">Passowrd Reset</h1>
      </div>

      <div class="container">
        <input type="password" placeholder="New Password" required id="new_pw" name="new_pw"/>
        <input type="password" placeholder="Confirm New Password" required id="new_pw_conf" name="new_pw_conf"/>

        <button type="submit" id="resetBtn" name="resetBtn">Reset Password</button>
      </div>
    </form>

    <!-- <footer>&copy; Copyright 2021 EZM Inc. All Rights Reserved.</footer> -->

    <!-- <script src="js/resetPw.js" type="text/javascript"></script> -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
      crossorigin="anonymous"
    ></script>
  </body>
</html>


<?php

session_start();

if(isset($_POST['resetBtn'])){
    require_once("db.php");
    $new_pw = $_POST['new_pw'];
    $new_pw_conf = $_POST['new_pw_conf'];
    $resetPwEmail = $_SESSION['confirmed_email'];


    if($new_pw == $new_pw_conf)
    {
        $_SESSION['new_pw'] = $new_pw;  
        header('Location: update_DB_PW.php');
        exit;
    }
    // $sql = "SELECT * FROM accounts";
    // $result = $conn->query($sql);
    // $accounts = array();
    // while($row = $result->fetch_assoc()){
    // $accounts[]=$row;
    // }
    // $conn->close();
    
    
    // foreach ($accounts as $account){
    //     if($account['email'] == $resetPwEmail)
    //     {   
    //         header('Location: test.php');
    //         exit;
    //     }
    // }
   
  }

?>

<br>
<br><br><br>

<?php require_once("footer.php");?>
