<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    include("includes/conn.php");
    $email = $_POST["email"];

    $sql = "SELECT * from users WHERE email = '$email' AND is_active = 1 AND verified = 1;";
       
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) {

         // generates random string
         $rand_token = openssl_random_pseudo_bytes(16);
         //change binary to hexadecimal
         $token = bin2hex($rand_token);
     
         $sql = "UPDATE users 
         SET token = '$token'
         WHERE email = '$email';";
 
         $result = mysqli_query($conn, $sql);
 
         $verify_link = "http://localhost/201itp/reset-password.php?token=" . $token;
 
         $txt = "Hi User! To reset password of user having email: " . $email . ", <a href=\"" . $verify_link . "\">Click Here</a>";
 
         mail($email, "Reset Password", $txt, null);

         echo "Check your email";

    } else {
        echo "user does not exist";
    }

} else {

    ?>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>"  method ="POST">
<input type="email" name="email">
<button type="Submit">Reset Password</button>
</form>

<?php

}


?>