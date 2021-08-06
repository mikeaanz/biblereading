<?php
include('functions/db.php');
if (isset($_POST['delete_user'])){
  if(empty($_POST['selector'])){
    echo '<script> swal({title: "Oh Lord Jesus!",text: "Please Check the checkbox before to proceed!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("addmanageweek.php","_self")});</script>';
    exit();
  }else
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROM week where ID='$id[$i]'");
}

echo '<script> swal({title: "Good Job!",text: "This Week is already Deleted!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("addmanageweek.php","_self")});</script>';
exit();




}
?>