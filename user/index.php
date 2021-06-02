<?php
include("includes/d_header.php");
// session_start();

if(isset($_SESSION["user"])) {
    $login_role = $_SESSION["role"];
    if($login_role != "user") {
        header("Location: ../$login_role/");
    }
}

$u_id =  $_SESSION['user'];
$sql = "SELECT * FROM task WHERE user_id = $u_id;";
$result = mysqli_query($conn, $sql);

$total_com_tasks_sql = "SELECT COUNT(task_id) as cnt FROM task WHERE status = 'Completed' AND user_id= $u_id;";
$total_com_tasks_result = mysqli_query($conn, $total_com_tasks_sql);
$total_com_task = mysqli_fetch_assoc($total_com_tasks_result)['cnt'];

$total_pend_tasks_sql = "SELECT COUNT(task_id) as cnt FROM task WHERE status = 'Pending' AND user_id= $u_id;";
$total_pend_tasks_result = mysqli_query($conn, $total_pend_tasks_sql);
$total_pend_task = mysqli_fetch_assoc($total_pend_tasks_result)['cnt'];

$total_sub_task = $total_com_task + $total_pend_task;

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
                data: [<?php echo $total_sub_task . ', ' . $total_com_task . ', ' . $total_pend_task; ?>],
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
<h2 class="display-6 text-center text-success">My Tasks</h2>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Task ID</th>
        <th scope="col">Task Name</th>
        <th scope="col">Assigned Date</th>
        <th scope="col">Submitted Date</th>
        <th scope="col">Due Date</th>
        <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody> 
		<?php
			$seq = 1;
			while ($employee = mysqli_fetch_assoc($result)) {
				$t_sql = "SELECT * from task_info where task_info_id = $employee[task_info_id];";
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