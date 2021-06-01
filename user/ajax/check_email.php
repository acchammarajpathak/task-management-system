<?php

include("../../includes/conn.php");

$email = $_REQUEST["email"];

$sql = "SELECT email FROM users WHERE email = '$email';";
$res = mysqli_query($conn, $sql);

$rows = mysqli_num_rows($res);

if($rows > 0) {
    echo '<span class="text-danger">User with this email already exists.</span>';
} else {
    echo '<span class="text-success">Email is available.</span>';
}

?>