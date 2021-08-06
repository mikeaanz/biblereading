<form method="POST">
<!-- Submit Modal Accounts -->
<div class="modal fade" id="uptrecovered" tabindex="-1" role="dialog" aria-labelledby="samplemodal" aria-hidden="true">
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
			<input class="form-control form-control-lg" name="Name" id="price" type="text"  />


            <label class="control-label" >Date Recovered:</label>
            <input class="form-control form-control-lg" data-date-format="mm/dd/yyyy" name="daterec"  data-provide="datepicker">
  
		
            <div class="form-group">
			<label class="control-label" >Status :</label>
                  <Select class="browser-default custom-select" name="userlevel" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from status_saints")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['stat_id']; ?>"><?php echo $row['Gender']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>




			<label class="control-label" for="price">Home Address:</label>
			<input class="form-control form-control-lg" name="homeadd" id="price" type="text"  />

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
if (isset($_POST['insertprop'])){
    
$name=$_POST['name'];
$daterec=$_POST['daterec'];
$userlevel=$_POST['userlevel'];
$homeadd=$_POST['homeadd'];



  $act = "SELECT * FROM recoveredsaints WHERE `Name`='$name'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    



if($activated > 0){


echo '<script> swal({title: "Notice!",text: "Your data already existing.", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("myentry.php?locate_idpost='.$historyfeedbackid.'","_self")});</script>';
exit();


}else {
// to be continue!!!

	mysql_query("INSERT INTO `recoveredsaints`( `Name`, `Date_recovered`, `Status`, `Home_address`, `acc_id`, `historyfeedback_id`) 
    VALUES ('$name','$daterec','$userlevel','$homeadd','$session_id','$historyfeedbackid')")or die(mysql_error());
	
echo '<script> swal({title: "Good Job!",text: "Your Data Successfully Save!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("myentry.php?locate_idpost='.$historyfeedbackid.'","_self")});</script>';
exit();



}
?>

<?php }?>