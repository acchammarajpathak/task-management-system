<?php
include("d_header.php");
?>

<?php
include("../functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
  
  include("../../includes/conn.php");
  $role = test_input($_POST["role"]);
  $firstname = test_input($_POST["firstname"]);
  $lastname = test_input($_POST["lastname"]);
  $email = test_input($_POST["email"]);
  $password1 = $_POST["password1"];
  $password2 = $_POST["password2"];
  $birthday = test_input($_POST["birthday"]);
  $gender = test_input($_POST["gender"]);
  $contact = test_input($_POST["contact"]);
  $nid = test_input($_POST["nid"]);
  $department = test_input($_POST["department"]);
  $address = test_input($_POST["address"]);
  $degree = test_input($_POST["degree"]);
  $pic = test_input($_POST["pic"]);

  $err = false;
  // $role_err = $address_err = $degree_err = $department_err = $nid_err = $firstname_err = $contact_err = $lastname_err = $gender_err = $birthday_err = $email_err = $password_err = $non_err = "";
  
  if (empty($role)) {
    $err = true;
    $role_err = "Role is required";
  }

  if (empty($firstname)) {
    $err = true;
    $firstname_err = "First Name is required";
  }

  if (empty($lastname)) {
    $err = true;
    $lastname_err = "Last Name is required";
  }

  if (empty($birthday)) {
    $err = true;
    $birthday_err = "Birthday is required";
  }

  if (empty($gender)) {
    $err = true;
    $gender_err = "Gender is required";
  }

  if (empty($contact)) {
    $err = true;
    $contact_err = "Contact is required";
  }

  if (empty($nid)) {
    $err = true;
    $nid_err = "Nid is required";
  }

  if (empty($address)) {
    $err = true;
    $address_err = "Address is required";
  }

  if (empty($department)) {
    $err = true;
    $department_err = "Department is required";
  }

  if (empty($degree)) {
    $err = true;
    $degree_err = "Degree is required";
  }
  
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
  
   if (empty($password1) or empty($password2)) {
     $err = true;
     $password_err = "Password is required";
   } else {
     if($password1 == $password2) {
       $password = md5($password1);
     } else {
      $err = true;
      $password_err = "Password doesnot match";
     }
   }
  
   if(!$err) {
     
       $sql = "INSERT INTO $role (firstname, lastname, email, password, birthday, gender, contact, nid, address, dept, degree, pic)
       VALUES ('$firstname', '$lastname', '$email', '$password', '$birthday', '$gender', '$contact', '$nid', '$address', '$department', '$degree', 'hjg');";
       

       $result = mysqli_query($conn, $sql);

       

       if($result) {
         $succ_msg = "Successfully Registered! <br> Wait to approve.  ";
       } else {
         $non_err = "Some Errors Occurred.";
       }

  
   }

}

?>








<div class="container mt-3 border p-3 mb-5">

    <form novalidate class="row g-3" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
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
            <option value="" selected>Choose One</option>
            <option value="admin">Admin</option>
            <option value="employee">Employee</option>
            <option value="users">User</option>
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
        <input name="firstname" type="text" class="form-control" id="firstname" required>
        <?php
          if(isset($firstname_err)) {
            echo "<div class='text-danger'>" . $firstname_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-6">
        <label for="lastname" class="form-label">Last Name</label>
        <input name="lastname" type="text" class="form-control" id="lastname" required>
        <?php
          if(isset($lastname_err)) {
            echo "<div class='text-danger'>" . $lastname_err . "</div>";
          }
        ?>
    </div>

    <div class="col-12">
        <label for="email" class="form-label">Email</label>
        <input name="email" type="email" class="form-control" id="email" required>
        <?php
          if(isset($email_err)) {
            echo "<div class='text-danger'>" . $email_err . "</div>";
          }
        ?>
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
        <input name="birthday" type="date" class="form-control" id="birthday" required>
        <?php
          if(isset($birthday_err)) {
            echo "<div class='text-danger'>" . $birthday_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-6">
        <label for="gender" class="form-label">Gender</label>
        <select name="gender" id="gender" class="form-select" required>
        <option value="" selected>Choose One</option>
        <option value="m">Male</option>
        <option value="f">Female</option>
        <option value="o">Others</option>
        </select>
        <?php
          if(isset($gender_err)) {
            echo "<div class='text-danger'>" . $gender_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-4">
        <label for="contact" class="form-label">Contact</label>
        <input name="contact" type="number" class="form-control" id="contact">
        <?php
          if(isset($contact_err)) {
            echo "<div class='text-danger'>" . $contact_err . "</div>";
          }
        ?>
    </div>


    <div class="col-md-4">
        <label for="nid" class="form-label">NID</label>
        <input name="nid" type="number" class="form-control" id="nid">
        <?php
          if(isset($nid_err)) {
            echo "<div class='text-danger'>" . $nid_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-4">
        <label for="department" class="form-label">Department</label>
        <input name="department" type="text" class="form-control" id="department">
        <?php
          if(isset($department_err)) {
            echo "<div class='text-danger'>" . $department_err . "</div>";
          }
        ?>
    </div>

    <div class="col-12">
        <label for="address" class="form-label">Address</label>
        <input name="address" type="text" class="form-control" id="address">
        <?php
          if(isset($address_err)) {
            echo "<div class='text-danger'>" . $address_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-6">
        <label for="degree" class="form-label">Degree</label>
        <input name="degree" type="text" class="form-control" id="degree">
        <?php
          if(isset($degree_err)) {
            echo "<div class='text-danger'>" . $degree_err . "</div>";
          }
        ?>
    </div>

    <div class="col-md-6">
        <label for="pic" class="form-label">Display Photo</label>
        <input name="pic" type="file" class="form-control" id="pic">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
    </div>
    </form>

</div>



  


<?
include("d_footer.php");
?>