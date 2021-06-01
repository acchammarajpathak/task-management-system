<?php
include("includes/header.php");

if(isset($_SESSION["user"])) {
  $role = $_SESSION['role'];
  header("Location: $role/");
}

include("functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
  
  include("includes/conn.php");
  $email = $_POST["email"];
  $password = $_POST["password"];
  $err = false;
  $email_err = $password_err = $non_err = "";
  
  if (empty($email)) {

     $err = true;
     $email_err = "Email is required";

   } else {

     $email = test_input($email);

     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $err = true;
      $email_err = "Invalid email format";
     }

   }
  
   if (empty($password)) {

     $err = true;
     $password_err = "Password is required";

   }
  
   if(!$err) {
     
       $sql = "SELECT * from users WHERE email = '$email' AND is_active = 1;";
       
       $result = mysqli_query($conn, $sql);
       
       if(mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        $db_password = $row["password"];

        if(md5($password) == $db_password) {

          $_SESSION['user'] = $row['user_id'];
          $role = $_SESSION['role'] = $row['role'];

          header("Location:  $role/");

        } else {

          $non_err = "Password mistake";

        }


       } else {

         $non_err = "User doesnot exist";

       }
  
   }

}
?>




<!-- 
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../img/logo.png" class="logo"></a>
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
          <a class="nav-link text-light" aria-current="page" href="#">Home </a>
        </li>
      </ul>
    </div>
  </div>
</nav> -->



<div class="container my-5 py-5">


  <form class="mb-3 mx-auto my-5" style="width:500px;"  novalidate action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">

    <?php
      if(!empty($non_err)) {
      echo "<div class='alert alert-danger'>" . $non_err . "</div>";
    }
    ?>

    <div class="mb-3 ">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" name="email"  <?php if(isset($email)) { echo "value='$email'"; } ?>  aria-describedby="emailHelp">
      <?php
      if(isset($email_err)) {
        echo "<div class='text-danger'>" . $email_err . "</div>";
      }
      ?>
    </div>

    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
      <?php
      if(isset($password_err)) {
        echo "<div class='text-danger'>" . $password_err . "</div>";
      }
      ?>
    </div>

    <div class="mb-3">
      New Here? <a href="../register.php">Register</a> | <a href="#">Forget Password?</a>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>

  </form>

</div>




<?php 
include("includes/footer.php");
?>