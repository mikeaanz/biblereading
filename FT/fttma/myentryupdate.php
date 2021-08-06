<form  method="POST">
<div class="row">

  <div class="col-lg-12">

  					<!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
					  <?php
												  $user_query = mysql_query("SELECT * FROM `weekspropagation`  where id_weekprop='$id'
												  ")or die(mysql_error());
												  while($row = mysql_fetch_array($user_query)){
						  $id=$row['id_weekprop'];
				   
												  ?>
					  <!--END OF CODE ---->


	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
	  <div class="card-header py-3">

		  <center><div class="btn-group" role="group" aria-label="Button group with nested dropdown">
 
  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars"> Additional Menu</i>
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    	 <a class="dropdown-item" href="viewbaptism.php?locate_idpost=<?php echo $historyfeedbackid;?>&BATCH=<?php echo $getbatch; 	?>&id=<?php echo $id; ?>"><i class="fa fa-address-book"> Baptized Contact</a></i>
</i>
    </div>
  </div>
</div>
		<h6 class="m-0 font-weight-bold text-info text-center">Propagation Data Update</h6>
	  </div>
	  <div class="card-body">
	  <label class="control-label" for="Prop_code">Propapagation Area:</label>
			<input  class="form-control form-control-lg"  id="Prop_code" type="text" value="<?php echo $locality['PLACES'];?>" disabled />
			 <!--only this data will  be get from post -->
			<input  class="form-control form-control-lg" name="Prop_code" id="Prop_code" type="hidden" value="<?php echo $locality['ID'];?>" disabled />
	
			<label class="control-label" for="Prop_code">Propagation type:</label>
            <input class="form-control form-control-lg"  id="Prop_code" type="text" value="<?php echo $user['LEVEL'];?>" disabled  />
            <!--only this data will  be get from post -->
			<input class="form-control form-control-lg" name="Prop_type" id="Prop_code" type="hidden" value="<?php echo $user['ID'];?>" disabled  />
            
			
		
			<label class="control-label" for="cost" >Homes Knocked:</label>
			<input  name="homesknock" name="homesknock" value="<?php echo $row['HOMESKNOCK'];?>" class="form-control form-control-lg" id="txtHomeKnock" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Homes Preached (out of Homes Knocked):</label>
			<input value="<?php echo $row['HOMESPREACH'];?>" class="form-control form-control-lg" name="homespreach" id="txtHomePreach" type="number"   onkeypress="return isNumberKey(event)"  />

			<label class="control-label" for="cost" >Person Contacted :</label>
			<input value="<?php echo $row['PCONTACTED'];?>" class="form-control form-control-lg" name="Pcontact" id="txtPersonCont" type="number"   onkeypress="return isNumberKey(event)" />

			<label class="control-label" for="cost" >Person who received the gospel/called (out of Person Contacted) :</label>
			<input value="<?php echo $row['RECEIVEDGOSPEL'];?>" class="form-control form-control-lg" name="recgospel" id="txtgospelcal" type="number"   onkeypress="return isNumberKey(event)"   />

			<label class="control-label" for="cost" >Gospel Friends Open for Follow-up :</label>
			<input value="<?php echo $row['GOPENFOLLOW'];?>" class="form-control form-control-lg" name="Gosfollow" id="txtgosfriend" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />




<!-- 		   <label class="control-label" for="cost" >No. of Baptisms (Brothers):</label> -->
			<input value="<?php echo $row['BROBAPTISM'];?>" class="form-control form-control-lg" name="bapbro" id="cost" type="hidden"   onkeypress="return isNumberKey(event)" maxlength="3"  />


<!-- 
		    <label class="control-label" for="price">No. of Baptisms (Sisters):</label> -->
			<input value="<?php echo $row['SISBAPTISM'];?>" class="form-control form-control-lg"  name="bapsis" id="price" type="hidden"   onkeypress="return isNumberKey(event)" maxlength="3"  />

										
												
			<label class="control-label" for="cost" >New Home Meetings Started :</label>
			<input value="<?php echo $row['NEWHOMESMTG'];?>" class="form-control form-control-lg" name="nhommtg" id="cost" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />
			
			<label class="control-label" for="cost" >Total Home Meeting Held :</label>
			<input value="<?php echo $row['TOTALHOMESMTG'];?>" class="form-control form-control-lg" name="tothommtg" id="txtmtgheld" type="number"  onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Total Person Home Met :</label>
			<input value="<?php echo $row['TOTALPERSONHMTG'];?>" class="form-control form-control-lg" name="personhommet" id="txthomemet" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />
			
			<label class="control-label" for="cost" >Person Visited But Not Home Met:</label>
			<input value="<?php echo $row['PVISITEDNOTHMEET'];?>" class="form-control form-control-lg" name="pervisbtnthommt" id="cost" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >New Small Group Meetings Establish:</label>
			<input value="<?php echo $row['NSMALLGMTG'];?>" class="form-control form-control-lg" name="nsmallgroupmtg" id="cost" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Total Small Group Meeting Held :</label>
			<input value="<?php echo $row['SMALLGMTGHELD'];?>" class="form-control form-control-lg" name="tsmalgrpmtg" id="txtSmGMHeld" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Total Local Saints Attending Small Group Meeting:</label>
			<input value="<?php echo $row['LOCALATTSMLMTG'];?>" class="form-control form-control-lg" name="locsainattsmll" id="txtTtlSaintsAttend" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" for="cost" >Local Saints Joining Propagation:</label>
			<input value="<?php echo $row['LOCALSAINTSJOINPROP'];?>" class="form-control form-control-lg" name="locsaintjoin" id="txtSaintsJoinProp" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

			
	<label class="control-label" for="cost" >Total Man-Hours of Local Saints Joining Propagation:</label>
			<input class="form-control form-control-lg numbers" name="manhours" id="txtTtlSaintsHours" type="text" value="<?php echo $row['MANHOURS'];?>"    maxlength="5"  />

			<label class="control-label" for="cost" >LTM Attendance:</label>
			<input value="<?php echo $row['LTM'];?>" class="form-control form-control-lg" name="ltm" id="LTM" type="number"   onkeypress="return isNumberKey(event)" maxlength="3"  />

	
		<label class="control-label" for="cost" >Total Trainee Team-Hours (In Hours):</label>
			<input class="form-control form-control-lg numbers" name="trainteamhrs" id="txtTeamHours" type="text" value="<?php echo $row['TEAMHOURS'];?>"   		 maxlength="5"  required/>




			<input class="form-control form-control-lg" value="<?php echo $session_id;?>" name="account_id" id="price" type="hidden"   onkeypress="return isNumberKey(event)" maxlength="3"  />


			<input class="form-control form-control-lg" name="timesup" id="price" type="hidden" value="<?php echo date('m/d/Y h:i:s a', time());  ?>" />
			
			<input class="form-control form-control-lg" value="<?php echo $row['countlimitupt'];?>" name="countlimit" type="hidden" value="<?= $id ?>" />

			<input class="form-control form-control-lg" name="id" type="hidden" value="<?= $id ?>" />
		
			<br>
			<div class="col text-center">		
   					 <button type="button" class="btn btn-success bg-gradient-success  sidebar-dark" id="btnEditProgData"  data-toggle="modal"    data-target="#manage" ><i class="fa fa-recycle"></i> UPDATE</button>
	  </div>
	</div>
	  </div>
	  <?php include 'modalupdate.php' ?>
</form>
	</div>
												  <?php }?>
  </div>




<?php
		include('functions/db.php');
if (isset($_POST['updateme'])){
    
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


	

$countlimit=$_POST['countlimit'];

$countone=1;
$totalcountall=$countone+$countlimit;


$countthree=3;
$totalmaximum=$countthree-$countlimit;






    $act = "SELECT * FROM weekspropagation WHERE  id_weekprop='$historyfeedbackid' and countlimitupt='0' or countlimitupt='1' or countlimitupt='2' or countlimitupt='3'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
	$activated = mysql_num_rows($result);
	/* end */
	
		/* check countupdate cheacking */
	$limit = "SELECT * FROM weekspropagation WHERE  id_weekprop='$historyfeedbackid' and countlimitupt='4' ";
	$resultlimit = mysql_query($limit)or die(mysql_error());
	$rowlimit = mysql_fetch_array($resultlimit);
	$countlimit = mysql_num_rows($resultlimit);
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
	  `Time_Updated`='$Time',
	  `countlimitupt`='$totalcountall'
	 WHERE id_weekprop='$id'")or die(mysql_error());

echo '<script> swal({title: "Good Job!",text: "Your Data Successfully Updated!.You only have only left maximum update '.$totalmaximum.'x", customClass: "swal-wide",
	confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("entryedit.php?locate_idpost='.$historyfeedbackid.'&BATCH='.$getbatch.'&id='.$id.'","_self")});</script>';
  exit();

  	// $result = mysql_query("UPDATE `longpropagation` SET 
	// `NOBAPTISMBRO`='$bapbro',`NOBAPTISMSISTER`='$bapsis',
	// `NORECOVEREDBRO`='$recbro',`NORECOVEREDSIS`='$recsis',`TOTALNEWHOMEMTG`='$newhome',
	// `TOTALSMALMTG`='$newsmall',`AVERAGELTM`='$ltm',`LOCALSAINTSJOINPROP`='$saint',
	// `ESTABLISHLOCAL`='$estlocal',`RECOVEREDLOCAL`='$reclocal',`ESTABLISHDISTRICT`='$estdis',
	// `RECOVEREDDISTRICT`='$recdis',`PROSPECTTRAINEEBRO`='$probro',`PROSPECTTRAINEESIS`='$prosis'
	// ,`Time_Updated`='$Time',`countlimitupt`='$totalcountall'
	//  WHERE id_prop='$historyfeedbackid' ")or die(mysql_error());


}else if($rowlimit > 0) {
	mysql_query("UPDATE `weekspropagation` SET
	manipulate_but='disabled'
   WHERE id_weekprop='$historyfeedbackid'")or die(mysql_error());
  
	echo '<script> swal({title: "OH NO!",text: "You have already reach to the maximum update of your current data.If you want to update this data you may request to the Administrator, thank you!", customClass: "swal-wide",
		confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("entryedit.php?locate_idpost='.$historyfeedbackid.'&BATCH='.$getbatch.'&id='.$id.'","_self")});</script>';
	  exit();


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