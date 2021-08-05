<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">


  <title>PMS - Login</title>

  <!-- Custom fonts for this template-->
<!--   <link href="../Admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
  <link href="css/FONT.css" rel="stylesheet">
  <link href="css/pacestyle.css" rel="stylesheet">
<!-- <link href='https://fonts.googleapis.com/css?family=Lora:400italic' rel='stylesheet' type='text/css'> -->
<!--     <link href="css/mdb.css" rel="stylesheet"> -->
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/demo.css" />
<!--  <link href="css/styles.css" rel="stylesheet">  -->
  <link href="css/style3.css" rel="stylesheet">
  <link href="sw/sweetalert.css" rel="stylesheet">
  <link href="css/textstyle.css" rel="stylesheet">
<script src="sw/sweetalert.js"></script>
<script src="js/anime.min.js"></script>


<!-- <script src="js/pace.js"></script> -->
<!--     <script src="https://cdn.jsdelivr.net/npm/jquery-bez@1.0.11/src/jquery.bez.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script> -->

<?php          session_start(); ?>
</head>




  <!-- <div id="nc-main" class="nc-main bg-cover bg-cc" > -->


      <div class="full-wh">
      
        <!-- STAR ANIMATION -->
        <div class="bg-animation">
          <div id='stars'></div>
          <div id='stars2'></div>
          <div id='stars3'></div>
          <div id='stars4'></div> 
     </div> 

      </div>
  </div> 




<!-- <h1 class="ml4"> -->
<!--   <span class="letters letters-1">Please</span> -->
<!--   <span class="letters letters-1">Welcome</span>
  <span class="letters letters-2">Back !</span> -->
<!--   <span class="letters letters-3">To Login!</span> -->
<!--   <p  style="text-align: center;">Excerpt From the Ministry</p> -->

<!--     <span   style="text-align: center; color: white;">We need to see that the burden we have received is not what most people consider to be the burden of the gospel.
     The burden of the gospel that we have received is Christ the Lord Himself.
     Jesus is the gospel (Acts 5:42; 17:18), and without Him the gospel amounts to nothing.
      Therefore,to preach the gospel is to preach the Lord Jesus 2 (Cor. 4:4-5).
      Such preaching is carried out not merely with words but by persons.
   Hence, our preaching depends on the kind of person we are.
   In order to be those who bear the Lord Jesus to others,
 we must be filled with the Lord Jesus.
 Our desire is to impart into others the Lord Jesus with whom we have been filled.
(Christ Being the Burden of the Gospel.chp 2.section 1, Witness Lee)</span> -->
  
<!-- </h1> -->




<!-- <h1 class="ml15">

    <span class="word">Scroll</span>
  <span class="word">Down To</span>
   <span class="word">Login!</span>
</h1> -->



<!-- <h1 class="ml11">
  <span class="text-wrapper">
    <span class="line line1"></span>
    <span class="letters">Scroll Down to Login.</span>
  </span>
</h1> -->




<!-- 
<br>


<br>     -->

 <body id="page">



        <ul class="cb-slideshow">
            <li><span></span><div><h3></h3></div></li>
            <li><span></span><div><h3></h3></div></li>
            <li><span></span><div><h3></h3></div></li>
            <li><span></span><div><h3></h3></div></li>
            <li><span></span><div><h3></h3></div></li>
            <li><span></span><div><h3></h3></div></li>

            <h1 class="ml7">
  <span class="text-wrapper">
    <span class="letters">Welcome Back!</span>
  </span>
</h1>

                    <h1 class="ml1">
               
  <span class="text-wrapper">
    <span class="line line1"></span>
    <span class="letters">FULL-TIMERS</span>

    <span class="line line2"></span>
  </span>

</h1>
</div>

</ul>
<!-- <h1 class="ml16">Made with love</h1> -->

        </ul>


  <div class="container">
 
    <!-- Outer Row -->
    <div class="row justify-content-left">

      <div class="col-xl-5 col-lg-10 col-md-7">

        <div class="card o-hidden border-1 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
            <div class="container">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">

<div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-interval="10000">
    <center>  <img src="Admin/img/logo1.png" class="d-block w-50" alt="..."></center>
    </div>
    <div class="carousel-item" data-interval="2000">
    <center>  <img src="Admin/img/logo2.png" class="d-block w-50" alt="..."></center>
    </div>
    <div class="carousel-item">
     <center> <img src="Admin/img/logo3.png" class="d-block w-50" alt="..."></center>
    </div>
  </div>
