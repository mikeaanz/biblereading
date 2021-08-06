<?php
include('functions/db.php');
if (isset($_POST['delete_user'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROM teammate where teammate_id='$id[$i]'");
}
echo '<script> swal({title: "OH LORD JESUS!",text: "This Accounts already Deleted!", customClass: "swal-wide",
	confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineeteam.php?current_teamid ='.$historyfeedback.'&locality_id='.$locality.'","_self")});</script>';
  exit();
}
?>