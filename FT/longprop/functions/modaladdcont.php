<form  method="post" enctype="multipart/form-data">
<!-- Delete Modal Accounts -->
<div class="modal fade" id="addme" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="exampleModalLabel">Add Contact's</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">

      <!-- <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
                  <div class="text-center img-placeholder"  onClick="triggerClick()">
              <h4>Upload image</h4>
              </div>
              <i  class="img"><img  src="img/logo.png" onClick="triggerClick()" id="profileDisplay"></i>
            </span>
           <input type="file" name="image" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;"> 
           
          </div>
          <label>Profile Image</label>
 
						 -->
								
</div>

  <div class="form-group">
    <label for="exampleInputEmail1">Contact's Full Name :</label>
    <input type="text" name="fullname" class="form-control" id="exampleInputEmail1"  placeholder="Ex.Jose Potasio Rizal" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Contact Number :</label>
    <input type="text" name="contactnum" class="form-control" id="exampleInputEmail1"  placeholder="Ex.09304531711" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
 
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Address :</label>
    <input type="text" name="address" class="form-control" id="exampleInputEmail1"  placeholder="Ex.Navotas City, District 4" required>

  </div>
  <!-- <div class="form-group">
    <label for="exampleInputEmail1">Baptism :</label>
    <input type="text" name="bap" class="form-control" data-toggle="datepicker" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>  -->

  <div class="form-group">
			<label class="control-label" >Gender :</label>
                  <Select class="browser-default custom-select" name="gender" id="userlevel" required>

                     <option  disabled>Select Mode Status Gender</option>
                              <?php
                                  $query = mysql_query("select * from stat_saints")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['stat_id']; ?>"><?php echo $row['Gender']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>    
                    </div>      

  <div class="form-group">
			<label class="control-label" >Status Saints :</label>
                  <Select class="browser-default custom-select" name="contstat" id="userlevel" required>

                     <option  disabled>Select Mode Status Saints</option>
                              <?php
                                  $query = mysql_query("select * from contactstatus")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['saints_legend']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>    
                    </div>          
<!-- <div class="form-group">
    <label for="exampleInputEmail1">Shepherding Materials :</label>
    <input type="text" name="shep" class="form-control" id="exampleInputEmail1"  placeholder="Ex. Trust Obey(Lesson 1.)" required>
  </div> -->

      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="saves"  class="btn btn-primary"><i class="fas fa-thumbs-up icon-check icon-large"></i> Amen!</button>
      </div>
    </div>
  </div>
</div>
<!--End of Modal Delete---->
                <?php} ?>
</form>
<?php
if (isset($_POST['saves'])){

            $fullname = $_POST['fullname'];
            $contactnum = $_POST['contactnum'];
            $address = $_POST['address'];
            // $bap =$_POST['bap'];
            $contstat=$_POST['contstat'];
            // $shep = $_POST['shep'];
            $gender = $_POST['gender'];

		/* check activated */
    $act = "SELECT * FROM contatcdetails WHERE FullName='$fullname' and  curteam_id='$get_id'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    /* end */


if($activated > 0){

echo '<script> swal({title: "Warning!",text: "This data already exist!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("contactadd.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
exit();



}else{

    mysql_query("INSERT INTO `contatcdetails`(`FullName`,`ContactNumber`,`address`,`contactstatus_id`,`curteam_id`,acc_id,gender) 
    VALUES ('$fullname','$contactnum','$address','$contstat','$get_id','$session_id','$gender')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("contactadd.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}
}?>
<?php ?>