
<?php 
include('functions/db.php');

if (isset($_POST['delete_user'])){

        $secure=$_POST['secure'];
        $act = "SELECT * FROM `security_code` WHERE securitycode='$secure'";
        $result = mysql_query($act)or die(mysql_error());
        $rows = mysql_fetch_array($result);
        $activated = mysql_num_rows($result);

      if(empty($_POST['selector'])){
     echo '<script> swal({title: "Notice!",text: "Please Check the checkbox before to proceed!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("traineeprofile.php","_self")});</script>';
    exit();
  }
       if($activated > 0){
          $id=$_POST['selector'];
            $N = count($id);
            for($i=0; $i < $N; $i++)
            {
                $result = mysql_query("DELETE FROM trainee_info where trainee_id='$id[$i]'");
                echo '<script> swal({title: "Security Code Match!",text: "This Data is Already Deleted!", customClass: "swal-wide",
                    confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineeprofile.php","_self")});</script>';
                    exit();
}

      }else
             echo '<script> swal({title: "Invalid Password!",text: "Your Security Code Does Not Match!.", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("traineeprofile.php","_self")});</script>';
    exit();

      }

  
?>