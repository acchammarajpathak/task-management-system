<?php
include("functions.php");
include("includes/header.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
  
  include("includes/conn.php");

  $firstname = test_input($_POST["firstname"]);
  $lastname = test_input($_POST["lastname"]);
  $email = test_input($_POST["email"]);
  $password1 = $_POST["password1"];
  $password2 = $_POST["password2"];
  $birthday = test_input($_POST["birthday"]);
  $gender = test_input($_POST["gender"]);
  $contact = test_input($_POST["contact"]);
  $address = test_input($_POST["address"]);
  $department = test_input($_POST["department"]);
  $degree = test_input($_POST["degree"]);
  $pic = $_FILES["pic"];
  $role = test_input($_POST["role"]);

  if(isset($_SESSION['role']) == "admin") {
    $is_active = 1;
  } else {
    $is_active = 0;
  }

  $err = false;
  // $role_err = $address_err = $degree_err = $department_err = $nid_err = $firstname_err = $contact_err = $lastname_err = $gender_err = $birthday_err = $email_err = $password_err = $non_err = "";
  
  if (empty($role)) {
    $err = true;
    $role_err = "Role is required.";
  } else {
    $roles = array("admin", "employee", "user");
    if (!in_array($role, $roles)) {
      $err = true;
      $role_err = "Invalid Role.";
    }
  }

  if (empty($firstname)) {
    $err = true;
    $firstname_err = "First Name is required.";
  } else {
    $pattern = "/^([a-zA-Z' ]+)$/";
    if(!preg_match($pattern, $firstname)) {
      $err = true;
      $firstname_err = "Invalid First Name.";
    }
  }

  if (empty($lastname)) {
    $err = true;
    $lastname_err = "Last Name is required";
  } else {
    $pattern = "/^([a-zA-Z' ]+)$/";
    if(!preg_match($pattern, $lastname)) {
      $err = true;
      $lastname_err = "Invalid Last Name.";
    }
  }

  if (empty($email)) {
    $err = true;
    $email_err = "Email is required.";
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $err = true;
     $email_err = "Invalid Email.";
    }
    $em_sql = "SELECT email FROM users WHERE email = '$email';";
    $em_res = mysqli_query($conn, $em_sql);
    $em_rows = mysqli_num_rows($em_res);
    if($em_rows > 0) {
      $err = true;
      $email_err = "User with this email already exists.";
    }
  }

  if (empty($password1) or empty($password2)) {
    $err = true;
    $password_err = "Password is required.";
  } else {
    if ($password1 == $password2) {
      $uppercase = preg_match('@[A-Z]@', $password1);
      $lowercase = preg_match('@[a-z]@', $password1);
      $number    = preg_match('@[0-9]@', $password1);
      $specialChars = preg_match('@[^\w]@', $password1);
      if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password1) < 8) {
        $err= true;
        $password_err = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
      } else {
        $password = md5($password1);
      }
    } else {
     $err = true;
     $password_err = "Passwords does not match.";
    }
  }

  if (empty($birthday)) {
    $err = true;
    $birthday_err = "Birthday is required";
  }

  if (empty($gender)) {
    $err = true;
    $gender_err = "Gender is required";
  } else {
    $genders = array("m", "f", "o");
    if (!in_array($gender, $genders)) {
      $err = true;
      $gender_err = "Invalid Gender.";
    }
  }

  if (empty($contact)) {
    $err = true;
    $contact_err = "Contact is required";
  } else {
    if (!filter_var($contact, FILTER_VALIDATE_INT) or strlen((string)$contact) >= 11 or strlen((string)$contact) <= 8) {
     $err = true;
     $contact_err = "Invalid Contact.";
    }
  }

  if (empty($department)) {
    $err = true;
    $department_err = "Department is required";
  } else {
    $pattern = "/^([a-zA-Z' ]+)$/";
    if(!preg_match($pattern, $department)) {
      $err = true;
      $department_err = "Invalid Department.";
    }
  }

  if (empty($address)) {
    $err = true;
    $address_err = "Address is required";
  }

  if (empty($degree)) {
    $err = true;
    $degree_err = "Degree is required";
  } else {
    $pattern = "/^([a-zA-Z' ]+)$/";
    if(!preg_match($pattern, $degree)) {
      $err = true;
      $degree_err = "Invalid Degree.";
    }
  }
  
  if (empty($pic)) {
    $err = true;
    $pic_err = "Photo is required";
  } else {
    $target_dir = "img/uploads/";
    $source_file = $target_dir . basename($pic["name"]);
    $imageFileType = strtolower(pathinfo($source_file,PATHINFO_EXTENSION));
    $target_file = $target_dir . uniqid() . '.' . $imageFileType;
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      $err = true;
      $pic_err = "Invalid File.";
    }
  }

  if(!$err) {

      $upload = move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);
      if ($upload) {
    
        $sql = "INSERT INTO users (firstname, lastname, email, password, birthday, gender, contact, address, department, degree, pic, role, is_active)
        VALUES ('$firstname', '$lastname', '$email', '$password', '$birthday', '$gender', '$contact', '$address', '$department', '$degree', '$target_file', '$role', '$is_active');";  

        $result = mysqli_query($conn, $sql);

        if($result) {
          $succ_msg = "Successfully Registered!";
          if (!$is_active) {
            $succ_msg .= "Wait for approval.";
          }
        } else {
          $non_err = "Some Errors Occurred.";
        }

      } else {
        $non_err = "Some Errors Occurred.";
      }

   }

}

