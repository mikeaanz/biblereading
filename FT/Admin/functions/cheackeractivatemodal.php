
<form method="post">
<!-- Delete Modal Accounts -->
<div class="modal fade" id="Activate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelsss" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-success">
        <h5 class="modal-title" style='color:#F8FAFB'   id="exampleModalLabelsss">Note!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-check-circle fa-4x mb-4 text-success" aria-hidden="true"></i>
       <h5 >Are you sure you want to Activate accounts? It cannot be undone ones it was proceeded!</h5>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="clickdisss" class="btn btn-success"><i class="icon-check icon-large"></i> Yes</button>
      </div>
    </div>
  </div>
</div>
</form>


<?php
include('functions/db.php');
if (isset($_POST['clickdisss'])){
  if(!empty($_POST['toggle'])){
    echo '<script> swal({title: "Oh Lord Jesus!",text: "Please Check the checkbox before to proceed!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("deactivate.php","_self")});</script>';
    exit();
  }else
$ids=$_POST['toggle'];   

$N = count($id);
for($i=0; $i < $N; $i++)
{
   mysql_query("UPDATE `accounts` SET `STATUS`='1'  where id='$ids[$i]'");
}
echo '<script> swal({title: "Amen,Hallelujah!",text: "Successfully Activated!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("deactivate.php","_self")});</script>';
   
    

}
?>

<!--End of Modal Delete---->

<!--End of Modal Delete---->



