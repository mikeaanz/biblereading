<?php include 'functions/db.php'?>
<?php include 'functions/session.php'?>
<?php $get_id = $_GET['id']; ?>
<?php $ft = $_GET['ft']; ?>
<?php $gender = $_GET['gender']; ?>
<?php $batch = $_GET['batch']; ?>
<?php $stat = $_GET['stat']; ?>


        <?php include('includes/header.php');?>
        <?php include('includes/sidenav.php');
         include('includes/topheader.php');
         date_default_timezone_set('Asia/Singapore')
        ?>
        


        <form  method="post">
<div class="container">
        <div class="row">

<!-- Activation Accounts -->


<div class="col-xl-9 col-lg-6">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-primary">All Informations Trainee Profile</h6>
    
    <div class="card-body">
    <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i> </a>
    <?php include 'functions/deletetrainee.php'?>
    </div>
    <div class="float-right">
    <ul class="nav nav-pills">

          <li class="active">
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
	
				</ul>
	</div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">	




                  <thead>
                    <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Profile Picture :</th>
                    <th>Full Name :</th>
                      <th>Register Number :</th>
                      <th>Full Timer :</th>
                      <th>Batch :</th>
                      <th>Gender :</th>
                      <th>Locality :</th>
                      <th>Status :</th>
                      <th>Province :</th>
                      <th>Region :</th>
                      <th>Country :</th>
                      <th>Birthdate :</th>
                      <th>School :</th>
                      <th>Degree :</th>
                      <th>ContactNumber :</th>
                      <th>Email :</th>
                      <th>Contact Person :</th>
                      <th>Relationship :</th>
                      <th>Relationship Contact Number :</th>
                      
              
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                    <th></th>
                      <th></th>
                      <th></th>
                      <th>Profile Picture :</th>
                      <th>Full Name :</th>
                      <th>Register Number :</th>
                      <th>Full Timer :</th>
                      <th>Batch :</th>
                      <th>Gender :</th>
                      <th>Locality :</th>
                      <th>Status :</th>
                      <th>Province :</th>
                      <th>Region :</th>
                      <th>Country :</th>
                      <th>Birthdate :</th>
                      <th>School :</th>
                      <th>Degree :</th>
                      <th>ContactNumber :</th>
                      <th>Email :</th>
                      <th>Contact Person :</th>
                      <th>Relationship :</th>
                      <th>Relationship Contact Number :</th>
        
                    </tr>
                  </tfoot>

                  <tbody>
                      <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
                  <?php
													$user_query = mysql_query("SELECT * from trainee_info
                                                    LEFT join status on trainee_info.Status=status.ID    
                                                    LEFT join batch on trainee_info.Batch=batch.ID    
                                                    LEFT Join class on trainee_info.Term=class.ID
                                                    LEFT Join stat_saints on trainee_info.Gender=stat_saints.stat_id
                                            
                                                     ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
                          $id = $row['trainee_id'];
                          $ft = $row['Term'];
                          $gender = $row['Gender'];
                          $batch=$row['Batch'];
                          $stat=$row['Status'];
                        //   $loc = $row['LOCALITY'];
                        //   $user = $row['USER_LEVEL'];
													?>
                        <!--END OF CODE ---->
           
                    <tr>


                    <td width="40">
                        <a    class="btn btn-primary btn-circle viewdable"><i class="fa fa-eye text-white"></i></a>
												</td>                               
                  <td width="40px">   <input id="optionsCheckbox"  class="switch cbox" name="selector[]" type="checkbox" value="<?php echo $id; ?>"id="q6" data-toggle="tooltip" title="Note! Allowed only One Check to Delete"></td>
                    <td width="40">
												<a  href="edittraineeinfo.php?id=<?php echo $id; ?>&ft=<?php echo $ft;?>&gender=<?php echo $gender ?>&batch=<?php echo $batch ?>&stat=<?php echo $stat ?>"   class="btn btn-success"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
												</td>
                        <td>    <img class="rounded-circle"  src="../Admin/img/<?php echo $row['profile_img'];?>" width="120" height="120" alt=""></td>
                        <td><?php echo $row['First_Name'];?> <?php echo $row['Middle_Name'];?> <?php echo $row['Last_Name'];?></td>
                      <td><?php echo $row['Reg_No'];?></td>
                      <td style="font-style:italic; color: blue;"><?php echo $row['FT'];?></td>
                      <td style="font-style:italic; color: dark;"><?php echo $row['BATCH'];?></td>
                      <td><?php echo $row['Gender'];?></td>
                      <td><?php echo $row['Sending_Locality'];?></td>
                      <td class="<?php echo $row['ACTION'];?>" style="font-style:bold;"><?php echo $row['ACTION'];?></td>
                      <td><?php echo $row['Country'];?></td>
                      <td><?php echo $row['Province'];?></td>
                      <td><?php echo $row['Region'];?></td>
                      <td><?php echo $row['Birthdate'];?></td>
                      <td><?php echo $row['School'];?></td>
                      <td><?php echo $row['Degree'];?></td>
                      <td><?php echo $row['Contact_number'];?></td>
                      <td><?php echo $row['Email'];?></td>
                      <td><?php echo $row['Emergency_Contact_Person'];?></td>
                      <td><?php echo $row['Relationship'];?></td>
                      <td><?php echo $row['Contact_No'];?></td>
    
    
                    </tr>
                    <?php } ?>
                  
                  </tbody>
                  
                </table>
                </form>
                 <?php include 'delete_trainee.php'?>
              </div>
            </div>
            </div>
            </div>
<?php include 'trainee_information.php'?>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
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
  <script src="js/cheackerone.js"></script>
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
    <script src="js/script.js"></script>
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

<script>
$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});
</script>

</body>
                    