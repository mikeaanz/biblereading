
        <form  method="post">
<div class="container">
        <div class="row">
        <div class="float-left">
              <ul class="breadcrumb">
        <a  href="contactrec.php" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Positive Contact's" ><i class="fa fa-arrow-left" ></i>Back</a>

     <a  href="contactadd.php?id=<?php echo $get_id;?>&week=<?php echo $weeks;?>" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Positive Contact's" ><i class="fa fa-users" ></i>Contact Profile </a>
      <a  href="monitoringcont.php?id=<?php echo $get_id;?>&week=<?php echo $weeks;?>" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Baptized Contact's" ><i class="fa fa-desktop" ></i>Monitored Contact</a>

 <!--    <a  href="baptismrecord.php?id=<?php echo $get_id;?>&week=<?php echo $weeks;?>" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Baptized Contact's" ><i class="fa fa-users" ></i>Baptized Ones </a> -->

    </ul>
<!-- Activation Accounts -->

<?php
													$user_query = mysql_query("SELECT * from historyfeedback
                                                  LEFT JOIN month on historyfeedback.MONTH=month.ID
                                               LEFT JOIN year on historyfeedback.YEAR=year.ID
                                                  LEFT JOIN batch on historyfeedback.BATCH=batch.ID
                                                  LEFT JOIN week on historyfeedback.WEEK=week.ID
                                                   LEFT JOIN userlevel on historyfeedback.acc_id=userlevel.ID
                         WHERE historyfeedback.id='$get_id'
                        
                            ORDER BY historyfeedback.id asc")or die(mysql_error());
													while($rows = mysql_fetch_array($user_query)){

                          //  $id = $row['contact_id'];
                          // $loc = $row['LOCALITY'];
                          // $user = $row['USER_LEVEL'];
													?>
</div>


<div class="col-xl-12 col-lg-7">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-info">CONTACT'S PROFILE DURING <?php echo $rows['MONTH'];?> <?php echo $rows['YR'];?> <?php echo $rows['BATCH'];?> <?php echo $rows['LEVEL'];?></h6>
    
    <div class="card-body">
    
<!--     <a href="#"  onclick="window.open('pdfweekform.php', 'newwindow', 'width=900, height=600'); return false;" class="d-show d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>    -->
    <a  href="#addme" class="btn btn-primary  btn-smll"  data-toggle="modal" data-target="#addme"><i class="fa fa-plus" data-toggle="tooltip" title="Delete"></i> </a>
    <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i> </a>

    <?php include 'functions/contactdeletemodal.php'?>
    
    </div>
   

  <div class="card-body">
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">	



                  <thead>
                    <tr>
                    <th>Full Name :</th>
                    <th></th>
                    <th></th>
                    <!-- <th></th> -->
                    <th>Status Gender :</th>
                     <th>Contact Number :</th>
                      <th>Address :</th>
                      <th>Status :</th>
           <!--            <th>Shepherding Materials :</th> -->
                      <th>Propagation Period :</th>
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                    <th>Full Name :</th>
                    <th></th>
                    <th></th>
                    <!-- <th></th> -->
                    <th>Status Gender :</th>
                     <th>Contact Number :</th>
                      <th>Address :</th>
                      <th>Status :</th>
    <!--                   <th>Shepherding Materials :</th> -->
                      <th>Propagation Period :</th>
        
                    </tr>
                  </tfoot>

                  <tbody>
                      <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
                  <?php
                      $get_id=$_GET['id'];
													$user_query = mysql_query("SELECT * from contatcdetails
                           RIGHT JOIN contactstatus ON contatcdetails.contactstatus_id=contactstatus.ID
                           RIGHT join stat_saints on contatcdetails.gender=stat_saints.stat_id
                           RIGHT join historyfeedback on historyfeedback.id=contatcdetails.curteam_id 
                           RIGHT join month on month.id=historyfeedback.MONTH 
                           RIGHT join year on year.id=historyfeedback.YEAR 
                           RIGHT join batch on batch.id=historyfeedback.BATCH 
                           RIGHT join week on week.id=historyfeedback.WEEK 
                           RIGHT join userlevel on userlevel.id=historyfeedback.acc_id
                           RIGHT join accounts on contatcdetails.acc_id=accounts.id
                           RIGHT join locality on locality.ID=accounts.LOCALITY
                      
                 
                           where contatcdetails.acc_id='$session_id'  or contatcdetails.curteam_id='$get_id'

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

                    <td width="40px">		<input id="optionsCheckbox" type="checkbox" class="switch" name="selector[]" type="checkbox" value="<?php echo  $contacid; ?>" data-toggle="tooltip" title="Check List"></td>
                    <td width="40"> 
												<a  href="updateposcon.php?id=<?php echo $get_id;?>&contacid=<?php echo  $contacid;?>&statid=<?php echo $row['gender'];?>&week=<?php echo   $weeks; ?>"   class="btn btn-success"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
												</td>
                        <!-- <td width="40">
												<a href="addteamup.php?id=<?php echo $id; ?>"   class="btn btn-primary btn-circle "><i class="fa fa-arrow-right" data-toggle="tooltip" title="Edit"></i></a>
												</td> -->
                        <td width="40px"><?php echo $row['Gender'];?></td>
                      <td width="40px"><?php echo $row['ContactNumber'];?></td>
                      <td width="40px"><?php echo $row['address'];?></td>
                      <td width="40px"><?php echo $row['saints_legend'];?></td>
        <!--               <td width="40px"><?php echo $row['shepmaterial'];?></td> -->
                      <td width="40px"><?php echo $row['MONTH'];?> <?php echo $row['YR'];?> <?php echo $row['BATCH'];?> <?php echo $row['LEVEL'];?> <?php echo $row['PLACES'];?></td>
                    </tr>
                    <?php } ?>
                  
                  </tbody>
                  
                </table>
                </form>
                <?php // include 'delete_account.php'?>
                <?php include 'functions/modaladdcont.php' ?>
              </div>
            </div>
            </div>

            </div>
                          <?php }?>