?>





<div class="container mt-3 border p-3 mb-5">

    <form novalidate class="row g-3" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
    <h1 class="text-center">Registration Info</h1>

      <?php
        if(isset($non_err)) {
          echo "<div class='alert alert-danger'>" . $non_err . "</div>";
        }
        if(isset($succ_msg)) {
          echo "<div class='alert alert-success'>" . $succ_msg . "</div>";
        }
      ?>

    <div class="col-3">
        <label for="role" class="form-label">Role</label>
        <select name="role" id="role" class="form-select" required>
            <option value="">Choose One</option>
            <option <?php if(isset($role) && $role == "admin") { echo "selected"; } ?> value="admin">Admin</option>
            <option <?php if(isset($role) && $role == "employee") { echo "selected"; } ?> value="employee">Employee</option>
            <option <?php if(isset($role) && $role == "user") { echo "selected"; } ?> value="user">User</option>
        </select>
        <?php
          if(isset($role_err)) {
            echo "<div class='text-danger'>" . $role_err . "</div>";
          }
        ?>
    </div>

    <div class="col-9"></div>

    <div class="col-md-6">
        <label for="firstname" class="form-label">First Name</label>
        <input <?php if(!empty($firstname)) { echo "value=" . $firstname; } ?> name="firstname" type="text" class="form-control" id="firstname" placeholder="First and Middle Name (if any)" required>
        <?php
          if(isset($firstname_err)) {
            echo "<div class='text-danger'>" . $firstname_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-6">
        <label for="lastname" class="form-label">Last Name</label>
        <input <?php if(!empty($lastname)) { echo "value=" . $lastname; } ?> name="lastname" type="text" class="form-control" id="lastname" required>
        <?php
          if(isset($lastname_err)) {
            echo "<div class='text-danger'>" . $lastname_err . "</div>";
          }
        ?>
    </div>

    <div class="col-12">
        <label for="email" class="form-label">Email</label>
        <input <?php if(!empty($email)) { echo "value=" . $email; } ?> name="email" type="email" class="form-control" id="email" required>
        <div id="emailDisplay">
        <?php
          if(isset($email_err)) {
            echo "<span class='text-danger'>" . $email_err . "</span>";
          }
        ?>
        </div>

    </div>

    <div class="col-md-6">
        <label for="password1" class="form-label">Password</label>
        <input name="password1" type="password" class="form-control" id="password1" required>
        <?php
          if(isset($password_err)) {
            echo "<div class='text-danger'>" . $password_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-6">
        <label for="password2" class="form-label">Confirm Password</label>
        <input name="password2" type="password" class="form-control" id="password2" required>
        <?php
          if(isset($password_err)) {
            echo "<div class='text-danger'>" . $password_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-6">
        <label for="birthday" class="form-label">Birthday</label>
        <input <?php if(!empty($birthday)) { echo "value=" . $birthday; } ?> name="birthday" type="date" class="form-control" id="birthday" required>
        <?php
          if(isset($birthday_err)) {
            echo "<div class='text-danger'>" . $birthday_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-6">
        <label for="gender" class="form-label">Gender</label>
        <select name="gender" id="gender" class="form-select" required>
        <option value="">Choose One</option>
        <option <?php if(isset($gender) && $gender == "m") { echo "selected"; } ?> value="m">Male</option>
        <option <?php if(isset($gender) && $gender == "f") { echo "selected"; } ?> value="f">Female</option>
        <option <?php if(isset($gender) && $gender == "o") { echo "selected"; } ?> value="o">Others</option>
        </select>
        <?php
          if(isset($gender_err)) {
            echo "<div class='text-danger'>" . $gender_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-6">
        <label for="contact" class="form-label">Contact</label>
        <input <?php if(!empty($contact)) { echo "value=" . $contact; } ?> name="contact" type="number" class="form-control" id="contact">
        <?php
          if(isset($contact_err)) {
            echo "<div class='text-danger'>" . $contact_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-6">
        <label for="department" class="form-label">Department</label>
        <input <?php if(!empty($department)) { echo "value=" . $department; } ?> name="department" type="text" class="form-control" id="department">
        <?php
          if(isset($department_err)) {
            echo "<div class='text-danger'>" . $department_err . "</div>";
          }
        ?>
    </div>

    <div class="col-12">
        <label for="address" class="form-label">Address</label>
        <input <?php if(!empty($address)) { echo "value=" . $address; } ?> name="address" type="text" class="form-control" id="address">
        <?php
          if(isset($address_err)) {
            echo "<div class='text-danger'>" . $address_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-6">
        <label for="degree" class="form-label">Degree</label>
        <input <?php if(!empty($degree)) { echo "value=" . $degree  ; } ?> name="degree" type="text" class="form-control" id="degree">
        <?php
          if(isset($degree_err)) {
            echo "<div class='text-danger'>" . $degree_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-6">
        <label for="pic" class="form-label">Display Photo</label>
        <input name="pic" type="file" class="form-control" id="pic">
        <?php
          if(isset($pic_err)) {
            echo "<div class='text-danger'>" . $pic_err . "</div>";
          }
        ?>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
    </div>
    </form>

</div>


<script>

$(document).ready(function() {
    $('#email').blur(function() {
        $.ajax({
            type: "POST",
            url: 'ajax/check_email.php',
            data: { email : $('#email').val() },
            success: function(response) {
              $('#emailDisplay').html(response);
            }
       });
     });
});

</script>


<?php include("includes/footer.php"); ?>