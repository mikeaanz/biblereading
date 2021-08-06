<form method="POST">
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
  </div>
  <input type="password" name="oldpassword" class="form-control" placeholder="Old password to confirm the new one" aria-label="Username" aria-describedby="basic-addon1" required>
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
  </div>
  <input type="password" name="newpassword" class="form-control" placeholder="New Password" aria-label="Username" aria-describedby="basic-addon1" required>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="clickmepass"  class="btn btn-primary"><i class="fas fa-thumbs-up icon-check icon-large"></i> Amen!</button>
      </div>
    </div>
  </div>
</div>
</form>
<?php
		include('functions/db.php');
if (isset($_POST['clickmepass'])){
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
   


/* check activated */
$act = "SELECT * FROM accounts WHERE  id='$session_id' and `PASSWORD`='$oldpassword' ";
$result = mysql_query($act)or die(mysql_error());
$rows = mysql_fetch_array($result);
$activated = mysql_num_rows($result);
/* end */


if($activated > 0){
    mysql_query("UPDATE `accounts` SET `PASSWORD`='$newpassword'
 WHERE id='$session_id'")or die(mysql_error());

echo '<script> swal({title: "Praise the Lord!",text: "Your Password Already Change!", customClass: "swal-wide",
confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("index.php","_self")});</script>';
exit();



}else{
 echo '<script> swal({title: "Lord Jesus!",text: "The old password does not match!", customClass: "swal-wide",
confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("index.php","_self")});</script>';
exit();
}
}?>

<?php ?>