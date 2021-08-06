
   <!-- Begin Page Content -->
   <div class="container-fluid">
   
   <form  method="post">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"></h1>
</div>


<div class="row">
<!-- Collapsable Card Example -->

<div class="col-xl-12 col-lg-6">
<div class="card shadow mb-4">
	  <!-- Card Header - Accordion -->
	<!--   <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"  aria-expanded="true" aria-controls="collapseCardExample">
		<h6 class="m-0 font-weight-bold text-primary text-center">Edit Report's Submitted</h6>
	  </a> -->
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
<!-- 	<a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete" title="Popover Header" data-content="Some content inside the popover"><i class="fa fa-trash"></i> </a> -->
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

	
	  
				  <canvas  class="chartjs-render-monitor" id="myChart" width="400" height="200"></canvas>
				  <br>

				    <canvas  class="chartjs-render-monitor" id="pie" width="400" height="140"></canvas>

				    <br>

				    <canvas  class="chartjs-render-monitor" id="barchart" width="400" height="200"></canvas>

				    <br>
				    <canvas id="line-chart" width="800" height="450"></canvas>

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
</body>
 





