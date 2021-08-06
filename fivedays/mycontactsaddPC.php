<?php
include 'functions/db.php';
include 'functions/session.php';
$Name = $_POST['CName'];
$Address = $_POST['CAddress'];
$AgeGroup = $_POST['CAgeGroup'];
$Contact = $_POST['CContact'];
$Topic = $_POST['CTopic'];
$Remarks = $_POST['CRemarks'];

mysql_query("CALL sp_SaveContact 
('" .$Name. "','".$Contact."','" .$Address. "','".$Topic.
"','" .$Remarks. "',''," .$AgeGroup. ",0)")or die(mysql_error("ERROR"));
?>