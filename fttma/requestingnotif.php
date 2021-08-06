<?php require_once 'functions/db.php';

if(isset($_GET['page'])){

    $page=$_GET['page'];
}
else{
    $page=1;
}


$num_per_page=05;
$start_from=($page-1)*05;

?>
<?php include 'functions/session.php'

?>
        <?php include('includes/header.php');?>
        <?php include('includes/sidenav.php');?>




        
        </nav>
        <!-- Begin Page Content -->


        <body>
   
        <form action="delete_historypost.php" method="post">    
<div class="container">

        <div class="row">







    <div class="card-body">
    <!-- <img class="card-img-top" src="img/fttma.jpg" alt="Card image cap"> -->
  <!--  <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> </a>-->

    </div>
    <div class="float-right">
    <ul class="nav nav-pills">

        <!--  <li class="active">
			<a  href="accountactivation.php" class="btn btn-primary  btn-circle" ><i class="fa fa-info"></i><i class="fa fa-users"></i> </a>
				</li>
                &nbsp;
				<li class="active">
			<a  href="activate.php" class="btn btn-success  btn-circle" ><i class="fa fa-check"></i><i class="fa fa-user"></i> </a>
				</li>
                &nbsp;
                -->
	<li class="">
         	<!--<a  href="longprop.php" class="btn btn-success btn-circle .btn-lg"><i class="fa fa-arrow-left" aria-hidden="true"></i> </a>-->
				</li> 
				</li>
	
				</ul>
	</div>
  </div>



  <?php







                                               $user_query = mysql_query("SELECT * FROM `requestdata` inner join longpropagation on requestdata.coderequest=longpropagation.id_prop 
                                                   where receiver_id = '$session_id' ORDER BY requestdata.request_id DESC
                                                  limit $start_from,$num_per_page  ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){

                                                        $id=$row['coderequest'];
                 
                 
                                                        ?> 
                                                      
<div class="container">

<div class="col-lg-14">
    

<!-- Dropdown Card Example -->
<div class="card shadow mb-1">
  <!-- Card Header - Dropdown -->
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
   

        
    </h6>


    


</label>
    
    <div class="dropdown no-arrow">
      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
      </a>
      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
        <div class="dropdown-header">Transaction:</div>
        <a class="dropdown-item" href="#">RePost</a>
        <a class="dropdown-item"  data-toggle="modal" data-target="#delete" name="selector" value="<?php echo $id; ?>" href="#delete" > <?php echo $id; ?> Delete</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">1 John 1:8</a>
      </div>
    </div>
  </div>
  <!-- Card Body -->

  <div class="card-body">

                    <!-- Card content -->
                    <div class="card" >

                   <!-- Title -->
                       
                            <p class="text-center">2 Timothy 2:7</p>
                        <h5 class="text-center" style="font-style:italic;">Consider what I say, for the Lord will give you understanding in all things.</h5>
                        <!-- Text -->
                        <p class="text-justify ">
                        <p class="card-text text-center bg-gradient-primary   " style="font-style:italic;"><a style='color:#F8FAFB' > Date Requested </a><span style='color:#F8FAFB' ><?php echo $row['date_requested'];?></span></p>
                        <p class="font-weight-bold card-text text-center">Code Requested #: <?php echo $row['coderequest'];?>-<?php echo $row['request_id'];?></p>
                        <p class="card-text text-center">Message</p>
                        <p class="font-weight-bold text-center"><?php echo $row['content'];?></p>
                       
           
                        <!-- Button -->
                            

                                          
                    <div class="col text-center">	
                        <a href="myentry.php?locate_idpost=<?php echo $id; ?>" class="btn btn-primary "><i class="fa fa-paper-plane"></i>UPDATE REQUEST</a>
                        <hr>
                    </div>
         
                    </div>
                    </div>
                    </div>
      
                    </div>
                    </div>
                                                    </form>
           
                    <?php }?>
                  <hr>
            
                  
                  <div class="col text-center">	
                  <nav>
                  <nav>
                    <nav>
                    <div class="col text-center">	
                                                    </div>
                                                    
                                              
                    <?php   $pr_query="Select * from requestdata  WHERE receiver_id='$session_id'";
                            $pr_result=mysql_query($pr_query);
                            $total_record=mysql_num_rows($pr_result);
                         

                            $total_page=ceil($total_record/$num_per_page);
                            if($page>1){
                                echo "
     
              
                    
                        
                     
                           <a href='requestingnotif.php?page=".($page-1)."'class='btn btn-danger'>            <i class='fa fa-arrow-left'></i> Previous</a>
                   
                           
                  
                           ";
                        
                            }
                  
                            for($i=1;$i<$total_page;$i++) 
                             { 
                            
                               //     echo "
                               
                                   // <a href='historypost.php?page=".$i."'class='btn btn-info text-center'>$i</a>&nbsp";
                        
                            }
                            
                            if($i>$page){
                                echo "
                                
         
                   
                           
                                <a href='requestingnotif.php?page=".($page+1)."'class='btn btn-primary'>Next   <i class='fa fa-arrow-right'></i></a>";
                        
                            }
                          
                    ?>
                

                 

  

   
      <?php include('includes/footer.php');?>
  <?php include('includes/logoutmodal.php');?>
      <!-- End of Main Content -->
      



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






</body>
                    