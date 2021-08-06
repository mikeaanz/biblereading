


<div class="col-xl-3">
  <div class="card shadow mb-4">
      <h6 class="m-3 font-weight-bold text-primary">Recovered District Information</h6>
    <!-- Card Body -->
    <form  method="POST">
    <div class="card-body">

    <?php
							$user_query = mysql_query("SELECT * FROM rec_district 
						 where rec_district.dist_id='$ids'
							")or die(mysql_error());
							while($row = mysql_fetch_array($user_query)){
							$id=$row['dist_id'];
                     
     ?>

            <label class="control-label" >Name of Recovered District:</label>
                        <input class="form-control form-control-lg" name="name" value="<?php echo $row['districtname'];?>" id="price" type="text"  />

 
                        <div class="dates">
			<label class="dates" for="price">Date Recovered District:</label>
			<input value="<?php echo $row['daterecovered'];?>" class="form-control form-control-lg" onkeypress="return isNumberKey(event)" style="background-color:#aed6f1;"  id="usr1" name="date"  placeholder="mm-dd-yyyy" autocomplete="off" required/>

			<input class="form-control form-control-lg dates" name="timesup" id="price" type="hidden" value="<?php echo date('m/d/Y');  ?>" />
</div>

	
                  <br>

      <br>
      <div class="col text-center">	
      <a  href="#success"  class="btn btn-primary  btn-smll" data-toggle="modal" data-target="#success" ><i class="fa fa-recycle"></i> Update</a>
      </div>
      </div>
      </div>
      </div>
      </div>
      <div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="samplemodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-success">
        <h5 class="modal-title" style='color:#F8FAFB'   id="samplemodal">Warning!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-check fa-4x mb-4 text-success" aria-hidden="true"></i>
       <h5 > Do you want to update this current data! It cannot be undone ones it was proceed! </h5>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="saves" class="btn btn-success"><i class="icon-check icon-large"></i> Yes</button>
      </div>
    </div>
      
</form>

 
<?php
    include('functions/db.php');
if (isset($_POST['saves'])){
    
$name=$_POST['name'];
$daterec=$_POST['date'];



  $act = "SELECT * FROM rec_district WHERE dist_id='$ids'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    



if($activated > 0){
    
    $result =mysql_query("UPDATE `rec_district` SET
   `districtname`='$name',
     `daterecovered`='$daterec'
    ")or die(mysql_error());
    
	echo '<script> swal({title: "Good Job!",text: "Your Data Successfully Updated!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("editrecdistrict.php?historyfeedbackid='.$back.'&id='.$ids.'","_self")});</script>';
      exit();

}else {
// to be continue!!!


echo '<script> swal({title: "Notice!",text: "Your data already existing.", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("editrecdistrict.php?historyfeedbackid='.$back.'&id='.$ids.'","_self")});</script>';
  exit();


}
?>

<?php }}?>