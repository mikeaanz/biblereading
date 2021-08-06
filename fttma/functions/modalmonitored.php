
<?php $weeks=$_GET['week'];?>
<form  method="post" enctype="multipart/form-data">
<!-- Delete Modal Accounts -->
<div class="modal fade" id="addme" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="exampleModalLabel">Monitored Contact's</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">


								
</div>

  <div class="form-group">
    <label for="exampleInputEmail1">Weekly Monitored:</label>
    <input type="text" name="" class="form-control" id="exampleInputEmail1" value="<?php echo $weeks; ?>"  placeholder="Ex.Jose Potasio Rizal" disabled>
      <input  name="wk" type="hidden" class="form-control" id="exampleInputEmail1" value="<?php echo $weeks; ?>"  placeholder="Ex.Jose Potasio Rizal" >
  </div>
                  <center>  <label for="exampleInputEmail1" >Weekly Activities</label></center>

<div class="form-group">
      <label class="control-label" >Contact :</label>
                  <Select class="browser-default custom-select" name="contact" id="userlevel" required>

                     <option  value="">Please Input Contact's Name</option>
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


   <div class="form-group">
      <label class="control-label" >Day One :</label>
                  <Select class="browser-default custom-select" name="one" id="userlevel" >

                     <option  value="">Select Propagation Activities</option>
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
      <label class="control-label" >Day Two :</label>
                  <Select class="browser-default custom-select" name="two" id="userlevel" >

                     <option  value="">Select Propagation Activities</option>
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
      <label class="control-label" >Day Three :</label>
                  <Select class="browser-default custom-select" name="three" id="userlevel" >

                     <option  value="">Select Propagation Activities</option>
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
      $wk=$_POST['wk'];
      $contacts=$_POST['contact'];
      $ones=$_POST['one'];
       $twos=$_POST['two'];
            $threes=$_POST['three'];


		/* check activated */
    $act = "SELECT * FROM weekendrpt WHERE contact_id='$contacts'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    /* end */

    if($activated > 0){
        echo '<script> swal({title: "Warning!",text: "This Contact Already Submitted from the Monitored list, Please just Update it.", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();

    }


 else if($wk=='Week 6' or $wk=='WEEK 6'){

    mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_six`)
     VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}
 else if($wk=='Week 7' or $wk=='WEEK 7'){

    mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_seven`)
     VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}

 else if($wk=='Week 8' or $wk=='WEEK 8'){

    mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_eight`)
     VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}

 else if($wk=='Week 9' or $wk=='WEEK 9'){

    mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_nine`)
     VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}

 else if($wk=='Week 10' or $wk=='WEEK 10'){

    mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_ten`)
     VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}


 else if($wk=='Week 11' or $wk=='WEEK 11'){

    mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_eleven`)
     VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}
 else if($wk=='Week 12' or $wk=='WEEK 12'){

    mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_twelve`)
     VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}

 else if($wk=='Week 13' or $wk=='WEEK 13'){

    mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_thirteen`)
     VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}


 else if($wk=='Week 14' or $wk=='WEEK 14'){

    mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_fourteen`)
     VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}


 else if($wk=='Week 15' or $wk=='WEEK 15'){

    mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_fifthteen`)
     VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}



 else if($wk=='Week 16' or $wk=='WEEK 16'){

    mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_sixteen`)
     VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}



 else if($wk=='Week 17' or $wk=='WEEK 17'){

    mysql_query("INSERT INTO `weekendrpt`(`contact_id`, `historyfeedback_id`,`acc_id`,`week_seventeen `)
     VALUES ('$contacts','$get_id','$session_id','$ones-$twos-$threes')")or die(mysql_error());

  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("monitoringcont.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}







}?>
<?php ?>