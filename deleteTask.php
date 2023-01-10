<?php

require_once('db.php');
$id=$_POST['id'];
$sql = "DELETE FROM tasks WHERE taskID=$id";
if ($conn->query($sql)===TRUE) {
    echo json_encode(array('success' => 1));
}else {
    echo json_encode(array('success' => 0));
}


?>