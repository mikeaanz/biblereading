<?php $get=$row['contactstatus_id'];
      $shep=$row['shepmaterial'];
      $get_id=$row['baptism_id'];
      $locate_idpost=$_GET['locate_idpost'];
 ?>


<form  method="post" enctype="multipart/form-data">
<!-- Delete Modal Accounts -->
<div class="modal fade" id="edit_<?php echo $row['baptism_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-success">
        <h5 class="modal-title" style='color:#F8FAFB'   id="exampleModalLabel">Edit Information's Baptized Ones</h5>
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

           
								
</div>

  <div class="form-group">
    <label for="exampleInputEmail1">Contact's Full Name :</label>
    <input type="text" name="fullname" class="form-control" id="exampleInputEmail1" value='<?php echo $row['FullName'];?>'  placeholder="Ex.Jose Potasio Rizal" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Contact Number :</label>
    <input type="text" name="contactnum" class="form-control" id="exampleInputEmail1" value='<?php echo $row['ContactNumber'];?>' placeholder="Ex.09304531711" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
 
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Address :</label>
    <input type="text" name="address" class="form-control" id="exampleInputEmail1"  value='<?php echo $row['address'];?>' placeholder="Ex.Navotas City, District 4" required>
  <input type="hidden" name="bapid" class="form-control" id="exampleInputEmail1"  value='<?php echo $row['baptism_id'];?>' placeholder="Ex.Navotas City, District 4" required>
 





  </div>
 <div class="form-group">
    <label for="exampleInputEmail1">Baptism :</label>
    <input type="text" name="bap" class="form-control" readonly data-toggle="datepicker"   value='<?php echo $row['date_baptize'];?>' id="exampleInputEmail1"  placeholder="Ex.12/12/2020" required>
  </div>  

  <div class="form-group">
			<label class="control-label" >Gender :</label>
                  <Select class="browser-default custom-select" name="gender" id="userlevel" required>

                     <option  disabled>Select Mode Status Saints</option>
                              <?php
                                  $query = mysql_query("select * from stat_saints where stat_id='".$row['gender']."' ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['stat_id']; ?>"><?php echo $row['Gender']; ?></option>
                                 <?php
                    }
                                 ?>
           

                                <?php
                                  $query = mysql_query("select * from stat_saints  ")or die(mysql_error());
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
                                  $query = mysql_query("select * from contactstatus where  ID='$get' ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['saints_legend']; ?></option>
                                 <?php
                    }
                                 ?>


                                 <?php
                                  $query = mysql_query("select * from contactstatus ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['saints_legend']; ?></option>
                                 <?php
                    }
                                 ?>
                    </select> 

                    <?php 
  $query_weekss = mysql_query("SELECT * FROM weekspropagation WHERE  historyfeedback_id='$locate_idpost'")or die(mysql_error());
     $num_row_weeksss = mysql_num_rows($query_weekss);
        $row_week = mysql_fetch_array($query_weekss);
?>

    

          <input type="hidden" name="id" value="<?php echo $get_id;?>">
           <input type="hidden" name="id" value="<?php echo $locate_idpost;?>">

                  <!--Tracing the value for brothers in mysql output to determine from the conditions in if/else statements--->
          <input type="hidden" name="brother" value="<?php echo $row_week['BROBAPTISM'];?>" >
                 <!--Tracing the value for sisters in mysql output to determine from the conditions in if/else statements--->
          <input type="hidden" name="sister"  value="<?php echo $row_week['SISBAPTISM'];?>">
<!--End of Modal Delete---->
                <?php} ?>




                    </div>       
<div class="form-group">
    <label for="exampleInputEmail1">Shepherding Materials :</label>
    <input type="text" name="shep" class="form-control" id="exampleInputEmail1" value='<?php echo $shep; ?>'   placeholder="Ex. Trust Obey(Lesson 1.)">
  </div>



      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="savess" class="btn btn-success"><i class="fas fa-thumbs-up icon-check icon-large"></i> Amen!</button>





      </div>
    </div>
  </div>
