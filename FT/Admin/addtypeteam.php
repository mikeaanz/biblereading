



<div class="col-xl-3 col-lg-5">
  <div class="card shadow mb-4">
      <h6 class="m-3 font-weight-bold text-primary">Add Term for Propagation of Team</h6>

   <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->

                        <!--END OF CODE ---->



    <!-- Card Body -->

    <div class="card-body">

<form method="POST">


    <div class="form-group">
			<label class="control-label" >Month :</label>
                  <Select class="browser-default custom-select" name="month" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from month order by ID ASC")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['MONTH']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>

                  
    <div class="form-group">
			<label class="control-label" >Year :</label>
                  <Select class="browser-default custom-select" name="year" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from year order by ID ASC")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['YR']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>

                                    
    <div class="form-group">
			<label class="control-label" >Batch :</label>
                  <Select class="browser-default custom-select" name="batch" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from batch order by ID ASC")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['BATCH']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>



            <div class="form-group">
			<label class="control-label" >Mode Status :</label>
                  <Select class="browser-default custom-select" name="stat" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from userlevel where ID='2' or ID='3' or ID='4'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['LEVEL']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>


                  <br>

      <br>
      <div class="col text-center">	
      <a  href="#success"  class="btn btn-primary  btn-smll" data-toggle="modal" data-target="#success" ><i class="fa fa-plus"></i></a>
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
  
$month=$_POST['month'];
$year=$_POST['year'];
$stat=$_POST['stat'];
$batch=$_POST['batch'];

		/* check activated */
    $act = "SELECT * FROM current_teamdata WHERE Month_id='$month' and Year_id='$year' and batch_id='$batch' and userlevel_id='$stat'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    /* end */


if($activated > 0){

  echo '<script> swal({title: "OH Lord Jesus!",text: "This Data Already Exist!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("traineepro.php","_self")});</script>';
  exit();

}else{

   mysql_query("INSERT INTO `current_teamdata`(`Month_id`, `Year_id`, `batch_id`, `userlevel_id`,`control_data`) 
   VALUES ('$month','$year','$batch','$stat','2')")or die(mysql_error());

echo '<script> swal({title: "Praise The Lord!",text: "Successfully Manage Transaction!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineepro.php","_self")});</script>';
exit();

}
}?>
<?php ?>