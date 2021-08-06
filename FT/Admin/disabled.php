<?php include 'requestingnotif.php'

?>

<?php
include('functions/db.php');
if (isset($_POST['sent'])){
  if(empty($_POST['selector'])){
		echo '<script> swal({title: "Oh Lord Jesus!",text: "Please Check the checkbox before to proceed!", customClass: "swal-wide",
		  confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("requestingnotif.php","_self")});</script>';
		exit();
	}else
$id=$_POST['selector'];

$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("UPDATE `weekspropagation` SET `manipulate_but`='disabled'  where id_weekprop='$id[$i]'");
}
echo '<script> swal({title: "Good Job!",text: "Successfully Disabled!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("requestingnotif.php","_self")});</script>';
   
    

}
?>


<?php include('includes/footer.php');?>
  <?php include('includes/logoutmodal.php');?>