</div>


</form>
<?php
if (isset($_POST['savess'])){
            $getbatch=$_GET['BATCH'];
            $getbap=$_POST['bapid'];
            $fullname = $_POST['fullname'];
            $contactnum = $_POST['contactnum'];
            $address = $_POST['address'];
            // $bap =$_POST['bap'];
            $contstat=$_POST['contstat'];
            $shep = $_POST['shep'];
            $bap=$_POST['bap'];
            $genders=$_POST['gender'];
            $id=$_POST['id'];

            $brother=$_POST['brother'];
            $sister=$_POST['sister'];


$one='1';

            $addbro=$brother + $one;
            $addsis=$sister+ $one;

            $minusbro=$brother - $one;
            $minussis=$sister - $one;

         

		/* check existed name */
    $act = "SELECT * FROM baptism_rpt WHERE baptism_id='$get_id' and  gender='$genders'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    /* end */

    //     $acts = "SELECT * FROM weekspropagation WHERE historyfeedback_id='$get_id'";
    // $results = mysql_query($acts)or die(mysql_error());
    // $rowss = mysql_fetch_array($results);
    // $mark = mysql_num_rows($results);

      /* determining the current historyfeedback and sister if already 0 from 'db' before to proceed */
     //  $query_week = mysql_query("SELECT * FROM weekspropagation WHERE  historyfeedback_id='$locate_idpost' and SISBAPTISM='0'")or die(mysql_error());
     // $num_row_week = mysql_num_rows($query_week);
     //    $row_week = mysql_fetch_array($query_week);

     //   determining the current historyfeedback and brother if already 0 from 'db' before to proceed 
     //  $query_bro = mysql_query("SELECT * FROM weekspropagation WHERE  historyfeedback_id='$locate_idpost' and BROBAPTISM='0'")or die(mysql_error());
     // $num_row_bro = mysql_num_rows($query_bro);
     //    $row_bro = mysql_fetch_array($query_bro);


if($activated > 0){

   $sql=mysql_query("UPDATE `baptism_rpt` SET `FullName`='$fullname',`ContactNumber`='$contactnum',`address`='$address',date_baptize='$bap',`contactstatus_id`='$contstat',`shepmaterial`='$shep'
 WHERE baptism_id='$getbap'")or die(mysql_error());

echo '<script> swal({title: "Amen!",text: "Successfully Updated!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("viewbaptism.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'&id='.$id.'","_self")});</script>';
exit();
}
 else if($genders=='1'){


  $sql=mysql_query("UPDATE `baptism_rpt` SET `FullName`='$fullname',`ContactNumber`='$contactnum',`address`='$address',date_baptize='$bap',`contactstatus_id`='$contstat',`shepmaterial`='$shep',gender='$genders'
 WHERE baptism_id='$getbap'")or die(mysql_error());

             mysql_query("UPDATE `weekspropagation` SET SISBAPTISM='$minussis'
             WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());

                  mysql_query("UPDATE `weekspropagation` SET BROBAPTISM='$addbro'
             WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());


              

echo '<script> swal({title: "Amen!",text: "Successfully Updated!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open(""viewbaptism.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'&id='.$id.'","_self")});</script>';
exit();

}

else if($genders=='2'  or  $sisters < $brother){

         mysql_query("UPDATE `weekspropagation` SET SISBAPTISM='$addsis'
             WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());


 $sql=mysql_query("UPDATE `baptism_rpt` SET `FullName`='$fullname',`ContactNumber`='$contactnum',`address`='$address',date_baptize='$bap',`contactstatus_id`='$contstat',`shepmaterial`='$shep',gender='$genders'
 WHERE baptism_id='$getbap'")or die(mysql_error());



           
                                 mysql_query("UPDATE `weekspropagation` SET BROBAPTISM='$minusbro'
             WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());


echo '<script> swal({title: "Amen!",text: "Successfully Updated", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("viewbaptism.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'&id='.$id.'","_self")});</script>';
exit();

}


      /***********************************Sisters else if Conditions***************************************************************************/
// sisters value is 0;
//  if($gender=='2' and $sisters==0){

//             mysql_query("UPDATE `weekspropagation` SET SISBAPTISM='$addsis'
//    WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());

   


//                 mysql_query("UPDATE `baptism_rpt` SET `FullName`='$fullname',`ContactNumber`='$contactnum',`address`='$address',`date_baptize`='$bap',`contactstatus_id`='$contstat',`shepmaterial`='$shep',`gender`='$gender'    WHERE baptism_id='$get_id'")or die(mysql_error());


//        echo '<script> swal({title: "Equal!",text: "sisters == 0 add one", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'","_self")});</script>';
// exit();
// }
// //determine the equavalent of the same value
// else if ($gender=='2' and $sisters==$brother){
//       mysql_query("UPDATE `weekspropagation` SET SISBAPTISM='$addsis'
//       WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());

//                  mysql_query("UPDATE `weekspropagation` SET BROBAPTISM='$minusbro'
//       WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());


//        echo '<script> swal({title: "sister and brother are equal!",text: "brother minus plus add one to sister", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'","_self")});</script>';
// exit();

// }
// //gender sister locate if the brother is 0
// else if ( $gender=='2'  and  $brother==0){
//   mysql_query("UPDATE `baptism_rpt` SET `FullName`='$fullname',`ContactNumber`='$contactnum',`address`='$address',`date_baptize`='$bap',`contactstatus_id`='$contstat',`shepmaterial`='$shep',`gender`='$gender'    WHERE baptism_id='$get_id'")or die(mysql_error());

//        echo '<script> swal({title: "Equal!",text: "This Status Gender Already updated,therefore no more update in count brothers", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'","_self")});</script>';
// exit();



// }else if ($gender=='2' and   $sisters > $brother or $sisters < $brother){
//         mysql_query("UPDATE `baptism_rpt` SET `FullName`='$fullname',`ContactNumber`='$contactnum',`address`='$address',`date_baptize`='$bap',`contactstatus_id`='$contstat',`shepmaterial`='$shep',`gender`='$gender'    WHERE baptism_id='$get_id'")or die(mysql_error());

//               mysql_query("UPDATE `weekspropagation` SET SISBAPTISM='$addsis'
//       WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());

//                  mysql_query("UPDATE `weekspropagation` SET BROBAPTISM='$minusbro'
//       WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());

//          echo '<script> swal({title: "plus!",text: "ADD SISTER MINUS To BROTHER", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'","_self")});</script>';
// exit();
// }
// /********************************************End of Condition for sisters*****************************************************************/


// /***********************************Brothers else if Conditions***************************************************************************/



// // brothers value is equal to 0
// else if ($gender=='1' and $brother==0){

//     mysql_query("UPDATE `baptism_rpt` SET `FullName`='$fullname',`ContactNumber`='$contactnum',`address`='$address',`date_baptize`='$bap',`contactstatus_id`='$contstat',`shepmaterial`='$shep',`gender`='$gender'    WHERE baptism_id='$get_id'")or die(mysql_error());

//      mysql_query("UPDATE `weekspropagation` SET BROBAPTISM='$addbro'
//    WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());


//            mysql_query("UPDATE `weekspropagation` SET SISBAPTISM='$minussis'
//       WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());

//        echo '<script> swal({title: "Equal!",text: "brother == 0 add one", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'","_self")});</script>';
// exit();

// }

// else if ($gender=='1' or $brother < $sisters){

//     mysql_query("UPDATE `baptism_rpt` SET `FullName`='$fullname',`ContactNumber`='$contactnum',`address`='$address',`date_baptize`='$bap',`contactstatus_id`='$contstat',`shepmaterial`='$shep',`gender`='$gender'    WHERE baptism_id='$get_id'")or die(mysql_error());

//      mysql_query("UPDATE `weekspropagation` SET BROBAPTISM='$addbro'
//     WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());


//        echo '<script> swal({title: "Equal!",text: "brother == 0 add one", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'","_self")});</script>';
// exit();

// }

// //extracting or determine the brothers are equal to sisters value; this section will add automatically to the brothers sections plus one;
// else if ($gender=='1' and  $brother==$sisters){

//       mysql_query("UPDATE `weekspropagation` SET BROBAPTISM='$addbro'
//       WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());

//        echo '<script> swal({title: "sister and brother are equal!",text: "brother minus plus add one to sister", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'","_self")});</script>';
// exit();



// }
// //determine if the sisters value is 0 already
// else if ($gender=='1' and $sisters==0 ){
//   mysql_query("UPDATE `baptism_rpt` SET `FullName`='$fullname',`ContactNumber`='$contactnum',`address`='$address',`date_baptize`='$bap',`contactstatus_id`='$contstat',`shepmaterial`='$shep',`gender`='$gender'    WHERE baptism_id='$get_id'")or die(mysql_error());

//        echo '<script> swal({title: "Equal!",text: "This Status Gender Already updated,therefore no more update in count brothers", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'","_self")});</script>';
// exit();

// }else if ($gender=='1' and  $brother < $sisters and $brother > $sisters){

//    mysql_query("UPDATE `weekspropagation` SET BROBAPTISM='$addbro'
//       WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());

//       mysql_query("UPDATE `weekspropagation` SET SISBAPTISM='$minussis'
//       WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());



//     mysql_query("UPDATE `baptism_rpt` SET `FullName`='$fullname',`ContactNumber`='$contactnum',`address`='$address',`date_baptize`='$bap',`contactstatus_id`='$contstat',`shepmaterial`='$shep',`gender`='$gender'    WHERE baptism_id='$get_id'")or die(mysql_error());

//          echo '<script> swal({title: "plus!",text: "ADD BROTHER MINUS To SISTER", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'","_self")});</script>';
// exit();
// }

// else if($gender=='1' or  $sisters < $brother){
//    echo '<script> swal({title: "Bro greater Thank!",text: "brother add minus to sister!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'","_self")});</script>';
// exit();

// }
// else if($gender=='1' or $sisters < $brother){
//    echo '<script> swal({title: "Bro less thank!",text: "brother add minus to sister!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'","_self")});</script>';
// exit();

// }



  //this will just allowed the system updated the current information except the gender value sample brother val is 1 and sisters val. 0 this will just the end of deduction sisters will never be minus, when the user will select other this will go automatically to sisters sections;



/********************************************End of Condition for Brothers*****************************************************************/

   //    mysql_query("UPDATE `weekspropagation` SET SISBAPTISM='$addsis'
   // WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());

   // mysql_query("UPDATE `baptism_rpt` SET `FullName`='$fullname',`ContactNumber`='$contactnum',`address`='$address',`date_baptize`='$bap',`contactstatus_id`='$contstat',`shepmaterial`='$shep',`gender`='$gender'    WHERE baptism_id='$get_id'")or die(mysql_error());

   //  mysql_query("UPDATE `weekspropagation` SET BROBAPTISM='$addbro'
   // WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());

   //        mysql_query("UPDATE `weekspropagation` SET SISBAPTISM='$addsis'
   // WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());

   //      mysql_query("UPDATE `weekspropagation` SET BROBAPTISM='$minussis'
   // WHERE historyfeedback_id='$locate_idpost'")or die(mysql_error());


//   echo '<script> swal({title: "sister > 0 to sister!",text: "You cannot submit Baptism record while Propagation Data of this week is not filled, Please make sure you input first current week record of your propagation data before to proceed, Thank you..!", customClass: "swal-wide",
//     confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("baptizebookoflife.php?locate_idpost='.$locate_idpost.'&BATCH='.$getbatch.'","_self")});</script>';
// exit();












}

?>
<?php ?>