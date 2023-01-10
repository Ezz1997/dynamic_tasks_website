<?php
require_once("db.php");
session_start();
$writer_email = $_SESSION['email'];
$task_name = $_POST['titleInput'];
$writer_name = $_POST['writerInput'];
$deadline = $_POST['dateInput'];

$sql = "INSERT INTO `tasks`(`taskUserEmail`, `taskName`, `taskWriter`, `deadline`, `finished`) 
VALUES ('$writer_email','$task_name','$writer_name','$deadline','0')";
if ($conn->query($sql)===TRUE) {
    $last_id = $conn->insert_id;
    echo json_encode(array('success' => 1,"id"=>$last_id));
}else {
    echo json_encode(array('success' => 0));
}

$conn->close();

?>