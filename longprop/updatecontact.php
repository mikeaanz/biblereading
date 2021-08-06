


<form  method="POST">
<div class="container">
<div class="row">



  <div class="col-lg-12">

  					<!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
					  <?php
												  $user_query = mysql_query("SELECT * FROM `contatcdetails`  where contact_id='$contacid'
												  ")or die(mysql_error());
												  while($row = mysql_fetch_array($user_query)){
						  $id=$row['contact_id'];
                          $contactstatus=$row['contactstatus_id'];
												  ?>
					  <!--END OF CODE ---->


	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
	  <div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary text-center">Update Positive Contact</h6>
	  </div>
	  <div class="card-body">
	  <div class="form-group">
    <label for="exampleInputEmail1">Contact's Full Name :</label>
    <input type="text" name="fullname" class="form-control" id="exampleInputEmail1" value='<?php echo $row['FullName'];?>'  placeholder="Ex.Jose Potasio Rizal">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Contact Number :</label>
    <input type="text" name="contactnum" class="form-control" id="exampleInputEmail1" value='<?php echo $row['ContactNumber'];?>'  placeholder="Ex.09304531711">
 
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Address :</label>
    <input type="text" name="address" class="form-control" id="exampleInputEmail1"  value='<?php echo $row['address'];?>' placeholder="Ex.Navotas City, District 4">

  </div>
  <!-- <div class="form-group">
    <label for="exampleInputEmail1">Baptism :</label>
    <input type="text" name="bap" class="form-control" data-toggle="datepicker" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>  -->
  <div class="form-group">
			<label class="control-label" >Status Gender :</label>
                  <Select class="browser-default custom-select" name="gender" id="userlevel" required>

                     <option  disabled>Select Mode Gender Saints</option>
                              <?php
                                  $query = mysql_query("select * from stat_saints where stat_id='$statid'")or die(mysql_error());
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
			<label class="control-label" >Status Saints :</label>
                  <Select class="browser-default custom-select" name="contstat" id="userlevel" required>

                     <option  disabled>Select Mode Status Saints</option>
                              <?php
                                  $query = mysql_query("select * from contactstatus where ID='$contactstatus'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['saints_legend']; ?></option>
                                 <?php
                    }
                                 ?>

<?php
                                  $query = mysql_query("select * from contactstatus")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['saints_legend']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>        

                    	  <?php
												  $user_query = mysql_query("SELECT * FROM `contatcdetails`  where contact_id='$contacid'
												  ")or die(mysql_error());
												  while($row = mysql_fetch_array($user_query)){
						  $id=$row['contact_id'];
                          $contactstatus=$row['contactstatus_id'];
												  ?>  
<div class="form-group">
    <label for="exampleInputEmail1">Shepherding Materials :</label>
    <input type="text" name="shep" class="form-control" id="exampleInputEmail1" value="<?php echo $row['shepmaterial'];?>"  placeholder="Ex. Trust Obey(Lesson 1.)">
  </div>

		
			<br>
			<div class="col text-center">		
   					 <button type="button" class="btn btn-primary btn-lg" id="btnEditProgData"  data-toggle="modal"    data-target="#manage" ><i class="fa fa-recycle"></i> UPDATE</button>
	  </div>
	</div>
	  </div>
	  <?php include 'modalupdate.php' ?>
</form>
	</div>
    
												  <?php }}?>
  </div>




<?php
		include('functions/db.php');
if (isset($_POST['SAVES'])){
    $fullname = $_POST['fullname'];
    $contactnum = $_POST['contactnum'];
    $address = $_POST['address'];
    // $bap =$_POST['bap'];
    $contstat=$_POST['contstat'];
    $shep = $_POST['shep'];
    $gender=$_POST['gender'];


/* check activated */
$act = "SELECT * FROM contatcdetails WHERE  curteam_id='$get_id'";
$result = mysql_query($act)or die(mysql_error());
$rows = mysql_fetch_array($result);
$activated = mysql_num_rows($result);
/* end */


if($activated > 0){
    mysql_query("UPDATE `contatcdetails` SET 
`FullName`='$fullname',`ContactNumber`='$contactnum',`address`='$address',`contactstatus_id`='$contstat',`shepmaterial`='$shep',gender='$gender'
 WHERE contact_id='$contacid'")or die(mysql_error());

echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("addcontact.php?id='.$get_id.'","_self")});</script>';
exit();



}else{
 echo '<script> swal({title: "Lord Jesus!",text: "This data already exist!", customClass: "swal-wide",
confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("addcontact.php?id='.$get_id.'","_self")});</script>';
exit();
}
}?>

<?php ?>