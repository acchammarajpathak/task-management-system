<?php
session_start();
if(!isset($_SESSION["user"])) {
	header("Location: ../index.php");
}

require_once ('../../includes/conn.php');

$sql = "SELECT * from users WHERE email = 'test@gmail.com'";

//echo "$sql";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);


?>


<html>
<head>
	<title>Employee Panel | Employee Management System</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">

</head>
<body>
	
	<!-- Header -->
	<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../../img/logo.png" class="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-center d-flex" style="width:100%;">
        <li class="display-5 text-light nav-item">
          TMS
        </li>
      </ul>
	  <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Welcome <?php print($row['firstname']); ?></a>
        </li>
      </ul>
    </div>
  </div>
</nav>



<div class="container">
	<div class="row">
		<div class="col-4">


	
		<section id="header">
    		<div class="header container">
				<div class="nav-bar">
		
			
			
			
					
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.php">HOME</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" href="userprofile.php">My Profile</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" href="taskprice.php">Task Price</a>
							</li> 
							<li class="nav-item">
							<a class="nav-link" href="applytask.php">Given Task</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" href="payment.php">Payment</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" href="logout.php">Logout</a>
						</li>
					</ul>
					
			
          		</div>
			</div>
			
  		</section>
  </div>
<div class="col-8">