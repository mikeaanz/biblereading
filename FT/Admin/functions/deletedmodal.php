
<form  method="POST">
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
      <i class="fas fa-lock fa-4x mb-4 text-danger" aria-hidden="true"></i>
      <div class="form-group">
    <label for="exampleInputPassword1">Security Password:</label>
    <input type="password" class="form-control" name="secure"  placeholder="Security Code">
  </div>
       <p  ><i class="m-3 font-weight-italic text-danger">***Protected and Crucial Data Need to be Safe!***</i></p>
      </div>
      
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="delete_user" class="btn btn-danger"><i class="icon-check icon-large"></i> Yes</button>
      </div>
    </div>
  </div>
</div>
<!--End of Modal Delete---->
</form>



<?php 
include('functions/db.php');

if (isset($_POST['delete_user'])){

        $secure=$_POST['secure'];
        $act = "SELECT * FROM `security_code` WHERE securitycode='$secure'";
        $result = mysql_query($act)or die(mysql_error());
        $rows = mysql_fetch_array($result);
        $activated = mysql_num_rows($result);

      if(empty($_POST['selector'])){
     echo '<script> swal({title: "Notice!",text: "Please Check the checkbox before to proceed!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("historypost.php","_self")});</script>';
    exit();
  }
       if($activated > 0){
          $id=$_POST['selector'];
            $N = count($id);
            for($i=0; $i < $N; $i++)
            {
                $result = mysql_query("DELETE FROM historyfeedback where id='$id[$i]'");
                echo '<script> swal({title: "Security Code Match!",text: "This Data is Already Deleted!", customClass: "swal-wide",
                    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("historypost.php","_self")});</script>';
                    exit();
}

      }else
             echo '<script> swal({title: "Invalid Password!",text: "Your Security Code Does Not Match!.", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("historypost.php","_self")});</script>';
    exit();

      }

  
?>

