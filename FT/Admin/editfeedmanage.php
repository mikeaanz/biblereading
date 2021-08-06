



<div class="col-xl-3 col-lg-5">
  <div class="card shadow mb-4">
      <h6 class="m-3 font-weight-bold text-primary">Manage Propagation</h6>

   <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
   <?php
							$user_query = mysql_query("SELECT * FROM `weekspropagation`
							inner join accounts on weekspropagation.accounts_id=accounts.id 
							inner join locality on locality.id=accounts.LOCALITY
							inner join historyfeedback on weekspropagation.historyfeedback_id=historyfeedback.id 
							inner join month on month.id=historyfeedback.MONTH
							inner join year on year.id=historyfeedback.YEAR 
							inner join batch on batch.id=historyfeedback.BATCH 
							inner join week on week.id=historyfeedback.WEEK
							inner join userlevel on userlevel.id=historyfeedback.acc_id 
							inner join status on status.id=historyfeedback.status_id where id_weekprop='$historyfeedbackid'
							ORDER BY weekspropagation.id_weekprop DESC
							")or die(mysql_error());
							while($row = mysql_fetch_array($user_query)){
							$id=$row['id_weekprop'];
				   
												  ?>
                        <!--END OF CODE ---->

                        <form  method="POST">

    <!-- Card Body -->

    <div class="card-body">





            <div class="form-group">
            <div class="row no-gutters align-items-center">
        <div class="col mr-2">
<label for="">Place Of :</label>
        <input class="form-control" type="text" value="<?php echo $row['PLACES'];?>" disabled>
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><i ></i>Section 1</div>
          <a class="nav-link collapsed text-primary" href="#" data-toggle="collapse" data-target="#manageyear" aria-expanded="true" aria-controls="manageyear">
<i class="fas fa-recycle "></i>
<span>Click Me</span>
</a>



<div id="manageyear" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
<label for="inputDisabledEx2" class="disabled">Propagation Date</label>
           <input class="form-control" value=" <?php  echo $row['MONTH'];?>,<?php echo $row['YR'];?>,<?php echo $row['week'];?>,<?php echo $row['BATCH'];?>"  type="text" id="propagationdate" name="Time" disabled>

           <label for="inputDisabledEx2"  class="disabled">Time Submitted</label>
            <input class="form-control"  value="<?php echo $row['Time_Submitted'];?>"   type="text" id="time" name="Week" disabled>
	
            <label class="control-label" for="cost" >Homes Knocked:</label>
			<input  name="homesknock" name="homesknock" value="<?php echo $row['HOMESKNOCK'];?>" class="form-control form-control-lg" id="txtHomeKnock" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Homes Preached (out of Homes Knocked):</label>
			<input value="<?php echo $row['HOMESPREACH'];?>" class="form-control form-control-lg" name="homespreach" id="txtHomePreach" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Person Contacted :</label>
			<input value="<?php echo $row['PCONTACTED'];?>" class="form-control form-control-lg" name="Pcontact" id="txtPersonCont" type="number"  onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Person who received the gospel/called (out of Person Contacted) :</label>
			<input value="<?php echo $row['RECEIVEDGOSPEL'];?>" class="form-control form-control-lg" name="recgospel" id="txtgospelcal" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Gospel Friends Open for Follow-up :</label>
			<input value="<?php echo $row['GOPENFOLLOW'];?>" class="form-control form-control-lg" name="Gosfollow" id="txtgosfriend" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />




		   <label class="control-label" for="cost" >No. of Baptisms (Brothers):</label>
			<input value="<?php echo $row['BROBAPTISM'];?>" class="form-control form-control-lg" name="bapbro" id="cost" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />



		    <label class="control-label" for="price">No. of Baptisms (Sisters):</label>
			<input value="<?php echo $row['SISBAPTISM'];?>" class="form-control form-control-lg"  name="bapsis" id="price" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

										
												
			<label class="control-label" for="cost" >New Home Meetings Started :</label>
			<input value="<?php echo $row['NEWHOMESMTG'];?>" class="form-control form-control-lg" name="nhommtg" id="cost" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />
			
			<label class="control-label" for="cost" >Total Home Meeting Held :</label>
			<input value="<?php echo $row['TOTALHOMESMTG'];?>" class="form-control form-control-lg" name="tothommtg" id="txtmtgheld" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Total Person Home Met :</label>
			<input value="<?php echo $row['TOTALPERSONHMTG'];?>" class="form-control form-control-lg" name="personhommet" id="txthomemet" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />
			
</div>
</div>
<div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><i ></i>Section 2</div>
          <a class="nav-link collapsed text-primary" href="#" data-toggle="collapse" data-target="#secondraw" aria-expanded="true" aria-controls="secondraw">
<i class="fas fa-recycle "></i>
<span>Click Me</span>
</a>



<div id="secondraw" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
          
<label class="control-label" for="cost" >Person Visited But Not Home Met:</label>
			<input value="<?php echo $row['PVISITEDNOTHMEET'];?>" class="form-control form-control-lg" name="pervisbtnthommt" id="cost" type="number"  onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >New Small Group Meetings Establish:</label>
			<input value="<?php echo $row['NSMALLGMTG'];?>" class="form-control form-control-lg" name="nsmallgroupmtg" id="cost" type="number"  onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Total Small Group Meeting Held :</label>
			<input value="<?php echo $row['SMALLGMTGHELD'];?>" class="form-control form-control-lg" name="tsmalgrpmtg" id="txtSmGMHeld" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Total Local Saints Attending Small Group Meeting:</label>
			<input value="<?php echo $row['LOCALATTSMLMTG'];?>" class="form-control form-control-lg" name="locsainattsmll" id="txtTtlSaintsAttend" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Local Saints Joining Propagation:</label>
			<input value="<?php echo $row['LOCALSAINTSJOINPROP'];?>" class="form-control form-control-lg" name="locsaintjoin" id="txtSaintsJoinProp" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Total Man-Hours of Local Saints Joining Propagation:</label>
			<input value="<?php echo $row['MANHOURS'];?>" class="form-control form-control-lg" name="manhours" id="txtTtlSaintsHours" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >LTM Attendance:</label>
			<input value="<?php echo $row['LTM'];?>" class="form-control form-control-lg" name="ltm" id="LTM" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Total Trainee Team-Hours (In Hours):</label>
			<input value="<?php echo $row['TEAMHOURS'];?>" class="form-control form-control-lg" name="trainteamhrs" id="txtTeamHours" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />


            <input class="form-control" name="timesup" id="price" type="hidden" value="<?php echo date('m/d/Y h:i:s a', time());  ?>" />
			


          
</div>
</div>

                  <br>

      <br>
      <div class="col text-center">	
      <a  href="#success"  class="btn btn-primary  btn-smll" data-toggle="modal"    data-target="#manage" ><i class="fa fa-recycle"></i> Update</a>
      </div>
                                                  <?php }?>
      </div>
      </div>
      </div>
      </div>
<!-- Submit Modal Accounts -->
<div class="modal fade" id="manage" tabindex="-1" role="dialog" aria-labelledby="samplemodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="samplemodal">Update Data!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-recycle fa-4x mb-4 text-primary" aria-hidden="true"></i>
       <h5 > Do you want to Update this current data! It cannot be undone ones it was proceed! </h5>
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


  $bapbro=$_POST['bapbro'];  
  $homesknock = $_POST['homesknock'];
  $bapsis=$_POST['bapsis'];  
  $homespreach= $_POST['homespreach'];
  // $recbro=$_POST['recbro'];	
  $Pcontact= $_POST['Pcontact'];
  
  
  // $recsis=$_POST['recsis'];	
  $recgospel= $_POST['recgospel'];
  // $newhome=$_POST['newhome'];
   $Gosfollow= $_POST['Gosfollow'];
  // $newsmall=$_POST['newsmall']; 
  // $OpenFollow= $_POST['OpenFollow'];
  
  
  $ltm=$_POST['ltm'];  			
  $nhommtg= $_POST['nhommtg'];
  // $saint=$_POST['saint'];		
    $tothommtg= $_POST['tothommtg'];
  // $estlocal=$_POST['estlocal'];  
   $personhommet= $_POST['personhommet'];
  
  
  // $reclocal=$_POST['reclocal'];   
   $pervisbtnthommt= $_POST['pervisbtnthommt'];
  // $estdis=$_POST['estdis'];       
   $nsmallgroupmtg= $_POST['nsmallgroupmtg'];
  // $recdis=$_POST['recdis'];        
  $tsmalgrpmtg= $_POST['tsmalgrpmtg'];
  
  
  // $probro=$_POST['probro'];		
  $locsainattsmll= $_POST['locsainattsmll'];
  // $prosis=$_POST['prosis'];      
   $locsaintjoin= $_POST['locsaintjoin'];
  $Time=$_POST['timesup'];		
  $manhours= $_POST['manhours'];
                
  $trainteamhrs= $_POST['trainteamhrs'];
  
    


		/* check feedback cheacking */
    $act = "SELECT * FROM weekspropagation WHERE id_weekprop='$historyfeedbackid'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    /* end */
    


if($activated > 0){
  mysql_query("UPDATE `weekspropagation` SET
  `HOMESKNOCK`='$homesknock',
  `HOMESPREACH`='$homespreach',`PCONTACTED`='$Pcontact',
  `RECEIVEDGOSPEL`='$recgospel',`GOPENFOLLOW`='$Gosfollow',
  `BROBAPTISM`='$bapbro',`SISBAPTISM`='$bapsis',
  `NEWHOMESMTG`='$nhommtg',`TOTALHOMESMTG`='$tothommtg',
  `TOTALPERSONHMTG`='$personhommet',`PVISITEDNOTHMEET`='$pervisbtnthommt',
  `NSMALLGMTG`='$nsmallgroupmtg',`SMALLGMTGHELD`='$tsmalgrpmtg',
  `LOCALATTSMLMTG`='$locsainattsmll',`LOCALSAINTSJOINPROP`='$locsaintjoin',
  `MANHOURS`='$manhours',`LTM`='$ltm',`TEAMHOURS`='$trainteamhrs',
  `Time_Updated`='$Time'
 WHERE id_weekprop='$historyfeedbackid'")or die(mysql_error());

echo '<script> swal({title: "Good Job!",text: "Successfully Updated!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("editmanagedata.php?locate_idpost='.$historyfeedbackid.'","_self")});</script>';
  exit();


}
?>

<?php }?>
<!--End of Modal Delete---->