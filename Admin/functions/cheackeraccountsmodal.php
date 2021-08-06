
<form Method="post">
<!-- Delete Modal Accounts -->
<div class="modal fade" id="deactivate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelss" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-danger">
        <h5 class="modal-title" style='color:#F8FAFB'   id="exampleModalLabelss">Note!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-user-alt-slash fa-4x mb-4 text-danger" aria-hidden="true"></i>
       <h5 >Are you sure you want to Deactivate accounts? It cannot be undone ones it was proceeded!</h5>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="clickdis" class="btn btn-danger"><i class="icon-check icon-large"></i> Yes</button>
      </div>
    </div>
  </div>
</div>
</form>



<?php
include('functions/db.php');
if (isset($_POST['clickdis'])){
  if(empty($_POST['toogle'])){
    echo '<script> swal({title: "Oh Lord Jesus!",text: "Please Check the checkbox before to proceed!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("accountactivation.php","_self")});</script>';
    exit();
  }else
$id=$_POST['toogle'];   

$N = count($id);
for($i=0; $i < $N; $i++)
{
  $result = mysql_query("UPDATE `accounts` SET `STATUS`='2'  where id='$id[$i]'");
}
echo '<script> swal({title: "Amen!",text: "Successfully Deactivated!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("accountactivation.php","_self")});</script>';
   
    

}
?>

<!--End of Modal Delete---->



