
      <form  method="post" enctype="multipart/form-data">
<!-- Delete Modal Accounts -->
<div class="modal fade" id="delete_<?php echo $row['baptism_id']; ?>"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

      <input type="hidden" name="gender" value="<?php echo $row['gender'];?>">
          <input type="hidden" name="ids" value="<?php echo $row['baptism_id'];?>">


        <?php 
  $query_weekss = mysql_query("SELECT * FROM weekspropagation WHERE  historyfeedback_id='$get_id'")or die(mysql_error());
     $num_row_weeksss = mysql_num_rows($query_weekss);
        $row_week = mysql_fetch_array($query_weekss);
?> 

  <input type="hidden" name="id" value="<?php echo $get_id;?>">
    <input type="hidden" name="brotherss" value="<?php echo $row_week['BROBAPTISM'];?>">

       <input type="hidden" name="sisterss" value="<?php echo $row_week['SISBAPTISM'];?>">


        <p>Are you sure? Do you want to DELETE this data!</p>
        </div>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  name="deleterec" class="btn btn-danger"><i class="fas fa-thumbs-up icon-check icon-large"></i> Amen!</button>

      </div>
    </div>
  </div>
</div>
<!--End of Modal Delete---->
</form>


<?php

include('functions/db.php');
if (isset($_POST['deleterec'])){

$ids=$_POST['ids'];
$gender=$_POST['gender'];

$sisterss=$_POST['sisterss'];
$brotherss=$_POST['brotherss'];
$one='1';

//calculate count sister and brother
$minusSister=$sisterss-$one;

$minusBro=$brotherss-$one;


if ($gender == '1'){

    $result = mysql_query("DELETE FROM baptism_rpt where baptism_id='$ids'");

    mysql_query("UPDATE `weekspropagation` SET BROBAPTISM='$minusBro'
   WHERE historyfeedback_id='$get_id'")or die(mysql_error());

echo '<script> swal({title: "Amen!",text: "This Data already Deleted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$get_id.'&BATCH='.$getbatch.'","_self")});</script>';
  exit();
}

else if ($gender=='2'){

    $result = mysql_query("DELETE FROM baptism_rpt where baptism_id='$ids'");
 
    mysql_query("UPDATE `weekspropagation` SET SISBAPTISM='$minusSister'
   WHERE historyfeedback_id='$get_id'")or die(mysql_error());

echo '<script> swal({title: "Amen!",text: "This Data already Deleted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("baptizebookoflife.php?locate_idpost='.$get_id.'&BATCH='.$getbatch.'","_self")});</script>';
  exit();
}




// }

// }
}
?>