

<body>
<div class="container">
<ul class="breadcrumb">
						<?php
						$term = $_POST['batch'];
                        // $month = $_POST['month'];
                        // $year = $_POST['year'];
                        $level = $_POST['level'];
                        
						$termquery = mysql_query("SELECT * FROM batch,year,month,userlevel
                        where batch.BATCH='$term' and LEVEL='$level'
                      
                        ")or die(mysql_error());
						$propagation = mysql_fetch_array($termquery);

						?>
							<li><a href="#"><b>Trainees Team-up</b></a><span class="divider">/</span></li>
							<li><a href="#"><?php echo $propagation['BATCH']; ?> 
                            term 
                             <?php echo $propagation['LEVEL']; ?></a></li>
						</ul>


                        </div>
   <!-- Begin Page Content -->
   <div class="container-fluid">
   
   <form action="datadelete.php" method="post">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"></h1>
</div>


<div class="row">
<!-- Collapsable Card Example -->

<div class="col-xl-12 col-lg-6">
<div class="card shadow mb-4">
	  <!-- Card Header - Accordion -->
	  <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"  aria-expanded="true" aria-controls="collapseCardExample">
		<h6 class="m-0 font-weight-bold text-primary text-center">Trainees Information Team-Up</h6>
	  </a>
	  <!-- Card Content - Collapse -->
	  <div class="collapse show" id="collapseCardExample">
		<div class="card-body">
		  
		  
<div class="row">

  
<div class="col-xl-12 col-lg-6">

  <!-- Default Card Example -->
  <div class="card mb-4">
	<div class="card-header">
  				   <!-- Topbar Search -->



  <!-- Check All <input type="checkbox" class="switch"   name="selectAll" id="checkAll" /> -->
	<!-- <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> </a> -->
  <div class="float-right">
    <ul class="nav nav-pills">

          <li class="active">
			<!-- <a  href="enabledbut.php" class="btn btn-info  btn-circle" ><i class="fa fa-toggle-on"></i><i class="fa fa-activate"></i> </a> -->
				</li>

				</li>
	
				</ul>
	</div>
  </div>
  

    <div class="table-responsive">
     
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">	

			
    <thead>
                    <tr>
     
<!--                     <th>Profile Image :</th> -->
         
                        <th>Trainees ID # </th>
                       <th>Full-Timers Name </th>
       
                       <th>Locality Assign Area </th>
                      <th>Schedule of Propagation </th>
               
              
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
<!--   
                      <th>Profile Image :</th> -->
                        <th>Trainees ID # </th>
                       <th>Full-Timers Name </th>
          
                       <th>Locality Assign Area </th>
                      <th>Schedule of Propagation </th>
               
                    </tr>
                  </tfoot>
				<tbody>
					<!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
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
                                                                      where batch.BATCH='$term' and userlevel.LEVEL='$level'
                                                                      order by locality.ID DESC
															")or die(mysql_error());
															while($row = mysql_fetch_array($user_query)){
															// $id=$row['id_weekprop'];
												  ?>
					  <!--END OF CODE ---->
		 
				  <tr>
                  <!-- <td width="40px">		<input id="optionsCheckbox" class="switch" name="selector[]" type="checkbox" value="<?php echo $teammate_id; ?>" data-toggle="tooltip" title="Check List"></td> -->
               <!--      <td>    <img class="rounded-circle"  src="../Admin/img/<?php echo $row['profile_img'];?>" width="120" height="120" alt=""></td> -->

                      <td class="m-3 font-weight-bold" ><?php echo $row['Reg_No'];?></td>
                      <td class="m-3 font-weight-bold"> <?php echo $row['First_Name'];?> <?php echo $row['Middle_Name'];?> <?php echo $row['Last_Name'];?>  <?php echo $row['FT'];?></td>
              
                      <td class="m-3 font-weight-bold" ><?php echo $row['PLACES'];?></td>
                              <td class="m-3 font-weight-bold text-primary"><?php echo $row['MONTH'];?> <?php echo $row['YR'];?> <?php echo $row['BATCH'];?> <?php echo $row['LEVEL'];?></td>
    
					</tr>
				  <?php } ?>
				
				</tbody>
				
			  </table>
	 
			  
			</div>

<?php include 'modalmanagefeedback.php' ?>
<?php include 'modalupdatefeed.php' ?>
<?php include 'functions/deletedataxd.php' ?>


</form>


	</div>
  
</div>



		</div>
	

	





</div>
</div>
</div>
</div>


<!-- /.container-fluid -->
 
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



<script type="text/javascript">
$(document).ready(function(){
  $('.editable').click(function(){
      $('#fluidmodal').modal('show');
         $tr =$(this).closest('tr');

            var datas=$tr.children("td").map(function(){
              return $(this).text();  
              }).get();
              console.log(datas);
              $('#propagationdate').val(datas[3]);
              $('#time').val(datas[4]);
              $('#brobap').val(datas[5]);
              $('#sisbap').val(datas[6]);
              $('#recbro').val(datas[7]);
              $('#recsis').val(datas[8]);
              $('#newmtg').val(datas[9]);
              $('#smalmtg').val(datas[10]);
              $('#avLTM').val(datas[11]);
              $('#locjoin').val(datas[12]);
              $('#estloc').val(datas[13]);
              $('#recloc').val(datas[14]);
              $('#estdist').val(datas[15]);
              $('#recdist').val(datas[16]);
              $('#prostrainbro').val(datas[17]);
              $('#prostrainsis').val(datas[18]);
            
  });
});

</script>

<script>
	$(document).ready(function(){
$("#takeScreenShot").click(function(){

	html2canvas(document.body, {
		 onrendered: function(canvas) {
		 var tempcanvas=document.createElement('canvas');
            tempcanvas.width=1350;
            tempcanvas.height=1350;
            var context=tempcanvas.getContext('2d');
            context.drawImage(canvas,112,0,288,200,0,0,350,350);
            var link=document.createElement("a");
            link.href=tempcanvas.toDataURL('image/jpg');   //function blocks CORS
            link.download = 'screenshot.jpg';
            link.click();
		}
	});
});
});
}
}


</script>


<script>
								$("#checkAll").click(function () {
									$('input:checkbox').not(this).prop('checked', this.checked);
								});
								</script>	



