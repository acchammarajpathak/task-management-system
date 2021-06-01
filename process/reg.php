<?php
	include("../includes/conn.php");

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$role = $_POST['role'];

	if($password == $confirmpassword) {

		$sql = "INSERT INTO $role (firstname, lastname, username, email, password, gender, phone, address)
		VALUES ('{$firstname}', '{$lastname}', '{$username}', '{$email}', '{$password}', '{$gender}', '{$phone}', '{$address}')";

		$res = mysqli_query($conn, $sql);

		if ($res) {
			echo "Registered successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

	} else {
		echo "Password do not match.";
	}

	
	


	?>