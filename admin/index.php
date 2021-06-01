<?php
// session_start();
include("includes/d_header.php");

if(isset($_SESSION["user"])) {
    $login_role = $_SESSION["role"];
    if($login_role != "admin") {
        header("Location: ../$login_role/");
    }
}

?>

<?php 
require_once ("../includes/conn.php");
$sql = "SELECT * from users where role = 'employee';";
$result = mysqli_query($conn, $sql);
?>

<div class="container my-3">
<h5 class="display-6 text-center text-success">Employee leaderboard</h2>


	<table class="table">
	<thead>
		<tr>
		<th scope="col">#</th>
		<th scope="col">USER ID</th>
		<th scope="col">First</th>
		<th scope="col">Last</th>
		<th scope="col">Points</th>
		</tr>
	</thead>
	<tbody> 
		<?php
			$seq = 1;
			while ($employee = mysqli_fetch_assoc($result)) {
				$t_sql = "SELECT * from rank where eid = $employee[user_id];";
				$t_res = mysqli_query($conn, $t_sql);
				$t_row = mysqli_fetch_assoc($t_res);
				echo "<tr>";
				echo "<th scope='row'>".$seq."</td>";
				echo "<td>".$employee['user_id']."</td>";
				echo "<td>".$employee['firstname']."</td>";
				echo "<td>".$employee['lastname']."</td>";
				echo "<td>".$t_row['points']."</td>";
				echo "</tr>";
				$seq+=1;
			}
		?>
	</tbody>
	</table>

	<div class="text-end">
		<a class="btn btn-primary" href="reset.php">Reset Points</a>
	</div>

</div>

<hr>

<div class="container">
	<h5 class="display-6 text-center text-danger">Pending Requests</h5>

	<?php
	if(isset($_GET['approvemsg'])) {
		if ($_GET['approvemsg']) {
			echo "<div class='alert alert-success'>Successfuly Approved!</div>";
		} else {
			echo "<div class='alert alert-danger'>Approve Error!</div>";
		}
	}

	if(isset($_GET['delmsg'])) {
		if ($_GET['delmsg']) {
			echo "<div class='alert alert-danger'>Successfuly Deleted!</div>";
		} else {
			echo "<div class='alert alert-warning'>Deletion Error!</div>";
		}
	}

	$sql = "SELECT * from users where is_active = 0;";
	$result = mysqli_query($conn, $sql);
	?>
		
	<div class="container">
	
		<table class="table">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">USER ID</th>
			<th scope="col">Email</th>
			<th scope="col">First Name</th>
			<th scope="col">Last Name</th>
			<th scope="col">Role</th>
			<th scope="col">Remarks</th>
			</tr>
		</thead>
		<tbody> 
			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<th scope='row'>".$seq."</td>";
					echo "<td>".$employee['user_id']."</td>";
					echo "<td>".$employee['email']."</td>";
					echo "<td>".$employee['firstname']."</td>";
					echo "<td>".$employee['lastname']."</td>";
					echo "<td>".$employee['role']."</td>";
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