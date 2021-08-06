<!-- <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <link href="css/styles2.css" rel="stylesheet">
<link href="css/jquery.jgrowl.css" rel="stylesheet">
  <script src="js/jquery-3.4.1.min.js"></script> -->

<!--   <link href="sweetalert/sweetalert.css" rel="stylesheet">
<script src="sweetalert/sweetalert.js"></script> -->


<?php
		include('functions/db.php');
        session_start();
        
        
if(isset($_POST['login'])){

		$username = $_POST['username'];
		$password = $_POST['password'];
		/* admin */
			$admin = "SELECT * FROM accounts WHERE USERNAME='$username' AND PASSWORD='$password' AND user_level='1' and STATUS='1'";
			$result = mysql_query($admin)or die(mysql_error());
			$row = mysql_fetch_array($result);
			$num_row = mysql_num_rows($result);
		/* user week end */
		$query_week = mysql_query("SELECT * FROM accounts WHERE USERNAME='$username' AND PASSWORD='$password' and user_level='2' and STATUS='1'")or die(mysql_error());
		$num_row_week = mysql_num_rows($query_week);
        $row_week = mysql_fetch_array($query_week);
        
        /* user long propagation */
        $query_longprop = mysql_query("SELECT * FROM accounts WHERE USERNAME='$username' AND PASSWORD='$password' AND user_level='3' and STATUS='1'")or die(mysql_error());
        $num_row_query_longprop = mysql_num_rows($query_longprop);
        $row_query_longprop = mysql_fetch_array($query_longprop);


                /* user long 5days */
                $query_five = mysql_query("SELECT * FROM accounts WHERE USERNAME='$username' AND PASSWORD='$password' AND user_level='4' and STATUS='1'")or die(mysql_error());
                $num_row_query_five = mysql_num_rows($query_five);
                $row_query_five = mysql_fetch_array($query_five);
        
        


		if( $num_row > 0 ) { 
		$_SESSION['id']=$row['id'];
        echo 'true_admin';	
        echo '<script> swal({title: "Praise the Lord!",text: "Successfully Log In!", customClass: "swal-wide",
          confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("Admin/index.php","_self")});</script>';
  
        
		}else if ($num_row_week > 0){
		$_SESSION['id']=$row_week['id'];
        echo 'true';
        echo '<script> swal({title: "Praise the Lord!",text: "Successfully Log In!", customClass: "swal-wide",
            confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("fttma/index.php","_self")});</script>';
    
    
    }else if ($num_row_query_longprop > 0){
        $_SESSION['id']   = $row_query_longprop['id'];
        echo 'TRUE';
        echo '<script> swal({title: "Praise the Lord!",text: "Successfully Log In!", customClass: "swal-wide",
            confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("longprop/index.php","_self")});</script>';
    
    }else if ($num_row_query_five > 0){
            $_SESSION['id']   = $row_query_five ['id'];
            echo 'TRUE';
            echo '<script> swal({title: "Praise the Lord!",text: "Successfully Log In!", customClass: "swal-wide",
                confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("fivedays/index.php","_self")});</script>';
        
        
        }else{ 
        echo 'false';
        echo '<script> 	swal({title: "OH LORD!",text: "Your account needs to be activated by the Monitoring Team! Maybe your Username and Password does not match, please verify it before log in. Thank You..",customClass: "swal-wide",
          confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("index.php","_self")});</script>';
        exit();
		}	
    }

		?>