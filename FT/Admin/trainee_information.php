<?php $get_id = $_GET['id']; ?>
<?php $ft = $_GET['ft']; ?>
<?php $gender = $_GET['gender']; ?>
<?php $batch = $_GET['batch']; ?>
<?php $stat = $_GET['stat']; ?>


<div class="col-xl-3 col-lg-5">
  <div class="card shadow mb-4">
  <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"  aria-expanded="true" aria-controls="collapseCardExample">
  <h6 class="m-3 font-weight-bold text-primary"><i class="fas fa-recycle">Trainee Information Update Details</i></h6>
	  </a>
	  <!-- Card Content - Collapse -->
	  <div class="collapse hide" id="collapseCardExample">


   <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->

                        <!--END OF CODE ---->
                        <?php
													$user_query = mysql_query("SELECT * from trainee_info
                                                    Inner join status on trainee_info.Status=status.ID        
                                                    Inner Join class on trainee_info.Term=class.ID
                                                    Inner Join stat_saints on trainee_info.Gender=stat_saints.stat_id
                                    where trainee_info.trainee_id='$get_id'
                                              
                                                     ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
                        $id = $row['trainee_id'];
                        //   $loc = $row['LOCALITY'];
                        //   $user = $row['USER_LEVEL'];
													?>


    <!-- Card Body -->
    <div class="card-body">
    <form  method="POST"  enctype="multipart/form-data">



    <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick()">
              <h4>Upload image</h4>
              </div>
              <i  class="img"><img  src="img/logo.png" onClick="triggerClick()" id="profileDisplay"></i>
            </span>
           <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;"> 
           <label>Profile Image</label>
          </div>

 
				
<!-- <div class="form-group">
<input class="form-control form-control-sm" name="image" class="input-file uniform_on" id="fileInput" type="file" required>
</div> -->
<!-- 
    <label class="control-label" >Upload Photo :</label>
    <input class="form-control form-control-sm" name="image" class="input-file uniform_on" id="image" type="file" required>
    -->


    <label class="control-label" for="cost" >Reg No :</label>
      <input class="form-control form-control-sm" name="regno" id="cost" type="hidden" value='<?php echo $row['Reg_No']; ?>'  />
      <input class="form-control form-control-sm" name="regnoss" id="cost" type="text" value='<?php echo $row['Reg_No']; ?>'  disabled/>

            <div class="form-group">
			<label class="control-label" >Full-Timer(FT)  :</label>
                  <Select class="browser-default custom-select" name="ft" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from class where ID='$ft'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['FT']; ?></option>
                                 <?php
                    }
                                 ?>

<?php
                                  $query = mysql_query("select * from class")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['FT']; ?></option>
                                 <?php
                    }
                                 ?>
                                 
                              
                  </select>
                  <div class="form-group">
			<label class="control-label" >Batch  :</label>
                  <Select class="browser-default custom-select" name="batch" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from batch where ID='$batch' ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['BATCH']; ?></option>
                                 <?php
                    }
                                 ?>


<?php
                                  $query = mysql_query("select * from batch")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['BATCH']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>


                  <?php
													$user_query = mysql_query("SELECT * from trainee_info
                                                    Inner join status on trainee_info.Status=status.ID        
                                                    Inner Join class on trainee_info.Term=class.ID
                                                    Inner Join stat_saints on trainee_info.Gender=stat_saints.stat_id
                                    where trainee_info.trainee_id='$get_id'
                                              
                                                     ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
                        $id = $row['trainee_id'];
                        //   $loc = $row['LOCALITY'];
                        //   $user = $row['USER_LEVEL'];
													?>

                  

			<label class="control-label" >First Name :</label>
			<input class="form-control form-control-sm" name="fname" id="price" type="text" value='<?php echo $row['First_Name']; ?>'  required/>

      <input type="file" name="image" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;"> 
			<label class="control-label" >Middle Name :</label>
			<input class="form-control form-control-sm" name="mname" id="price" type="text" value='<?php echo $row['Middle_Name']; ?>'  required/>


			<label class="control-label" >Last Name :</label>
			<input class="form-control form-control-sm" name="lname" id="price" type="text"  value='<?php echo $row['Last_Name']; ?>'  required/>


			<label class="control-label" >Locality :</label>
      <input class="form-control form-control-sm" name="locality" id="price" type="text" value='<?php echo $row['Sending_Locality']; ?>'  required/>
      
      <div class="form-group">
			<label class="control-label" >Gender  :</label>
                  <Select class="browser-default custom-select" name="gender" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from stat_saints where Gender='$gender'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['stat_id']; ?>"><?php echo $row['Gender']; ?></option>
                                 <?php 
                    }
                                 ?>
