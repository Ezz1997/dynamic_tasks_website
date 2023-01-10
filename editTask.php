<?php
require_once('db.php');
session_start();

$id = $_POST["id"];
$writer_email = $_SESSION['email'];
$task_name = $_POST['titleInputEdit'];
$writer_name = $_POST['writerInputEdit'];
$deadline = $_POST['dateInputEdit'];

echo $task_name;
echo $writer_name;
echo $deadline; 


$sql = "UPDATE `tasks` SET `taskUserEmail`='$writer_email',`taskName`='$task_name',`taskWriter`='$writer_name',`deadline`='$deadline',`finished`='0' WHERE taskID=$id";
if ($conn->query($sql)===TRUE) {
    echo json_encode(array('success' => 1));
}else {
    echo json_encode(array('success' => 0));
}

$conn->close();

?>