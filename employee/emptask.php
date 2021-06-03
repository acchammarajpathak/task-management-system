<?php
include("includes/d_header.php");

?>




<?php 
    $id = $_SESSION['user'];
    $sql = "SELECT * FROM task where emp_id = '$id'";
	$result = mysqli_query($conn, $sql);
	
?>

<br>

<div class="container">
	<h5 class="display-6 text-center text-success">My Tasks</h5>

	
		
	<div class="container">
	
		<table class="table">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Task ID</th>
			<th scope="col">Task Name</th>
			<th scope="col">Assign Date</th>
			<th scope="col">Submitted Date</th>
			<th scope="col">Due Date</th>
			<th scope="col">Status</th>
			<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody> 
			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result)) {

					$task_info_id_for_emp = $employee['task_info_id'];
				$t_sql ="SELECT * from task_info where task_info_id = $task_info_id_for_emp;";
				$t_res = mysqli_query($conn, $t_sql);
				$t_row = mysqli_fetch_assoc($t_res);


					echo "<tr>";
					echo "<th scope='row'>".$seq."</td>";
					echo "<td>".$employee['task_id']."</td>";
					echo "<td>".$t_row['task_name']."</td>";
					echo "<td>".$employee['assign_date']."</td>";
					echo "<td>".$employee['sub_date']."</td>";
					echo "<td>".$employee['due_date']."</td>";
					echo "<td>".$employee['status']."</td>";
					if ($employee['status'] == 'Pending') {
						echo "<td> <a href='task_complete.php?id=" . $employee['task_id'] . "' class='btn btn-sm btn-success'>Complete</a> </td>";
					} else {
						echo '<td>-</td>';
					}
					echo "</tr>";
					$seq+=1;
				}
			?>
		</tbody>
		</table>

</div>
<?php
include("includes/d_footer.php");
?>




