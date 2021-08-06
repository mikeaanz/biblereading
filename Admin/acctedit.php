

<?php $get_id = $_GET['id']; ?>
<?php $locality = $_GET['loc']; ?>
<?php $userlvl = $_GET['userlvl']; ?>
<div class="col-xl-3 col-lg-5">
  <div class="card shadow mb-4">
      <h6 class="m-3 font-weight-bold text-primary">Account Information</h6>
    <!-- Card Body -->
    <form  method="POST">
    <div class="card-body">
    <?php
													$user_query = mysql_query("SELECT * from accounts
                                                    LEFT join userlevel on accounts.USER_LEVEL = userlevel.ID 
                                                    LEFT join locality on accounts.LOCALITY = locality.ID
                                                    LEFT join status on accounts.STATUS = status.ID where accounts.id='$get_id'")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
                          $id = $row['ID'];
                          $userlvl=$row['USER_LEVEL'];
                          $locality=$row['LOCALITY'];
               
													?>


<div class="form-group" >
    <label class="control-label" for="cost" >Username :</label>
			<input class="form-control form-control-sm" name="Username"  type="text"  value='<?php echo $row['USERNAME']; ?>'  />
</div>
<div class="form-group" >
		    <label class="control-label" for="price">Password :</label>
			<input class="form-control form-control-sm"  name="Password" id="price" type="text"  value='<?php echo $row['PASSWORD']; ?>'  />
      </div>


      <div class="form-group" >
			<label class="control-label" >Date Created :</label>
      <input class="form-control form-control-sm" name="Datecreated" id="datecreated" type="text"  value='<?php echo $row['DATE_CREATED']; ?>'  disabled/>
    </div>

   
    <!--  <div class="form-group" >   
			<label class="control-label" >Date Activated :</label>
      -->
			<input class="form-control form-control-sm" name="" id="" type="hidden"  value='<?php echo $row['Time']; ?>'  />
    

<div class="form-group" >  

<input name="dateactive" id="dateactive" class="form-control form-control-sm"  type="hidden" value="<?php echo date('m/d/Y h:i:s a', time());  ?>" />
</div>

<div class="form-group">
      <label class="control-label" >Users Level :</label>
                  <Select class="browser-default custom-select" name="Userlevel" id="locality" required> 
                              <?php
                                  $query = mysql_query("select * from userlevel where ID = '$userlvl' ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>">Current: <?php echo $row['LEVEL']; ?> </option>
                               <?php
                    }
                                 ?>
                              <?php
                                  $query = mysql_query("select * from userlevel where ID <> 1 AND ID <> '$userlvl' ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['LEVEL']; ?> </option>
                               <?php
                    }
                                 ?>
                              
                  </select>                    

</div>


      <div class="form-group">
      <label class="control-label" >Locality :</label>
                  <Select class="browser-default custom-select" name="Locality" id="locality" required>
                              <option  disabled>Select Your Locality</option>
                              <?php
                                  $query = mysql_query("select * from locality where ID='$locality'   ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['PLACES']; ?> </option>
                               <?php
                    }
                                 ?>

                                  <?php
                                  $query = mysql_query("select * from locality where ID <> 1 AND ID <> '$userlvl'   ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['PLACES']; ?> </option>
                               <?php
                    }
                                 ?>
                              
                  </select>




            <div class="form-group">
			<label class="control-label" >Mode Status :</label>
                  <Select class="browser-default custom-select" name="Status" id="Status" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from Status ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['ACTION']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>


                  <br>

      <br>
      <div class="col text-center">	
      <a  href="#success"  class="btn btn-primary  btn-smll" data-toggle="modal" data-target="#success" ><i class="fa fa-check"></i> Activate</a>
      </div>
      </div>
      </div>
      </div>
      </div>
      <?php include 'updateactiv.php'?>
      
</form>

                                                          <!-- Submit Modal Accounts -->
        


                                                    <?php }?>



<?php
if (isset($_POST['saves'])){

$username=$_POST['Username'];
$password=$_POST['Password'];
$locality=$_POST['Locality'];
$datecreated=$_POST['Datecreated'];
$dateactivated=$POST['dateactive'];
$status=$_POST['Status'];
$userlevel=$_POST['Userlevel'];


		/* check activated */
    $act = "SELECT * FROM accounts WHERE  STATUS='1'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    /* end */
    
    $query_week = mysql_query("SELECT * FROM accounts WHERE STATUS='2'")or die(mysql_error());
		$num_row_week = mysql_num_rows($query_week);
        $row_week = mysql_fetch_array($query_week);

    /* end */

if($activated > 0){

	$result = mysql_query("UPDATE accounts SET 
    USERNAME='$username',
    PASSWORD='$password',
    USER_LEVEL='$userlevel',
    LOCALITY='$locality',
    DATE_CREATED='$datecreated',
    STATUS='$status'
     where id='$get_id' ")or die(mysql_error());


     


echo '<script> swal({title: "Good Job!",text: "Successfully Manage Transaction!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("accountactivation.php","_self")});</script>';
exit();


}else if($row_week > 0){
	$catch = mysql_query("UPDATE `accounts` SET 
    USERNAME='$username',PASSWORD='$password',USER_LEVEL='$userlevel',
    LOCALITY='$locality',DATE_CREATED='$datecreated',STATUS='$status' WHERE id='$get_id' ")or die(mysql_error());

echo '<script> swal({title: "OH NO!",text: "Successfully Deactivated Accounts!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("accountactivation.php","_self")});</script>';
exit();


}
?>
<script>
  window.location = "accountactivation.php"; 
</script>
<?php }?>
<!--End of Modal Delete---->