<?php
include('functions/db.php');
if (isset($_POST['delete_user'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROM accounts where id='$id[$i]'");
}
echo '<script> swal({title: "Alright!",text: "This Accounts already Deleted!", customClass: "swal-wide",
	confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("activate.php","_self")});</script>';
  exit();
}
?>