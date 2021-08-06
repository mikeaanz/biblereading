<form  method="post" enctype="multipart/form-data">
<!-- Delete Modal Accounts -->
<div class="modal fade" id="addme" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="exampleModalLabel">Add Information's Baptized Ones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">

      <!-- <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
                  <div class="text-center img-placeholder"  onClick="triggerClick()">
              <h4>Upload image</h4>
              </div>
              <i  class="img"><img  src="img/logo.png" onClick="triggerClick()" id="profileDisplay"></i>
            </span>
           <input type="file" name="image" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;"> 
           
          </div>
          <label>Profile Image</label>
 
						 -->

             
<?php 
  $query_weekss = mysql_query("SELECT * FROM weekspropagation WHERE  historyfeedback_id='$get_id'")or die(mysql_error());
     $num_row_weeksss = mysql_num_rows($query_weekss);
        $row_week = mysql_fetch_array($query_weekss);
?>

    

          <input type="hidden" name="id" value="<?php echo $get_id;?>">
          <input type="hidden" name="brother" value="<?php echo $row_week['BROBAPTISM'];?>">
          <input type="hidden" name="sister" value="<?php echo $row_week['SISBAPTISM'];?>">
								
</div>

  <div class="form-group">
    <label for="exampleInputEmail1">Contact's Full Name :</label>
    <input type="text" name="fullname" class="form-control" id="exampleInputEmail1"  placeholder="Ex.Jose Potasio Rizal" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Contact Number :</label>
    <input type="text" name="contactnum" class="form-control" id="exampleInputEmail1"  placeholder="Ex.09304531711" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
 
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Address :</label>
    <input type="text" name="address" class="form-control" id="exampleInputEmail1"  placeholder="Ex.Navotas City, District 4" required>

  </div>
 <div class="form-group">
    <label for="exampleInputEmail1">Baptism :</label>
    <input type="text" name="bap" class="form-control" readonly data-toggle="datepicker" id="exampleInputEmail1"  placeholder="Ex.12/12/2020" required>
  </div>  

  <div class="form-group">
			<label class="control-label" >Gender :</label>
                  <Select class="browser-default custom-select" name="gender" id="userlevel" required>

                     <option  disabled>Select Mode Status Saints</option>
                              <?php
                                  $query = mysql_query("select * from stat_saints")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['stat_id']; ?>"><?php echo $row['Gender']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>  
                    </div>

  <div class="form-group">
			<label class="control-label" >Status Saints :</label>
                  <Select class="browser-default custom-select" name="contstat" id="userlevel" required>

                     <option  disabled>Select Mode Status Saints</option>
                              <?php
                                  $query = mysql_query("select * from contactstatus")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['saints_legend']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select>   
                    </div>       
<div class="form-group">
    <label for="exampleInputEmail1">Shepherding Materials :</label>
    <input type="text" name="shep" class="form-control" id="exampleInputEmail1"  placeholder="Ex. Trust Obey(Lesson 1.)">
  </div>



      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="saves" class="btn btn-primary"><i class="fas fa-thumbs-up icon-check icon-large"></i> Amen!</button>




      </div>
    </div>
  </div>
</div>
<!--End of Modal Delete---->
                <?php} ?>
</form>
<?php
if (isset($_POST['saves'])){
  $getbatch=$_GET['BATCH'];
  $get_id=$_GET['locate_idpost'];

            $fullname = $_POST['fullname'];
            $contactnum = $_POST['contactnum'];
            $address = $_POST['address'];
            // $bap =$_POST['bap'];
            $contstat=$_POST['contstat'];
            $shep = $_POST['shep'];
            $bap=$_POST['bap'];
            $gender=$_POST['gender'];
            $id=$_POST['id'];

                $brother=$_POST['brother'];
                $sisters=$_POST['sister'];
                $one='1';

                $addbro=$brother + $one;
                $addsis=$sisters + $one;


		/* check existed name */
    $act = "SELECT * FROM baptism_rpt WHERE FullName='$fullname' and  curteam_id='$get_id'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    /* end */

    //     $acts = "SELECT * FROM weekspropagation WHERE historyfeedback_id='$get_id'";
    // $results = mysql_query($acts)or die(mysql_error());
    // $rowss = mysql_fetch_array($results);
    // $mark = mysql_num_rows($results);

      /* determining the current historyfeedback before to proceed */
      $query_week = mysql_query("SELECT * FROM weekspropagation WHERE  historyfeedback_id='$get_id'")or die(mysql_error());
     $num_row_week = mysql_num_rows($query_week);
        $row_week = mysql_fetch_array($query_week);

         /* determining the current sister to add data field */
     


if($activated > 0){

echo '<script> swal({title: "Amen!",text: "Successfully Updated!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("baptizebookoflife.php?locate_idpost='.$get_id.'&BATCH='.$getbatch.'","_self")});</script>';
exit();
}
else if($num_row_week < 1){


  echo '<script> swal({title: "Warning!",text: "You cannot submit Baptism record while Propagation Data of this week is not filled, Please make sure you input first current week record of your propagation data before to proceed, Thank you..!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("baptizebookoflife.php?locate_idpost='.$get_id.'&BATCH='.$getbatch.'","_self")});</script>';
exit();

}
else if ($gender == '1'){

                    mysql_query("UPDATE `weekspropagation` SET BROBAPTISM='$addbro'
   WHERE historyfeedback_id='$get_id'")or die(mysql_error());

    mysql_query("INSERT INTO `baptism_rpt`(`FullName`,`ContactNumber`,`address`,date_baptize,`contactstatus_id`,`shepmaterial`,`curteam_id`,acc_id,gender) 
    VALUES ('$fullname','$contactnum','$address','$bap','$contstat','$shep','$get_id','$session_id','$gender')")or die(mysql_error());



  echo '<script> swal({title: "Praise the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$get_id.'&BATCH='.$getbatch.'","_self")});</script>';
  exit();
}

else if ($gender=='2'){

    mysql_query("UPDATE `weekspropagation` SET SISBAPTISM='$addsis'
   WHERE historyfeedback_id='$get_id'")or die(mysql_error());

   $sql= mysql_query("INSERT INTO `baptism_rpt`(`FullName`,`ContactNumber`,`address`,date_baptize,`contactstatus_id`,`shepmaterial`,`curteam_id`,acc_id,gender) 
    VALUES ('$fullname','$contactnum','$address','$bap','$contstat','$shep','$get_id','$session_id','$gender')")or die(mysql_error());


  echo '<script> swal({title: "Praisess the Lord!",text: "Data already submitted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$get_id.'&BATCH='.$getbatch.'","_self")});</script>';
  exit();
}
}

?>
<?php ?>