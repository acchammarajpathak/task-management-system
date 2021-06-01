<?php
include("d_header.php");
?>
<?php

require_once ("../../includes/conn.php");
$sql = "SELECT * from employee, rank WHERE employee.id = rank.eid";

//echo "$sql";
$result = mysqli_query($conn, $sql);

?>

<br>

<table>
    <tr>

        <th align = "center">Emp. ID</th>
        <th align = "center">Picture</th>
        <th align = "center">Name</th>
        <th align = "center">Email</th>
        <th align = "center">Birthday</th>
        <th align = "center">Gender</th>
        <th align = "center">Contact</th>
        <th align = "center">NID</th>
        <th align = "center">Address</th>
        <th align = "center">Department</th>
        <th align = "center">Degree</th>
        <th align = "center">Point</th>
        
        
        <th align = "center">Options</th>
    </tr>

    <?php
        while ($employee = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$employee['id']."</td>";
            echo "<td><img src='process/".$employee['pic']."' height = 60px width = 60px></td>";
            echo "<td>".$employee['firstname']." ".$employee['lastname']."</td>";
            
            echo "<td>".$employee['email']."</td>";
            echo "<td>".$employee['birthday']."</td>";
            echo "<td>".$employee['gender']."</td>";
            echo "<td>".$employee['contact']."</td>";
            echo "<td>".$employee['nid']."</td>";
            echo "<td>".$employee['address']."</td>";
            echo "<td>".$employee['dept']."</td>";
            echo "<td>".$employee['degree']."</td>";
            echo "<td>".$employee['points']."</td>";

            echo "<td><a href=\"edit.php?id=$employee[id]\">Edit</a> | <a href=\"delete.php?id=$employee[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

        }


    ?>

</table>

<?
include("d_footer.php");
?>