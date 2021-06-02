<?php
include("includes/d_header.php");
// session_start();

if(isset($_SESSION["user"])) {
    $login_role = $_SESSION["role"];
    if($login_role != "user") {
        header("Location: ../$login_role/");
    }
}
?>


<div class="container text-center" style="width: 500px; height: 500px;"> 
    <canvas id="taskChart"></canvas>
    <script>
    var ctx = document.getElementById('taskChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                'Task Submitted',
                'Task Completed',
                'Task Pending'
            ],
            datasets: [{
                label: 'Task Details',
                data: [300, 50, 100],
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
            }
    });
    </script>
</div>

<div class="container my-3">
<h2 class="display-6 text-center text-success">Completed Tasks</h2>
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
<h2 class="display-6 text-center text-success">Submitted Tasks</h2>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Task ID</th>
        <th scope="col">Task Name</th>
        <th scope="col">Submitted Date</th>
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
				echo "<td>".$employee['sub_date']."</td>";
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