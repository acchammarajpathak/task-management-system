<?php
include("includes/d_header.php");

?>




<?php 
	$sql = "SELECT * FROM users WHERE id =1";

    //echo "$sql";
    $result = mysqli_query($conn, $sql);
    
    
      $id = (isset($_GET['id']) ? $_GET['id'] : '');
      $sql = "SELECT * from employee WHERE id=$id";
      $sql2 = "SELECT * from salary WHERE id = $id";
      $result = mysqli_query($conn, $sql);
      $result2 = mysqli_query($conn , $sql2);
      $salary = mysqli_fetch_assoc ($result2);

      $empS = ($salary['total']);
     
      if($result){
      while($res = mysqli_fetch_assoc($result)){
      $firstname = $res['firstname'];
      $lastname = $res['lastname'];
      $email = $res['email'];
      $contact = $res['contact'];
      $address = $res['address'];
      $gender = $res['gender'];
      $birthday = $res['birthday'];
      $dept = $res['dept'];
      $degree = $res['degree'];
      $pic = $res['pic'];
    }
    }
  
?>




<div class="divider"></div>
  

  <!-- <form id = "registration" action="edit.php" method="POST"> -->
<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
      <div class="wrapper wrapper--w680">
          <div class="card card-1">
              <div class="card-heading"></div>
              <div class="card-body">
                  <h2 class="title">My Info</h2>
                  <form method="POST" action="myprofileup.php?id=<?php echo $id?>" >

                      <div class="input-group">
                        <img src="process/<?php echo $pic;?>" height = 150px width = 150px>
                      </div>


                      <div class="row row-space">
                          <div class="col-2">
                              <div class="input-group">
                                <p>First Name</p>
                                   <input class="input--style-1" type="text" name="firstName" value="<?php echo $firstname;?>" readonly >
                              </div>
                          </div>
                          <div class="col-2">
                              <div class="input-group">
                                <p>Last Name</p>
                                  <input class="input--style-1" type="text" name="lastName" value="<?php echo $lastname;?>" readonly>
                              </div>
                          </div>
                      </div>





                      <div class="input-group">
                        <p>Email</p>
                          <input class="input--style-1" type="email"  name="email" value="<?php echo $email;?>" readonly>
                      </div>
                      <div class="row row-space">
                          <div class="col-2">
                              <div class="input-group">
                                <p>Date of Birth</p>
                                  <input class="input--style-1" type="text" name="birthday" value="<?php echo $birthday;?>" readonly>
                                 
                              </div>
                          </div>
                          <div class="col-2">
                              <div class="input-group">
                                <p>Gender</p>
                                <input class="input--style-1" type="text" name="gender" value="<?php echo $gender;?>" readonly>
                              </div>
                          </div>
                      </div>
                      
                      <div class="input-group">
                        <p>Contact Number</p>
                          <input class="input--style-1" type="number" name="contact" value="<?php echo $contact;?>" readonly>
                      </div>

                      <div class="input-group">
                        <p>NID</p>
                          <input class="input--style-1" type="number" name="nid" value="<?php echo $nid;?>" readonly>
                      </div>

                      
                       <div class="input-group">
                        <p>Address</p>
                          <input class="input--style-1" type="text"  name="address" value="<?php echo $address;?>" readonly>
                      </div>

                      <div class="input-group">
                        <p>Department</p>
                          <input class="input--style-1" type="text" name="dept" value="<?php echo $dept;?>" readonly>
                      </div>

                      <div class="input-group">
                        <p>Degree</p>
                          <input class="input--style-1" type="text" name="degree" value="<?php echo $degree;?>" readonly>
                      </div>


                      <div class="input-group">
                        <p>Total Salary</p>
                          <input class="input--style-1" type="text" name="degree" value="<?php echo $empS;?>" readonly>
                      </div>

                      <input type="hidden" name="id" id="textField" value="<?php echo $id;?>" required="required"><br><br>
                      <div class="p-t-20">
                          <button class="btn btn--radius btn--green"  name="send" >Update Info</button>
                      </div>
                      
                  </form>
              </div>
          </div>
      </div>
  </div>


<?php
include("d_footer.php");
?>




