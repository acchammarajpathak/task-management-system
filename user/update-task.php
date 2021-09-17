<?php
include("includes/d_header.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $task_id = $_POST['task_id'];
    $due_date = $_POST['due_date'];
    $remarks = trim($_POST['remarks']);
    $user_id = $_SESSION['user'];

    $sql = "UPDATE task
    set due_date = '$due_date', remarks = '$remarks'
    where task_id = '$task_id' AND user_id = '$user_id';";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        header('Location: index.php?success=1');
    } else {
        echo '<div class="alert alert-danger">Update Error.</div>';
    }

} else {
    $task_id = $_GET['task'];
    
    $sql = "SELECT * FROM task where task_id = '$task_id';";

    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($res);
?>





<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" style="width:300px;">
<input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
<div class="mb-3">
  <label for="taskname" class="form-label">Task Name</label>
    <?php
    $temp_info = $row['task_info_id'];
    $sql2 = "SELECT * FROM task_info WHERE task_info_id = '$temp_info';";
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2)
    ?>
    <input type=text class="form-control disabled" id="taskname" value="<?php echo $row2['task_name']; ?>" readonly>
</div>

<div class="mb-3">
  <label for="duedate" class="form-label">Due Date</label>
  <input type="date" min="<?php echo date("Y-m-d"); ?>" class="form-control" name="due_date" id="duedate" value="<?php echo $row['due_date']; ?>" required>
</div>

<div class="mb-3">
  <label for="remarks" class="form-label">Remarks</label>
  <textarea class="form-control" id="remarks" name="remarks" rows="3"><?php echo trim($row['remarks']); ?></textarea>
</div>

<button class="btn btn-success" type="submit">Update</button>
</form>





<?php
}
include("includes/d_footer.php");
?>