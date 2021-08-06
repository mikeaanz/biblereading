
<form METHOD="post">
<!-- Delete Modal Accounts -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="exampleModalLabel">Request Note!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-paper-plane fa-4x mb-4 text-primary" aria-hidden="true"></i>
       <h5 > Are you sure you want to request this current data? It cannot be undone ones it was proceed!</h5>
       <h5 > Write your reason here!</h5>
       <textarea class="form-control form-control-lg" name="reason" id="price" type="textarea"  ></textarea>

			<input class="form-control form-control-lg" name="coderequest" id="price" type="text" value="<?php echo $historyfeedbackid;  ?>" />
     
      <input class="form-control form-control-lg" name="timesup" id="price" type="text" value="<?php echo date('m/d/Y h:i:s a', time());  ?>" />
			
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="sent" class="btn btn-primary"><i class="icon-check icon-large"></i> Yes</button>
      </div>
    </div>
  </div>
</div>
</form>

<?php
include('functions/db.php');
if (isset($_POST['sent'])){
$reason=$_POST['reason'];
$coderequest=$_POST['coderequest'];
$timesup=$_POST['timesup'];

	$result = mysql_query("INSERT INTO `requestdata`(`receiver_id`, `content`, `sender_id`, `request_status`, `date_requested`, `coderequest`)
   VALUES ('29','$reason','$session_id','2','$timesup','$coderequest')");


echo '<script> swal({title: "Good Job!",text: "TYour Request Successfully Sent!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("entryedit.php?locate_idpost='.$historyfeedbackid.'","_self")});</script>';
exit();

}
?>
<!--End of Modal Delete---->


