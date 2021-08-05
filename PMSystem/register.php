

<?php include 'header.php'?>
<link href="sweetalert/sweetalert.css" rel="stylesheet">
<script src="sweetalert/sweetalert.js"></script>

<?php include('functions/db.php'); 
 date_default_timezone_set('Asia/Singapore');

?>

  <div class="container">

  <div class="row justify-content-center">

<div class="col-xl-10 col-lg-5 col-md-12">
    <div class="card o-hidden border-3 shadow-lg my-5">
        <!-- Nested Row within Card Body -->
        <div class="row">

          <div class="col-lg-12">
            <div class="p-3">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create Your Own Account</h1>
              </div>

                <div class="form-group row">
                  <div class="col-sm-12 mb-12 mb-sm-">
             
           
         <form   method="post" >

                <div class="form-group" >
                  <input type="text" name="username" id="username" class="form-control form-control-user" id="exampleInputEmail" placeholder="Create Username" required>
                </div>
                <div class="form-group">
                  <input type="password" name="password" id="password" class="form-control form-control-user" id="exampleInputEmail" placeholder="Password" required>
                </div>
                <!-- <div class="form-group">
                  <input type="password" name="cpassword" id="cpassword" class="form-control form-control-user" id="exampleInputEmail" placeholder="Re-Type Password" required>
                </div> -->
                <div class="form-group">
                  <input name="datecreated" id="datecreated" class="form-control form-control-user"  type="HIDDEN" value="<?php echo date('m/d/Y h:i:s a', time());  ?>" />
                   </div>



                <div class="form-group ">
                  <Select class="selectpicker" data-live-search="true" data-size="6" data-width="99%" name="userlevel" id="selectpicker" required>
                              <option  disabled>Select Your User Level</option>
                              <?php
                                  $query = mysql_query("select * from userlevel where LEVEL='WEEKEND' or LEVEL='LONG PROPAGATION' or LEVEL='5 DAYS PROPAGATION' ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['LEVEL']; ?></option>
                               <?php
                    }
                                 ?>
                              
                  </select>
                </div>

                <div class="form-group">

              <Select class="form-control selectpicker text-center" data-live-search="true" data-size="6" data-width="99%" name="locality" id="selectpicker"  required>
                              <option class="text-center"  disabled>Select Your Locality</option>
                              <?php
                                  $query = mysql_query("select * from locality order by ID DESC ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>" class="text-center"><?php echo $row['PLACES']; ?> </option>
                               <?php
                    }
                                 ?>
                              
                  </select>

             
                  <div class="col-sm-6 mb-1 mb-sm-0">
                   
                  </div>
                  <div class="col-sm-3">
                    
                  </div>
                </div>
            <input type="submit"  name="save" value="Register Your Accounts" class="btn btn-primary btn-user btn-block" ><i class="icon-check icon-large"></i>
            &nbsp;
           <a href="index.php" class="btn btn-info btn-user btn-block">
                  Log in Your Account
                </a>
       
           
              </form>

              
            
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</body>
  
<!--
  <script>

$("#cpassword").blur(function(){
	var pass = $("#password").val();
	var cpass = $("#cpassword").val();

if( pass !== cpass){
  Swal.fire({
  			type: 'error',
  	 	title: 'Warning! Wrong Input',
 		 	text: 'Total Person Meet should not be zero (0).Amen Brothers & Sisters!!',
  		 	footer: '<a >Note !  Incorrect input is an offense.Re-check your inputs before submitting.</a>'
		 });
 
}
}
  });
  
</script>
-->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/pms.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/bootstrap-select.min.js"></script>
  <script src="js/bootstrap-select.js"></script>

<script>
$(document).ready(function(e){
  $(".selectpicker").selectpicker({
            size: '10'
        });

        }
    });
</script>

</body>
<?php


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
  

    echo '<script> swal({title: "Message!",text: "Registered Successfully!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("register.php","_self")});</script>';
  
  
  
      exit();
    }
  }
  
  ?>

</html>
