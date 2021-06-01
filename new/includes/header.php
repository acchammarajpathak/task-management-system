<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="vendor/fontawesome/css/all.css">
  <title>201IT</title>

  <script src="js/jquery.js"></script>
</head>

<body>




<nav class="navbar lead navbar-expand-lg navbar-dark bg-secondary" style="font-size: 25px;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="img/logo.png" class="logo"></a> <span class="text-light fw-bold display-6">Task Management System</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-5 me-auto mb-2 mb-lg-0">

        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
        <li class="nav-item"><a class="nav-link" href="projects.php">Projects</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
       

      </ul>

      <ul class="navbar-nav mx-5  mb-2 mb-lg-0">

      <?php
      if(isset($_SESSION['user'])) {
        ?>
          <li class="nav-item"><a class="nav-link" href="<?php echo $_SESSION['role'] . '/'; ?>">Dashboard</a></li>

        <?php
      } else {
        ?>
          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>

          <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Login
            </a>

            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="employee/">Employee</a></li>
              <li><a class="dropdown-item" href="user/">User</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="admin/">Admin</a></li>
            </ul>
          </li>

        <?php
      }
      ?>

      </ul>

  

    </div>
  </div>
</nav>