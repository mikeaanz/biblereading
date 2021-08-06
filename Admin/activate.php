<?php include 'functions/db.php'?>
<?php include 'functions/session.php'?>
        <?php include('includes/header.php');?>

        <?php include('includes/sidenav.php');?>
        <?php include 'includes/topheader.php' ?>
        </nav>
        <!-- Begin Page Content -->


        <body>
        <form  method="post">
<div class="container">
        <div class="row">

<!-- Activation Accounts -->


<div class="col-xl-9 col-lg-6">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-success">Activated Accounts</h6>
    
    <div class="card-body">
   Check All <input type="checkbox" class="switch"   name="selectAll" id="checkAll" data-toggle="tooltip" title="All Check!" />
   <a  href="#delete" class="btn btn-light  btn-smll"  data-toggle="modal" data-target="#deactivate"><i class="text-danger fa-2x fa fa-times-circle" data-toggle="tooltip" title="Deactivated!"></i> </a>

    <div class="float-right">
    <ul class="nav nav-pills">

          <li class="active">
			<a  href="accountactivation.php" class="btn btn-primary  btn-circle" ><i class="fa fa-info"></i><i class="fa fa-users"></i> </a>
				</li>
                &nbsp;
				<li class="active">
			<a  href="activate.php" class="btn btn-success  btn-circle" ><i class="fa fa-check"></i><i class="fa fa-user"></i> </a>
				</li>
                &nbsp;
				<li class="">
       	<a  href="deactivate.php" class="btn btn-danger btn-circle"><i class="fa fa-times"></i><i class="fa fa-user"></i> </a>
				</li>
				</li>
	
				</ul>
	</div>

     <?php include 'functions/cheackeraccountsmodal.php'?>
  </div>
  <div class="card-body">
    <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">




                  <thead>
                    <tr>
                    <th></th>
           <!--          <th></th> -->
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
   <!--                    <th></th> -->
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
                           LEFT join status on accounts.STATUS = status.ID where accounts.STATUS='1'")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													$id = $row['id'];
                             $loc = $row['LOCALITY'];
                          $user = $row['USER_LEVEL'];
													?>
                        <!--END OF CODE ---->
           
                    <tr>


      
     <td width="40px">  

<label class="switch">
      <input id="optionsCheckbox"   name="toogle[]" type="checkbox"   data-toggle="tooltip" title="toogle to Activate!" value="<?php echo $id; ?>">
  <span class="slider round"></span>
</label>
              <!--       <td width="40px">		<input id="optionsCheckbox"  class="switch" name="selector[]" type="checkbox" value="<?php echo $id; ?>"></td> -->
                    <td width="40">
												<a  href="activated.php<?php echo '?id='.$id; ?>&loc=<?php echo $loc; ?>&userlvl=<?php echo $user; ?>"  class="btn btn-success"><i class="fa fa-edit"></i></a>
												</td>
                      <td><?php echo $row['USERNAME'];?></td>
                      <td><?php echo $row['PASSWORD'];?></td>
                      <td><?php echo $row['LEVEL'];?></td>
                      <td class="m-3 font-weight-bold text-success"><?php echo $row['ACTION'];?></td>
                      <td><?php echo $row['PLACES'];?></td>
                      <td><?php echo $row['DATE_CREATED'];?></td>
     
                    </tr>
                    <?php } ?>
                  
                  </tbody>
                  
                </table>
                </form>
                  <?php include 'functions/allmodal.php'?>
                <?php include 'delete_account.php'?>
              </div>
            </div>
            </div>

            </div>
            </div>
                 </div>
<!-- activation of information -->



<?php include 'accinformation.php' ?>

  

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
                  $("#checkAll").click(function () {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                  });
                  </script> 


</body>
                    