<?php
include('admin/dbcon.php');
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$userlevel = $_POST['userlevel'];
$locality = $_POST['locality'];
$ID = $_POST['ID'];

$query = mysql_query("select * from accounts where username='$username' ")or die(mysql_error());
$row = mysql_fetch_array($query);
$id = $row['ID'];

$count = mysql_num_rows($query);
if ($count > 0){
	mysql_query("update accounts set PASSWORD = '$password', status = '1' where ID = '$id'")or die(mysql_error());
	$_SESSION['id']=$id;
	echo 'true';
}else{
echo 'false';
}
?>