


<form  method="POST">
<div class="container">
<div class="row">



  <div class="col-lg-12">

  					<!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
	<?php
                          $user_query = mysql_query("SELECT * from weekendrpt LEFT join contatcdetails on contatcdetails.contact_id=weekendrpt.contact_id LEFT join historyfeedback on historyfeedback.id=weekendrpt.historyfeedback_id LEFT join month on month.id=historyfeedback.MONTH LEFT join year on year.id=historyfeedback.YEAR LEFT join batch on batch.id=historyfeedback.BATCH LEFT join week on week.id=historyfeedback.WEEK LEFT join userlevel on userlevel.id=historyfeedback.acc_id
          
                 
                           where  weekendrpt.weekendrpt_id='$get_id'

                          ORDER BY weekendrpt_id ASC")or die(mysql_error());
                          while($row = mysql_fetch_array($user_query)){



?>
	<!-- Basic Card Example -->
	<div class="card shadow mb-4">
	  <div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary text-center">Monitored Contact's</h6>
	  </div>
	  <div class="card-body">
	  <div class="form-group">
    <label for="exampleInputEmail1">Contact's Full Name :</label>
    <input type="text" name="fullname" class="form-control" id="exampleInputEmail1" value='<?php echo $row['FullName']; ?>'  placeholder="Ex.Jose Potasio Rizal"disabled>
  </div>
  <div class="form-group">
    <center><label for="exampleInputEmail1">Weeks Control </label></center>
                  <Select class="browser-default custom-select" name="wk" id="userlevel" required>

                     <option  disabled>Select Weeks</option>
                              <?php
                                  $query = mysql_query("SELECT * from week where where ID <> 1  ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['week']; ?>"><?php echo $row['week']; ?></option>
                                 <?php
                    }
                                 ?>


                    </select>   

  <div class="form-group">
     <center> <label class="control-label" > Day 1 :</label></center>
                  <Select class="browser-default custom-select" name="one" id="userlevel" required>

                     <option  disabled>Select Mode Status Saints</option>
                              <?php
                                  $query = mysql_query("select * from shepherd_code")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['shepcode']; ?>"><?php echo $row['descrip_shepherding']; ?></option>
                                 <?php
                    }
                                 ?>

                    </select>    


                      <div class="form-group">
     <center> <label class="control-label" >Day 2 :</label></center>
                  <Select class="browser-default custom-select" name="two" id="userlevel" required>

                     <option  disabled>Select Mode Status Saints</option>
                              <?php
                                  $query = mysql_query("select * from shepherd_code")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['shepcode']; ?>"><?php echo $row['descrip_shepherding']; ?></option>
                                 <?php
                    }
                                 ?>

                    </select>   

  <div class="form-group">
		<center>	<label class="control-label" > Day 3 :</label></center> 
                  <Select class="browser-default custom-select" name="three" id="userlevel" required>

                     <option  disabled>Select Mode Status Saints</option>
                              <?php
                                  $query = mysql_query("select * from shepherd_code")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['shepcode']; ?>"><?php echo $row['descrip_shepherding']; ?></option>
                                 <?php
                    }
                                 ?>

                    </select>        

                    <br>

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
      $wk=$_POST['wk'];
      $contacts=$_POST['contact'];
      $ones=$_POST['one'];
       $twos=$_POST['two'];
            $threes=$_POST['three'];


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


 if($wk=='Week 6' or $wk=='WEEK 6'){

      mysql_query("UPDATE `weekendrpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`week_six`='$ones-$twos-$threes'
 WHERE weekendrpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Your Data already Inserted!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
  exit();
}

 else if($wk=='Week 7' or $wk=='WEEK 7'){

   mysql_query("UPDATE `weekendrpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`week_seven`='$ones-$twos-$threes'
 WHERE weekendrpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Your Data already Inserted!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
          exit();
}

 else if($wk=='Week 8' or $wk=='WEEK 8'){

   mysql_query("UPDATE `weekendrpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`week_eight`='$ones-$twos-$threes'
 WHERE weekendrpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Your Data already Inserted!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
          exit();
}


 else if($wk=='Week 9' or $wk=='WEEK 9'){

   mysql_query("UPDATE `weekendrpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`week_nine`='$ones-$twos-$threes'
 WHERE weekendrpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Your Data already Inserted!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
          exit();
}


 else if($wk=='Week 10' or $wk=='WEEK 10'){

   mysql_query("UPDATE `weekendrpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`week_ten`='$ones-$twos-$threes'
 WHERE weekendrpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Your Data already Inserted!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
          exit();
}


 else if($wk=='Week 11' or $wk=='WEEK 11'){

mysql_query("UPDATE `weekendrpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`week_eleven`='$ones-$twos-$threes'
 WHERE weekendrpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Your Data already Inserted!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
          exit();
}


 else if($wk=='Week 12' or $wk=='WEEK 12'){

mysql_query("UPDATE `weekendrpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`week_twelve`='$ones-$twos-$threes'
 WHERE weekendrpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Your Data already Inserted!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
          exit();
}


 else if($wk=='Week 13' or $wk=='WEEK 13'){

  mysql_query("UPDATE `weekendrpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`week_thirteen`='$ones-$twos-$threes'
 WHERE weekendrpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Your Data already Inserted!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
          exit();

}


 else if($wk=='Week 14' or $wk=='WEEK 14'){
  mysql_query("UPDATE `weekendrpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`week_fourteen`='$ones-$twos-$threes'
 WHERE weekendrpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Your Data already Inserted!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
          exit();
}


 else if($wk=='Week 15' or $wk=='WEEK 15'){
  mysql_query("UPDATE `weekendrpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`week_fifthteen`='$ones-$twos-$threes'
 WHERE weekendrpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Your Data already Inserted!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
          exit();
}

 else if($wk=='Week 16' or $wk=='WEEK 16'){

  mysql_query("UPDATE `weekendrpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`week_sixteen`='$ones-$twos-$threes'
 WHERE weekendrpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Your Data already Inserted!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
          exit();
}

 else if($wk=='Week 17' or $wk=='WEEK 17'){

  mysql_query("UPDATE `weekendrpt` SET 
`historyfeedback_id`='$moni',`acc_id`='$session_id',`week_seventeen`='$ones-$twos-$threes'
 WHERE weekendrpt_id='$get_id'")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Your Data already Inserted!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>'; 
          exit();
}

 else if($wk!='5 WEEKS ' or $wk!='5 Weeks'){
  echo '<script> swal({title: "Invalid!",text: "This week does not exist in the weekend report, please check before to proceed", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>';
  exit();
}

 else if($wk!='3 DAYS' or $wk!='3 days'){
  echo '<script> swal({title: "Invalid!",text: "This week does not exist in the weekend report, please check before to proceed", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("monitoredupd.php?id='.$get_id.'&monitored='.$moni.'&week='.$week.'","_self")});</script>';
  exit();
}







}?>

<?php }?>