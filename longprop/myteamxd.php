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
        <?php include('includes/sidenav.php');
        include('includes/topteamsearch.php');
        // $term=$_GET['batch'];
        // $month=$_GET['month'];
        // $year=$_GET['year'];
        ?>




        
        </nav>
        <!-- Begin Page Content -->


        <body>

        <div class="container">
        <ul class="breadcrumb">
						<?php
						$term = $_POST['batch'];
                        // $month = $_POST['month'];
                        // $year = $_POST['year'];
                   
                        
						$termquery = mysql_query("SELECT * FROM batch,year,month
                        where batch.BATCH='$term'
                      
                        ")or die(mysql_error());
						$propagation = mysql_fetch_array($termquery);

						?>
							<li><a href="#"><b>My Propagation</b></a><span class="divider">/</span></li>
							<li><a href="#"><?php echo $propagation['BATCH']; ?> 
                            term 
                           </a></li>
						</ul>
                        </div>
        <?php //include 'viewtable.php' ?>


   
        <form  method="post">    


 





        <?php include 'functions/sharemessmodal.php'?>



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
                                               $user_query = mysql_query("SELECT * from teammate 
                                                    
                                               INNER JOIN trainee_info on teammate.trainee_id=trainee_info.trainee_id
                                                INNER JOIN current_teamdata on current_teamdata.c_team_id=teammate.currentteam_id
                                                 INNER join month on current_teamdata.Month_id = month.ID 
                                                   INNER join year on current_teamdata.Year_id = year.ID 
                                                    INNER join batch on current_teamdata.batch_id = batch.ID 
                                                       INNER join userlevel on current_teamdata.userlevel_id = userlevel.ID 
                                                         INNER JOIN locality on teammate.locality_id=locality.ID
                                                         INNER JOIN class on teammate.ft_term=class.ID
                                                   where locality.ID='$check' and  userlevel.ID='3' and batch.BATCH='$term'   
                                                   ORDER BY teammate.teammate_id DESC
                                                   ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
                                                      //  $id=$row['id'];
                                                        ?> 
                                                      
<div class="container">

<div class="col-lg-14">
    

<!-- Dropdown Card Example -->
<div class="card shadow mb-1">
  <!-- Card Header - Dropdown -->
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
   

        
    </h6>


    




  <div class="card-body">
                      
                    <!-- Card content -->
                 
                    <div class="text-center">
                    <img class="rounded-circle" src="../Admin/img/<?php echo $row['profile_img'];?>" width="140" height="140" alt="">
  
                   <!-- Title -->
                
                            <h5 class="m-3 font-weight-bold namedesign"><?php echo $row['First_Name']?> <?php echo $row['Middle_Name']?> <?php echo $row['Last_Name']?> <?php echo $row['FT']?></h5>
                        <!-- Text -->
                        
                        <p class="m-3 font-weight-bold namedesign" >Term assign : <?php echo $row['MONTH'] ?> <?php echo $row['YR'] ?> <?php echo $row['BATCH'] ?> term</p>
                        <p class="text-justify ">
                        <p class="text-primary font-weight-bold"> <?php echo $row['Sending_Locality'] ?> <?php echo $row['Country'] ?></p>
                        <!-- <h5 ><p>1 Timothy 1:15-16 – Here is a trustworthy saying that deserves full 
        acceptance: Christ Jesus came into the world to save sinners—of whom I
         am the worst. But for that very reason I was shown mercy so that in me,
          the worst of sinners, Christ Jesus might display his immense patience as
           an example for those who would believe in him and receive eternal life.</p></h5> -->
           <!-- <a  href="#delete" class="btn btn-primary  btn-lg"  data-toggle="modal" data-target="#delete"><i class="fa fa-users"></i> </a>
                   -->
                        <!-- Button -->
                            
                            

                                          
                
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
                                                    
                                              
                    <?php   $pr_query="Select * from teammate";
                            $pr_result=mysql_query($pr_query);
                            $total_record=mysql_num_rows($pr_result);
                         

                          //   $total_page=ceil($total_record/$num_per_page);
                          //   if($page>1){
                          //     echo "
     
              
                    
                        
                     
                          //  <a href='myteamxd.php?page=".($page-1)."&batch=".$term."&month=".$month."&year=".$year."'class='btn btn-danger'>            <i class='fa fa-arrow-left'></i> Previous</a>
                   
                           
                  
                          //  ";
                        
                          //   }
                  
                          //   for($i=1;$i<$total_page;$i++) 
                          //    { 
                            
                          //      //     echo "
                               
                          //          // <a href='historypost.php?page=".$i."'class='btn btn-info text-center'>$i</a>&nbsp";
                        
                          //   }
                            
                          //   if($i>$page){
                          //       // echo "
                                
         
                   
                           
                          //       // <a href='myteamxd.php?page=".($page+1)."&batch=".$term."'class='btn btn-primary'>Next   <i class='fa fa-arrow-right'></i></a>";
                        
                          //   }
                          
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

  <script type="text/javascript">
$(document).ready(function(){
  $('.viewdable').click(function(){
      $('#fluidmodalInfo').modal('show');
         $tr =$(this).closest('tr');

            var data=$tr.children("td").map(function(){
              return $(this).text();  
              }).get();
              console.log(data);
              $('#propagationdate').val(data[2]);
              $('#time').val(data[3]);
              $('#brobap').val(data[4]);
              $('#sisbap').val(data[5]);
              $('#recbro').val(data[6]);
              $('#recsis').val(data[7]);
              $('#newmtg').val(data[8]);
              $('#smalmtg').val(data[9]);
              $('#avLTM').val(data[10]);
              $('#locjoin').val(data[11]);
              $('#estloc').val(data[12]);
              $('#recloc').val(data[13]);
              $('#estdist').val(data[14]);
              $('#recdist').val(data[15]);
              $('#prostrainbro').val(data[16]);
              $('#prostrainsis').val(data[17]);
			  $('#join').val(data[18]);
			  $('#manhrs').val(data[19]);
			  $('#ltm').val(data[20]);
			  $('#teamhrs').val(data[21]);
		
  });
});

</script>




</body>
                    