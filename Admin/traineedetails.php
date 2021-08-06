
<div class="col-xl-3 col-lg-5">
  <div class="card shadow mb-4">
  <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"  aria-expanded="true" aria-controls="collapseCardExample">
  <h6 class="m-3 font-weight-bold text-primary"><i class="fas fa-plus">Trainee Information Add Details</i></h6>
	  </a>
	  <!-- Card Content - Collapse -->
	  <div class="collapse hide" id="collapseCardExample">
      <div class="card-body">
    <form  method="POST">
 
 <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick()">
              <h4>Upload image</h4>
              </div>
              <i  class="img"><img  src="img/logo.png" onClick="triggerClick()" id="profileDisplay"></i>
            </span>
           <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;"> 
           <label class="text-center">Profile Image</label>
          </div>					

    <label class="control-label" for="cost" >Reg No :</label>
			<input class="form-control form-control-sm" name="regno" id="cost" type="text"  />

            <div class="form-group">
			<label class="control-label" >Full-Timer(FT)  :</label>
                  <Select class="browser-default custom-select" name="ft" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from class")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['FT']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>
                  </div>

                    <div class="form-group">
			<label class="control-label" >Batch  :</label>
                  <Select class="browser-default custom-select" name="batch" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from batch")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['BATCH']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>

                  </div>


			<label class="control-label" >First Name :</label>
			<input class="form-control form-control-sm" name="fname" id="price" type="text"   required/>


			<label class="control-label" >Middle Name :</label>
			<input class="form-control form-control-sm" name="mname" id="price" type="text"  required/>


			<label class="control-label" >Last Name :</label>
			<input class="form-control form-control-sm" name="lname" id="price" type="text"  required/>


			<label class="control-label" >Locality :</label>
      <input class="form-control form-control-sm" name="locality" id="price" type="text"  required/>


      <div class="form-group">
			<label class="control-label" >Gender  :</label>
                  <Select class="browser-default custom-select" name="gender" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
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
                                  $query = mysql_query("select * from Status")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['ACTION']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>

      <label class="control-label" >Province :</label>
      <input class="form-control form-control-sm" name="province" id="price" type="text"  required/>

      <label class="control-label" >Region :</label>
      <input class="form-control form-control-sm" name="region" id="price" type="text"  required/>

      <label class="control-label" >Country :</label>
      <input class="form-control form-control-sm" name="country" id="price" type="text"  required/>
      
      
      <label class="control-label" >Birthdate :</label>
      <input class="form-control form-control-sm datepicker" name="bdate" data-toggle="datepicker"  id="date01" type="text"  required/>
      
      <label class="control-label" >School :</label>
      <input class="form-control form-control-sm" name="school" id="price" type="text"  required/>
      
      <label class="control-label" >Degree :</label>
      <input class="form-control form-control-sm" name="degree" id="price" type="text"   required/>
      
      <label class="control-label" >Contact Number :</label>
      <input class="form-control form-control-sm" name="contactno" id="price" type="text"  required/>
      

      <label class="control-label" >Email :</label>
      <input class="form-control form-control-sm" name="email" id="price" type="text"  required/>
      
      <label class="control-label" >Contact Person(Guardian) :</label>
      <input class="form-control form-control-sm" name="guardian" id="price" type="text"  required/>
      
      <label class="control-label" >Relationship :</label>
      <input class="form-control form-control-sm" name="relation" id="price" type="text"  required/>
      
      <label class="control-label" >Guardian Contact # :</label>
      <input class="form-control form-control-sm" name="guardcont" id="price" type="text"  required/>
      
                  <br>

      <br>
      <div class="col text-center">	
      <a  href="#success"  class="btn btn-primary  btn-smll" data-toggle="modal" data-target="#success" ><i class="fa fa-check"></i>Submit</a>
      </div>
      </div>

    
      <!-- Modal -->
      <?php include ("includes/modaltraineesubmit.php"); ?>





  
                  <?php ?>


                                                    
                  </form>


                
                  <?php
if (isset($_POST['saves'])){

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
$image=$_POST['profileImage'];
$profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
// For image upload
$target_dir = "../Admin/img/"; 
$target_file = $target_dir . basename($profileImageName);

		/* check activated */
    $act = "SELECT * FROM trainee_info WHERE Reg_No='$regno' or profile_img='$image'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    /* end */

    if($activated > 0){

      echo '<script> swal({title: "Lord Jesus!",text: "Registered Number or File Image Already Exists!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("traineeprofile.php","_self")});</script>';
      exit();
      
      }



    if($_FILES['profileImage']['size'] > 4000000000) {

      echo '<script> swal({title: "afsasf!",text: "Successfully Manage Transaction!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("edittraineeinfo.php?id='.$get_id.'&ft='.$ft.'&gender='.$gender.'&batch='.$batch.'&stat='.$stat.'","_self")});</script>';
      exit();

    }
    // check if file exists
    if(file_exists($target_file)) {

      echo '<script> swal({title: "safamichosf!",text: "Successfully Manage Transaction!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("edittraineeinfo.php?id='.$get_id.'&ft='.$ft.'&gender='.$gender.'&batch='.$batch.'&stat='.$stat.'","_self")});</script>';
      exit();
  

    }
    // Upload image only if no errors
    if (empty($error)) {

      mysql_query("INSERT INTO trainee_info (Last_Name,First_Name,Middle_Name,Gender,Status,Batch,Term,Sending_Locality,Province,Region,Country,Birthdate,School,Degree,Contact_number,Email,Emergency_Contact_Person,Relationship,Contact_No,Reg_No,profile_img)
      VALUES ('$lname','$fname','$mname','$gender','$stat','$batch','$ft','$locality','$province','$region','$country','$bdate','$school','$degree','$contactno','$email','$guardian','$relation','$guardcont','$regno','$profileImageName')")or die(mysql_error());
   
   echo '<script> swal({title: "Praise The Lord!",text: "Successfully Manage Transaction!", customClass: "swal-wide",
     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineeprofile.php","_self")});</script>';
   exit();

}else 
echo '<script> swal({title: "Error!",text: "No file !", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineeprofile.php","_self")});</script>';
exit();
}
?>
<?php ?>