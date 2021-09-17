<?php
include("includes/d_header.php");
?>
<div class="container my-1">
<h5 class="display-6 text-center text-success">Task Info Table</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Task ID</th>
      <th scope="col">Task Name</th>
      <th scope="col">Price</th>
      <th scope="col">Remarks</th>
      <th scope="col">Rank</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php                                                                                                                                             
    $sql = "SELECT * FROM task_info;";
    $res = mysqli_query($conn, $sql);
    $seq = 1; 
    while($row = mysqli_fetch_assoc($res)) {
        ?>
        <tr>
            <th scope="row"><?php echo $seq; $seq++; ?></th>
            <td><?php echo $row['task_info_id']; ?></td>
            <td><?php echo $row['task_name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['remarks']; ?></td>
            <td><?php echo $row['points']; ?></td>

             <td><a class="btn btn-sm btn-info" href="edit_task.php?id=<?php echo $row['task_info_id']; ?>">Update</a></td>
        </tr>
    <?php
    }
    ?>
  </tbody>
</table>

<div class="container">
  <a class="btn btn-success" href="add_task.php">Add New</a>
</div>

  
<?php
include("includes/d_footer.php");
?>