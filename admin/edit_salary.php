<?php
include("../functions.php");
include("includes/d_header.php");

$u_id = $_GET['id'];

$sql2 = "SELECT * FROM salary WHERE emp_id = $u_id;";  

$result2 = mysqli_query($conn, $sql2);

$row = mysqli_fetch_assoc($result2);

$firstname = $row["firstname"];
$lastname = $row["lastname"];
$basesalary = $row["base_salary"];
$bonus = $row["bonus"];
$tax = $row["tax"];
$total = $row["total"];

if($_SERVER["REQUEST_METHOD"] == "POST") {
  
  include("../includes/conn.php");
  $firstname = test_input($_POST["firstname"];
  $lastname = test_input($_POST["lastname"];
  $basesalary = test_input($_POST["base_salary"];
  $bonus = test_input($_POST["bonus"];
  $tax = test_input($_POST["tax"];
  $total = test_input($_POST["total"];

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
      SET basesalary = '$basesalary',
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




<div class="col-12">
    <label for="remarks" class="form-label">Base Salary</label>
    <input <?php if(!empty($remarks)) { echo "value=" . $remarks; } ?> name="remarks" type="text" class="form-control" id="remarks">
    <?php
      if(isset($remarks_err)) {
        echo "<span class='text-danger'>" . $remarks_err . "</span>";
      }
    ?>

</div>

<div class="col-12">
    <label for="remarks" class="form-label">Bonus</label>
    <input <?php if(!empty($remarks)) { echo "value=" . $remarks; } ?> name="remarks" type="text" class="form-control" id="remarks">
    <?php
      if(isset($remarks_err)) {
        echo "<span class='text-danger'>" . $remarks_err . "</span>";
      }
    ?>

</div>

<div class="col-12">
    <label for="remarks" class="form-label">Tax</label>
    <input <?php if(!empty($remarks)) { echo "value=" . $remarks; } ?> name="remarks" type="text" class="form-control" id="remarks">
    <?php
      if(isset($remarks_err)) {
        echo "<span class='text-danger'>" . $remarks_err . "</span>";
      }
    ?>

</div>

<div class="col-12">
    <label for="remarks" class="form-label">Total</label>
    <input <?php if(!empty($remarks)) { echo "value=" . $remarks; } ?> name="remarks" type="text" class="form-control" id="remarks">
    <?php
      if(isset($remarks_err)) {
        echo "<span class='text-danger'>" . $remarks_err . "</span>";
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