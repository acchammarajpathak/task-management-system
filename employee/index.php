<?php
include("includes/d_header.php");
$u_id = $_SESSION['user'];


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
<h2 class="text-center text-success">Employee leaderboard</h2>
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
<h2 class=" text-center text-success">Pending Tasks</h2>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Task ID</th>
        <th scope="col">Task Name</th>
        <th scope="col">Assign Date</th>
        <th scope="col">Due Date</th>
        <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody> 
		<?php

            $task_sql ="SELECT * from task where status = 'Pending' AND emp_id = $u_id;";
            $task_res = mysqli_query($conn, $task_sql);
        
			$seq = 1;
			while ($employee = mysqli_fetch_assoc($task_res)) {
                $task_info_id_for_emp = $employee['task_info_id'];
				$t_sql ="SELECT * from task_info where task_info_id = $task_info_id_for_emp;";
				$t_res = mysqli_query($conn, $t_sql);
				$t_row = mysqli_fetch_assoc($t_res);
                
				echo "<tr>";
				echo "<th scope='row'>".$seq."</td>";
				echo "<td>".$employee['task_id']."</td>";
				echo "<td>".$t_row['task_name']."</td>";
                echo "<td>".$employee['assign_date']."</td>";
                echo "<td>".$employee['due_date']."</td>";
				echo "<td>".$employee['status']."</td>";
				echo "</tr>";
				$seq+=1;
			}
		?>
	</tbody>
    </table>
</div>

<div class="container my-3">
<h2 class="text-center text-success">Salary Status</h2>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Salary ID</th>
        <th scope="col">Base Salary</th>
        <th scope="col">Bonus</th>
        <th scope="col">Tax</th>
        </tr>
    </thead>
    <tbody>
    <?php
            $task_sql ="SELECT * from salary where  emp_id = $u_id;";
            $task_res = mysqli_query($conn, $task_sql);

            $seq = 1;
            while ($employee = mysqli_fetch_assoc($task_res)) {
                
                
                echo "<tr>";
                echo "<th scope='row'>".$seq."</td>";
                echo "<td>".$employee['salary_id']."</td>";
                echo "<td>".$employee['base_salary']."</td>";
                echo "<td>".$employee['bonus']."</td>";
                echo "<td>".$employee['tax']."</td>";
            
                echo "</tr>";
                $seq+=1;
}
?>
    </tbody>
    </table>
</div>
<div class="container my-3">
<h2 class="text-center text-danger">Leave Status</h2>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Leave ID</th>
        <th scope="col">Reason</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
    <?php
            $task_sql ="SELECT * from emp_leave where  emp_id = $u_id;";
            $task_res = mysqli_query($conn, $task_sql);

            $seq = 1;
            while ($employee = mysqli_fetch_assoc($task_res)) {
                
                
                echo "<tr>";
                echo "<th scope='row'>".$seq."</td>";
                echo "<td>".$employee['leave_id']."</td>";
                echo "<td>".$employee['reason']."</td>";
                echo "<td>".$employee['start_date']."</td>";
                echo "<td>".$employee['end_date']."</td>";
                echo "<td>".$employee['status']."</td>";
            
                echo "</tr>";
                $seq+=1;
}
?>
    </tbody>
    </table>
</div>


<br><br><br>
<?php
include("includes/d_footer.php");
?>




