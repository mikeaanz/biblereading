



<div class="col-xl-3 col-lg-5">
  <div class="card shadow mb-4">
      <h6 class="m-3 font-weight-bold text-info">Reposted Propagation</h6>

   <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->

   <?php
                                                    $user_query = mysql_query("SELECT * from historyfeedback  
                                                    where id='$get_id'")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){

                                                        $id=$row['id'];
                                                        $month=$row['MONTH'];
                                                        $yr=$row['YEAR'];
                                                        $BATCH=$row['BATCH'];
                                                        $week=$row['WEEK'];
                                                        $accid=$row['acc_id'];
                                                        $status=$row['status_id'];
                                                        ?>

                        <!--END OF CODE ---->

                        <form  method="POST">

    <!-- Card Body -->




    <div class="card-body">





            <div class="form-group">
			<label class="control-label" >Propagation Month :</label>
                  <Select class="browser-default custom-select" name="month" id="month" required>

            
                  <?php
                                  $query = mysql_query("SELECT * from month where ID='$month' ORDER BY `ID` ASC  ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>" ><?php echo $row['MONTH']; ?></option>
                                 <?php
                    }
                                 ?>

                     
                              <?php
                                  $query = mysql_query("select * from month ORDER BY `ID` ASC")or die(mysql_error());
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

                  <?php
                                  $query = mysql_query("select * from year WHERE ID='$yr'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>" ><?php echo $row['YR']; ?></option>
                                 <?php
                    }
                                 ?>

                              <?php
                                  $query = mysql_query("select * from year ")or die(mysql_error());
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

                  <?php
                                  $query = mysql_query("select * from batch where ID='$BATCH'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>" ><?php echo $row['BATCH']; ?></option>
                                 <?php
                    }
                                 ?>

                              <?php
                                  $query = mysql_query("select * from batch ")or die(mysql_error());
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

                  <?php
                                  $query = mysql_query("select * from Week where ID='$week' ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>" ><?php echo $row['week']; ?></option>
                                 <?php
                    }
                                 ?>

                              <?php
                                  $query = mysql_query("select * from Week ")or die(mysql_error());
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

                  <?php
                                  $query = mysql_query("select * from userlevel where ID='$accid'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['LEVEL']; ?></option>
                                 <?php
                    }
                                 ?>

                              <?php
                                  $query = mysql_query("select * from userlevel where ID='2' or ID='3' or ID='4'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['LEVEL']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>


                  
                  <div class="form-group">
			<label class="control-label" >Status Posted :</label>
                  <Select class="browser-default custom-select" name="status_id" id="week" required>

                  <?php
                                  $query = mysql_query("select * from status where ID='$status'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['ACTION']; ?></option>
                                 <?php
                    }
                                 ?>

                              <?php
                                  $query = mysql_query("select * from status")or die(mysql_error());
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
      <a  href="#success"  class="btn btn-info btn-circle .btn-lg" data-toggle="modal"    data-target="#manage" ><i class="fa fa-plus-circle "></i></a>
      </div>
      
      </div>
      </div>
                <?php }?>
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
       <!-- <input type="password" class="form-group"> -->
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
$status_id=$_POST['status_id'];


		/* check feedback cheacking */
    $act = "SELECT * FROM historyfeedback WHERE MONTH='$month' and YEAR='$yr' and BATCH='$batch' and WEEK='$week' and acc_id='$accid' and status_id='$status_id' ";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    /* end */
    


if($activated > 0){



echo '<script> swal({title: "Warnig!",text: "This data already exist in the database! Thank You.", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("historypost.php","_self")});</script>';
exit();


}else {
   // mysql_query("INSERT INTO `feedback`(`MONTH`, `YEAR`, `BATCH`,`WEEK`,`acc_id`) 
    //VALUES ('$month','$yr','$batch','$week','$accid')")or die(mysql_error());


//mysql_query("INSERT INTO `historyfeedback`(`MONTH`, `YEAR`, `BATCH`,`WEEK`,`acc_id`) 
//VALUES ('$month','$yr','$batch','$week','$accid')")or die(mysql_error());

//mysql_query("INSERT INTO `historyfeedback`(`MONTH`,`YEAR`,`BATCH`,`WEEK`,`acc_id`,`status_id`) 
//VALUES ('$month','$yr','$batch','$week','$accid','$status_id')")or die(mysql_error());

//$result = mysql_query("UPDATE historyfeedback SET 
//MONTH='$month',
//YEAR='$yr',
//BATCH='$batch',
//WEEK='$week',
//acc_id='$accid',
//status_id='$status_id'

 //where id='$get_id' ")or die(mysql_error());


 $result = mysql_query("UPDATE historyfeedback   SET 
MONTH='$month',
YEAR='$yr',
BATCH='$batch',
WEEK='$week',
acc_id='$accid',
status_id='$status_id'

 where id='$get_id' ")or die(mysql_error());


echo '<script> swal({title: "Good Job!",text: "Successfully Posted!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("historypost.php","_self")});</script>';
exit();



}
?>

<?php }?>
<!--End of Modal Delete---->