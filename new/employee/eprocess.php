<?php

require_once ('../includes/conn.php');

$Email = $_POST['email'];
$Password = $_POST['password'];

$sql = "SELECT * from employee WHERE email = '$Email' AND password = '$Password'";

//echo "$sql";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) >0){
	

	//echo ("logged in");
	header("Location: ../employee/eloginwel.php");
}

else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Invalid Email or Password')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}
?>