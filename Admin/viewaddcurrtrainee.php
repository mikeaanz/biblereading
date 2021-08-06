    
        <form  method="post">
<div class="container">
        <div class="row">

<!-- Activation Accounts -->


<div class="col-xl-9 col-lg-6">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-primary">Batch Data Reassign</h6>
    
    <div class="card-body">
    <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i> </a>
    <?php include 'functions/moddeletelocalityteam.php'?>
    </div>
    <div class="float-right">
    <!-- <ul class="nav nav-pills">

          <li class="active">
			<a  href="accountactivation.php" class="btn btn-primary  btn-circle" ><i class="fa fa-info"></i><i class="fa fa-users" data-toggle="tooltip" title="All Information"></i> </a>
				</li>
                &nbsp;
				<li class="active">
			<a  href="activate.php" class="btn btn-success  btn-circle" ><i class="fa fa-check"></i><i class="fa fa-user" data-toggle="tooltip" title="All Activated"></i> </a>
				</li>
                &nbsp;
				<li class="">
       	<a  href="deactivate.php" class="btn btn-danger btn-circle"><i class="fa fa-times"></i><i class="fa fa-user" data-toggle="tooltip" title="All Deactivated"></i> </a>
				</li>
				</li>
	
				</ul> -->
	</div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">




                  <thead>
                    <tr>
                    <th></th>
                    <th></th>
                    <th>Go to Locality</th>
       <!--               <th>Month</th>
                      <th>Year</th> -->
                      <th>batch</th>
                      <th>Level</th>
           <!--             <th>Status</th> -->
              
              
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                      <th></th>
                      <th></th>
                      <th>Go to Locality</th>
       <!--                <th>Month</th>
                      <th>Year</th> -->
                      <th>batch</th>
                      <th>Level</th>
             <!--            <th>Status</th> -->
              
        
                    </tr>
                  </tfoot>

                  <tbody>
                      <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
                  <?php
													$user_query = mysql_query("SELECT * from current_teamdata LEFT join month on current_teamdata.Month_id = month.ID LEFT join year on current_teamdata.Year_id = year.ID LEFT join batch on current_teamdata.batch_id = batch.ID LEFT join userlevel on current_teamdata.userlevel_id = userlevel.ID LEFT join status on status.ID = current_teamdata.control_data ORDER BY c_team_id  DESC")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){

                           $id = $row['c_team_id'];
                               $month  =  $row['MONTH'];
                                $yr  =  $row['YR'];
                          // $loc = $row['LOCALITY'];
                          // $user = $row['USER_LEVEL'];
													?>
                        <!--END OF CODE ---->
           
                    <tr>


      
                    <td width="40px">		<input id="optionsCheckbox" class="switch cbox" name="selector[]" type="checkbox" value="<?php echo $id; ?>" data-toggle="tooltip" title="Note!. Allow Only one check"></td>
                    <td width="40"> 
												<a  href="editteammanage.php?id=<?php echo $id;?>&month=<?php echo $month;?>&year=<?php echo    $yr;?>&batch_id=<?php echo $row['batch_id'];?>&userlevel=<?php echo $row['userlevel_id'];?>"   class="btn btn-success"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
												</td>
                        <td width="40">
												<a href="addteamup.php?id=<?php echo $id; ?>&userlevel=<?php echo $row['userlevel_id'];?>"   class="btn btn-primary btn-circle "><i class="fa fa-arrow-right" data-toggle="tooltip" title="Edit"></i></a>
												</td>
               <!--        <td><?php echo $row['MONTH'];?></td>
                      <td><?php echo $row['YR'];?></td> -->
                      <td><?php echo $row['BATCH'];?></td>
                      <td class="text-primary" style="font-style:italic;"><?php echo $row['LEVEL'];?></td>
           <!--            <td class="<?php echo $row['ACTION'];?>" style="font-style:italic;"><?php echo $row['ACTION'];?></td> -->
    
                    </tr>
                    <?php } ?>
                  
                  </tbody>
                  
                </table>
                </form>
                <?php // include 'delete_account.php'?>
              </div>
            </div>
            </div>

            </div>
<!--             <?php

include('functions/db.php');
if (isset($_POST['delete_user'])){
  if(empty($_POST['selector'])){
    echo '<script> swal({title: "Oh Lord Jesus!",text: "Please Check the checkbox before to proceed!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("traineepro.php","_self")});</script>';
    exit();
}else
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROM current_teamdata where c_team_id='$id[$i]'");
}
echo '<script> swal({title: "Oh Lord Jesus!",text: "This Data already Deleted!", customClass: "swal-wide",
	confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineepro.php","_self")});</script>';
  exit();
}
?> -->