<!--   <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only ">Previous</span> -->
  </a>
<!--   <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span> -->
  </a>
</div>
        &nbsp;


                    <h1 class="h5 text-gray-900 mb-1 title">Propagation Monitoring System</h1>
                    
                <!--     <p class="p text-gray-22 mb-3">@ Propagation Monitoring System</p> -->
                  </div>


                  <form method="POST">
                        &nbsp;
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="exampleInputEmail" name="username" placeholder="Enter your Username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                     <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
         
                                   <input type="submit" name="login"  class="btn btn-outline-primary waves-effect btn-user btn-block"  value="Sign In"><i class="fa fa-sign-in"></i></input>

            
         
              <!--       <a href="register.php" class="btn btn-danger btn-user btn-block">
                      Create Account    
                    </a> -->
                      
                  </form>
                  <hr>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>


  <a class="scroll-to-top rounded" href="#page-top">
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="sw/sweetalert.js"></script>
  <script src="sw/sweetalert.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
  
<script type="text/javascript">
  $('.carousel').carousel({
  interval: 2000
})
</script>

     <script type="text/javascript">
        
        var textWrapper = document.querySelector('.ml7 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml7 .letter',
    translateY: ["1.1em", 0],
    translateX: ["0.55em", 0],
    translateZ: 0,
    rotateZ: [180, 0],
    duration: 1400,
    easing: "easeOutExpo",
    delay: (el, i) => 50 * i
  }).add({
    targets: '.ml7',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });
      </script>
 <script>

        paceOptions = {
        ajax: true,
        document: true,
        eventLag: false
        };

        Pace.on('done', function() {
        $('.p').delay(500).animate({top: '30%', opacity: '0'}, 3000, $.bez([0.19,1,0.22,1]));


        $('#preloader').delay(1500).animate({top: '-100%'}, 2000, $.bez([0.19,1,0.22,1]));

        TweenMax.from(".title", 2, {
             delay: 1.8,
                  y: 10,
                  opacity: 0,
                  ease: Expo.easeInOut
            })
       });

      </script>
        <script>
        var textWrapper = document.querySelector('.ml1 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml1 .letter',
    scale: [0.3,1],
    opacity: [0,1],
    translateZ: 0,
    easing: "easeOutExpo",
    duration: 600,
    delay: (el, i) => 70 * (i+1)
  }).add({
    targets: '.ml1 .line',
    scaleX: [0,1],
    opacity: [0.5,1],
    easing: "easeOutExpo",
    duration: 1399,
    offset: '-=875',
    delay: (el, i, l) => 80 * (l - i)
  }).add({
    targets: '.ml1',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });

      </script>

      <script>
var ml4 = {};
ml4.opacityIn = [0,1];
ml4.scaleIn = [0.2, 1];
ml4.scaleOut = 3;
ml4.durationIn = 800;
ml4.durationOut = 600;
ml4.delay = 500;

anime.timeline({loop: true})
  .add({
    targets: '.ml4 .letters-1',
    opacity: ml4.opacityIn,
    scale: ml4.scaleIn,
    duration: ml4.durationIn
  }).add({
    targets: '.ml4 .letters-1',
    opacity: 0,
    scale: ml4.scaleOut,
    duration: ml4.durationOut,
    easing: "easeInExpo",
    delay: ml4.delay
  }).add({
    targets: '.ml4 .letters-2',
    opacity: ml4.opacityIn,
    scale: ml4.scaleIn,
    duration: ml4.durationIn
  }).add({
    targets: '.ml4 .letters-2',
    opacity: 0,
    scale: ml4.scaleOut,
    duration: ml4.durationOut,
    easing: "easeInExpo",
    delay: ml4.delay
  }).add({
    targets: '.ml4 .letters-3',
    opacity: ml4.opacityIn,
    scale: ml4.scaleIn,
    duration: ml4.durationIn
  }).add({
    targets: '.ml4 .letters-3',
    opacity: 0,
    scale: ml4.scaleOut,
    duration: ml4.durationOut,
    easing: "easeInExpo",
    delay: ml4.delay
  }).add({
    targets: '.ml4',
    opacity: 0,
    duration: 800,
    delay: 800
  });
      </script>

      <script type="text/javascript">
        var textWrapper = document.querySelector('.ml16');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml16 .letter',
    translateY: [-100,0],
    easing: "easeOutExpo",
    duration: 1400,
    delay: (el, i) => 30 * i
  }).add({
    targets: '.ml16',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });
      </script>

 <!--            <script>
