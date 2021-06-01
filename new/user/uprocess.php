<?php

require_once ('../includes/conn.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * from users WHERE email = '$email' AND password = '$password'";


$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) >0){
	

	//echo ("logged in");
	header("Location: uloginwel.php");
}

else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Invalid Email or Password')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}
?>