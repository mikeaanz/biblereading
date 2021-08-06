



<div class="col-xl-3 col-lg-5">
  <div class="card shadow mb-4">
      <h6 class="m-3 font-weight-bold text-primary">Manage Propagation</h6>

   <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->

                        <!--END OF CODE ---->

                        <form  method="POST">

    <!-- Card Body -->

    <div class="card-body">





            <div class="form-group">
			<label class="control-label" >Propagation Month :</label>
                  <Select class="browser-default custom-select" name="month" id="month" required>

                     <option  disabled>Select Month Propagation</option>
                              <?php
                                  $query = mysql_query("select * from month order by id asc ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['MONTH']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>



                  
            <div class="form-group">
			<label class="control-label" >Propagation Year :</label>
                  <Select class="browser-default custom-select" name="year" id="year" required>

                     <option  disabled>Select Year Propagation</option>
                              <?php
                                  $query = mysql_query("select * from year order by id asc ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['YR']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>


                  <div class="form-group">
			<label class="control-label" >Propagation Batch :</label>
                  <Select class="browser-default custom-select" name="batch" id="batch" required>

                     <option  disabled>Select Batch Propagation</option>
                              <?php
                                  $query = mysql_query("select * from batch order by id asc ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['BATCH']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>



                  
                  <div class="form-group">
			<label class="control-label" >Propagation Week :</label>
                  <Select class="browser-default custom-select" name="week" id="week" required>

                     <option  disabled>Select Propagation Week</option>
                              <?php
                                  $query = mysql_query("select * from Week order by id asc ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['week']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>


                  <div class="form-group">
			<label class="control-label" >Propagation Users :</label>
                  <Select class="browser-default custom-select" name="accid" id="week" required>

                     <option  disabled>Select Propagation Week</option>
                              <?php
                                  $query = mysql_query("select * from userlevel where ID='2' or ID='3' or ID='4' order by id asc")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['LEVEL']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>


    <input class="form-control form-control-lg" name="timesup" id="price" type="hidden" value="<?php echo date('m/d/Y h:i:s a', time());  ?>" />

                  
                  <div class="form-group">
			<label class="control-label" >Status Post:</label>
                  <Select class="browser-default custom-select" name="status" id="week" required>

                     <option  disabled>Select Propagation Status</option>
                              <?php
                                  $query = mysql_query("select * from status where ID='2' order by id asc")or die(mysql_error());
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
      <a  href="#success"  class="btn btn-primary  btn-smll" data-toggle="modal"    data-target="#manage" ><i class="fa fa-exchange-alt"></i> Manage</a>
      </div>
      
      </div>
      </div>
      </div>
      </div>
<!-- Submit Modal Accounts -->
<div class="modal fade" id="manage" tabindex="-1" role="dialog" aria-labelledby="samplemodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="samplemodal">Post Feedback!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-sticky-note fa-4x mb-4 text-primary" aria-hidden="true"></i>
       <h5 > Do you want to Post this current data! It cannot be undone ones it was proceed! </h5>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="manage" class="btn btn-primary"><i class="icon-check icon-large"></i> Yes</button>
      </div>
    </div>
  </div>
</div>
<!--End of Modal Delete---->



                                                    <?php ?>


                                                    


</form>
<?php}?>

<?php
		include('functions/db.php');
if (isset($_POST['manage'])){

$month=$_POST['month'];
$yr=$_POST['year'];
$batch=$_POST['batch'];
$week=$_POST['week'];
$accid=$_POST['accid'];
$status=$_POST['status'];
$time=$_POST['timesup'];

		/* check feedback cheacking */
    $act = "SELECT * FROM feedback WHERE MONTH='$month' and YEAR='$yr' and BATCH='$batch' and WEEK='$week' and acc_id='$accid'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    /* end */
    


if($activated > 0){
    echo '<script> swal({title: "OH NO!",text: "This Feedback Already Prepared!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("feedback.php","_self")});</script>';
      exit();


}else {
    mysql_query("INSERT INTO `Feedback`(`MONTH`, `YEAR`, `BATCH`,`WEEK`,`acc_id`,`status_id`,date_started) 
    VALUES ('$month','$yr','$batch','$week','$accid','$status','$time')")or die(mysql_error());

    mysql_query("INSERT INTO `historyfeedback`(`MONTH`, `YEAR`, `BATCH`,`WEEK`,`acc_id`,`status_id`,date_started) 
    VALUES ('$month','$yr','$batch','$week','$accid','$status','$time')")or die(mysql_error());

echo '<script> swal({title: "Good Job!",text: "Successfully Prepared, If you want to activate this account please go to history feedback!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("feedback.php","_self")});</script>';
exit();



}
?>

<?php }?>
<!--End of Modal Delete---->