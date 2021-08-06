<link href="sweetalert/sweetalert.css" rel="stylesheet">
<script src="sweetalert/sweetalert.js"></script>
    <?php

      include 'functions/db.php'     
if (isset($_POST['saves'])){
  
$trainee_id=$_POST['trainee_id'];
$locality=$_GET['locality_id'];
 $historyfeedback=$_GET['historyfeedback_id'];

		/* check activated */
    $act = "SELECT * FROM teammate WHERE trainee_id='$trainee_id'and histortfeedback_id='$historyfeedback' and locality_id='$locality'";
    $result = mysql_query($act)or die(mysql_error());
    $rows = mysql_fetch_array($result);
    $activated = mysql_num_rows($result);
    /* end */


if($activated > 0){

  echo '<script> swal({title: "OH Lord Jesus!",text: "This FT  Already Exist!", customClass: "swal-wide",
    confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("traineeprofile.php","_self")});</script>';
  exit();

}else{

   mysql_query("INSERT INTO `teammate`(`trainee_id`, `historyfeedback_id`, `locality_id`)
    VALUES ('$trainee_id','$historyfeedback',','$locality')")or die(mysql_error());

echo '<script> swal({title: "Praise The Lord!",text: "Successfully Manage Transaction!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineeprofile.php","_self")});</script>';
exit();


}?>