<?php
include('functions/db.php');
if (isset($_POST['delete_user'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROM current_teamdata where c_team_id='$id[$i]'");
}
echo '<script> swal({title: "Oh Lord Jesus!",text: "This Data already Deleted!", customClass: "swal-wide",
	confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineeprofile.php","_self")});</script>';
  exit();
}
?>