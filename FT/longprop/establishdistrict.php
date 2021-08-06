
<?php include('includes/header.php');?>
<?php $historyfeedbackid = $_GET['locate_idpost'];
	$getbatch=$_GET['BATCH']; ?>
<?php include 'functions/db.php'?>
<?php include 'functions/session.php' ?>
<?php include('includes/sidenav.php');
	  include('includes/topheader.php');
 date_default_timezone_set('Asia/Singapore');
?>


<body>

	
<form  method="POST">
   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"></h1>
</div>

<div class="row">
<!-- Collapsable Card Example -->
<div class="col-lg-9">
<div class="card shadow mb-4">
	  <!-- Card Header - Accordion -->
	  <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"  aria-expanded="true" aria-controls="collapseCardExample">
		<h6 class="m-0 font-weight-bold text-primary text-center">Establish District</h6>
	  </a>
	  <!-- Card Content - Collapse -->
	  <div class="collapse show" id="collapseCardExample">
		<div class="card-body">
		<a  class="btn btn-link btn-lg" href="myentry.php?locate_idpost=<?php echo $historyfeedbackid;?>&BATCH=<?php echo $getbatch;?>"><i class="fa fa-arrow-left "></i>Back</a>

		<a  class="btn btn-success btn-circle" data-toggle="modal"    data-target="#recovered" ><i class="fa fa-plus text-white"></i></a>
		
		<a  class="btn btn-danger btn-circle" data-toggle="modal"    data-target="#delete" ><i class="fa fa-trash text-white"></i></a>
		
		<div class="float-right">
    <ul class="nav nav-pills">

          <li class="active">
		<!-- 	<a  href="" class="btn btn-primary  btn-circle" ><i class="fa fa-file-pdf"></i></a> -->
				</li>

				</div>
<div class="row">

<div class="col-lg-12">
  <!-- Default Card Example -->

  <div class="card mb-4">
	<div class="card-header">

    <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

				<?php include 'functions/moddeleter.php'?>

				<thead>
				<tr>
					   <tr>
			  <th></th>
			  <th></th>
              <th>Name of Establish District:</th>
              <th>Date Establish :</th>

				  </tr>
				</thead>

				<tfoot>
				  <tr>
			  
				  <tr>
				  <th></th>
				  <th></th>
      		  <th>Name of District:</th>
              <th>Date Recovered :</th>
				  </tr>
				  <tr>
				</tfoot>

				<tbody>
					<!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
				<?php	

							$user_query = mysql_query("SELECT * FROM establish_dist where establish_dist.acc_id='$session_id'
							ORDER BY establish_dist.est_id DESC
							")or die(mysql_error());
							while($row = mysql_fetch_array($user_query)){
							$id=$row['est_id'];
				   
												  ?>
					  <!--END OF CODE ---->
		 
				  <tr>
				  <td width="40">
				  <input id="optionsCheckbox" class="switch" name="selector[]" type="checkbox" value="<?php echo $id; ?>"></a>    
    
												</td>
				  <td width="40">
				  <a  href="editestablishdist.php?historyfeedbackid=<?php echo $historyfeedbackid; ?>&id=<?php echo $id;?>&BATCH=<?php echo $getbatch;?>"  class="btn btn-success"><i class="fa fa-edit"></i></a>
					
												</td>
			
				
				   <td><?php echo $row['establishname'];?></td>
					<td><?php echo $row['dateestablish'];?></td>
	
					</tr>
				  <?php } ?>
				
				</tbody>
				
			  </table>
			  </form>

			  <?php include 'functions/modestdistrict.php' ?>
		
			</div>
	
			<?php //include 'functions/modalupdaterec.php'?> 
		


	</div>
  
</div>
		</div>
	  </div>
	</div>
	

	</div>

    
<?php //include 'mypropdataadd.php'?>


  </div>
  </div>
  <?php include 'infoestabdist.php' ?>


</div>
</div>


</div>
<!-- /.container-fluid -->
</div>


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
  <!-- <script src="js/bootstrap-datetimepicker.min.js"></script> -->
<!--   <script src="js/bootstrap-datepicker.js"></script>  -->

<script src="mdb/js/datepicker.min.js"></script>
<script src="mdb/js/datepicker.js"></script>		

  <script type="text/javascript">
$(document).ready(function(){
  $('.viewdable').click(function(){
      $('#fluidmodalInfo').modal('show');
         $tr =$(this).closest('tr');

            var data=$tr.children("td").map(function(){
              return $(this).text();  
              }).get();
              console.log(data);	
              $('#ids').val(data[0]);
        
		
  });
});

</script>

    <script>
    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
      });
    });
  </script>
        

<!-- <script>
$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});
</script> -->


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





  <?php include('includes/footer.php');?>
  <?php include('includes/logoutmodal.php');?>
