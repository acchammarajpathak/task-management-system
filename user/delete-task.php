<?php
include("includes/d_header.php");

$task_id = $_GET['task'];
$user_id = $_SESSION['user'];

$sql = "UPDATE task
set status = 'Canceled'
where task_id = '$task_id' AND user_id = '$user_id';";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        header('Location: index.php?success=1');
    } else {
        echo '<div class="alert alert-danger">CANCEL Error.</div>';
    }

?>