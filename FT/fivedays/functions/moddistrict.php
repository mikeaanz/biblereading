<form method="POST">
<!-- Submit Modal Accounts -->
<div class="modal fade" id="recovered" tabindex="-1" role="dialog" aria-labelledby="samplemodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="samplemodal">    <i class="fa fa-plus"></i> Recovered District Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      
        </button>
      </div>
      <div class="modal-body">
      <div class="text-left">
      <!-- <i class="fas fa-plus-circle fa-3x mb-4 text-primary" aria-hidden="true"></i>
     -->

     
			<label class="control-label" >Name of Recovered District :</label>
			<input class="form-control form-control-lg" name="name" id="price" type="text"  />

      <div class="dates">
			<label class="dates" for="price">Date Recovered District:</label>
			<input class="form-control form-control-lg" onkeypress="return isNumberKey(event)" style="background-color:#aed6f1;"  id="usr1" name="date"  placeholder="mm-dd-yyyy" autocomplete="off" required/>

			<input class="form-control form-control-lg dates" name="timesup" id="price" type="hidden" value="<?php echo date('m/d/Y');  ?>" />
</div>

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
 $historyfeedbackid = $_GET['historyfeedbackid'];
    $ids=$_GET['id'];

if (isset($_POST['insertprop'])){
    
$name=$_POST['name'];
$timesup=$_POST['date'];



  $act = "SELECT * FROM rec_district WHERE `districtname`='$name'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    



if($activated > 0){


echo '<script> swal({title: "Notice!",text: "Your data already existing.", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("recdistrict.php?locate_idpost='.$historyfeedbackid.'","_self")});</script>';
exit();


}else {
// to be continue!!!

	mysql_query("INSERT INTO `rec_district`(`districtname`, `daterecovered`, `acc_id`, `historyfeedback`)
     VALUES ('$name','$timesup','$session_id','$historyfeedbackid')")or die(mysql_error());
	
echo '<script> swal({title: "Good Job!",text: "Your Data Successfully Save!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("recdistrict.php?locate_idpost='.$historyfeedbackid.'","_self")});</script>';
exit();



}
?>

<?php }?>   