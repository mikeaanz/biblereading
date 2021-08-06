



<div class="col-xl-3 col-lg-5">
  <div class="card shadow mb-4">
      <h6 class="m-3 font-weight-bold text-primary">Update Type Of Team</h6>

   <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->

                        <!--END OF CODE ---->



    <!-- Card Body -->

    <div class="card-body">

<form method="POST">

    <div class="form-group">
			<label class="control-label" >Month :</label>
                  <Select class="browser-default custom-select" name="month" id="userlevel" >

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from month where ID='$month'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['MONTH']; ?></option>
                                 <?php
                    }
                                 ?>

<?php
                                  $query = mysql_query("select * from month order by id asc")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['MONTH']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>

                  
    <div class="form-group">
			<label class="control-label" >Year :</label>
                  <Select class="browser-default custom-select" name="year" id="userlevel" >

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from year where ID='$year'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['YR']; ?></option>
                                 <?php
                    }
                                 ?>
                                                   <?php
                                  $query = mysql_query("select * from year order by id asc")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['YR']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>

                                    
    <div class="form-group">
			<label class="control-label" >Batch :</label>
                  <Select class="browser-default custom-select" name="batch" id="userlevel" >

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from batch where ID='$batch_id'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['BATCH']; ?></option>
                                 <?php
                    }
                                 ?>

<?php
                                  $query = mysql_query("select * from batch order by id asc")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['BATCH']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>



            <div class="form-group">
			<label class="control-label" >Mode Status :</label>
                  <Select class="browser-default custom-select" name="stat" id="userlevel" >

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from userlevel where ID='$userlevel'")or die(mysql_error());
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
      <label class="control-label" >Deactivate/Activate Records :</label>
                  <Select class="browser-default custom-select" name="disabled" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from status ")or die(mysql_error());
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
      <a  href="#success"  class="btn btn-primary  btn-smll" data-toggle="modal" data-target="#success" ><i class="fa fa-recycle"></i></a>
      </div>
      
      </div>
      </div>
      </div>

      </div>
                                                    <?php ?>


                                                    

<!-- Submit Modal Accounts -->
<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="samplemodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="samplemodal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-check fa-4x mb-4 text-primary" aria-hidden="true"></i>
       <h5 > Do you want to Save this current data! It cannot be undone ones it was proceed! </h5>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="saves"  class="btn btn-primary"><i class="icon-check icon-large"></i> Yes</button>
      </div>
    </div>
  </div>
</div>
<!--End of Modal Delete---->
</form>

                
<?php
if (isset($_POST['saves'])){
        $id=$_GET['id'];
$month=$_POST['month'];
$year=$_POST['year'];
$stat=$_POST['stat'];
$batch=$_POST['batch'];
$sss=$_POST['disabled'];
		/* check activated */
    $act = "SELECT * FROM current_teamdata WHERE c_team_id='$id'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    /* end */


if($activated > 0){

   mysql_query("UPDATE `current_teamdata` SET 
  `Month_id`='$month',`Year_id`='$year',`batch_id`='$batch',`userlevel_id`='$stat',`control_data`='$sss'  WHERE c_team_id='$id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Successfully updated!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineepro.php","_self")});</script>';
  exit();

}else{


echo '<script> swal({title: "error!",text: "This Data does not exists!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("traineepro.php","_self")});</script>';
exit();

}
}?>
<?php ?>