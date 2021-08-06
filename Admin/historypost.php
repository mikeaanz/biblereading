<?php include 'functions/db.php'?>
<?php include 'functions/session.php'?>
        <?php include('includes/header.php');?>
        <?php include('includes/sidenav.php');
        include('includes/topheader.php');
        ?>
        
        </nav>
        <!-- Begin Page Content -->


        <body>
        <form method="post"> -
<div class="container">
        <div class="row">

<!-- Activation Accounts -->


<div class="col-xl-9 col-lg-6">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-info">History Feedback</h6>
    
    <div class="card-body">
    <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i> </a>
    <?php include 'functions/deletedmodal.php'?>
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
         	<a  href="feedback.php" class="btn btn-success btn-circle .btn-lg"><i class="fa fa-arrow-left" data-toggle="tooltip" title="back to Create Feedback"></i> &nbsp;<i class="fa fa-newspaper" ></i> </a>
				</li> 
        &nbsp;
				<li class="">
         	<a  href="historypost.php" class="btn btn-info btn-circle .btn-lg"><i class="fa fa-history" data-toggle="tooltip" title="history Feedback"></i> </a>
				</li> 
				</li>
	
				</ul>

	</div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">




                  <thead>
                    <tr>
                    <th>Check to Delete</th>
                    <th>Edit</th>
                      <th>Month</th>
                      <th>Year</th>
                      <th>Batch</th>
                      <th>Week</th>
                      <th>User Level</th>
                      <th>Status Posted</th>
                      <th>Date Started</th>
                    
              
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                      <th>Check to Delete</th>
                      <th>Edit</th>
                      <th>Month</th>
                      <th>Year</th>
                      <th>Batch</th>
                      <th>Week</th>
                      <th>User Level</th>
                      <th>Status Posted</th>
                      <th>Date Posted</th>
                  
                    </tr>
                  </tfoot>

                  <tbody>
                      <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
                  <?php
                                                    $user_query = mysql_query("SELECT * from historyfeedback
                                                    LEFT JOIN month on historyfeedback.MONTH=month.ID
                                                    LEFT JOIN year on historyfeedback.YEAR=year.ID
                                                    LEFT JOIN batch on historyfeedback.BATCH=batch.ID
                                                    LEFT JOIN week on historyfeedback.WEEK=week.ID
                                                    LEFT JOIN userlevel on historyfeedback.acc_id=userlevel.ID
                                                    LEFT JOIN status on historyfeedback.status_id=status.ID
                                                    ORDER BY historyfeedback.id DESC
                                                    ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){

                                                        $id=$row['id'];
                                                        $month=$row['ID'];
                                                        $yr=$row['YEAR'];
                                                        $batch=$row['BATCH'];
                                                        $week=$row['WEEK'];
                                                        $accid=$row['acc_id'];
                                                        $status_id=$row['status_id'];
                                               
                 
													?>
                        <!--END OF CODE ---->
           
                    <tr>


                    <td width="40px">		<input id="optionsCheckbox"  class="switch cbox" name="selector[]" type="checkbox" value="<?php echo $id; ?>"id="q6" data-toggle="tooltip" title="Note! Allowed only One Check to Delete"></td>
                    <td width="40">
                        <a  href="edithistorypost.php?id=<?php echo $id; ?>"   class="btn btn-info  btn-circle .btn-lg"><i class="fa fa-plus-circle " data-toggle="tooltip" title="Edit"></i></a>
												</td>
                      <td><?php echo $row['MONTH'];?></td>
                      <td><?php echo $row['YR'];?></td>
                      <td class="m-3 font-weight-bold text-primary"><?php echo $row['BATCH'];?></td>
                      <td><?php echo $row['week'];?></td>
                      <td><?php echo $row['LEVEL'];?></td>
                      <td  class="<?php echo $row['ACTION'];?>" style="font-style:italic;"><?php echo $row['ACTION'];?></td>
                      <td class=""><?php echo $row['date_started'];?></td>
                    </tr>
                    <?php } ?>
                  
                  </tbody>
                  
                </table>
     </form> 
                
              </div>
            </div>
            </div>

            </div>
     
<!-- activation of information -->






<?php include 'historyviewrepost.php' ?>



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
  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/cheackerone.js"></script>

  <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>





</body>
                    