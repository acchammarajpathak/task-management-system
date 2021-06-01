<?php
// session_start();
include("includes/d_header.php");

require_once ("../includes/conn.php");
$sql = "SELECT * from emp_leave join users on emp_leave.emp_id = users.user_id;";
$result = mysqli_query($conn, $sql);
?>



<div class="container my-1">
<h5 class="display-6 text-center text-success">Employee Leave Table</h2>
	<table class="table">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">USER ID</th>
			<th scope="col">First Name</th>
			<th scope="col">Last Name</th>
			<th scope="col">Start Date</th>
			<th scope="col">End Date</th>
			<th scope="col">Reason</th>
			<th scope="col">Status</th>
			<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody> 
			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<th scope='row'>".$seq."</td>";
					echo "<td>".$employee['user_id']."</td>";
					echo "<td>".$employee['firstname']."</td>";
					echo "<td>".$employee['lastname']."</td>";
					echo "<td>".$employee['start_date']."</td>";
					echo "<td>".$employee['end_date']."</td>";
					echo "<td>".$employee['reason']."</td>";
					echo "<td>".$employee['status']."</td>";
					echo "<td> <a href='approve_user.php?id=". $employee['user_id'] ."'  class='btn btn-sm btn-success'>Approve</a> <a href='delete.php?source=dash&id=". $employee['user_id'] ."' class='btn btn-sm btn-danger'>Delete</a> </td>";
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