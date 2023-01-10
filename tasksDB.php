<?php

// $servername = "localhost";
// $username = "root";
// $password = "";
// // Create connection
// $conn = new mysqli($servername, $username, $password);
// // Check connection
// if ($conn->connect_error)
//     die("Connection failed: " . $conn->connect_error);

// $dbName = "users";
// if (!mysqli_select_db($conn,$dbName)){ // בודק עם מסד הנתונים לא קיים כבר
//     $sql = "CREATE DATABASE $dbName";
//     if ($conn->query($sql) === TRUE) {
//         echo "Database created successfully";
//     }else {
//         echo "Error creating database: " . $conn->error;
//     }
// }

// // if database already exist contiune

// $conn = new mysqli($servername, $username, $password, $dbName);

// $sql =" SELECT id FROM tasks ";
// if (!$conn->query($sql)){
//     $sql = "CREATE TABLE tasks(taskID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//      `taskUserEmail` VARCHAR(30),`taskName` VARCHAR(30), `taskWriter` VARCHAR(30), `deadline` VARCHAR(30), 
//      `finished` tinyint(1));";
//     if ($conn->query($sql) === TRUE) {
//         echo "Table Customers created successfully";
//     } else {
//         echo "Error creating table: " . $conn->error;
//     }
// }


?>