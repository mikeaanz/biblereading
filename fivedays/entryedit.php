
<?php include('includes/header.php');?>
<?php $historyfeedbackid = $_GET['locate_idpost']; $id=$_GET['id']; $getbatch=$_GET['BATCH']; ?>
<?php include 'functions/db.php'?>
<?php include 'functions/session.php' ?>
<?php include('includes/sidenav.php');
include('includes/topheader.php');
 date_default_timezone_set('Asia/Singapore');
?>


<body>

	

   <!-- Begin Page Content -->
   <div class="container-fluid">


<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"></h1>
</div>

<div class="row">
<!-- Collapsable Card Example -->
<div class="col-lg-12">
<div class="card shadow mb-4">
	  <!-- Card Header - Accordion -->
	  <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"  aria-expanded="true" aria-controls="collapseCardExample">
		<h6 class="m-0 font-weight-bold text-success text-center">View Record's Table</h6>
	  </a>
	  <!-- Card Content - Collapse -->
	  <div class="collapse hide" id="collapseCardExample">
		<div class="card-body">
		  
<div class="row">

<div class="col-lg-12">

  <!-- Default Card Example -->
  <div class="card mb-4">
	<div class="card-header">

    <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">



				<thead>
				<tr>
					   <tr>
			  <th></th>
			  <th></th>
	<!-- 		  <th></th> -->
			  <th>Propagation Date :</th>
				  <th>Time Submitted :</th>
					<th>Homes Knock :</th>
					<th>Homes Preach :</th>
					<th>Person Contacted :</th>
					<th>Person Who received the gospel called(out of Persons Contacted) :</th>
					<th>Gospel Friends open for follow-up :</th>
					<th>Brother Baptism :</th>
					<th>Sister Baptism :</th>
					<th>New Home Meetings Started :</th>
					<th>Total Home Meeting Held :</th>
					<th>Total Persons Home Met :</th>
					<th>Person Visited But Not Home Met :</th>
					<th>New Small Group Meetings established :</th>
					<th>Total Small Group Meeting Held :</th>
					<th>Total Local Saints Attending Small Group meetings :</th>
					<th>Local Saints Joining Propagation :</th>
					<th>Total Man-Hours of Local saints joining Propagation :</th>
					<th>LTM Attendance :</th>
					<th>Total Trainee Team-Hours (In Hours) :</th>
  
  
	   

			
				  </tr>
				</thead>

				<tfoot>
				  <tr>
			  
				  <tr>
				  <th></th>
				  <th></th>
			<!-- 	  <th></th> -->
				  <th>Propagation Date :</th>
				  <th>Time Submitted :</th>
					<th>Homes Knock :</th>
					<th>Homes Preach :</th>
					<th>Person Contacted :</th>
					<th>Person Who received the gospel called(out of Persons Contacted) :</th>
					<th>Gospel Friends open for follow-up :</th>
					<th>Brother Baptism :</th>
					<th>Sister Baptism :</th>
					<th>New Home Meetings Started :</th>
					<th>Total Home Meeting Held :</th>
					<th>Total Persons Home Met :</th>
					<th>Person Visited But Not Home Met :</th>
					<th>New Small Group Meetings established :</th>
					<th>Total Small Group Meeting Held :</th>
					<th>Total Local Saints Attending Small Group meetings :</th>
					<th>Local Saints Joining Propagation :</th>
					<th>Total Man-Hours of Local saints joining Propagation :</th>
					<th>LTM Attendance :</th>
					<th>Total Trainee Team-Hours (In Hours) :</th>
  
  
				  </tr>
				  <tr>
				</tfoot>

				<tbody>
					<!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
				<?php
					$user_query = mysql_query("SELECT * FROM `weekspropagation`
					inner join accounts on weekspropagation.accounts_id=accounts.id 
					inner join locality on locality.id=accounts.LOCALITY
					inner join historyfeedback on weekspropagation.historyfeedback_id=historyfeedback.id 
					inner join month on month.id=historyfeedback.MONTH
					inner join year on year.id=historyfeedback.YEAR 
					inner join batch on batch.id=historyfeedback.BATCH 
					inner join week on week.id=historyfeedback.WEEK
					inner join userlevel on userlevel.id=historyfeedback.acc_id 
					inner join status on status.id=historyfeedback.status_id where weekspropagation.accounts_id='$session_id'
					ORDER BY weekspropagation.id_weekprop DESC
					")or die(mysql_error());
					while($row = mysql_fetch_array($user_query)){
				$id=$row['id_weekprop'];
							      $batch=$row['BATCH'];
							      		$historyfeedback=$row['historyfeedback_id'];


				   
												  ?>
					  <!--END OF CODE ---->
		 
				  <tr>
				  <td width="40">
                        <a    class="btn btn-primary btn-circle viewdable"><i class="fa fa-eye text-white"></i></a>
												</td>
				  <td width="40">
				  <button onclick="window.location.href='entryedit.php?locate_idpost=<?php echo $historyfeedback; ?>&BATCH=<?php echo $batch; ?>&id=<?php echo $id;?>'"  class="btn btn-success" <?php echo $row['manipulate_but'];?>><i class="fa fa-edit"></i></button>
											
												</td>
			<!-- 	  <td width="40">
                        <a  data-toggle="modal" data-target="#delete"   class="btn btn-warning btn-circle" disabled><i class="fa fa-paper-plane text-primary"></i></a>
										<?php include 'functions/requestdata.php' ?>	
												</td> -->
			
				  <td  class="m-3 font-weight-bold text-primary"><?php echo $row['MONTH'];?>,<?php echo $row['YR'];?>,<?php echo $row['week'];?>,<?php echo $row['BATCH'];?>  <?php echo $row['PLACES'];?></td>
				  <td><?php echo $row['Time_Submitted'];?></td>
					<td><?php echo $row['HOMESKNOCK'];?></td>
					<td><?php echo $row['HOMESPREACH'];?></td>
					<td><?php echo $row['PCONTACTED'];?></td>
					<td><?php echo $row['RECEIVEDGOSPEL'];?></td>
					<td><?php echo $row['GOPENFOLLOW'];?></td>
					<td><?php echo $row['BROBAPTISM'];?></td>
					<td><?php echo $row['SISBAPTISM'];?></td>
					<td><?php echo $row['NEWHOMESMTG'];?></td>
					<td><?php echo $row['TOTALHOMESMTG'];?></td>
					<td><?php echo $row['TOTALPERSONHMTG'];?></td>
					<td><?php echo $row['PVISITEDNOTHMEET'];?></td>
					<td><?php echo $row['NSMALLGMTG'];?></td>
					<td><?php echo $row['SMALLGMTGHELD'];?></td>
					<td><?php echo $row['LOCALATTSMLMTG'];?></td>
					<td><?php echo $row['LOCALSAINTSJOINPROP'];?></td>
					<td><?php echo $row['MAN-HOURS'];?></td>
					<td><?php echo $row['LTM'];?></td>
					<td><?php echo $row['TEAMHOURS'];?></td>
				  
					</tr>
				  <?php } ?>
				
				</tbody>
				
			  </table>
	 
			  
			</div>

			<?php include 'modalviewrecord.php'?>



	</div>
  
</div>



		</div>
	  </div>
	</div>
	</div>
	</div>
<?php include 'myentryupdate.php'?>
	

  </div>

</div>

</div>
<!-- /.container-fluid -->



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
  <script src="js/errorcheaker.js"></script>
  

  <script type="text/javascript">
$(document).ready(function(){
  $('.viewdable').click(function(){
      $('#fluidmodalInfo').modal('show');
         $tr =$(this).closest('tr');

            var data=$tr.children("td").map(function(){
              return $(this).text();  
              }).get();
              console.log(data);
			  $('#propagationdate').val(data[3]);
              $('#time').val(data[4]);
              $('#brobap').val(data[5]);
              $('#sisbap').val(data[6]);
              $('#recbro').val(data[7]);
              $('#recsis').val(data[8]);
              $('#newmtg').val(data[9]);
              $('#smalmtg').val(data[10]);
              $('#avLTM').val(data[11]);
              $('#locjoin').val(data[12]);
              $('#estloc').val(data[13]);
              $('#recloc').val(data[14]);
              $('#estdist').val(data[15]);
              $('#recdist').val(data[16]);
              $('#prostrainbro').val(data[17]);
              $('#prostrainsis').val(data[18]);
			  $('#join').val(data[19]);
			  $('#manhrs').val(data[20]);
			  $('#ltm').val(data[21]);
			  $('#teamhrs').val(data[22]);
		
		
  });
});

</script>



<script type="application/javascript">

  function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57 ))
            return false;
         return true;
      }
</script>							

<script type="text/javascript">
 $(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
     $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
		});
</script>


<script>

$('.numbers').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});


</script>



</script>


  <?php include('includes/footer.php');?>
  <?php include('includes/logoutmodal.php');?>
