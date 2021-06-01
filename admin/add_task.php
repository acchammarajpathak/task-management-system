<?php
include("../functions.php");
include("includes/d_header.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
  
  include("../includes/conn.php");

  $taskname = test_input($_POST["taskname"]);
  $taskprice = test_input($_POST["taskprice"]);
  $remarks = test_input($_POST["remarks"]);

  $err = false;

  if (empty($taskname)) {
        $err = true;
        $taskname_err = "Task Name is required";
  }

  if (empty($taskprice)) {
    $err = true;
    $taskname_err = "Task Price is required";
 }

 if ($_SESSION['role'] != 'admin') {
    $err = true;
    $non_err = "Permission Denied!";
 }

 if(!$err) {
  
      $sql = "INSERT INTO task_info (task_name, price, remarks)
      VALUES ('$taskname', '$taskprice', '$remarks');";  

      $result = mysqli_query($conn, $sql);

      if($result) {
        $succ_msg = "Successfully Added!";
      } else {
        $non_err = "Some Errors Occurred.";
      }


}
}
?>



  

<div class="container mt-3 border p-3 mb-5" style="width:500px;">

<form novalidate class="row g-3" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
<h1 class="text-center text-success">Add New Task</h1>

  <?php
    if(isset($non_err)) {
      echo "<div class='alert alert-danger'>" . $non_err . "</div>";
    }
    if(isset($succ_msg)) {
      echo "<div class='alert alert-success'>" . $succ_msg . "</div>";
    }
  ?>


<div class="col-md-12">
    <label for="firstname" class="form-label">Task Name</label>
    <input <?php if(!empty($taskname)) { echo 'value="' . $taskname . '"'; } ?> name="taskname" type="text" class="form-control" id="taskname" placeholder="Task Name" required>
    <?php
      if(isset($taskname_err)) {
        echo "<div class='text-danger'>" . $taskname_err . "</div>";
      }
    ?>
</div>

<div class="col-md-12">
    <label for="taskprice" class="form-label">Task Price</label>
    <input <?php if(!empty($taskprice)) { echo "value=" . $taskprice; } ?> name="taskprice" type="text" class="form-control" id="taskprice" required>
    <?php
      if(isset($taskprice_err)) {
        echo "<div class='text-danger'>" . $taskprice_err . "</div>";
      }
    ?>
</div>

<div class="col-12">
    <label for="remarks" class="form-label">Remarks</label>
    <input <?php if(!empty($remarks)) { echo "value=" . $remarks; } ?> name="remarks" type="remarks" class="form-control" id="remarks">
    <div id="remarksDisplay">
    <?php
      if(isset($remarks_err)) {
        echo "<span class='text-danger'>" . $remarks_err . "</span>";
      }
    ?>
    </div>

</div>

<div class="col-12">
    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
</div>
</form>

</div>


<?php
    include("includes/d_footer.php"); 
?>