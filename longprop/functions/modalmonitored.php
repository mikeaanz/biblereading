
<?php $weeks=$_GET['week'];?>
<form  method="post" enctype="multipart/form-data">
<!-- Delete Modal Accounts -->
<div class="modal fade" id="addme" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="exampleModalLabel">Monitored Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">


								
</div>

                                        <div class="card">
                  <center>  <label for="exampleInputEmail1" class="font-weight-bold text-dark" >Weekly Activities</label></center>
  <center><label for="exampleInputEmail1" class="control-label m-3 font-weight-bold  text-dark" ><font size="16"><?php echo $weeks; ?></label></font></center>
</div>
              

                    <div class="form-group">
<!--     <center><label for="exampleInputEmail1" class="control-label m-3 font-weight-bold  text-primary" >Weekly Monitored:</label></center> -->

    <input type="hidden" name="" class="form-control" id="exampleInputEmail1" value="<?php echo $weeks; ?>"  placeholder="Ex.Jose Potasio Rizal" disabled>
      <input  name="wk" type="hidden" class="form-control" id="exampleInputEmail1" value="<?php echo $weeks; ?>"  placeholder="Ex.Jose Potasio Rizal" >
  </div>
    <div class="form-group">
      <center><label class="control-label m-3 font-weight-bold  text-dark" >Name of Contact Person Visited</label></center>
                  <Select class="browser-default custom-select" name="contact" id="userlevel" required>

                     <option  disabled>Please Input Contact's Name</option>
                              <?php
                                  $query = mysql_query("select * from contatcdetails where acc_id='$session_id'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['contact_id']; ?>"><?php echo $row['FullName']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>    
                    </div>  


     <!--    <a class="nav-primary collapsed" href="#" data-toggle="collapse" data-target="#collapsefice" aria-expanded="true" aria-controls="collapseOne">

       <center>  <span>Vacant day not allocated for week 1, sample after you already arrive at your location area during saturday or Lord's Day you can filled this info just, if you are have the local saints click this link</span> </center>
        </a>
        <div id="collapsefice" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
      
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
        </div>
      
    </div>
 -->

   <div class="form-group">
                  <center>  <label class="control-label m-3 font-weight-bold  text-dark" >MONDAY</label></center>

                  <Select class="browser-default custom-select" name="mon" id="userlevel" >

                     <option  value="" >Select Monday Activity</option>
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


  
  <!-- <div class="form-group">
    <label for="exampleInputEmail1">Baptism :</label>
    <input type="text" name="bap" class="form-control" data-toggle="datepicker" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>  -->

      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="saves"  class="btn btn-primary"><i class="fas fa-thumbs-up icon-check icon-large"></i> Amen!</button>
      </div>
    </div>
  </div>
</div>
<!--End of Modal Delete---->
                <?php} ?>
</form>
<?php
if (isset($_POST['saves'])){
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

      $monday='MON';
      $TUESDAY='TUE';
      $WEDNESDAY='WED';
      $THURSDAY='THURS';
      $FRIDAY='FRIDAY';
      $SATURDAY='SAT';
      $L='LORDS DAY';


		/* check activated */
    $act = "SELECT * FROM longproprpt WHERE contact_id='$contacts'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    /* end */

    if($activated > 0){
        echo '<script> swal({title: "Warning!",text: "This Contact Already Submitted from the Monitored list, Please just Update it.", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();

    }


if($wk=='Week 1' or $wk=='WEEK 1' or $wk=='week 1'){

    mysql_query("INSERT INTO `longproprpt`(`contact_id`, `historyfeedback_id`, `acc_id`, `Week_ONE`) VALUES ('$contacts','$get_id','$session_id','($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}
 else if($wk=='Week 2' or $wk=='WEEK 2' or $wk=='week 2'){

    mysql_query("INSERT INTO `longproprpt`(`contact_id`, `historyfeedback_id`, `acc_id`, `Week_TWO`) VALUES ('$contacts','$get_id','$session_id','($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}
 else if($wk=='Week 3' or $wk=='WEEK 3' or $wk=='week 3'){

    mysql_query("INSERT INTO `longproprpt`(`contact_id`, `historyfeedback_id`, `acc_id`, `Week_THREE`) VALUES ('$contacts','$get_id','$session_id','($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}
 else if($wk=='Week 4' or $wk=='WEEK 4' or $wk=='week 4'){

    mysql_query("INSERT INTO `longproprpt`(`contact_id`, `historyfeedback_id`, `acc_id`, `Week_FOUR`) VALUES ('$contacts','$get_id','$session_id','($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}
 else if($wk=='Week 5' or $wk=='WEEK 5' or $wk=='week 5'){

    mysql_query("INSERT INTO `longproprpt`(`contact_id`, `historyfeedback_id`, `acc_id`, `Week_FIVE`) VALUES ('$contacts','$get_id','$session_id','($monday-$mon) ($TUESDAY-$tue) ($WEDNESDAY-$wed) ($THURSDAY-$thur) ($FRIDAY-$fri) ($SATURDAY-$sat) ($L-$LD)')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}
 else{

  echo '<script> swal({title: "Notice!",text: "Please Check the week, Available only Week 1 - 5!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}


//  else if($wk=='Week 7' or $wk=='WEEK 7'){

//     mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_seven`)
//      VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes-$four-$five')")or die(mysql_error());

//   echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
//   exit();
// }

//  else if($wk=='Week 8' or $wk=='WEEK 8'){

//     mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_eight`)
//      VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes-$four-$five')")or die(mysql_error());

//   echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
//   exit();
// }

//  else if($wk=='Week 9' or $wk=='WEEK 9'){

//     mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_nine`)
//      VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes-$four-$five')")or die(mysql_error());

//   echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
//   exit();
// }

//  else if($wk=='Week 10' or $wk=='WEEK 10'){

//     mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_ten`)
//      VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes-$four-$five')")or die(mysql_error());

//   echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
//   exit();
// }


//  else if($wk=='Week 11' or $wk=='WEEK 11'){

//     mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_eleven`)
//      VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes-$four-$five')")or die(mysql_error());

//   echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
//   exit();
// }
//  else if($wk=='Week 12' or $wk=='WEEK 12'){

//     mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_twelve`)
//      VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes-$four-$five')")or die(mysql_error());

//   echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
//   exit();
// }

//  else if($wk=='Week 13' or $wk=='WEEK 13'){

//     mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_thirteen`)
//      VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes-$four-$five')")or die(mysql_error());

//   echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
//   exit();
// }


//  else if($wk=='Week 14' or $wk=='WEEK 14'){

//     mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_fourteen`)
//      VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes-$four-$five')")or die(mysql_error());

//   echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
//   exit();
// }


//  else if($wk=='Week 15' or $wk=='WEEK 15'){

//     mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_fifthteen`)
//      VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes-$four-$five')")or die(mysql_error());

//   echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
//   exit();
// }



//  else if($wk=='Week 16' or $wk=='WEEK 16'){

//     mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_sixteen`)
//      VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes-$four-$five')")or die(mysql_error());

//   echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
//   exit();
// }



//  else if($wk=='Week 17' or $wk=='WEEK 17'){

//     mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_seventeen`)
//      VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes-$four-$five')")or die(mysql_error());

//   echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
//   exit();
// }

//  else if($wk=='5 WEEKS' or $wk=='5 weeks'){

//     mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_seventeen`)
//      VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes-$four-$five')")or die(mysql_error());

//   echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
//   exit();
// }








}?>
<?php ?>