<?php
include("includes/d_header.php");


if(isset($_SESSION["user"])) {
    $login_role = $_SESSION["role"];
    if($login_role != "employee") {
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
<h2 class="display-6 text-center text-success">Employee leaderboard</h2>
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
    </div>


<div class="container my-3">
<h2 class="display-6 text-center text-success">Pending Tasks</h2>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Task ID</th>
        <th scope="col">Task Name</th>
        <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody> 
		<?php
			$seq = 1;
			while ($employee = mysqli_fetch_assoc($result)) {
				$t_sql = "SELECT * from task where eid = $employee[user_id];";
				$t_res = mysqli_query($conn, $t_sql);
				$t_row = mysqli_fetch_assoc($t_res);
				echo "<tr>";
				echo "<th scope='row'>".$seq."</td>";
				echo "<td>".$employee['task_id']."</td>";
				echo "<td>".$employee['task_name']."</td>";
				echo "<td>".$employee['status']."</td>";
				echo "</tr>";
				$seq+=1;
			}
		?>
	</tbody>
    </table>
</div>

<div class="container my-3">
<h2 class="text-center">Salary Status</h2>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>
        <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        </tr>
        <tr>
        <th scope="row">3</th>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
        </tr>
    </tbody>
    </table>
</div>
<div class="container my-3">
<h2 class="text-center">Leave Status</h2>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>
        <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        </tr>
        <tr>
        <th scope="row">3</th>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
        </tr>
    </tbody>
    </table>
</div>


<br><br><br>
<?php
include("includes/d_footer.php");
?>




