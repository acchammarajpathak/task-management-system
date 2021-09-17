<?php

include("includes/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $password1 = $_POST["password1"];
  $password2 = $_POST["password2"];
  $temp_token = $_POST["token"];

  if (empty($password1) or empty($password2)) {
    echo "Password is required.";
  } else {
    if ($password1 == $password2) {
      $uppercase = preg_match('@[A-Z]@', $password1);
      $lowercase = preg_match('@[a-z]@', $password1);
      $number    = preg_match('@[0-9]@', $password1);
      $specialChars = preg_match('@[^\w]@', $password1);
      if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password1) < 8) {
        echo "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
      } else {
        $password = md5($password1);
        $sql2 = "UPDATE users
        SET password = '$password'
        WHERE token = '$temp_token';";

        $res2 = mysqli_query($conn, $sql2); 
        
        if ($res2) {

            echo 'password changed.';
        } else {
            echo 'some error';
        }

      }
    } else {
     echo "Passwords does not match.";
    }
  }


}





if (isset($_GET['token'])) {

    $token = $_GET['token'];
    
    $sql = "select * from users where token = '$token';";
    
    $res = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($res) == 1) {

        ?>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type="password" name="password1">
            <input type="password" name="password2">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <button type="submit">Reset password</button>
             </form>

    <?php
    
    } else {
        echo ' user does not exist';
    }

}

?>