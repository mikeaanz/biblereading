<?php include('includes/header.php');?> 
<?php include 'functions/db.php'?>
<?php include 'functions/session.php' ?>
<?php include('includes/sidenav.php');

 include('page.php');
include('maincontent.php');
 date_default_timezone_set('Asia/Singapore');
?>


<?php
include('functions/db.php');
if (isset($_POST['delete_user'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROM accounts where id='$id[$i]'");
}

echo '<script> swal({title: "OH NO!",text: "This accounts is Successfully Deleted!", customClass: "swal-wide",
	confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("accountactivation.php","_self")});</script>';
  exit();


}
?>
<?php include('includes/footer.php');?>
  <?php include('includes/logoutmodal.php');?>


