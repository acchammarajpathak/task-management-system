<?php

include("../includes/conn.php");

$u_id = $_GET['id'];
$u_source = $_GET['source'];

$sql = "DELETE FROM users WHERE user_id = $u_id;";  

$result = mysqli_query($conn, $sql);

if($result) {
    $msg = 1;
} else {
    $msg = 0;
}

if ($u_source == 'dash') {
    $bits = explode('?',$_SERVER['HTTP_REFERRER']);
    $redirect = $bits[0];
    $turl = $redirect . "?delmsg=" . $msg;
} elseif ($u_source == 'page') {
    $turl = $_SERVER['HTTP_REFERER'] . "&delmsg=" . $msg;
} else {
    $turl = $_SERVER['HTTP_REFERER'];
}

header("Location: $turl");

?>