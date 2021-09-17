<?php

include("includes/conn.php");

if (isset($_GET['token'])) {

    $token = $_GET['token'];
    
    $sql = "select * from users where token = '$token';";
    
    $res = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($res) == 1) {
    
        $sql2 = "UPDATE users
        SET verified = 1
        WHERE token = '$token';";

        $res2 = mysqli_query($conn, $sql2); 
        
        if ($res2) {

            echo 'verified, you can now login.';
        } else {
            echo 'some error';
        }
    
    } else {
        echo ' user does not exist';
    }

} else {
    echo 'you dont have permission to view this page';
}

?>