
        <form  method="post">


        <div class="container">
        <ul class="breadcrumb">
						<?php
						$term = $_POST['batch'];
                
                   
                        
						$termquery = mysql_query("SELECT * FROM batch,year,month
                        where batch.BATCH='$term' 
                      
                        ")or die(mysql_error());
						$propagation = mysql_fetch_array($termquery);

						?>
							<li><a href="#"><b>My Positive Contacts During :</b></a><span class="divider">/</span></li>
							<li><a href="#"><?php echo $propagation['BATCH']; ?> 
                            term 
                           </a></li>
						</ul>
                        </div>


<div class="container">
        <div class="row">
        <div class="float-left">
        <!-- <a  href="mycontact.php" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Positive Contact's" ><i class="fa fa-arrow-left" ></i>Back</a>
     <a  href="addcontact.php?id=<?php echo $get_id;?>" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Positive Contact's" ><i class="fa fa-users" ></i>Positive Contact's </a>
    <a  href="addbaptism.php?id=<?php echo $get_id;?>" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Baptized Contact's" ><i class="fa fa-users" ></i>Baptized Ones </a> -->
<!-- Activation Accounts -->

<?php
						// 							$user_query = mysql_query("SELECT * from current_teamdata
                        //   inner join month on month.id=current_teamdata.Month_id
                        //   inner join year on year.id=current_teamdata.Year_id
                        //   inner join batch on batch.id=current_teamdata.Batch_id
                        //   inner join userlevel on userlevel.id=current_teamdata.userlevel_id
                        //  WHERE current_teamdata.c_team_id='$get_id'
                        
                        //     ORDER BY current_teamdata.c_team_id asc")or die(mysql_error());
						// 							while($rows = mysql_fetch_array($user_query)){

                          //  $id = $row['contact_id'];
                          // $loc = $row['LOCALITY'];
                          // $user = $row['USER_LEVEL'];
													?>
</div>


<div class="col-xl-12 col-lg-7">
  <div class="card shadow mb-1">
    <!-- <h6 class="m-3 font-weight-bold text-success">POSITIVE CONTACT DURING <?php echo $rows['MONTH'];?> <?php echo $rows['YR'];?> <?php echo $rows['BATCH'];?> <?php echo $rows['LEVEL'];?></h6> -->
    
    <div class="card-body">
    <h3 class="m-3 font-weight-bold text-success">My Profiles Contacts</h3>
    <!-- <a  href="#addme" class="btn btn-primary  btn-smll"  data-toggle="modal" data-target="#addme"><i class="fa fa-plus" data-toggle="tooltip" title="Delete"></i> </a>
    <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i> </a> -->

    <?php include 'functions/deletemodal.php'?>
    <?php include 'functions/modaladdcont.php' ?>
    </div>
   

  <div class="card-body">
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">	



                  <thead>
                    <tr>
                    <th>Full Name :</th>
                    <!-- <th></th>
                    <th></th> -->
                    <!-- <th></th> -->
                    <th>Status Gender :</th>
                     <th>Contact Number :</th>
                      <th>Address :</th>
                      <th>Status :</th>
                      <th>Shepherding Materials :</th>
                      <th>Propagation Period :</th>
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                    <th>Full Name :</th>
                    <!-- <th></th>
                    <th></th> -->
                    <!-- <th></th> -->
                    <th>Status Gender :</th>
                     <th>Contact Number :</th>
                      <th>Address :</th>
                      <th>Status :</th>
                      <th>Shepherding Materials :</th>
                      <th>Propagation Period :</th>
        
                    </tr>
                  </tfoot>

                  <tbody>
                      <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
                  <?php
													$user_query = mysql_query("SELECT * from contatcdetails
                          RIGHT JOIN contactstatus ON contatcdetails.contactstatus_id=contactstatus.ID
                          RIGHT join stat_saints on contatcdetails.gender=stat_saints.stat_id
                          RIGHT join historyfeedback on historyfeedback.id=contatcdetails.curteam_id 
                          RIGHT join month on month.id=historyfeedback.Month
                          RIGHT join year on year.id=historyfeedback.Year 
                          RIGHT join batch on batch.id=historyfeedback.Batch
                          RIGHT join userlevel on userlevel.id=historyfeedback.acc_id
                          RIGHT join accounts on contatcdetails.acc_id=accounts.id
                          RIGHT join locality on locality.ID=accounts.LOCALITY
                           where contatcdetails.acc_id='$session_id' and batch.BATCH='$term' 

                          ORDER BY contact_id ASC")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){

                           $contacid = $row['contact_id'];
                          // $loc = $row['LOCALITY'];
                          // $user = $row['USER_LEVEL'];
													?>
                        <!--END OF CODE ---->
           
                    <tr>
                    <td width="10" > <a    class="btn btn-primary btn-circle btn-sm viewdable"><i class="fa fa-plus text-white"></i></a> <?php echo $row['FullName'];?>
                       
												</td>    

                    <!-- <td width="40px">		<input id="optionsCheckbox" class="switch" name="selector[]" type="checkbox" value="<?php echo  $contacid; ?>" data-toggle="tooltip" title="Check List"></td>
                    <td width="40"> 
												<a  href="updateposcon.php?id=<?php echo $get_id;?>&contacid=<?php echo  $contacid;?>"   class="btn btn-success"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
												</td> -->
                        <!-- <td width="40">
												<a href="addteamup.php?id=<?php echo $id; ?>"   class="btn btn-primary btn-circle "><i class="fa fa-arrow-right" data-toggle="tooltip" title="Edit"></i></a>
												</td> -->
                        <td width="40px"><?php echo $row['Gender'];?></td>
                      <td width="40px"><?php echo $row['ContactNumber'];?></td>
                      <td width="40px"><?php echo $row['address'];?></td>
                      <td width="40px"><?php echo $row['saints_legend'];?></td>
                      <td width="40px"><?php echo $row['shepmaterial'];?></td>
                      <td width="40px"><?php echo $row['MONTH'];?> <?php echo $row['YR'];?> <?php echo $row['BATCH'];?> <?php echo $row['LEVEL'];?> <?php echo $row['PLACES'];?></td>
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
                          <?php ?>