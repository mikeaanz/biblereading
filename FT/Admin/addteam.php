
<div class="col-xl-3 col-lg-5">
  <div class="card shadow mb-4">
  <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"  aria-expanded="true" aria-controls="collapseCardExample">
  <h6 class="m-3 font-weight-bold text-primary"><i class="fas fa-plus">Assign Trainee Propagation</i></h6>
	  </a>
	  <!-- Card Content - Collapse -->
	  <div class="collapse show" id="collapseCardExample">
      <div class="card-body">
    <form  method="POST">

    <div class="form-group">
 <label class="control-label" >Trainees Name</label>
                                         
                <select  class="selectpicker" data-live-search="true" name="trainee_id"  required>
                        
                                             	<option></option>
											<?php
											$query = mysql_query("select * from trainee_info");
											while($row = mysql_fetch_array($query)){
											
											?>
											<option value="<?php echo $row['trainee_id']; ?>">  <?php echo $row['First_Name']; ?> <?php echo $row['Middle_Name']; ?> <?php echo $row['Last_Name']; ?> </option>
											<?php } ?>
                                            </select>
                  <br>
                  <div class="form-group">
 <label class="control-label" >Full-Timer Class(FT)</label>
                                         
                <select  class="selectpicker" data-live-search="true" name="ft"  required>
                        
                                             	<option></option>
											<?php
											$query = mysql_query("select * from class");
											while($row = mysql_fetch_array($query)){
											
											?>
											<option value="<?php echo $row['ID']; ?>">  <?php echo $row['FT']; ?> </option>
											<?php } ?>
                                            </select>

      <br>
      <div class="col text-center">	
      <a  href="#success"  class="btn btn-primary  btn-smll" data-toggle="modal" data-target="#success" ><i class="fa fa-check"></i>Submit</a>
      </div>
      </div>

    
      <!-- Modal -->
      <?php include ("includes/modaltraineesubmit.php"); ?>





  
                  <?php ?>
                </form>
     
<?php
if (isset($_POST['saves'])){
  $ft=$_POST['ft'];
    $trainee_id=$_POST['trainee_id'];
    $locality=$_GET['locality_id'];
    $historyfeedback=$_GET['currentteamid'];
        /* check activated */
        $act = "SELECT * FROM teammate WHERE  trainee_id='$trainee_id' and currentteam_id='$historyfeedback'";
        $result = mysql_query($act)or die(mysql_error());
        $rows = mysql_fetch_array($result);
        $activated = mysql_num_rows($result);
        /* end */
    
    
    if($activated > 0){
    
      echo '<script> swal({title: "OH Lord Jesus!",text: "This FT  Already Exist!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineeteam.php?currentteamid='.$historyfeedback.'&locality_id='.$locality.'&userlevel='.$userlevel.'","_self")});</script>';
      exit();
    
    }else{
    
       mysql_query("INSERT INTO `teammate`(`trainee_id`,currentteam_id,locality_id,ft_term) VALUES ('$trainee_id','$historyfeedback','$locality','$ft')")or die(mysql_error());
    
    echo '<script> swal({title: "Praise The Lord!",text: "Successfully Manage Transaction!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineeteam.php?currentteamid='.$historyfeedback.'&locality_id='.$locality.'&userlevel='.$userlevel.'","_self")});</script>';
    exit();
    
}
}?>
<?php ?>  