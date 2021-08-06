<form  method="POST">

<div class="row">

  <div class="col-lg-12">

  					<!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
					  <?php

					  					$getbatch=$_GET['BATCH'];
												  $user_query = mysql_query("SELECT * FROM historyfeedback
                                                  LEFT JOIN month on historyfeedback.MONTH=month.ID
                                               LEFT JOIN year on historyfeedback.YEAR=year.ID
                                                  LEFT JOIN batch on historyfeedback.BATCH=batch.ID
                                                  LEFT JOIN week on historyfeedback.WEEK=week.ID
                                                   LEFT JOIN userlevel on historyfeedback.acc_id=userlevel.ID
												     where historyfeedback.id='$historyfeedbackid'
												  ")or die(mysql_error());
												  while($row = mysql_fetch_array($user_query)){
						  $id=$row['id'];
						  $week=$row['week'];
				   
												  ?>
					  <!--END OF CODE ---->



<div class="card">


	
		  <!-- <button type="button" class="btn btn-link btn-lg"   data-toggle="modal"    data-target="#summary" ><i class="fa fa-list "></i> Other's</button> -->




	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
	  <div class="card-header py-3">
		  <h1 class="text-primary text-right week"><?php echo $row['week'];?></h1>





<!--  <a  class="btn btn-success btn-small active" href="establishlocality.php?locate_idpost=<?php echo $historyfeedbackid;?>"><i class="fa fa-plus">Establish Locality</i></a> -->


<!-- <a  class="btn btn-dark btn-small active" href="recoveredlocal.php?locate_idpost=<?php echo $historyfeedbackid;?>"><i class="fa fa-plus">Recovered Locality</i></a> -->


<!-- <a  class="btn btn-light btn-small active" href="establishdistrict.php?locate_idpost=<?php echo $historyfeedbackid;?>"><i class="fa fa-home">Establish District</i></a> -->

<!-- <a  class="btn btn-warning btn-small" href="recdistrict.php?locate_idpost=<?php echo $historyfeedbackid;?>"><i class="fa fa-user-plus ">Recovered District</i></a> -->

<!-- <a  class="btn btn-info btn-small" href="recestlocal.php?locate_idpost=<?php echo $historyfeedbackid;?>"><i class="fa fa-user-plus ">Recovered Saints</i></a> -->
		  
		<!--   <a  class="btn btn-primary btn-small" href="prospecttrain.php?locate_idpost=<?php echo $historyfeedbackid;?>"><i class="fa fa-user-plus ">Prospect Trainees</i></a>
 -->		  	 


<center><div class="btn-group" role="group" aria-label="Button group with nested dropdown">
 
  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars"> Additional Menu</i>
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    	 <a class="dropdown-item" href="baptizebookoflife.php?locate_idpost=<?php echo $historyfeedbackid;?>&BATCH=<?php echo $getbatch; 	?>"><i class="fa fa-address-book"> Baptized Contact</a></i>
      <a class="dropdown-item" href="establishlocality.php?locate_idpost=<?php echo $historyfeedbackid;?>&BATCH=<?php echo $getbatch;?>"><i class="fa fa-plus-circle"> Establish Locality</a></i>
      <a class="dropdown-item" href="recoveredlocal.php?locate_idpost=<?php echo $historyfeedbackid;?>&BATCH=<?php echo $getbatch;?>"><i class="fa fa-plus-square"> Recovered Locality</a></i>
       <a class="dropdown-item" href="establishdistrict.php?locate_idpost=<?php echo $historyfeedbackid;?>&BATCH=<?php echo $getbatch;?>"><i class="fa fa-home"> Establish District</a></i>
        <a class="dropdown-item" href="recdistrict.php?locate_idpost=<?php echo $historyfeedbackid;?>&BATCH=<?php echo $getbatch;?>"><i class="fa fa-map-signs"> Recovered District</a></i>
          <a class="dropdown-item" href="recestlocal.php?locate_idpost=<?php echo $historyfeedbackid;?>&BATCH=<?php echo $getbatch;?>"><i class="fa fa-user-plus"> Recovered Saints</a></i>
            <a class="dropdown-item" href="prospecttrain.php?locate_idpost=<?php echo $historyfeedbackid;?>&BATCH=<?php echo $getbatch;?>"><i class="fa fa-user-plus"> Prospect Trainees</a></i>
    </div>
  </div>
</div>





		       <!-- Nav Item - Pages My Schedule Collapse Menu -->


		  <?php include 'modalsummaryinput.php' ?>



		<h6 class="m-0 font-weight-bold text-primary text-center">Propagation Data</h6>
	  </div>
	  <div class="card-body">
	  <label class="control-label" for="Prop_code">Propapagation Area:</label>
			<input  class="form-control form-control-lg"  id="Prop_area" type="text" value="<?php echo $locality['PLACES'];?>" disabled />
			 <!--only this data will  be get from post -->
			<input  class="form-control form-control-lg" name="Prop_area" id="Prop_area" type="hidden" value="<?php echo $locality['ID'];?>" disabled />
	
			<label class="control-label" for="Prop_code">Propagation type:</label>
            <input class="form-control form-control-lg"  id="Prop_type" type="text" value="<?php echo $user['LEVEL'];?>" disabled  />
            <!--only this data will  be get from post -->
			<input class="form-control form-control-lg" name="Prop_type" id="Prop_type" type="hidden" value="<?php echo $user['ID'];?>" disabled  />
			
			
			<label class="control-label" for="cost" >Homes Knocked:</label>
			<input class="form-control form-control-lg" name="homesknock" id="txtHomeKnock" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Homes Preached (out of Homes Knocked):</label> 
			<input class="form-control form-control-lg" name="homespreach" id="txtHomePreach" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Person Contacted :</label>
			<input class="form-control form-control-lg" name="Pcontact" id="txtPersonCont" type="text"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Person who received the gospel/called (out of Person Contacted) :</label>
			<input class="form-control form-control-lg" name="recgospel" id="txtgospelcal" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Gospel Friends Open for Follow-up :</label>
			<input class="form-control form-control-lg" name="Gosfollow" id="txtgosfriend" type="text"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  onkeypress="return isNumberKey(event)" maxlength="3"  />

<!-- 
	<a href="#baptism" class="d-block card-header py-3" data-toggle="collapse"  aria-expanded="true" aria-controls="collapseCardExample">
	<h6 class="m-0 font-weight-bold text-primary text-left">Baptism</h6>
	  </a> -->
	  <!-- Card Content - Collapse -->
	  <!-- <div class="collapse hide" id="baptism"> -->

<!-- 		<label class="control-label" for="cost" >No. of Baptisms (Brothers):</label> -->
			<input class="form-control form-control-lg" name="bapbro" id="baptism" type="hidden"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  onkeypress="return isNumberKey(event)" maxlength="3"  />



	<!-- 	    <label class="control-label" for="price">No. of Baptisms (Sisters):</label> -->
			<input class="form-control form-control-lg"  name="bapsis" id="sbap" type="hidden"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  onkeypress="return isNumberKey(event)" maxlength="3"  />

												  <!-- </div> -->
												
			<label class="control-label" for="cost" >New Home Meetings Started :</label>
			<input class="form-control form-control-lg" name="nhommtg" id="nhome" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   onkeypress="return isNumberKey(event)" maxlength="3"  />
			
			<label class="control-label" for="cost" >Total Home Meeting Held :</label>
			<input class="form-control form-control-lg" name="tothommtg" id="txtmtgheld" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Total Person Home Met :</label>
			<input class="form-control form-control-lg" name="personhommet" id="txthomemet" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   onkeypress="return isNumberKey(event)" maxlength="3"  />
			
			<label class="control-label" for="cost" >Person Visited But Not Home Met:</label>
			<input class="form-control form-control-lg" name="pervisbtnthommt" id="pvisit" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >New Small Group Meetings Establish:</label>
			<input class="form-control form-control-lg" name="nsmallgroupmtg" id="estabgrp" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Total Small Group Meeting Held :</label>
			<input class="form-control form-control-lg" name="tsmalgrpmtg" id="txtSmGMHeld" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Total Local Saints Attending Small Group Meeting:</label>
			<input class="form-control form-control-lg" name="locsainattsmll" id="txtTtlSaintsAttend" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Local Saints Joining Propagation:</label>
			<input class="form-control form-control-lg" name="locsaintjoin" id="txtSaintsJoinProp" type="text"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Total Man-Hours of Local Saints Joining Propagation:</label>
			<input class="form-control form-control-lg numbers" name="manhours" id="txtTtlSaintsHours" type="text"  maxlength="5"  />

			<label class="control-label" for="cost" >LTM Attendance:</label>
			<input class="form-control form-control-lg" name="ltm" id="LTM" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Total Trainee Team-Hours (In Hours):</label>
			<input class="form-control form-control-lg numbers" name="trainteamhrs" id="txtTeamHours" type="text"    maxlength="5"  />









			
			<!-- <label class="control-label" for="cost" >No. of Baptisms (Brothers):</label>
			<input class="form-control form-control-lg" name="bapbro" id="cost" type="number" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3"  />



		    <label class="control-label" for="price">No. of Baptisms (Sisters):</label>
			<input class="form-control form-control-lg"  name="bapsis" id="price" type="number" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" >No. of Recovered Saints (Brothers):</label>
			<input class="form-control form-control-lg" name="recbro" id="price" type="number" onfocus="this.value=''" onkeypress="return isNumberKey(event)" maxlength="3"  />


			<label class="control-label" >No. of Recovered Saints (Sisters):</label>
			<input class="form-control form-control-lg" name="recsis" id="price" type="number" onfocus="this.value=''" onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" >Total New Home Meetings Established:</label>
			<input class="form-control form-control-lg" name="newhome" id="price" type="number" onfocus="this.value=''" onkeypress="return isNumberKey(event)" maxlength="3"  />
		
							
			<label class="control-label" for="price">Total New Small Group Meetings Established:</label>
			<input class="form-control form-control-lg" name="newsmall" id="price" type="number" onfocus="this.value=''"  maxlength="3"  />


					<label class="control-label" for="price">Average LTM Attendance:</label>
			<input class="form-control form-control-lg" name="ltm" id="price" type="number" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3"  />

			
			<label class="control-label" for="price"> Local Saints joining propagation:</label>
			<input class="form-control form-control-lg" name="saint" id="price" type="number" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3"  />

			
			<label class="control-label" for="price">Establish Locality:</label>
			<input class="form-control form-control-lg" name="estlocal" id="price" type="number"  />


			<label class="control-label" for="price">Recovered Locality:</label>
			<input class="form-control form-control-lg" name="reclocal" id="price" type="number"  />


			<label class="control-label" for="price">Established District:</label>
			<input class="form-control form-control-lg" name="estdis" id="price" type="number"  />

			<label class="control-label" for="price">Recovered District:</label>
			<input class="form-control form-control-lg" name="recdis" id="price" type="number"  maxlength="3"  />

			<label class="control-label" for="price">Prospect Trainees for Incoming Term (Brothers):</label>
			<input class="form-control form-control-lg"  name="probro" id="price" type="number" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3" />


			<label class="control-label" for="price">Prospect Trainees for Incoming Term (Sisters):</label>
			<input class="form-control form-control-lg" name="prosis" id="price" type="number" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3"  /> -->

			<input class="form-control form-control-lg" value="<?php echo $session_id;?>" name="account_id" id="price" type="hidden" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3"  />


			<input class="form-control form-control-lg" name="timesup" id="price" type="hidden" value="<?php echo date('m/d/Y h:i:s a', time());  ?>" />


			<input class="form-control form-control-lg" name="id" type="hidden" value="<?= $id ?>" />
		
			<br>
			<div class="col text-center">		
   					 <button type="button" class="btn btn-success bg-gradient-primary  sidebar-dark" id="btnEditProgData"   data-toggle="modal"    data-target="#manage" ><i class="fa fa-plus"></i>ADD</button>
						<!-- <button type="button" class="btn btn-info btn-lg"   data-toggle="modal"    data-target="#summary" ><i class="fa fa-list "></i>Other's</button> -->
			
					</div>

	</div>
	  </div>
	  
	</div>
												  <?php }?>
  </div>

  <?php include 'modaladddata.php' ?>

</form>

</div>
<?php
	  $conn = mysqli_connect("localhost", "root", "", "dbmonitoring");
if (isset($_POST['insertprop'])){
    

// $bapbro=$_POST['bapbro'];  
$homesknock = $_POST['homesknock'];
// $bapsis=$_POST['bapsis'];
  $homespreach= $_POST['homespreach'];
$recbro=$_POST['recbro'];	
$Pcontact= $_POST['Pcontact'];


$recsis=$_POST['recsis'];	$recgospel= $_POST['recgospel'];
// $newhome=$_POST['newhome'];
 $Gosfollow= $_POST['Gosfollow'];
// $newsmall=$_POST['newsmall']; 
$OpenFollow= $_POST['OpenFollow'];


$ltm=$_POST['ltm'];  			
$nhommtg= $_POST['nhommtg'];
// $saint=$_POST['saint'];		
	$tothommtg= $_POST['tothommtg'];
$estlocal=$_POST['estlocal'];  
 $personhommet= $_POST['personhommet'];


$reclocal=$_POST['reclocal'];   
 $pervisbtnthommt= $_POST['pervisbtnthommt'];
$estdis=$_POST['estdis'];       
 $nsmallgroupmtg= $_POST['nsmallgroupmtg'];
$recdis=$_POST['recdis'];        
$tsmalgrpmtg= $_POST['tsmalgrpmtg'];


$probro=$_POST['probro'];		
$locsainattsmll= $_POST['locsainattsmll'];
$prosis=$_POST['prosis'];      
 $locsaintjoin= $_POST['locsaintjoin'];
$Time=$_POST['timesup'];		
$manhours= $_POST['manhours'];
							
$trainteamhrs= $_POST['trainteamhrs'];
$readonly='1';


		/* check feedback cheacking */
    // $act = "SELECT * FROM longpropagation WHERE accounts_id='$session_id' and historyfeedback_id='$historyfeedbackid' ";
    // $result = mysql_query($act)or die(mysql_error());
    // $rows = mysql_fetch_array($result);
    // $activated = mysql_num_rows($result);
	/* end */
	

  $act = "SELECT * FROM weekspropagation WHERE accounts_id='$session_id' and historyfeedback_id='$historyfeedbackid' ";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    



if($activated > 0){


echo '<script> swal({title: "Notice!",text: "Your data already existing.", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("myentry.php?locate_idpost='.$historyfeedbackid.'&BATCH='.$getbatch.'","_self")});</script>';
exit();


}else {
// to be continue!!!

	mysql_query("INSERT INTO `weekspropagation`
	(`HOMESKNOCK`, `HOMESPREACH`, `PCONTACTED`,RECEIVEDGOSPEL,GOPENFOLLOW,BROBAPTISM,SISBAPTISM,NEWHOMESMTG,TOTALHOMESMTG,TOTALPERSONHMTG,PVISITEDNOTHMEET,NSMALLGMTG,SMALLGMTGHELD,LOCALATTSMLMTG,LOCALSAINTSJOINPROP,`MANHOURS`,LTM,TEAMHOURS,accounts_id,historyfeedback_id,Time_Submitted,readonly)
		 VALUES ('$homesknock','$homespreach','$Pcontact','$recgospel','$Gosfollow','$bapbro','$bapsis','$nhommtg','$tothommtg','$personhommet','$pervisbtnthommt','$nsmallgroupmtg','$tsmalgrpmtg','$locsainattsmll','$locsaintjoin','$manhours','$ltm','$trainteamhrs','$session_id','$historyfeedbackid','$Time','$readonly')")or die(mysql_error());
	
echo '<script> swal({title: "Amen!hallelujah",text: "Your Data Successfully Save!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("myentry.php?locate_idpost='.$historyfeedbackid.'&BATCH='.$getbatch.'","_self")});</script>';
exit();



	
//    mysql_query("INSERT INTO `longpropagation`
//    (
 
//    `NOBAPTISMBRO`, 
//    `NOBAPTISMSISTER`,
// 	`NORECOVEREDBRO`, 
// 	`NORECOVEREDSIS`,
// 	`TOTALNEWHOMEMTG`, 
// 	`TOTALSMALMTG`, 
// 	`AVERAGELTM`,
// 	 `LOCALSAINTSJOINPROP`, 
// 	`ESTABLISHLOCAL`,
// 	 `RECOVEREDLOCAL`, 
// 	 `ESTABLISHDISTRICT`,
// 	  `RECOVEREDDISTRICT`, 
// 	`PROSPECTTRAINEEBRO`, 
// 	`PROSPECTTRAINEESIS`,
// 	 `accounts_id`, 
// 	 `historyfeedback_id`,
// 	 `Time_Submitted`) 

//    VALUES ('$bapbro','$bapsis','$recbro','$recsis','$newhome'
//    ,'$newsmall','$ltm','$saint','$estlocal','$reclocal',
//    '$estdis','$recdis','$probro','$prosis','$session_id',
//    '$historyfeedbackid','$Time')")or die(mysql_error());


//mysql_query("INSERT INTO `historyfeedback`(`MONTH`, `YEAR`, `BATCH`,`WEEK`,`acc_id`) 
//VALUES ('$month','$yr','$batch','$week','$accid')")or die(mysql_error());

// $result = mysql_query("UPDATE feedback SET 
// MONTH='$month',
// YEAR='$yr',
// BATCH='$batch',
// WEEK='$week',
// acc_id='$accid',
// status_id='$status_id'

//  where id='$get_id' ")or die(mysql_error());








}
?>

<?php }?>