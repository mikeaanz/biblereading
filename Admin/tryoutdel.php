            <?php
include('functions/db.php');
if(isset($_GET['id'])){
// $id=$_POST['selector'];

	$result = mysql_query("DELETE FROM current_teamdata where c_team_id='".$_GET['id']."'");
}
echo '<script> swal({title: "Lord Jesus!",text: "This Accounts already Deleted!", customClass: "swal-wide",
	confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineepro.php","_self")});</script>';
  exit();

?>
                                              