<?php
                                  $query = mysql_query("select * from stat_saints")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['stat_id']; ?>"><?php echo $row['Gender']; ?></option>
                                 
                                 <?php        
                    }
                                 ?>    
                  </select>


            <div class="form-group">
			<label class="control-label" >Mode Status :</label>
                  <Select class="browser-default custom-select" name="stat" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from Status where ID='$stat'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['ACTION']; ?></option>
                                 <?php
                    }
                                 ?>

<?php
                                  $query = mysql_query("select * from Status")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['ACTION']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>


                  <?php
													$user_query = mysql_query("SELECT * from trainee_info
                                                    Inner join status on trainee_info.Status=status.ID        
                                                    Inner Join class on trainee_info.Term=class.ID
                                                    Inner Join stat_saints on trainee_info.Gender=stat_saints.stat_id
                                    where trainee_info.trainee_id='$get_id'
                                              
                                                     ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
                        $id = $row['trainee_id'];
                        //   $loc = $row['LOCALITY'];
                        //   $user = $row['USER_LEVEL'];
													?>


                  <label class="control-label" >Province :</label>
      <input class="form-control form-control-sm" name="province" id="price" type="text"  value='<?php echo $row['Province']; ?>'  required/>
      
      <label class="control-label" >Region :</label>
      <input class="form-control form-control-sm" name="region" id="price" type="text" value='<?php echo $row['Region']; ?>'  required/>

      <label class="control-label" >Country :</label>
      <input class="form-control form-control-sm" name="country" id="price" type="text" value='<?php echo $row['Country']; ?>'   required/>
      

      <label class="control-label" >Birthdate :</label>
      <input class="form-control form-control-sm datepicker" name="bdate" id="price" type="text"  data-toggle="datepicker"  id="date01" value='<?php echo $row['Birthdate']; ?>'  required/>
      
      <label class="control-label" >School :</label>
      <input class="form-control form-control-sm" name="school" id="price" type="text"  value='<?php echo $row['School']; ?>' required/>
      
      <label class="control-label" >Degree :</label>
      <input class="form-control form-control-sm" name="degree" id="price" type="text"  value='<?php echo $row['Degree']; ?>'  required/>
      
      <label class="control-label" >Contact Number :</label>
      <input class="form-control form-control-sm" name="contactno" id="price" type="text"  value='<?php echo $row['Contact_number']; ?>'  required/>
      

      <label class="control-label" >Email :</label>
      <input class="form-control form-control-sm" name="email" id="price" type="email"  value='<?php echo $row['Email']; ?>'  required/>
      
      <label class="control-label" >Contact Person(Guardian) :</label>
      <input class="form-control form-control-sm" name="guardian" id="price" type="text"  value='<?php echo $row['Emergency_Contact_Person']; ?>'  required/>
      
      <label class="control-label" >Relationship :</label>
      <input class="form-control form-control-sm" name="relation" id="price" type="text"  value='<?php echo $row['Relationship']; ?>'  />
      
      <label class="control-label" >Guardian Contact # :</label>
      <input class="form-control form-control-sm" name="guardcont" id="price" type="text"  value='<?php echo $row['Contact_No']; ?>'  required/>
      
                  <br>

      <br>
      <div class="col text-center">	
      <a  href="#success"  class="btn btn-primary  btn-smll"  data-toggle="modal" data-target="#success" ><i class="fa fa-recycle"></i> Update</a>
      </div>
      
      </div>
      </div>
      </div>
      </div>
                                                    <?php ?>


                                                    

<!-- Submit Modal Accounts -->
<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="samplemodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="samplemodal">Warning!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-recycle   fa-4x mb-4 text-primary" aria-hidden="true"></i>
       <h5 > Do you want to update this current data! It cannot be undone ones it was proceed! </h5>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="saves" class="btn btn-primary"><i class="icon-check icon-large"></i> Yes</button>
      </div>
    </div>
  </div>
</div>
<!--End of Modal Delete---->
                <?php }}}?>
                </form>


                
<?php
  include('functions/db.php');
