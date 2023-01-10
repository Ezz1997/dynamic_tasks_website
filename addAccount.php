<?php


// require_once("db.php");
// $reg_userName = $_POST['regUserName'];
// $reg_email = $_POST['register_email'];
// $conf_email = $_POST['confirm_email'];
// $reg_pw = $_POST['register_pw'];
// $conf_pw = $_POST['confirm_pw'];

// $sql = "SELECT * FROM accounts";
// $result = $conn->query($sql);
// $accounts = array();
// while($row = $result->fetch_assoc()){
// $accounts[]=$row;
// }
// $conn->close();

// $email_exists = false;

// if(($reg_email == $conf_email) && ($reg_pw == $conf_pw))
// {
//     foreach ($accounts as $account){
//         if($account['email'] == $reg_email)
//         {  
//             $email_exists = true;
//             break;
//         }
//     }

//     if($email_exists == true)
//     {
//         $message = "Email Already Exists!";
//         echo "<script type='text/javascript'>alert('$message');</script>";
        
        
//     }else{
//         $sql = "INSERT INTO `accounts`( `userName`, `email`, `pw`)
//         VALUES ('$reg_userName','$reg_email','$reg_pw')";
//         if ($conn->query($sql)===TRUE) {
//         $last_id = $conn->insert_id;
//         echo json_encode(array('success' => 1,"id"=>$last_id));
//         header('Location: signInForm.php');
//         exit;
//         }else {
//         echo json_encode(array('success' => 0));
//         echo "Something went wrong";
//         header('Location: signUpForm.php');
//         exit;

//         }

//         $conn->close();
//     }

// }else{
//     if($reg_email != $conf_email)
//     {
//         $message = "Emails don't match";
//         echo "<script type='text/javascript'>alert('$message');</script>";
//     }

//     if($reg_pw != $conf_pw)
//     {
//         $message = "Passwords don't match";
//         echo "<script type='text/javascript'>alert('$message');</script>"; 
//     }

//     header('Location: signUpForm.php');
//     exit;
// }

?>
