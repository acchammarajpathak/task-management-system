<?php
include("includes/d_header.php");

?>

<?php 
require_once ("../includes/conn.php");
$sql = "SELECT * from task
JOIN users on task.emp_id = users.user_id
JOIN task_info on task.task_info_id = task_info.task_info_id
order by sub_date desc";
$result = mysqli_query($conn, $sql);
?>

<div class="container my-1">
<h5 class="display-6 text-center text-success">Task Status Table</h2>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Task ID</th>
      <th scope="col">Assigned to</th>
      <th scope="col">Task Name</th>
	  <th scope="col">Due Date</th>
	  <th scope="col">Submission Date</th>
	  <th scope="col">Status</th>
	  <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

	<?php
		$step = 1;
		while ($employee = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td scope='row'>".$step."</td>"; $step++;
			echo "<td scope='row'>".$employee['task_id']."</td>";
			echo "<td>".$employee['firstname']."</td>";
			echo "<td>".$employee['task_name']."</td>";
			echo "<td>".$employee['due_date']."</td>";
			echo "<td>".$employee['sub_date']."</td>";
			echo "<td>".$employee['status']."</td>";
			if ($employee['status'] == 'Pending') {
				echo "<td> <a href='task_complete.php?id=" . $employee['task_id'] . "' class='btn btn-sm btn-success'>Complete</a> </td>";
			} else {
				echo "<td class='text-center'> - </td>";
			}
			echo "</tr>";
		}
	?>

  </tbody>
</table>




		<table>
			<tr>

				
				
				
			</tr>

			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['task_id']."</td>";
					echo "<td>".$employee['emp_id']."</td>";
					echo "<td>".$employee['task_info_id']."</td>";
					echo "<td>".$employee['due_date']."</td>";
					echo "<td>".$employee['sub_date']."</td>";
					echo "<td>".$employee['status']."</td>";
					

				}


			?>

		</table>





<?php
include("includes/d_footer.php");
?>