if (isset($_POST['saves'])){
 
  
// $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
// $image_name = addslashes($_FILES['image']['name']);
// $image_size = getimagesize($_FILES['image']['tmp_name']);

// move_uploaded_file($_FILES["image"]["tmp_name"], "../fttma/img/" . $_FILES["image"]["name"]);
// $location = "img/" . $_FILES["image"]["name"];

// mysql_query("UPDATE `trainee_info` SET profile_img='$location' WHERE trainee_id='$get_id' ")or die(mysql_error());


  
$regno=$_POST['regno'];
$ft=$_POST['ft'];
$fname=$_POST['fname'];
$mname=$_POST['mname'];
$lname=$_POST['lname'];
$gender=$_POST['gender'];
$locality=$_POST['locality'];
$stat=$_POST['stat'];
$province=$_POST['province'];
$country=$_POST['country'];
$region=$_POST['region'];
$bdate=$_POST['bdate'];
$school=$_POST['school'];
$degree=$_POST['degree'];
$contactno=$_POST['contactno'];
$email=$_POST['email'];
$guardian=$_POST['guardian'];
$relation=$_POST['relation'];
$guardcont=$_POST['guardcont'];
$batch=$_POST['batch'];
$image=$_POST['image'];


// $profileImage=$_FILES["profileImage"]["name"];
// move_uploaded_file($_FILES["profileImage"]["tmp_name"],"Admin/img/".$_FILES["profileImage"]["name"]);

    // for the database
    $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "../Admin/img/"; 
    $target_file = $target_dir . basename($profileImageName);
    // VALIDATION
    // validate image size. Size is calculated in Bytes

    //cheacking pic;

    if($_FILES['profileImage']['size'] > 200000) {
      echo '<script> swal({title: "Note!",text: "Image size should not be greated than 200Kb", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("edittraineeinfo.php?id='.$get_id.'&ft='.$ft.'&gender='.$gender.'&batch='.$batch.'&stat='.$stat.'","_self")});</script>';
      exit();
    }
    // check if file exists
    if(file_exists($target_file)) {
      echo '<script> swal({title: "Exist!",text: "File already exists!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("edittraineeinfo.php?id='.$get_id.'&ft='.$ft.'&gender='.$gender.'&batch='.$batch.'&stat='.$stat.'","_self")});</script>';
      exit();
    }
    // Upload image only if no errors
    if (empty($error)) {
      if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
        mysql_query("UPDATE `trainee_info` SET `Last_Name`='$lname',`First_Name`='$fname',`Middle_Name`='$mname',`Gender`='$gender',
        `Status`='$stat',`Batch`='$batch',`Term`='$ft',`Sending_Locality`='$locality',`Province`='$province',`Region`='$region',
        `Country`='$country',`Birthdate`='$bdate',`School`='$school',`Degree`='$degree',`Contact_number`='$contactno',`Email`='$email',
        `Emergency_Contact_Person`='$guardian',`Relationship`='$relation',`Contact_No`='$guardcont',`Reg_No`='$regno',profile_img='$profileImageName' WHERE trainee_id='$get_id' ")or die(mysql_error());
        echo '<script> swal({title: "Praise The Lord!",text: "Successfully Manage Transaction!", customClass: "swal-wide",
          confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("edittraineeinfo.php?id='.$get_id.'&ft='.$ft.'&gender='.$gender.'&batch='.$batch.'&stat='.$stat.'","_self")});</script>';
        exit();
      
      }else 
      echo '<script> swal({title: "Error!",text: "No file !", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineeprofile.php","_self")});</script>';
      exit();
      }
    }



// to be uncheacked!!

// 		/* check activated */
//     $act = "SELECT * FROM trainee_info WHERE Reg_No='$regno'";
//     $result = mysql_query($act)or die(mysql_error());
//     $rows = mysql_fetch_array($result);
//     $activated = mysql_num_rows($result);
//     /* end */


// if($activated > 0){


  
  // mysql_query("UPDATE `trainee_info` SET `Last_Name`='$lname',`First_Name`='$fname',`Middle_Name`='$mname',`Gender`='$gender',
  // `Status`='$stat',`Batch`='$batch',`Term`='$ft',`Sending_Locality`='$locality',`Province`='$province',`Region`='$region',
  // `Country`='$country',`Birthdate`='$bdate',`School`='$school',`Degree`='$degree',`Contact_number`='$contactno',`Email`='$email',
  // `Emergency_Contact_Person`='$guardian',`Relationship`='$relation',`Contact_No`='$guardcont',`Reg_No`='$regno',profile_img='$image' WHERE trainee_id='$get_id' ")or die(mysql_error());


// $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
// $image_name = addslashes($_FILES['image']['name']);
// $image_size = getimagesize($_FILES['image']['tmp_name']);
// move_uploaded_file($_FILES["image"]["tmp_name"], "Admin/img/" . $_FILES["image"]["name"]);
// $location = "Admin/img/" . $_FILES["image"]["name"];

// echo '<script> swal({title: "Praise The Lord!",text: "Successfully Manage Transaction!", customClass: "swal-wide",
//   confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("edittraineeinfo.php?id='.$get_id.'&ft='.$ft.'&gender='.$gender.'&batch='.$batch.'&stat='.$stat.'","_self")});</script>';
// exit();




// }else{


//   echo '<script> swal({title: "OH Lord Jesus!",text: "This Register Number Already Exist!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("edittraineeinfo.php?id='.$get_id.'&ft='.$ft.'&gender='.$gender.'&batch='.$batch.'&stat='.$stat.'","_self")});</script>';
//   exit();

?>
<?php ?>