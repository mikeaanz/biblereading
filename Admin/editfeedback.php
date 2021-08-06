<?php include 'functions/db.php'?>
<?php $get_id = $_GET['id']; ?>
<?php include 'functions/session.php'?>
        <?php include('includes/header.php');?>
        <?php include('includes/sidenav.php');?>
        
        </nav>
        <!-- Begin Page Content -->


        <body>
        <form action="delete_post.php" method="post">
<div class="container">
        <div class="row">

<!-- Activation Accounts -->


<div class="col-xl-9 col-lg-6">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-primary">Edit FeedBack</h6>
    
    <div class="card-body">
    <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> </a>
    <?php include 'functions/allmodal.php'?>
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
        
        				<li class="">
         	<a  href="historypost.php" class="btn btn-info btn-circle .btn-lg"><i class="fa fa-history"></i> </a>
				</li> 
                &nbsp;
                -->
				<li class="">
         	<a  href="historypost.php" class="btn btn-info btn-circle .btn-lg"><i class="fa fa-history"></i> </a>
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
                      <th>Date Posted</th>
              
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
                                                    $user_query = mysql_query("SELECT * from feedback
                                                    LEFT JOIN month on feedback.MONTH=month.ID
                                                    LEFT JOIN year on feedback.YEAR=year.ID
                                                    LEFT JOIN batch on feedback.BATCH=batch.ID
                                                    LEFT JOIN week on feedback.WEEK=week.ID
                                                    LEFT JOIN userlevel on feedback.acc_id=userlevel.ID
                                                    LEFT JOIN status on feedback.status_id=status.ID
                                                    ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){

                            $id=$row['id'];
                            $month=$row['ID'];
                            $yr=$row['YEAR'];
                            $batch=$row['BATCH'];
                            $week=$row['WEEK'];
                            $accid=$row['acc_id'];
                            $status=$row['status_id'];
													?>



                        <!--END OF CODE ---->
           
                    <tr>


                    <td width="40px">		<input id="optionsCheckbox"  class="switch" name="selector[]" type="checkbox" value="<?php echo $id; ?>"></td>
                    <td width="40">
                        <a  href="editfeedback.php?id=<?php echo $id; ?>&month=<?php echo $month; ?>&yr=<?php echo $yr;?>&batch=<?php $batch;?>&week=<?php echo $week;?>"   class="btn btn-success"><i class="fa fa-edit"></i></a>
												</td>
                      <td><?php echo $row['MONTH'];?></td>
                      <td><?php echo $row['YR'];?></td>
                      <td class="m-3 font-weight-bold text-primary"><?php echo $row['BATCH'];?></td>
                      <td><?php echo $row['week'];?></td>
                      <td><?php echo $row['LEVEL'];?></td>
                      <td  class="<?php echo $row['ACTION'];?>" style="font-style:italic;"><?php echo $row['ACTION'];?></td>
                      <td><?php echo $row['date_started'];?></td>
                    </tr>
                    <?php  }?>
                  
                  </tbody>
                  
                </table>
                </form>
                
              </div>
            </div>
            </div>

            </div>
     
<!-- activation of information -->






<?php include 'manageeditfeedback.php' ?>



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






</body>
                    