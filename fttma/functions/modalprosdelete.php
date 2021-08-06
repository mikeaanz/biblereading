

<!-- Delete Modal Accounts -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-danger">
        <h5 class="modal-title" style='color:#F8FAFB'   id="exampleModalLabel">Warning!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-times fa-4x mb-4 text-danger" aria-hidden="true"></i>
       <h5 > Are you sure you want to delete this data? It cannot be undone ones it was proceed!</h5>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="delete_user" class="btn btn-danger"><i class="icon-check icon-large"></i> Yes</button>
      </div>
    </div>
  </div>
</div>
<?php
include('functions/db.php');
if (isset($_POST['delete_user'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROM prospect_train where pros_id='$id[$i]'");
}

echo '<script> swal({title: "OH NO!",text: "This record is Successfully Deleted!", customClass: "swal-wide",
	confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("prospecttrain.php?locate_idpost='.$historyfeedbackid.'","_self")});</script>';
  exit();


}
?>
