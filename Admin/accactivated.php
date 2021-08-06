<?php include 'functions/db.php'?>
<?php $get_id = $_GET['id']; ?>
<?php $locality = $_GET['loc']; ?>
<?php $userlvl = $_GET['userlvl']; ?>
<?php include 'functions/session.php'?>
        <?php include('includes/header.php');?>
        <?php include('includes/sidenav.php');
         include('includes/topheader.php');
         date_default_timezone_set('Asia/Singapore')
        ?>
        
        </nav>
        <!-- Begin Page Content -->


        <body>
     
<div class="container">
        <div class="row">

<!-- Activation Accounts -->


<div class="col-xl-9 col-lg-6">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-primary">All Informations Accounts</h6>


    
    <form action="delete_account.php" method="post">
    <div class="card-body">
    <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash"  data-toggle="tooltip" title="Delete"></i> </a>
    <?php include 'functions/allmodal.php'?>
    </div>
    <div class="float-right">
    <ul class="nav nav-pills">

          <li class="active">
			<a  href="accountactivation.php" class="btn btn-primary  btn-circle" ><i class="fa fa-info"></i><i class="fa fa-users"  data-toggle="tooltip" title="All Information"></i> </a>
				</li>
                &nbsp;
				<li class="active">
			<a  href="activate.php" class="btn btn-success  btn-circle" ><i class="fa fa-check"></i><i class="fa fa-user"  data-toggle="tooltip" title="All Activated"></i> </a>
				</li>
                &nbsp;
				<li class="">
       	<a  href="deactivate.php" class="btn btn-danger btn-circle"><i class="fa fa-times"></i><i class="fa fa-user"  data-toggle="tooltip" title="All Deactivated"></i> </a>
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
                    <th></th>
                    <th></th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>User Level</th>
                      <th>Status</th>
                      <th>Locality</th>
                      <th>Date Created</th>

              
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                      <th></th>
                      <th></th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>User Level</th>
                      <th>Status</th>
                      <th>Locality</th>
                      <th>Date Created</th>
                  
        
                    </tr>
                  </tfoot>

                  <tbody>
                      <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
                  <?php
													$user_query = mysql_query("SELECT * from accounts
                           LEFT join userlevel on accounts.USER_LEVEL = userlevel.ID 
                           LEFT join locality on accounts.LOCALITY = locality.ID
                           LEFT join status on accounts.STATUS = status.ID ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
                            $id = $row['id'];
                            $loc = $row['LOCALITY'];
                            $user = $row['USER_LEVEL'];
                     
													?>
                        <!--END OF CODE ---->
           
                    <tr>


      
                    <td width="40px">		<input id="optionsCheckbox"  class="switch" name="selector[]" type="checkbox" value="<?php echo $id; ?>"  data-toggle="tooltip" title="Check List"></td>
                    <td width="40">
                    <a  href="accactivated.php?id=<?php echo $id; ?>&loc=<?php echo $loc; ?>&userlvl=<?php echo $user; ?>"   class="btn btn-success"><i class="fa fa-edit"  data-toggle="tooltip" title="Edit" ></i></a>
												</td>
                      <td><?php echo $row['USERNAME'];?></td>
                      <td><?php echo $row['PASSWORD'];?></td>
                      <td><?php echo $row['LEVEL'];?></td>
                      <td class="m-3 font-weight-bold text-primary"><?php echo $row['ACTION'];?></td>
                      <td><?php echo $row['PLACES'];?></td>
                      <td><?php echo $row['DATE_CREATED'];?></td>
     
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




<?php include 'acctedit.php' ?>






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

  <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>




</body>

