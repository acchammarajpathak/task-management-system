<?php
include("includes/d_header.php");

require_once ("../includes/conn.php");
$sql  = "SELECT * FROM salary join users on salary.emp_id = users.user_id;";

$result = mysqli_query($conn, $sql);
?>

<div class="container my-1">
<h5 class="display-6 text-center text-success">Employee Salary Table</h2>
<table class="table">

  <thead>
    <tr>
      <th scope="col">Emp ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Base Salary</th>
	  <th scope="col">Bonus</th>
	  <th scope="col">Tax Percent</th>
	  <th scope="col">Total</th>
	  <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>

	<?php
		while ($employee = mysqli_fetch_assoc($result)) {
			$grand = $employee['base_salary'] + $employee['bonus'];
			$total_salary = $grand - ($grand * $employee['tax']/100);
			echo "<tr>";
			echo "<td scope='row'>".$employee['emp_id']."</td>";
			echo "<td>".$employee['firstname']."</td>";
			echo "<td>".$employee['lastname']."</td>";
			echo "<td>".$employee['base_salary']." </td>";
			echo "<td>".$employee['bonus']."</td>";
			echo "<td>".$employee['tax']."</td>";
			echo "<td>".$total_salary."</td>";
			echo "<td> <a href='#' class='btn btn-sm btn-info' >Edit</a></td>";
			echo "</tr>";
		}
	?>

  </tbody>
</table>

<?php
include("includes/d_footer.php");
?>