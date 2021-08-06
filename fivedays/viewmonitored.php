
        <form  method="post">
<div class="container">
        <div class="row">
        <div class="float-left">

            <ul class="breadcrumb">
        <a  href="contactrec.php" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Positive Contact's" ><i class="fa fa-arrow-left" ></i>Back</a>

        <a  href="contactadd.php?id=<?php echo $get_id;?>&week=<?php echo $weeks;?>" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Positive Contact's" ><i class="fa fa-users" ></i>Contact Profile </a>
        <a  href="monitoringcont.php?id=<?php echo $get_id;?>&week=<?php echo $weeks;?>" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Baptized Contact's" ><i class="fa fa-desktop" ></i>Monitored Contact</a>

<!--     <a  href="baptismrecord.php?id=<?php echo $get_id;?>&week=<?php echo $weeks;?>" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Baptized Contact's" ><i class="fa fa-users" ></i>Baptized Ones </a> -->

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

                           // $loc = $row['LOCALITY'];
                           // $user = $row['USER_LEVEL'];
													?>
</div>


<div class="col-xl-12 col-lg-7">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-info">MONITORED CONTACT DURING <?php echo $rows['MONTH'];?> <?php echo $rows['YR'];?> <?php echo $rows['BATCH'];?> <?php echo $rows['week'];?> <?php echo $rows['LEVEL'];?></h6>
    
    <div class="card-body">
    
    <a href="#"  onclick="window.open(
    'pdfweekform.php?id=<?php echo $session_id?>&month=<?php echo $rows['MONTH'];?>&year=<?php echo $rows['YR'];?>&batch=<?php echo $rows['BATCH'];?>&level=<?php echo $rows['LEVEL'];?>', 'newwindow', 'width=900, height=600'); return false;" class="btn btn-light  btn-smll"><i class="fas fa-download fa-sm text-dark-50"></i> PDF</a>   

    <a  href="#addme" class="btn btn-primary  btn-smll"  data-toggle="modal" data-target="#addme"><i class="fa fa-plus-square" data-toggle="tooltip" title="Add"></i> </a>

    <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i> </a>
    
   <?php include  'functions/modaldeletecontact.php'?>
     <?php include 'functions/modalmonitored.php' ?>
 
    
    </div>
   

  <div class="card-body">
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">	



                  <thead>
                    <tr>
                         <th>Full Name :</th>
                         <th></th>
                         <th></th>
                    <th>Address :</th>
                         <th>Contact #:</th>
                    <th>Week 6 :</th>
                       <th>Week 7 :</th>
                        <th>Week 8 :</th>
                         <th>Week 9 :</th>
                         <th>Week 10 :</th>
                            <th>Week 11 :</th>
                            <th>Week 12 :</th>
                           <th>Week 13 :</th>
                              <th>Week 14 :</th>
                                    <th>Week 15 :</th>
                                    <th>Week 16 :</th>
                                        <th>Week 17 :</th>



                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                              <th>Full Name :</th>
                         <th></th>
                         <th></th>
                    <th>Address :</th>
                           <th>Contact #:</th>
                       <th>Week 6 :</th>
                       <th>Week 7 :</th>
                        <th>Week 8 :</th>
                         <th>Week 9 :</th>
                         <th>Week 10 :</th>
                            <th>Week 11 :</th>
                            <th>Week 12 :</th>
                           <th>Week 13 :</th>
                              <th>Week 14 :</th>
                                    <th>Week 15 :</th>
                                    <th>Week 16 :</th>
                                        <th>Week 17 :</th>
                    <!-- <th></th> -->
            
        
                    </tr>
                  </tfoot>

                  <tbody>
                      <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
                  <?php
													$user_query = mysql_query("SELECT * from weekendrpt LEFT join contatcdetails on contatcdetails.contact_id=weekendrpt.contact_id LEFT join historyfeedback on historyfeedback.id=weekendrpt.historyfeedback_id LEFT join month on month.id=historyfeedback.MONTH LEFT join year on year.id=historyfeedback.YEAR LEFT join batch on batch.id=historyfeedback.BATCH LEFT join week on week.id=historyfeedback.WEEK LEFT join userlevel on userlevel.id=historyfeedback.acc_id
          
                 
                           where weekendrpt.acc_id='$session_id'  or contatcdetails.contact_id='$get_id'

                          ORDER BY weekendrpt_id ASC")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){

                           $wwk = $row['weekendrpt_id'];
                          // $loc = $row['LOCALITY'];
                          // $user = $row['USER_LEVEL'];
													?>
                        <!--END OF CODE ---->
           
                    <tr>
                    <td width="10" > <a    class="btn btn-primary btn-circle btn-sm viewdable"><i class="fa fa-plus text-white"></i></a> <?php echo $row['FullName'];?>
                       
												</td>    

                    <td width="40px">		<input id="optionsCheckbox" type="checkbox" class="switch" name="selector[]" type="checkbox" value="<?php echo  $wwk; ?>" data-toggle="tooltip" title="Check List"></td>

                    <td width="40"> 
												<a  href="monitoredupd.php?id=<?php echo  $wwk;?>&monitored=<?php echo $get_id; ?>&week=<?php echo $weeks; ?>"   class="btn btn-info"><i class="fa fa-place-of-worship" data-toggle="tooltip" title="Edit"></i></a>
												</td>
                        <!-- <td width="40">
												<a href="addteamup.php?id=<?php echo $id; ?>"   class="btn btn-primary btn-circle "><i class="fa fa-arrow-right" data-toggle="tooltip" title="Edit"></i></a>
												</td> -->
                          
                      <td width="40px"><?php echo $row['address'];?></td>
                      <td width="40px"><?php echo $row['ContactNumber'];?></td>
                      <td width="40px"><?php echo $row['week_six'];?></td>
                      <td width="40px"><?php echo $row['week_seven'];?></td>
                      <td width="40px"><?php echo $row['week_eight'];?></td>
                      <td width="40px"><?php echo $row['week_nine'];?></td>
                      <td width="40px"><?php echo $row['week_ten'];?></td>
                      <td width="40px"><?php echo $row['week_eleven'];?></td>
                      <td width="40px"><?php echo $row['week_twelve'];?></td>
                      <td width="40px"><?php echo $row['week_thirteen'];?></td>
                      <td width="40px"><?php echo $row['week_fourteen'];?></td>
                      <td width="40px"><?php echo $row['week_fifthteen'];?></td>
                      <td width="40px"><?php echo $row['week_sixteen'];?></td>

                      <td width="40px"><?php echo $row['week_seventeen'];?></td>
                  
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
                          <?php }?>