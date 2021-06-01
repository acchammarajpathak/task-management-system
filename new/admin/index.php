<?php
include("d_header.php");
?>

<?php 
require_once ("../../includes/conn.php");
$sql = "SELECT id, firstname, lastname,  points FROM employee, rank WHERE rank.eid = employee.id order by rank.points desc";
$result = mysqli_query($conn, $sql);
?>



	<div id="divimg">
		<h2 style="margin-top:10px; font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Empolyee Leaderboard </h2>
    	<table>

			<tr bgcolor="#000">
				<th align = "center">Seq.</th>
				<th align = "center">Emp. ID</th>
				<th align = "center">Name</th>
				<th align = "center">Points</th>
				

			</tr>

			

			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$seq."</td>";
					echo "<td>".$employee['id']."</td>";
					
					echo "<td>".$employee['firstname']." ".$employee['lastname']."</td>";
					
					echo "<td>".$employee['points']."</td>";
					
					$seq+=1;
				}

			?>

		</table>

		<div class="p-t-20">
			<button class="btn btn--radius btn--green" onclick="location.href='reset.php';" style="float: right; margin-right: 60px;">Reset Points</button>
		</div>

		
	</div>


<?php
include("d_footer.php");
?>