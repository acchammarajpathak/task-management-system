<?php
include("includes/d_header.php");
?>
<?php

require_once ("../includes/conn.php");

$u_role = $_GET['role'];

$sql = "SELECT * from users where is_active = 1 AND role='$u_role';";

//echo "$sql";
$result = mysqli_query($conn, $sql);

?>

<br>


<?php
if(isset($_GET['delmsg'])) {
  if ($_GET['delmsg']) {
    echo "<div class='alert alert-danger'>Successfuly Deleted!</div>";
  } else {
    echo "<div class='alert alert-warning'>Deletion Error!</div>";
  }
}
$head = ucfirst($_GET['role']);
echo '<h2 class="text-center text-success">' . $head . ' List</h2>';
?>


<table class="table">
  <thead>
    <tr>

        <th scope="col">User ID</th>
        <th scope="col">Picture</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Birthday</th>
        <th scope="col">Gender</th>
        <th scope="col">Contact</th>
        <th scope="col">Address</th>
        <th scope="col">Department</th>
        <th scope="col">Degree</th>
        <th scope="col">Options</th>

    </tr>
  </thead>
  <tbody> 
	<?php
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<th scope='row'>" . $row['user_id'] . "</th>";
        echo "<td><img src=" . $row['pic'] . " height = 60px width = 60px></td>";
		echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
		echo "<td>".$row['email']."</td>";
        echo "<td>".$row['birthday']."</td>";
        echo "<td>".$row['gender']."</td>";
        echo "<td>".$row['contact']."</td>";
        echo "<td>".$row['address']."</td>";
        echo "<td>".$row['department']."</td>";
        echo "<td>".$row['degree']."</td>";

        echo "<td><a href=\"edit.php?id=$row[user_id]\">Edit</a> | <a href=\"delete.php?source=page&id=$row[user_id]\">Delete</a></td>";
		echo "</tr>";
	}







		?>

   
  </tbody>
</table>




<?php
include("includes/d_footer.php");
?>