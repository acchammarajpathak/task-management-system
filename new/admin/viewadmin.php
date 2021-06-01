<?php
include("d_header.php");
?>
<?php

require_once ("../../includes/conn.php");
$sql = "SELECT * from users";

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
        
        
        
        <th align = "center">Options</th>
    </tr>

    <?php
       
        while ($user = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$user['id']."</td>";
            echo "<td><img src='process/".$user['pic']."' height = 60px width = 60px></td>";
            echo "<td>".$user['firstname']." ".$user['lastname']."</td>";
            
            echo "<td>".$user['email']."</td>";
            echo "<td>".$user['birthday']."</td>";
            echo "<td>".$user['gender']."</td>";
            echo "<td>".$user['contact']."</td>";
            echo "<td>".$user['nid']."</td>";
            echo "<td>".$user['address']."</td>";
            echo "<td>".$user['dept']."</td>";
            echo "<td>".$user['degree']."</td>";
           

            echo "<td><a href=\"edit.php?id=$user[id]\">Edit</a> | <a href=\"delete.php?id=$user[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

        }


    ?>

</table>

<?
include("d_footer.php");
?>