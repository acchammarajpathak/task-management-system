<?php
session_start();
include("functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
  
  include("../includes/conn.php");
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
     
       $sql = "SELECT * from users WHERE email = '$email' AND password = '$password';";
       
       $result = mysqli_query($conn, $sql);
       
       if(mysqli_num_rows($result) > 0) {

        $_SESSION['user'] = $email;
        header("Location: dashboard/");

       } else {

         $non_err = "User doesnot exist";

       }
  
   }

}
?>





<?php 
include("includes/header.php");
?>

<!-- Header -->
<section id="header">
  <div class="header container">
    <div class="nav-bar">
      <div class="brand">
        <a href="#hero"><img src="../img/logo.png" class="logo"></a>
      </div>
      <div class="nav-list">
        <div class="hamburger">
          <div class="bar"></div>
        </div>
        <ul>
          <li><a href="/201itp/" data-after="Home">Home</a></li>
          <li><a href="">User</a></li>
        </ul>
      </div>
      </ul>
    </div>
  </div>
  </div>
</section>
<!-- End Header -->


<!-- Login Section -->
<section id="login">
  <div class="login container">
    <div class="content">
      <div class="text">User Login Form</div>

      <?php
      if(isset($non_err)) {
        echo "<div>" . $non_err . "</div>";
      }
      ?>

      <form novalidate action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="POST">

        <div class="field">
          <input type="text" name="email" required>
          <span class="fas fa-user"></span>
          <label>Email</label>
        </div>

          <?php
          if(isset($email_err)) {
            echo "<div>" . $email_err . "</div>";
          }
          ?>

        <div class="field">
          <input type="password" name="password" required>
          <span class="fas fa-lock"></span>
          <label>Password</label>
        </div>

          <?php
          if(isset($password_err)) {
            echo "<div>" . $password_err . "</div>";
          }
          ?>

        <div class="forgot-pass">
          <a href="#">Forgot Password?</a>
        </div>

        <button>Sign in</button>

        <div class="sign-up">
          Not a member?
          <a href="#register">signup now</a>
        </div>

      </form>
    </div>
  </div>
</section>
<!-- End Login Section -->


<?php 
include("includes/footer.php");
?>