<link href="css/sb-admin-2.min.css" rel="stylesheet">

  <link href="css/styles2.css" rel="stylesheet">
<link href="css/jquery.jgrowl.css" rel="stylesheet">
  <script src="js/jquery-3.4.1.min.js"></script>

  <link href="sweetalert/sweetalert.css" rel="stylesheet">
<script src="sweetalert/sweetalert.js"></script>

<?php
include('functions/db.php');
session_start();



if(isset($_POST['save'])){



$username = $_POST['username'];
$password = $_POST['password'];
$userlevel = $_POST['userlevel'];
$locality = $_POST['locality'];
$datecreated=$_POST['datecreated'];


/*this is to cheack if your username already exist*/
$query = mysql_query("select * from accounts where USERNAME='$username'")or die(mysql_error());
$row = mysql_fetch_array($query);
$id = $row['ID'];
$count = mysql_num_rows($query);



/* insert data 
$insert = mysql_query("INSERT INTO `accounts`(`USERNAME`, `PASSWORD`, `USER_LEVEL`, `LOCALITY`, `DATE_CREATED`, `STATUS`) 
VALUES ('$username','$password','$userlevel','$locality','$datecreated','1')")or die(mysql_error());
$insertrow = mysql_fetch_array($query);
$idrows = $insertrow['ID'];
$countrow = mysql_num_rows($insert);
*/

if ($count > 0){
	echo 'True';
	echo '<script> 	swal({title: "Message!",text: "Username Already Existed!.",customClass: "swal-wide",
		confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("register.php","_self")});</script>';
	exit();

						 
		}else{
			mysql_query("INSERT INTO `accounts`(`USERNAME`, `PASSWORD`, `USER_LEVEL`,`LOCALITY`,`DATE_CREATED`, `STATUS`) 
			VALUES ('$username','$password','$userlevel','$locality','$datecreated','2')")or die(mysql_error());

	echo 'False';
	echo '<script> swal({title: "Message!",text: "Registered Successfully!", customClass: "swal-wide",
		confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("register.php","_self")});</script>';



		exit();
	}
}

?>