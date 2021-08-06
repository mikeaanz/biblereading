

      <form  method="post" enctype="multipart/form-data">
<!-- Delete Modal Accounts -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-danger">
        <h5 class="modal-title" style='color:#F8FAFB'   id="exampleModalLabel">Confirmation!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-trash fa-4x mb-4 text-danger" aria-hidden="true"></i>
        <p>Are you sure? Do you want to DELETE this data!</p>
        </div>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="deleterec" class="btn btn-danger"><i class="fas fa-thumbs-up icon-check icon-large"></i> Amen!</button>
      </div>
    </div>
  </div>
</div>
<!--End of Modal Delete---->
</form>
<?php

include('functions/db.php');
if (isset($_POST['deleterec'])){
    if(empty($_POST['selector'])){
      echo '<script> swal({title: "Warning!",text: "Please Check the checkbox before to proceed!", customClass: "swal-wide",
        confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("baptismrecord.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
      exit();
  }else
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROM baptism_rpt where baptism_id='$id[$i]'");
}
echo '<script> swal({title: "Amen!",text: "This Data already Deleted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptismrecord.php?id='.$get_id.'&week='.$weeks.'","_self")});</script>';
  exit();
}
?>