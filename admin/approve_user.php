<?php

include("../includes/conn.php");
ob_start();

$u_id = $_GET['id'];

$sql = "UPDATE users SET is_active = 1 WHERE user_id = $u_id;";  

$result = mysqli_query($conn, $sql);

if($result) {
    $msg = 1;
} else {
    $msg = 0;
}

$turl = $_SERVER['HTTP_REFERER'] . "?approvemsg=" . $msg;
header("Location: $turl");

?>