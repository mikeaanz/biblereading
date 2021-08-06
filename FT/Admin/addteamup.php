<?php include 'functions/db.php'?>
<?php $team=$_GET['id']; 
?>
<?php     $userlevel=$_GET['userlevel'];?>


<?php include 'functions/session.php'?>
        <?php include('includes/header.php');?>
        <?php include('includes/sidenav.php');
        include('includes/topheader.php');
        ?>
  

 <body>
     
 
        <form  method="post">
<div class="container">
        <div class="row">

<!-- Activation Accounts -->


<div class="col-xl-12 col-lg-6">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-primary">All Informations Locality Locations Team</h6>
    
    <div class="card-body">
    <a  href="traineepro.php" class="btn btn-link  btn-sm"  ><i class="fa fa-arrow-left" data-toggle="tooltip" title="Delete"></i>Back </a>
    <?php include 'functions/allmodal.php'?>
    </div>
    <div class="float-right">
    <ul class="nav nav-pills">

          <!-- <li class="active">
			<a  href="traineeprofile.php" class="btn btn-primary  btn-circle" ><i class="fa fa-info"></i><i class="fa fa-users" data-toggle="tooltip" title="All Information"></i> </a>
				</li>
                &nbsp;
				<li class="active">
			<a  href="traineeactive.php" class="btn btn-success  btn-circle" ><i class="fa fa-check"></i><i class="fa fa-user" data-toggle="tooltip" title="All Activated"></i> </a>
				</li>
                &nbsp;
				<li class="">
       	<a  href="traineinactive.php" class="btn btn-danger btn-circle"><i class="fa fa-times"></i><i class="fa fa-user" data-toggle="tooltip" title="All Deactivated"></i> </a>
				</li>
				</li>
	
				</ul> -->
	</div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">	




                  <thead>
                    <tr>
                    <th></th>
          
                      <th>Locality Team-Up :</th>
       

                      
              
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                    <th></th>
                 
                      <th>Locality Team-Up :</th>

                
        
                    </tr>
                  </tfoot>

                  <tbody>
                      <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
                  <?php
													$user_query = mysql_query("SELECT * from Locality
                                                    
                                            
                                                     ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
                            $ID=$row['ID'];
                            $places=$row['PLACES'];
                            $userlevel=$_GET['userlevel'];
                          // $id = $row['trainee_id'];
                          // $ft = $row['Term'];
                          // $gender = $row['Gender'];
                          // $batch=$row['Batch'];
                          // $stat=$row['Status'];
                        //   $loc = $row['LOCALITY'];
                        //   $user = $row['USER_LEVEL'];
													?>
                        <!--END OF CODE ---->
           
                    <tr>


                    <td width="40">
                    <a  href="traineeteam.php?currentteamid=<?php echo $team; ?>&locality_id=<?php echo $ID; ?>&userlevel=<?php echo $userlevel;?>" class="btn btn-primary  " ><i class="fa fa-plus" data-toggle="tooltip" title="All Information">Team-Up</i> </a>
												</td>  
                        <td><?php echo    $places; ?> </td>                             
             
       
      
                    </tr>
                    <?php } ?>
                  
                  </tbody>
                  
                </table>
                 
                <?php include 'deleteteam.php'?>
                </form>
                
        

	</div>
  
  </div>
  
  
      </div>
      </div>
      </div>
      </div>
             
      <?php //include 'addteam.php' ?>
    

      </body>   

  
 
          

         
     
      
           
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

  <script src="js/bootstrap-datepicker.js"></script>

	  <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.bootstrap4.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
    <script src="js/buttons.colVis.min.js"></script>
    <script src="js/dataTables.responsive.min.js"></script>

     <!--datepicker-->


<script src="mdb/js/datepicker.min.js"></script>
<script src="mdb/js/datepicker.js"></script>

    <script>
    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
      });
    });
  </script>





<script>

$(document).ready(function() {
    var table = $('#example').DataTable( {
        
        lengthChange: true,
        
        
        buttons: ['excel', 'colvis' ]
    } );

    
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>


  <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>


				
 
   
          
           
            
        
       
            
            
     
