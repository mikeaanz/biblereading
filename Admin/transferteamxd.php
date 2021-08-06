
<div class="col-xl-3 col-lg-5">
  <div class="card shadow mb-4">
  <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"  aria-expanded="true" aria-controls="collapseCardExample">
  <h6 class="m-3 font-weight-bold text-primary"><i class="fas fa-plus">Transfer Trainees Areas for Propagation</i></h6>
	  </a>
	  <!-- Card Content - Collapse -->
	  <div class="collapse show" id="collapseCardExample">
      <div class="card-body">
    <form  method="POST">
    <div class="form-group">
 <label class="control-label" >Trainees Name :</label>
                                         
                <select  class="selectpicker" data-live-search="true" name="trainee_id"  required>
                        
											<?php
											$query = mysql_query("select * from trainee_info where trainee_id='$id'");
											while($row = mysql_fetch_array($query)){
											
											?>
											<option value="<?php echo $row['trainee_id']; ?>">  <?php echo $row['First_Name']; ?> <?php echo $row['Middle_Name']; ?> <?php echo $row['Last_Name']; ?> </option>
											<?php } ?>

            

                                            </select>
                  <br>
                  <div class="form-group">
 <label class="control-label" >Transfer to other Locality :</label>
                                         
                <select  class="selectpicker" data-live-search="true" name="transfer"  data-width="99%" required>
                        
                                             	<option></option>
											<?php
											$query = mysql_query("select * from locality");
											while($row = mysql_fetch_array($query)){
											
											?>
											<option value="<?php echo $row['ID']; ?>">  <?php echo $row['PLACES']; ?> </option>
											<?php } ?>
                                            </select>

      <br>
            <br>
      <div class="col text-center">	
      <a  href="#success"  class="btn btn-primary  btn-smll" data-toggle="modal" data-target="#success" ><i class="fa fa-exchange-alt"></i> Transfer</a>
      </div>
      </div>

    
      <!-- Modal -->
      <?php include ("includes/modaltraineesubmit.php"); ?>





  
                  <?php ?>
                </form>
     
<?php
if (isset($_POST['saves'])){
  $transfer=$_POST['transfer'];
   $teammateid=$_GET['teammateid']; 

        /* check activated */
        $act = "SELECT * FROM teammate WHERE  teammate_id='$teammateid'";
        $result = mysql_query($act)or die(mysql_error());
        $rows = mysql_fetch_array($result);
        $activated = mysql_num_rows($result);
        /* end */
    
    
    if($activated > 0){
         mysql_query("UPDATE `teammate` SET `locality_id`='$transfer' WHERE teammate_id='$teammateid'")or die(mysql_error());
        echo '<script> swal({title: "Praise The Lord!",text: "Successfully Trainee transfered to another locality!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("transferteam.php?id_trainee='.$id.'&currentteamid='.$currentteamid.'&locality_id='.$locality.'&userlevel='.$userlevel.'&teammateid='.$teammateid.'","_self")});</script>';
    exit();
    
 
    }else{
    

      echo '<script> swal({title: "OH Lord Jesus!",text: "Could not transfer!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("transferteam.php?id_trainee='.$id.'&currentteamid='.$currentteamid.'&locality_id='.$locality.'&userlevel='.$userlevel.'&teammateid='.$teammateid.'","_self")});</script>';
      exit();
    
}
}?>
<?php ?>  