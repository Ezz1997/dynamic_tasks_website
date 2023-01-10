<?php
session_start();
$resetPwEmail = $_SESSION['confirmed_email'];
$new_pw = $_SESSION['new_pw'];

require_once("db.php");

$sql = "UPDATE `accounts`
SET `pw`='$new_pw'
    WHERE `email`='$resetPwEmail'";
if ($conn->query($sql)===TRUE) {
    echo json_encode(array('success' => 1));
}else {
    echo json_encode(array('success' => 0));
}

?>