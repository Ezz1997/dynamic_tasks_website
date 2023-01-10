<?php

session_start();
session_destroy();

$email = $_COOKIE['email'];
$pw = $_COOKIE['pw'];

setCookie('email', $email, strtotime("-1 day"));
setCookie('pw', $pw, strtotime("-1 day"));

header('Location: signInForm.php');
exit;
?>