<?php
include("includes/d_header.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $emp_id = $_POST['emp_id'];
    $task_id = $_POST['task_id'];

    $sql = "UPDATE task SET
   emp_id = $emp_id WHERE task_id = $task_id";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo '<div class="alert alert-success">Successfully Submitted.</div>';
    } else {
        echo '<div class="alert alert-danger">Submission Error.</div>';
    }

}
?>
<div class="container my-3">
<h5 class="display-6 text-center text-success">Assigning Tasks</h5>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" style="width:300px;">
<div class="mb-3">
  <label for="task_id" class="form-label">Task Name</label>
  <select id="task_id" class="form-select" required name="task_id">
  <option value="" selected>-- Choose One --</option>

    <?php

    $sql = "SELECT * FROM task WHERE emp_id is null;";
    $res = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($res)) {
        $sql2 = "SELECT * FROM task_info WHERE task_info_id = $row[task_info_id];";
        $res2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($res2);
        ?>
            <option value="<?php echo $row['task_id'] ?>"><?php echo $row2['task_name'] ?></option>
        <?php
    }
    ?>
</select>
</div>


<div class="mb-3">
  <label for="employee" class="form-label">Employee</label>
  <select id="employee" class="form-select" required name="emp_id">
  <option value="" selected>-- Choose One --</option>

    <?php

    $sql = "SELECT * FROM users WHERE role = 'employee';";
    $res = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($res)) {
        ?>
            <option value="<?php echo $row['user_id']; ?>"><?php echo $row['firstname'] . ' ' .  $row['lastname']; ?></option>
        <?php
    }
    ?>
</select>
</div>
<button class="btn btn-success" type="submit">Submit</button>
</form>



<?php
include("includes/d_footer.php");
?>