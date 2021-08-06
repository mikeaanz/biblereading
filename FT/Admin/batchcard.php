 <form  method="post">
<div class="container">
        <div class="row">

<div class="col-xl-9 col-lg-6">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-dark">Batch Information</h6>
    
    <div class="card-body">
    <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i> </a>
    <?php include 'functions/allmodal.php'?>
    </div>
    <div class="float-right">
    <ul class="nav nav-pills">
    <li class="active">
			<a  href="addmanage.php"  class="btn btn-outline-primary" data-toggle="tooltip" title="Proceed to Month Area" title="Month"
  ></i><i class="fa fa-calendar"></i> MONTH </a>
				</li>
                &nbsp;
				<li class="active">
			<a  href="addmanageyear.php"  class="btn btn-outline-info" data-toggle="tooltip" title="Proceed to Year Area!" ><i class="fa fa-calendar-check" ></i><i></i> YEAR</a>
				</li>
                &nbsp;
				<li class="">
         	<a  href="addmanagebatch.php"  class="btn btn-outline-dark" data-toggle="tooltip" title="Proceed to Batch Area!"><i class="fa fa-tasks"></i><i ></i> BATCH</a>
				</li> 
				</li>

        &nbsp;
				<li class="">
         	<a  href="addmanageweek.php" class="btn btn-outline-success" data-toggle="tooltip" title="Proceed to Week Area!" ><i class="fa fa-calendar-alt"></i><i ></i> WEEK</a>
				</li> 
				</li>
        &nbsp;
        <li class="">
         	<a  href="locality.php" class="btn btn-outline-warning" data-toggle="tooltip" title="Proceed to Locality Area!"><i class="fa fa-map-marker"></i><i ></i> LOCALITY</a>
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
                  
                      <th>BATCH</th>
         

              
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                      <th></th>
                      <th></th>
           
                      <th>Batch</th>
              
                  
        
                    </tr>
                  </tfoot>

                  <tbody>
                      <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
                  <?php
													$user_query = mysql_query("SELECT * from batch ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
                            $id=$row['ID'];
                     
													?>
                        <!--END OF CODE ---->
           
                    <tr>


      
                    <td width="40px">		<input id="optionsCheckbox"  class="switch" name="selector[]" type="checkbox" value="<?php echo $id; ?>" data-toggle="tooltip" title="Check List!" ></td>
                    <td width="40">
                    <a  href="addeditbatch.php?id=<?php echo $id; ?>"   class="btn btn-success"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
												</td>
                      <td><?php echo $row['BATCH'];?></td>
            
            
     
                      </tr>
                    <?php } ?>
                  
                  </tbody>
                  
                </table>
                </form>
                
              </div>
            </div>
            </div>

            </div>
</form>


<?php include 'functions/delete_batch.php' ?>
            

