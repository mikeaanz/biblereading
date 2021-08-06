<?php
include('functions/db.php');
if (isset($_POST['saves'])){

$id=$_POST['id'];
$username=$_POST['username'];
$password=$_POST['password'];
$locality=$_POST['locality'];
$datecreated=$_POST['datecreated'];
$dateactivated=$POST['dateactivated'];
$status=$_POST['status'];


$result=mysql_query("UPDATE `accounts` SET 
    `USERNAME`='$username',`PASSWORD`='$password',`USER_LEVEL`='$userlevel',
    `LOCALITY`='$locality',`DATE_CREATED`='$datecreated',`STATUS`='$status',`DATE_ACTIVATED`='$dateactivated' WHERE id='$id' ")or die(mysql_error());

header  ("accactivated.php");

?>
<?php


}
?>