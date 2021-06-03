<?php

include("../includes/conn.php");
ob_start();

$u_id = $_GET['id'];

$sql = "UPDATE task SET status = 'Completed', sub_date = now() WHERE task_id = $u_id;";  

$result = mysqli_query($conn, $sql);

$turl = $_SERVER['HTTP_REFERER'];
header("Location: $turl");

?>