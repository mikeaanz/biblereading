



<div class="col-xl-3 col-lg-5">
  <div class="card shadow mb-4">
      <h6 class="m-3 font-weight-bold text-info">Create Information</h6>

   <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
<?php
   					$user_query = mysql_query("SELECT * from year where ID='$get_id'")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
?>
                        <!--END OF CODE ---->



    <!-- Card Body -->

    <div class="card-body">




    <form  method="POST">
            <div class="form-group">
            <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><i ></i>Year</div>
          <a class="nav-link collapsed text-info" href="#" data-toggle="collapse" data-target="#manageyear" aria-expanded="true" aria-controls="manageyear">
<i class="fas fa-calendar "></i>
<span>Click Me</span>
</a>




<div class="bg-white py-2 collapse-inner rounded">
<h6 class="collapse-header"><i class="fas fa-plus-square"></i> ADD Year:</h6>


<input class="form-control form-control-sm" name="year" id="cost" type="text"   onkeypress="return isNumberKey(event)" value="<?php echo $row['YR']; ?>"  placeholder="Please Enter Year" required/>


</div>
<div class="col text-center">	
<a  href="#month"  class="btn btn-info  btn-circle .btn-lg" data-toggle="modal"  data-target="#manage" ><i class="fa fa-plus"></i> </a>
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
      <div class="modal-header bg-gradient-info">
        <h5 class="modal-title" style='color:#F8FAFB'   id="samplemodal">Insert Year!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-calendar-check fa-4x mb-4 text-info" aria-hidden="true"></i>
       <h5 > Do you want to Insert this current data! It cannot be undone ones it was proceed! </h5>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="manage" class="btn btn-info"><i class="icon-check icon-large"></i> Yes</button>
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

$year=$_POST['year'];




$act = "SELECT * FROM year WHERE  YR='$year'";
$result = mysql_query($act)or die(mysql_error());
$rows = mysql_fetch_array($result);
$activated = mysql_num_rows($result);
    /* end */
    


if($activated > 0){

    echo '<script> swal({title: "OH NO!",text: "This Year can not be updated due of already exists!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("addmanageyear.php","_self")});</script>';
      exit();
      


}else {
    mysql_query("UPDATE `year` SET `YR`='$year' WHERE ID='$get_id'")or die(mysql_error());
    echo '<script> swal({title: "God Job!",text: "Successfully Updated!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("addmanageyear.php","_self")});</script>';
      exit();


}
?>
<script>
  window.location = "addmanageyear.php"; 
</script>
<?php }?>
<!--End of Modal Delete---->