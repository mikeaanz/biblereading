
<?php $get_id = $_GET['id']; 
 $region = $_GET['region']; 
  $area = $_GET['area']; 
?>


<div class="col-xl-3 col-lg-5">
  <div class="card shadow mb-4">
      <h6 class="m-3 font-weight-bold text-warning">Create Information</h6>

   <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
<?php
   					$user_query = mysql_query("SELECT * from locality where ID='$get_id'")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
?>
                        <!--END OF CODE ---->



    <!-- Card Body -->

    <div class="card-body">




    <form  method="POST">
            <div class="form-group">
            <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><i ></i>Locality</div>
          <a class="nav-link collapsed text-warning" href="#" data-toggle="collapse" data-target="#manageyear" aria-expanded="true" aria-controls="manageyear">
<i class="fas fa-calendar "></i>
<span>Click Me</span>
</a>




<div class="bg-white py-2 collapse-inner rounded">
<h6 class="collapse-header"><i class="fas fa-plus-square"></i> ADD Locality:</h6>


<input class="form-control form-control-sm" name="locality" id="cost" type="text"   onkeypress="return isNumberKey(event)" value="<?php echo $row['PLACES']; ?>"  placeholder="Please Enter Year" required/>



      <label class="control-label" >Region :</label>
                  <Select class="browser-default custom-select" name="region" id="locality" required> 
                              <?php
                                  $query = mysql_query("select * from region where region_id = '$region' ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['region_id']; ?>">Current Region: <?php echo $row['Region']; ?> </option>
                               <?php
                    }
                                 ?>
                              <?php
                                  $query = mysql_query("select * from region where region_id <> 1 AND region_id <> '$region'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['region_id']; ?>"><?php echo $row['Region']; ?> </option>
                               <?php
                    }
                                 ?>
                              
               

                  </select>        


                  <div class="form-group">
      <label class="control-label" >Area Fellowship :</label>
                  <Select class="browser-default custom-select" name="area" id="locality" required> 
                              <?php
                                  $query = mysql_query("select * from area where Area_id  ='$area'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['Area_id']; ?>">Area: <?php echo $row['locations']; ?> </option>
                                      <?php
                    }
                                 ?>
                                                           <?php
                                  $query = mysql_query("select * from area where Area_id <> 1 AND Area_id <> '$area'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['Area_id']; ?>">Area: <?php echo $row['locations']; ?> </option>
                               <?php
                    }
                                 ?>
                              
                              
                  </select>    

</div>
<div class="col text-center">	
<a  href="#month"  class="btn btn-warning  btn-circle .btn-lg" data-toggle="modal"  data-target="#manage" ><i class="fa fa-plus"></i> </a>
</div>


                  <br>

 

      </div>
      
      </div>
      </div>
      </div>
      </div>
<!-- Submit Modal Accounts -->
<div class="modal fade" id="manage" tabindex="-1" role="dialog" aria-labelledby="samplemodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-warning">
        <h5 class="modal-title" style='color:#F8FAFB'   id="samplemodal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-map fa-4x mb-4 text-warning" aria-hidden="true"></i>
       <h5 > Do you want to Update this current data! It cannot be undone ones it was proceeded..</h5>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="manage" class="btn btn-warning"><i class="icon-check icon-large"></i> Yes</button>
      </div>
    </div>
  </div>
</div>
<!--End of Modal Delete---->



<?php }?>

                                                    


</form>
<?php}?>

<?php
		include('functions/db.php');
if (isset($_POST['manage'])){

$locality=$_POST['locality'];
$region=$_POST['region'];
$areas=$_POST['area'];


$act = "SELECT * FROM locality WHERE   ID='$get_id'";
$result = mysql_query($act)or die(mysql_error());
$rows = mysql_fetch_array($result);
$activated = mysql_num_rows($result);
    /* end */
    


if($activated > 0){

   mysql_query("UPDATE `locality` SET `PLACES`='$locality',Region_id='$region',area_id='$areas' WHERE ID='$get_id'")or die(mysql_error());
    echo '<script> swal({title: "Amen!",text: "Successfully Updated!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("localityedit.php?id='. $get_id.'&region='.$region.'&area='.$area.'","_self")});</script>';
      exit();
      


}

?>
<?php }?>
<!--End of Modal Delete---->