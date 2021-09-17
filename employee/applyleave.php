<?php
include("../functions.php");
include("includes/d_header.php");

$u_id = $_SESSION['user'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
  
  include("../includes/conn.php");

  $start_date = test_input($_POST["start_date"]);
  $end_date = test_input($_POST["end_date"]);
  $reason = test_input($_POST["reason"]);

  $err = false;

  if (empty($start_date)) {
        $err = true;
        $start_date_err = "Start Date is required";
  }

  if (empty($end_date)) {
    $err = true;
    $end_date_err = "End Date is required";
 }

 if (empty($reason)) {
    $err = true;
    $reason_err = "Reason  is required";
 }

 if ($_SESSION['role'] != 'employee') {
    $err = true;
    $non_err = "Permission Denied!";
 }

 if(!$err) {
  
      $sql = "INSERT INTO emp_leave (emp_id, start_date, end_date, reason) VALUES ('$u_id', '$start_date', '$end_date', '$reason');";  
  

      $result = mysqli_query($conn, $sql);

      if($result) {
        $succ_msg = "Successfully Applied!";
      } else {
        $non_err = "Some Errors Occurred.";
      }
  }
}
?>



  

<div class="container mt-3 border p-3 mb-5" style="width:500px;">

<form novalidate class="row g-3" method="POST" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" enctype="multipart/form-data">
<h1 class="text-center text-success">Apply Leave</h1>

  <?php
    if(isset($non_err)) {
      echo "<div class='alert alert-danger'>" . $non_err . "</div>";
    }
    if(isset($succ_msg)) {
      echo "<div class='alert alert-success'>" . $succ_msg . "</div>";
    }
  ?>



<div class="col-12">
    <label for="start_date" class="form-label">Start Date</label>
    <input id="start_date" min="<?php echo date("Y-m-d"); ?>" <?php if(!empty($start_date)) { echo "value=" . $start_date; } ?> name="start_date" type="date" class="form-control">
    <?php
      if(isset($start_date_err)) {
        echo "<span class='text-danger'>" . $start_date_err . "</span>";
      }
    ?>

</div>

<div class="col-12">
    <label for="end_date" class="form-label">End Date</label>
    <input id="end_date" min="<?php echo date("Y-m-d"); ?>"<?php if(!empty($end_date)) { echo "value=" . $end_date; } ?> name="end_date" type="date" class="form-control">
    <?php
      if(isset($end_date_err)) {
        echo "<span class='text-danger'>" . $end_date_err . "</span>";
      }
    ?>

</div>

<div class="col-12">
    <label for="tax" class="form-label">Reason</label>
    <input <?php if(!empty($reason)) { echo "value=" . $reason; } ?> name="reason" type="text" class="form-control" id="reason">
    <?php
      if(isset($reason_err)) {
        echo "<span class='text-danger'>" . $reason_err . "</span>";
      }
    ?>

</div>

<div class="col-12">
    <button type="submit" class="btn btn-lg btn-primary">Apply</button>
</div>
</form>

</div>


<?php
    include("includes/d_footer.php"); 
?>