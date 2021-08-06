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
        include ('includes/topheader.php')
   //include('includes/notsub.php');
        ?>




        
        </nav>
        <!-- Begin Page Content -->


        <body>

        <div class="row">
<!-- Collapsable Card Example -->
<div class="col-lg-12">
<div class="card shadow mb-4">
	  <!-- Card Header - Accordion -->
	  <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseCardExample">
		<h6 class="m-0 font-weight-bold text-primary text-center">Not Submitted Report</h6>
	  </a>
	  <!-- Card Content - Collapse -->
	  <div class="collapse show" id="collapseCardExample">
		<div class="card-body">
		  
<div class="row">

<div class="col-lg-12">

  <!-- Default Card Example -->
  <div class="card mb-4">
	<div class="card-header">
<!-- <button class="btn btn-success btn-circle"><i class="fa fa-file-pdf"></i></button> -->
    <div class="table-responsive">
	<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">	



				<thead>
			
			  <!-- <th></th> -->
			  <!-- <th></th> -->
			  <th>Propagation Date :</th>
			  <th>Accounts Information</th> 
            <th>Places</th> 
        
				  <!-- <th>Time Submitted :</th>
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
					<th>Total Trainee Team-Hours (In Hours) :</th> -->
  
  
	  
	   

			
				  </tr>
				</thead>

	

				<tbody>
					<!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
				<?php
            // old query
							$user_query = mysql_query("SELECT * FROM historyfeedback
                 
                             inner join month on historyfeedback.MONTH=month.ID
                              inner join year on historyfeedback.YEAR=year.ID 
                              inner join week on historyfeedback.WEEK=week.ID
                               inner join batch on historyfeedback.BATCH=batch.ID
                     
                                inner join locality
                                 INNER join accounts on locality.ID=accounts.LOCALITY
                                 INNER JOIN userlevel on accounts.USER_LEVEL=userlevel.ID
                      
                   
                                  WHERE  NOT EXISTS ( SELECT * FROM weekspropagation WHERE accounts.id = weekspropagation.accounts_id and readonly='1')
                                  
                           ")or die(mysql_error());
							while($row = mysql_fetch_array($user_query)){
              // $id=$row['id_weekprop'];
              
              
						// 	$user_query = mysql_query("SELECT * FROM `weekspropagation`
            //   inner join accounts on weekspropagation.accounts_id=accounts.id
            //    inner join locality on locality.id=accounts.LOCALITY 
            //    inner join historyfeedback on weekspropagation.historyfeedback_id=historyfeedback.id
            //     inner join month on month.id=historyfeedback.MONTH 
            //     inner join year on year.id=historyfeedback.YEAR
            //      inner join batch on batch.id=historyfeedback.BATCH 
            //      inner join week on week.id=historyfeedback.WEEK
            //       inner join userlevel on userlevel.id=historyfeedback.acc_id
            //        inner join status on status.id=historyfeedback.status_id
            //         WHERE NOT EXISTS 
            //         ( SELECT * FROM accounts WHERE accounts.id = weekspropagation.accounts_id and weekspropagation.manipulate_but='disabled')
            //               ")or die(mysql_error());
            //  while($row = mysql_fetch_array($user_query)){

				   
												  ?>
					  <!--END OF CODE ---->
		 
				  <tr>
				  <!-- <td width="40">
                        <a    class="btn btn-dark btn-circle viewdable"><i class="fa fa-eye text-white"></i></a>
												</td> -->
				  <!-- <td width="40">
                        <button  onclick="window.location.href='entryedit.php?locate_idpost=<?php echo $id; ?>'"   class="btn btn-danger" <?php echo $row['manipulate_but'];?>><i class="fa fa-file-pdf"></i></button>
												</td> -->
			
				  <td  class="m-3 font-weight-bold text-primary"><?php echo $row['MONTH'];?>, <?php echo $row['YR'];?>, <?php echo $row['BATCH'];?>  </td>
          <td><i  class="m-3 font-weight-italic text-primary">  <?php echo $row['USERNAME'];?> <?php echo $row['LEVEL'];?></i></td>
				<td><i  class="m-3 font-weight-italic text-dark"> <?php echo $row['PLACES'];?></i> <i class="m-3 font-weight-italic text-danger"><?php echo $row['week'];?></i> </td>

				   <!-- <td><?php echo $row['Time_Submitted'];?></td>
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
					<td><?php echo $row['TEAMHOURS'];?></td> -->
					</tr>
				  <?php } ?>
				
				</tbody>
    
			  </table>

			  
	 
			  <?php include 'modalviewrecord.php'?>	
			</div>





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







<script>

$(document).ready(function() {
    var table = $('#example').DataTable( {
        
        lengthChange: true,
        
        
        buttons: ['pdf','excel', 'colvis' ]
    } );

    
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>






	


	


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


<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_category)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":{
    url:"fetch.php",
    type:"POST",
    data:{is_category:is_category}
   },
   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],
  });
 }

 $(document).on('change', '#category', function(){
  var category = $(this).val();
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>




</body>
                    