<?php
include 'functions/db.php';
include 'functions/session.php';
$Name = $_POST['CName'];
$Address = $_POST['CAddress'];
$AgeGroup = $_POST['CAgeGroup'];
$Contact = $_POST['CContact'];
$Topic = $_POST['CTopic'];
$Bap = $_POST['CBap'];

mysql_query("CALL sp_SaveContact 
('" .$Name. "','".$Contact."','" .$Address. "','".$Topic.
"','','".$Bap."'," .$AgeGroup. ",1)")or die(mysql_error("ERROR"));
?>