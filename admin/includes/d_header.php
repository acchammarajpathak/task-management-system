<?php
session_start();
if(!isset($_SESSION["user"])) {
	header("Location: ../index.php");
}

include('../includes/conn.php');

$user = $_SESSION["user"];
$sql = "SELECT * from users WHERE user_id = '$user';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>

<html>
<head>
	<title>Admin Panel | Employee Management System</title>
	
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	
	<script src="../js/jquery.js"></script>


</head>
<body>
	

	
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../img/logo.png" class="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-center d-flex" style="width:80%;">
        <li class="display-5 text-light nav-item">
          Task Management System
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

<br>

<div class="container">
	<div class="row">
		<div class="col-2">
		
			<section id="header">
				<div class="header container">
					<div class="nav-bar">
						<ul class="nav flex-column">
							<li class="nav-item">
								<a class="btn btn-secondary border border-light nav-link" href="index.php">HOME</a>
							</li>
							<li class="nav-item">
								<a class="btn btn-secondary border border-light nav-link" href="add.php">Add</a>
							</li>

							<li class="nav-item">
								
								<div class="dropdown">
								<button class="btn w-100 btn-secondary border border-light dropdown-toggle" type="button" id="test" data-bs-toggle="dropdown" aria-expanded="false">
									View
								</button>
								<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="test">
									<li><a class="dropdown-item" href="view.php?role=admin">Admin</a></li>
									<li><a class="dropdown-item" href="view.php?role=employee">Employee</a></li>
									<li><a class="dropdown-item" href="view.php?role=user">Users</a></li>
								</ul>
								</div>

							</li>

							<li class="nav-item">
								
							<div class="dropdown">
								<button class="btn w-100 btn-secondary border border-light dropdown-toggle" type="button" id="test2" data-bs-toggle="dropdown" aria-expanded="false">
									Task
								</button>
								<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="test2">
									<li><a class="dropdown-item" href="taskinfo.php">Info</a></li>
									<li><a class="dropdown-item" href="assigntask.php">Assign</a></li>
									<li><a class="dropdown-item" href="taskstatus.php">Status</a></li>
								</ul>
								</div>
	
							</li> 

							<li class="nav-item">
								<a class="btn btn-secondary border border-light nav-link" href="salary.php">Salary Table</a>
							</li> 
							<li class="nav-item">
								<a class="btn btn-secondary border border-light nav-link" href="empleave.php">Employee Leave</a>
							</li>
							<li class="nav-item">
								<a class="btn btn-secondary border border-light nav-link" href="../logout.php">Logout</a>
							</li>
						</ul>
					</div>
				</div>
			</section>
		
		</div>
		<div class="col-10">