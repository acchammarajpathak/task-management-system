<?php
include("includes/d_header.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $task_info_id = $_POST['task_info_id'];
    $due_date = $_POST['due_date'];
    $remarks = trim($_POST['remarks']);
    $user_id = $_SESSION['user'];

    $sql = "INSERT INTO task(task_info_id, due_date, user_id, remarks)
    VALUES ('$task_info_id', '$due_date', '$user_id', '$remarks');";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo '<div class="alert alert-success">Successfully Submitted.</div>';
    } else {
        echo '<div class="alert alert-danger">Submission Error.</div>';
    }

}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" style="width:300px;">
<div class="mb-3">
  <label for="taskname" class="form-label">Task Name</label>
  <select id="taskname" class="form-select" required name="task_info_id">
  <option value="" selected>-- Choose One --</option>

    <?php

    $sql = "SELECT * FROM task_info;";
    $res = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($res)) {
        ?>
            <option value="<?php echo $row['task_info_id'] ?>"><?php echo $row['task_name'] ?></option>
        <?php
    }
    ?>
</select>
</div>

<div class="mb-3">
  <label for="duedate" class="form-label">Due Date</label>
  <input type="date" class="form-control" name="due_date" id="duedate" min="<?php echo date("Y-m-d"); ?>" required>
</div>

<div class="mb-3"
  <label for="remarks" class="form-label">Remarks</label>
  <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
</div>

<button class="btn btn-success" type="submit">Submit</button>
</form>



<?php
include("includes/d_footer.php");
?>