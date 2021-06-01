<?php
include("d_header.php");

?>





<?php 
require_once ("../../includes/conn.php");
$sql  = "SELECT employee.id,employee.firstname,employee.lastname,salary.base,salary.bonus,salary.total from employee,salary where employee.id=salary.id";

$result = mysqli_query($conn, $sql);
?>

<br>

	
	<table>
			<tr>
				<th align = "center">Emp. ID</th>
				<th align = "center">Name</th>
				
				
				<th align = "center">Base Salary</th>
				<th align = "center">Bonus</th>
				<th align = "center">TotalSalary</th>
				
				
			</tr>
			
			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['id']."</td>";
					echo "<td>".$employee['firstname']." ".$employee['lastname']."</td>";
					
					echo "<td>".$employee['base']."</td>";
					echo "<td>".$employee['bonus']." %</td>";
					echo "<td>".$employee['total']."</td>";
					
					

				}


			?>
			
			</table>







<?php
include("d_footer.php");
?>