<link href="sweetalert/sweetalert.css" rel="stylesheet">
<script src="sweetalert/sweetalert.js"></script>
<?php
include('functions/db.php');
if (isset($_POST['delete_user'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROM feedback where id='$id[$i]'");
}
echo '<script> swal({title: "Good Job!",text: "Successfully Deleted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("feedback.php","_self")});</script>';
header("location:feedback.php");

}
?>
