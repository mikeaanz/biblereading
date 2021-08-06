<form method="POST">
<!-- Submit Modal Accounts -->
<div class="modal fade" id="recovered" tabindex="-1" role="dialog" aria-labelledby="samplemodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="samplemodal">    <i class="fa fa-plus"></i>Prospect Trainee Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      
        </button>
      </div>
      <div class="modal-body">
      <div class="text-left">
      <!-- <i class="fas fa-plus-circle fa-3x mb-4 text-primary" aria-hidden="true"></i>
     -->

     
			<label class="control-label" >Name of Prospect Trainee:</label>
			<input class="form-control form-control-lg" name="name" id="price" type="text"  required/>



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



			<label class="control-label" for="price">Cell-Phone #:</label>
			<input class="form-control form-control-lg" name="cell" id="price" 
 onkeypress="return isNumberKey(event)" placeholder="Example +6393045311711"  maxlength="11" required/>

			<input class="form-control form-control-lg" name="timesup" id="price" type="hidden" value="<?php echo date('m/d/Y h:i:s a', time());  ?>" />



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
$timesup=$_POST['timesup'];
$userlevel=$_POST['userlevel'];
$cell=$_POST['cell'];


  $act = "SELECT * FROM prospect_train WHERE `Name`='$name' and acc_id='$session_id' and historyfeedback='$historyfeedback'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    



if($activated > 0){


echo '<script> swal({title: "Notice!",text: "Your data already existing.", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("prospecttrain.php?locate_idpost='.$historyfeedbackid.'","_self")});</script>';
exit();


}else {
// to be continue!!!

	mysql_query("INSERT INTO `prospect_train`(`Name`, `Status`, `acc_id`, `historyfeedback`, `date_prospect`, `cellphone`)
     VALUES ('$name','$userlevel','$session_id','$historyfeedbackid','$timesup','$cell')")or die(mysql_error());
	
echo '<script> swal({title: "Good Job!",text: "Your Data Successfully Save!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("prospecttrain.php?locate_idpost='.$historyfeedbackid.'","_self")});</script>';
exit();



}
?>

<?php }?>