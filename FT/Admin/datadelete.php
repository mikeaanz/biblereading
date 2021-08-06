<?php include 'requestingnotif.php'
?>

<?php
include('functions/db.php');
if (isset($_POST['sent'])){
$id=$_POST['selector'];

$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("Delete From weekspropagation  where id_weekprop='$id[$i]'");
}
echo '<script> swal({title: "OH NO!",text: "Data Already Deleted!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("Editreport.php","_self")});</script>';
   
    

}
?>


<?php include('includes/footer.php');?>
  <?php include('includes/logoutmodal.php');?>