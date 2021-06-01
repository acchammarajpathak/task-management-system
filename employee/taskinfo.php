<?php
include("includes/d_header.php");
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Task ID</th>
      <th scope="col">Task Name</th>
      <th scope="col">Price</th>
      <th scope="col">Remarks</th>
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
        </tr>
    <?php
    }
    ?>
  </tbody>
</table>
  
<?php
include("includes/d_footer.php");
?>