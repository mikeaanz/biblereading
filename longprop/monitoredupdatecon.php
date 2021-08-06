


<form  method="POST">
<div class="container">
<div class="row">



  <div class="col-lg-12">

  					<!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
	<?php


                          $user_query = mysql_query("SELECT * from longproprpt LEFT join contatcdetails on contatcdetails.contact_id=longproprpt.contact_id LEFT join historyfeedback on historyfeedback.id=longproprpt.historyfeedback_id LEFT join month on month.id=historyfeedback.MONTH LEFT join year on year.id=historyfeedback.YEAR LEFT join batch on batch.id=historyfeedback.BATCH LEFT join week on week.id=historyfeedback.WEEK LEFT join userlevel on userlevel.id=historyfeedback.acc_id
          
                 
                           where  longproprpt.longproprpt_id='$get_id'

                          ORDER BY longproprpt_id ASC")or die(mysql_error());
                          while($row = mysql_fetch_array($user_query)){



?>
	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
	  <div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary text-center">Monitored Contact's</h6>
	  </div>
	  <div class="card-body">
	  <div class="form-group">
   <center> <label for="exampleInputEmail1" class="control-label m-3 font-weight-bold  text-dark">Contact's Full Name :</label></center>
    <input type="text" name="fullname" class="form-control" id="exampleInputEmail1" value='<?php echo $row['FullName']; ?>'  placeholder="Ex.Jose Potasio Rizal"disabled>
  </div>
  <div class="form-group">
    <center><label for="exampleInputEmail1" class="control-label m-3 font-weight-bold  text-dark">Weeks Control</label></center>
                  <Select class="browser-default custom-select" name="wk" id="userlevel" required>

                     <option  value="">Select Propagation Activity Week</option>
                              <?php
                                  $query = mysql_query("SELECT * from week  where ID <> 1 and ID='15' or ID='16' or ID='17' or ID='18' or ID='19'  ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['week']; ?>"><?php echo $row['week']; ?></option>
                                 <?php
                    }
                                 ?>


                    </select>   

</div>
                                    <center>     <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                 <i class="fa fa-car"> AFTER ARRIVAL</i> </a> </center>


<div class="collapse" id="collapseExample">
  <div class="card card-body">
        <p style="color:red; text-align: justify; font-family: Century Schoolbook;">This area is for those you Home met contact that are currently visited after you were arriving in the particular locality, with your teammate that held some service (visitation, etc..) with that person, please kindly fill this data. Note this is just for week 1. For more details information during (2) days such as ('Saturday' & 'LORD'S DAY) upon arrival in the locality. (If you have question please ask the monitoring team.)</p>
        <br>
            <div class="form-group">
              <center>  <label class="control-label m-3 font-weight-bold  text-primary" >SATURDAY</label></center>
               
                  <Select class="browser-default custom-select" name="upsat" id="userlevel" >

                     <option   value="">Select Activity Upon Arrival</option>
                              <?php
                                  $query = mysql_query("select * from shepherd_code")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['shepcode']; ?>"><?php echo $row['descrip_shepherding']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>    
           
                    </div> 

                                         <div class="form-group">
              <center>  <label class="control-label m-3 font-weight-bold  text-primary" >LORD'S DAY</label></center>
                  <Select class="browser-default custom-select" name="upLD" id="userlevel" >

                     <option  value="">Select Activity Upon Arrival</option>
                              <?php
                                  $query = mysql_query("select * from shepherd_code")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['shepcode']; ?>"><?php echo $row['descrip_shepherding']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>    
           
                    </div> 

  </div>
</div>

 <div class="form-group">
                  <center>  <label class="control-label m-3 font-weight-bold  text-dark" >MONDAY</label></center>

                  <Select class="browser-default custom-select" name="mon" id="userlevel" >

                     <option  val="" >Select Monday Activity</option>
                              <?php
                                  $query = mysql_query("select * from shepherd_code")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['shepcode']; ?>"><?php echo $row['descrip_shepherding']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>    
                    </div>  


                     <div class="form-group">
              <center>  <label class="control-label m-3 font-weight-bold  text-dark" >TUESDAY </label></center>

                  <Select class="browser-default custom-select" name="tue" id="userlevel" >

                     <option  value="" >Select Tuesday Activity</option>
                              <?php
                                  $query = mysql_query("select * from shepherd_code")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['shepcode']; ?>"><?php echo $row['descrip_shepherding']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>    
           
                    </div>  

                             <div class="form-group">
              <center>  <label class="control-label m-3 font-weight-bold  text-dark" >WEDNESDAY</label></center>

                  <Select class="browser-default custom-select" name="wed" id="userlevel" >

                     <option   value="">Select Wednesday Activity</option>
                              <?php
                                  $query = mysql_query("select * from shepherd_code")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['shepcode']; ?>"><?php echo $row['descrip_shepherding']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>    
           
                    </div> 

                             <div class="form-group">
              <center>  <label class="control-label m-3 font-weight-bold  text-dark" >THURSDAY</label></center>
                  <Select class="browser-default custom-select" name="thur" id="userlevel" >

                     <option   value="">Select Friday Activity</option>
                              <?php
                                  $query = mysql_query("select * from shepherd_code")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['shepcode']; ?>"><?php echo $row['descrip_shepherding']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>    
           
                    </div> 




                             <div class="form-group">
              <center>  <label class="control-label m-3 font-weight-bold  text-dark" >FRIDAY</label></center>
                  <Select class="browser-default custom-select" name="fri" id="userlevel" >

                     <option   value="">Select Friday Activity</option>
                              <?php
                                  $query = mysql_query("select * from shepherd_code")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['shepcode']; ?>"><?php echo $row['descrip_shepherding']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>    
           
                    </div> 

                                         <div class="form-group">
              <center>  <label class="control-label m-3 font-weight-bold  text-dark" >SATURDAY</label></center>
               
                  <Select class="browser-default custom-select" name="sat" id="userlevel" >

                     <option   value="">Select Saturday Activity</option>
                              <?php
                                  $query = mysql_query("select * from shepherd_code")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['shepcode']; ?>"><?php echo $row['descrip_shepherding']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>    
           
                    </div> 

                                         <div class="form-group">
              <center>  <label class="control-label m-3 font-weight-bold  text-dark" >LORD'S DAY</label></center>
                  <Select class="browser-default custom-select" name="LD" id="userlevel" >

                     <option  value="">Select Lord's Day Activity</option>
                              <?php
                                  $query = mysql_query("select * from shepherd_code")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['shepcode']; ?>"><?php echo $row['descrip_shepherding']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>    
           
                    </div> 


  

                    <br>

    <div class="col text-center">   
             <button type="button" class="btn btn-primary btn-smll" id="btnEditProgData"  data-toggle="modal"    data-target="#manage" ><i class="fa fa-recycle"></i> UPDATE</button>
    </div>
                    
		
			<br>
	
	</div>
	  </div>
	  <?php  include 'modalpositiveupt.php' ?>
</form>


<?php
    include('functions/db.php');
if (isset($_POST['updateme'])){
  $get_id=$_GET['id'];
      $wk=$_POST['wk'];
      $contacts=$_POST['contact'];

      $mon=$_POST['mon'];
      $tue=$_POST['tue'];
      $wed=$_POST['wed'];
      $thur=$_POST['thur'];
      $fri=$_POST['fri'];
      $sat=$_POST['sat'];
      $LD=$_POST['LD'];

      $upsat=$_POST['sat'];
      $upLD=$_POST['LD'];

      $monday='MON';
      $TUESDAY='TUE';
      $WEDNESDAY='WED';
      $THURSDAY='THURS';
      $FRIDAY='FRIDAY';
      $SATURDAY='SAT';
      $L='LORDS DAY';


    /* check activated */
  //   $act = "SELECT * FROM weekendrpt WHERE contact_id='$contacts'";
  //   $result = mysql_query($act)or die(mysql_error());
  //   $rows = mysql_fetch_array($result);
  //   $activated = mysql_num_rows($result);
  //   /* end */

  //   if($activated > 0){
  //       echo '<script> swal({title: "Warning!",text: "This Contact Already Submitted from the Monitored list, Please just Update it.", customClass: "swal-wide",
  //       confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  // exit();

  //   }
 if($wk=='week 1' or $wk=='WEEK 1' or $wk=='Week 1'){

    // mysql_query("INSERT INTO `longproprpt`(`contact_id`, `historyfeedback_id`, `acc_id`, `Week_ONE`) VALUES ('$contacts','$get_id','$session_id','($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)')")or die(mysql_error());

          mysql_query("UPDATE `longproprpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`Sun_LD`='($SATURDAY-$upsat) ($L-$upLD)',`Week_ONE`='($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)'
 WHERE longproprpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
  exit();
}
else if($wk=='week 2' or $wk=='WEEK 2' or $wk=='Week 2'){

    // mysql_query("INSERT INTO `longproprpt`(`contact_id`, `historyfeedback_id`, `acc_id`, `Week_ONE`) VALUES ('$contacts','$get_id','$session_id','($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)')")or die(mysql_error());

          mysql_query("UPDATE `longproprpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`Week_TWO`='($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)'
 WHERE longproprpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
  exit();
}

 else if($wk=='week 3' or $wk=='WEEK 3' or $wk=='Week 3'){

    // mysql_query("INSERT INTO `longproprpt`(`contact_id`, `historyfeedback_id`, `acc_id`, `Week_ONE`) VALUES ('$contacts','$get_id','$session_id','($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)')")or die(mysql_error());

          mysql_query("UPDATE `longproprpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`Week_THREE`='($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)'
 WHERE longproprpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
  exit();
}
else if($wk=='week 4' or $wk=='WEEK 4' or $wk=='Week 4'){

    // mysql_query("INSERT INTO `longproprpt`(`contact_id`, `historyfeedback_id`, `acc_id`, `Week_ONE`) VALUES ('$contacts','$get_id','$session_id','($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)')")or die(mysql_error());

          mysql_query("UPDATE `longproprpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`Week_FOUR`='($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)'
 WHERE longproprpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
  exit();
}

 else if($wk=='week 5' or $wk=='WEEK 5' or $wk=='Week 5'){

    // mysql_query("INSERT INTO `longproprpt`(`contact_id`, `historyfeedback_id`, `acc_id`, `Week_ONE`) VALUES ('$contacts','$get_id','$session_id','($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)')")or die(mysql_error());

          mysql_query("UPDATE `longproprpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`Week_FIVE`='($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)'
 WHERE longproprpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
  exit();
}





}?>

<?php }?>