<form method="POST">
<!-- Submit Modal Accounts -->
<div class="modal fade" id="recovered" tabindex="-1" role="dialog" aria-labelledby="samplemodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="samplemodal">    <i class="fa fa-plus"></i> Recovered Saints</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      
        </button>
      </div>
      <div class="modal-body">
      <div class="text-left">
      <!-- <i class="fas fa-plus-circle fa-3x mb-4 text-primary" aria-hidden="true"></i>
     -->

     
			<label class="control-label" >Name of Brother and Sister:</label>
			<input class="form-control form-control-lg" name="name" id="price" type="text"  required/>


    

            <div class="dates">
			<label class="dates" for="price">Date Recovered:</label>
			<input class="form-control form-control-lg" data-toggle="datepicker" readonly

 onkeypress="return isNumberKey(event)" style="background-color:#aed6f1;"  id="usr1" name="daterec"  placeholder="mm-dd-yyyy" autocomplete="off" required/>

			<input class="form-control form-control-lg dates" name="timesup" id="price" type="hidden" value="<?php echo date('m/d/Y');  ?>" />
</div>

            <div class="form-group">
			<label class="control-label" >Status :</label>
                  <Select class="browser-default custom-select" name="userlevel" id="userlevel" required>

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




			<label class="control-label" for="price">Home Address:</label>
			<input class="form-control form-control-lg" name="homeadd" id="price" type="text"  />


			<label class="control-label" for="price">Cell-Phone #:</label>
			<input class="form-control form-control-lg" name="cell" id="price" type="Number" placeholder="Example +6393045311711" maxlength="11" required/>


   </div>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="insertprop" class="btn btn-primary"><i class="icon-check icon-large"></i> Yes</button>
      </div>
    </div>
  </div>
</div>
</form>

<?php
    include('functions/db.php');
 $historyfeedbackid = $_GET['locate_idpost'];
if (isset($_POST['insertprop'])){
    
$name=$_POST['name'];
$daterec=$_POST['daterec'];
$userlevel=$_POST['userlevel'];
$homeadd=$_POST['homeadd'];
$cell=$_POST['cell'];


  $act = "SELECT * FROM recoversaints WHERE `Name`='$name' and acc_id='$session_id' and historyfeedback='$historyfeedbackid'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    



if($activated > 0){


echo '<script> swal({title: "Notice!",text: "Your data already existing.", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("recestlocal.php?locate_idpost='.$historyfeedbackid.'&BATCH='.$getbatch.'","_self")});</script>';
exit();


}else {
// to be continue!!!

	mysql_query("INSERT INTO `recoversaints`(`Name`, `Home_address`, `Status`, `cellphone`,`acc_id`, `historyfeedback`, `Date_recovered`) 
    VALUES ('$name','$homeadd','$userlevel','$cell','$session_id','$historyfeedbackid','$daterec')")or die(mysql_error());
	
echo '<script> swal({title: "Praise the Lord!",text: "Your Data Successfully Save!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("recestlocal.php?locate_idpost='.$historyfeedbackid.'&BATCH='.$getbatch.'","_self")});</script>';
exit();



}
?>

<?php }?>