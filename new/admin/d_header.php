<?php
session_start();
if(!isset($_SESSION["user"])) {
	header("Location: ../index.php");
}

include('../../includes/conn.php');

$user = $_SESSION["user"];
$sql = "SELECT * from users WHERE user_id = '$user';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>

<html>
<head>
	<title>Admin Panel | Employee Management System</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" href="styleemplogin.css">
	
	 <!-- Icons font CSS-->
	 <link href="../../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../../vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

</head>
<body>
	





	
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../../img/logo.png" class="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-center d-flex" style="width:80%;">
        <li class="display-5 text-light nav-item">
          TMS
        </li>
      </ul>
	  <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-light" aria-current="page" href="#">Welcome <?php print($row['firstname']); ?> </a>
        </li>
      </ul>
    </div>
  </div>
</nav>



<div class="container">
	<div class="row">
		<div class="col-2">
		
			<section id="header">
				<div class="header container">
					<div class="nav-bar">
						<ul class="nav flex-column">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="index.php">HOME</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="../../register.php">Add</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="viewemp.php">Employees</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="viewuser.php">Users</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="viewadmin.php">Admins</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="task.php">Task</a>
							</li> 
							<li class="nav-item">
								<a class="nav-link" href="assigntask.php">Assign Task</a>
							</li> 
							<li class="nav-item">
								<a class="nav-link" href="taskstatus.php">Task Status</a>
							</li> 
							<li class="nav-item">
								<a class="nav-link" href="salary.php">Salary Table</a>
							</li> 
							<li class="nav-item">
								<a class="nav-link" href="empleave.php">Employee Leave</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="logout.php">Logout</a>
							</li>
						</ul>
					</div>
				</div>
			</section>
		
		</div>
		<div class="col-10">