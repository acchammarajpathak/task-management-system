<?php

include("../includes/conn.php");
session_start();
ob_start();

$u_id = $_GET['id'];
$action = $_GET['action'];

if ($_SESSION['role'] == 'admin') {

    if ($action == 'approve') {
        $sql = "UPDATE emp_leave SET status = 'Approved' WHERE leave_id = $u_id;";  
    } else {
        $sql = "UPDATE emp_leave SET status = 'Denied' WHERE leave_id = $u_id;";  
    }

    $result = mysqli_query($conn, $sql);
    
    $turl = $_SERVER['HTTP_REFERER'];
    header("Location: $turl");

} else {

    echo 'Permission Denied!';
}



?>