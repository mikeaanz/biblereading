    
        <form action="delete_account.php" method="post">
<div class="container">
        <div class="row">

<!-- Activation Accounts -->


<div class="col-xl-9 col-lg-6">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-success">All Informations Active Trainee Profile</h6>
    
    <div class="card-body">
<!--     <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i> </a> -->
    <?php include 'functions/allmodal.php'?>
    </div>
    <div class="float-right">
    <ul class="nav nav-pills">
   
    <li class="active">
			<a  href="traineeprofile.php" class="btn btn-primary  btn-circle" ><i class="fa fa-info"></i><i class="fa fa-users" data-toggle="tooltip" title="All Information"></i> </a>
				</li>
                &nbsp;
				<li class="active">
			<a  href="traineeactive.php" class="btn btn-success  btn-circle" ><i class="fa fa-check"></i><i class="fa fa-user" data-toggle="tooltip" title="All Activated"></i> </a>
				</li>
                &nbsp;
				<li class="">
       	<a  href="traineinactive.php" class="btn btn-danger btn-circle"><i class="fa fa-times"></i><i class="fa fa-user" data-toggle="tooltip" title="All Deactivated"></i> </a>
				</li>
				</li>
	
				</ul>
	</div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">	



<thead>
  <tr>
  <th></th>
<!--   <th></th> -->
  <th></th>
  <th>Profile Picture :</th>
      <th>Full Name :</th>
    <th>Register Number :</th>
    <th>Full Timer :</th>
    <th>Batch :</th>
    <th>Gender :</th>
    <th>Locality :</th>
    <th>Status :</th>
    <th>Province :</th>
    <th>Region :</th>
    <th>Country :</th>
    <th>Birthdate :</th>
    <th>School :</th>
    <th>Degree :</th>
    <th>ContactNumber :</th>
    <th>Email :</th>
    <th>Contact Person :</th>
    <th>Relationship :</th>
    <th>Relationship Contact Number :</th>
    

  </tr>
</thead>

<tfoot>
  <tr>
  <th></th>
<!--     <th></th> -->
    <th></th>
    <th>Profile Picture :</th>
    <th>Full Name :</th>
    <th>Register Number :</th>
    <th>Full Timer :</th>
    <th>Batch :</th>
    <th>Gender :</th>
    <th>Locality :</th>
    <th>Status :</th>
    <th>Province :</th>
    <th>Region :</th>
    <th>Country :</th>
    <th>Birthdate :</th>
    <th>School :</th>
    <th>Degree :</th>
    <th>ContactNumber :</th>
    <th>Email :</th>
    <th>Contact Person :</th>
    <th>Relationship :</th>
    <th>Relationship Contact Number :</th>

  </tr>
</tfoot>

                  <tbody>
                      <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
                  <?php
													$user_query = mysql_query("SELECT * from trainee_info
                          LEFT join status on trainee_info.Status=status.ID    
                          LEFT join batch on trainee_info.Batch=batch.ID    
                          LEFT Join class on trainee_info.Term=class.ID
                          LEFT Join stat_saints on trainee_info.Gender=stat_saints.stat_id
                  
                                                    where status.id='1'
                                                     ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
                            $id = $row['trainee_id'];
                            $ft = $row['Term'];
                            $gender = $row['Gender'];
                            $batch=$row['Batch'];
                            $stat=$row['Status'];
													?>
                        <!--END OF CODE ---->
           
                
                        <td width="40">
                        <a    class="btn btn-primary btn-circle viewdable"><i class="fa fa-eye text-white"></i></a>
												</td>                               
                   <!--  <td width="40px">		<input id="optionsCheckbox" class="switch" name="selector[]" type="checkbox" value="<?php echo $id; ?>" data-toggle="tooltip" title="Check List"></td> -->
                    <td width="40">
												<a  href="edittraineeinfo.php?id=<?php echo $id; ?>&ft=<?php echo $ft;?>&gender=<?php echo $gender ?>&batch=<?php echo $batch ?>&stat=<?php echo $stat ?>"   class="btn btn-success"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
												</td>
                        <td>    <img class="rounded-circle"  src="../Admin/img/<?php echo $row['profile_img'];?>" width="120" height="120" alt=""></td>
                        <td style="font-style:italic; color: #0dc764 ;"><?php echo $row['First_Name'];?> <?php echo $row['Middle_Name'];?> <?php echo $row['Last_Name'];?></td>
                      <td><?php echo $row['Reg_No'];?></td>
                      <td style="font-style:italic; color: blue;"><?php echo $row['FT'];?></td>
                      <td style="font-style:italic; color: dark;"><?php echo $row['BATCH'];?></td>
                      <td><?php echo $row['Gender'];?></td>
                      <td><?php echo $row['Sending_Locality'];?></td>
                      <td class="<?php echo $row['ACTION'];?>" style="font-style:bold;"><?php echo $row['ACTION'];?></td>
                      <td><?php echo $row['Country'];?></td>
                      <td><?php echo $row['Province'];?></td>
                      <td><?php echo $row['Region'];?></td>
                      <td><?php echo $row['Birthdate'];?></td>
                      <td><?php echo $row['School'];?></td>
                      <td><?php echo $row['Degree'];?></td>
                      <td><?php echo $row['Contact_number'];?></td>
                      <td><?php echo $row['Email'];?></td>
                      <td><?php echo $row['Emergency_Contact_Person'];?></td>
                      <td><?php echo $row['Relationship'];?></td>
                      <td><?php echo $row['Contact_No'];?></td>
    
                    </tr>
                    <?php } ?>
                  
                  </tbody>
                  
                </table>
                </form>
                <?php include 'delete_trainee.php'?>
              </div>
            </div>
            </div>

            </div>