var ml5 = {};
ml5.opacityIn = [0,1];
ml5.scaleIn = [0.2, 1];
ml5.scaleOut = 3;
ml5.durationIn = 800;
ml5.durationOut = 600;
ml5.delay = 500;

anime.timeline({loop: true})
  .add({
    targets: '.ml5 .letterss-1',
    opacity: ml5.opacityIn,
    scale: ml5.scaleIn,
    duration: ml5.durationIn
  }).add({
    targets: '.ml5 .letterss-1',
    opacity: 0,
    scale: ml5.scaleOut,
    duration: ml5.durationOut,
    easing: "easeInExpo",
    delay: ml5.delay
  }).add({
    targets: '.ml5 .letterss-2',
    opacity: ml5.opacityIn,
    scale: ml5.scaleIn,
    duration: ml5.durationIn
  }).add({
    targets: '.ml5 .letters-2',
    opacity: 0,
    scale: ml5.scaleOut,
    duration: ml5.durationOut,
    easing: "easeInExpo",
    delay: ml5.delay
  }).add({
    targets: '.ml5 .letterss-3',
    opacity: ml5.opacityIn,
    scale: ml5.scaleIn,
    duration: ml5.durationIn
  }).add({
    targets: '.ml5 .letterss-3',
    opacity: 0,
    scale: ml5.scaleOut,
    duration: ml5.durationOut,
    easing: "easeInExpo",
    delay: ml5.delay
  }).add({
    targets: '.ml5',
    opacity: 0,
    duration: 500,
    delay: 500
  });
      </script>
 -->
    <!--   <script type="text/javascript">
        
        anime.timeline({loop: true})
  .add({
    targets: '.ml15 .word',
    scale: [14,1],
    opacity: [0,1],
    easing: "easeOutCirc",
    duration: 800,
    delay: (el, i) => 800 * i
  }).add({
    targets: '.ml15',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });
      </script>


      <script type="text/javascript">
        
        var textWrapper = document.querySelector('.ml11 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml11 .line',
    scaleY: [0,1],
    opacity: [0.5,1],
    easing: "easeOutExpo",
    duration: 700
  })
  .add({
    targets: '.ml11 .line',
    translateX: [0, document.querySelector('.ml11 .letters').getBoundingClientRect().width + 10],
    easing: "easeOutExpo",
    duration: 700,
    delay: 100
  }).add({
    targets: '.ml11 .letter',
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: 600,
    offset: '-=775',
    delay: (el, i) => 34 * (i+1)
  }).add({
    targets: '.ml11',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 2000
  });
      </script>

      <script type="text/javascript">
        anime.timeline({loop: true})
  .add({
    targets: '.ml8 .circle-white',
    scale: [0, 3],
    opacity: [1, 0],
    easing: "easeInOutExpo",
    rotateZ: 360,
    duration: 1100
  }).add({
    targets: '.ml8 .circle-container',
    scale: [0, 1],
    duration: 1100,
    easing: "easeInOutExpo",
    offset: '-=1000'
  }).add({
    targets: '.ml8 .circle-dark',
    scale: [0, 1],
    duration: 1100,
    easing: "easeOutExpo",
    offset: '-=600'
  }).add({
    targets: '.ml8 .letters-left',
    scale: [0, 1],
    duration: 1200,
    offset: '-=550'
  }).add({
    targets: '.ml8 .bang',
    scale: [0, 1],
    rotateZ: [45, 15],
    duration: 1200,
    offset: '-=1000'
  }).add({
    targets: '.ml8',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1400
  });

anime({
  targets: '.ml8 .circle-dark-dashed',
  rotateZ: 360,
  duration: 8000,
  easing: "linear",
  loop: true
});


      </script> -->





      </div>





</body>


<?php
		include('functions/db.php');
 

       // 
        
        
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

        echo '<script> 	swal({title: "OH LORD!",text: "Your account needs to be activated by the Monitoring Team! Maybe your Username and Password does not match, please verify it before log in. Thank You..",customClass: "swal-wide",
          confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("index.php","_self")});</script>';
        exit();
		}	
    }

		?>
</html>
