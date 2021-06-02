<?php
include("../functions.php");
include("includes/d_header.php");

$u_id = $_GET['id'];

$sql2 = "SELECT * FROM salary WHERE emp_id = $u_id;";  
$result2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result2);

$user_sql = "SELECT firstname, lastname from users WHERE user_id = $u_id;";
$user_result = mysqli_query($conn, $user_sql);
$user_row = mysqli_fetch_assoc($user_result);


$firstname = $user_row["firstname"];
$lastname = $user_row["lastname"];
$basesalary = $row["base_salary"];
$bonus = $row["bonus"];
$tax = $row["tax"];

if($_SERVER["REQUEST_METHOD"] == "POST") {
  
  include("../includes/conn.php");

  $basesalary = test_input($_POST["basesalary"]);
  $bonus = test_input($_POST["bonus"]);
  $tax = test_input($_POST["tax"]);

  $err = false;

  if (empty($basesalary)) {
        $err = true;
        $basesalary_err = "Base Salary is required";
  }

  if (empty($bonus)) {
    $err = true;
    $bonus_err = "Bonus is required";
 }

 if (empty($tax)) {
    $err = true;
    $tax_err = "Tax  is required";
 }

 if ($_SESSION['role'] != 'admin') {
    $err = true;
    $non_err = "Permission Denied!";
 }

 if(!$err) {
  
      $sql = "UPDATE salary  
      SET base_salary = '$basesalary',
        bonus = '$bonus',
        tax = '$tax'
        WHERE emp_id = $u_id;";  
  

      $result = mysqli_query($conn, $sql);

      if($result) {
        $succ_msg = "Successfully Updated!";
      } else {
        $non_err = "Some Errors Occurred.";
      }
  }
}
?>



  

<div class="container mt-3 border p-3 mb-5" style="width:500px;">

<form novalidate class="row g-3" method="POST" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" enctype="multipart/form-data">
<h1 class="text-center text-success">Update Salary</h1>

  <?php
    if(isset($non_err)) {
      echo "<div class='alert alert-danger'>" . $non_err . "</div>";
    }
    if(isset($succ_msg)) {
      echo "<div class='alert alert-success'>" . $succ_msg . "</div>";
    }
  ?>


    <div class="col-12 text-success">Employee ID: <?php echo $u_id;?></div>
    <div class="col-12 text-primary">First Name: <?php echo $firstname;?></div>
    <div class="col-12 text-primary">Last Name: <?php echo $lastname;?></div>


<div class="col-12">
    <label for="basesalary" class="form-label">Base Salary</label>
    <input id="basesalary" <?php if(!empty($basesalary)) { echo "value=" . $basesalary; } ?> name="basesalary" type="number" class="form-control">
    <?php
      if(isset($basesalary_err)) {
        echo "<span class='text-danger'>" . $basesalary_err . "</span>";
      }
    ?>

</div>

<div class="col-12">
    <label for="bonus" class="form-label">Bonus</label>
    <input <?php if(!empty($bonus)) { echo "value=" . $bonus; } ?> name="bonus" type="number" class="form-control" id="bonus">
    <?php
      if(isset($bonus_err)) {
        echo "<span class='text-danger'>" . $bonus_err . "</span>";
      }
    ?>

</div>

<div class="col-12">
    <label for="tax" class="form-label">Tax</label>
    <input <?php if(!empty($tax)) { echo "value=" . $tax; } ?> name="tax" type="number" class="form-control" id="tax">
    <?php
      if(isset($tax_err)) {
        echo "<span class='text-danger'>" . $tax_err . "</span>";
      }
    ?>

</div>

<div class="col-12">
    <button type="submit" class="btn btn-lg btn-primary">Update</button>
</div>
</form>

</div>


<?php
    include("includes/d_footer.php"); 
?>