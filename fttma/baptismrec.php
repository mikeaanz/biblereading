
        <form  method="post">

<div class="container">
        <div class="row">
        <div class="float-left">
              <ul class="breadcrumb">
          <a  href="myentry.php?locate_idpost=<?php echo $get_id; ?>&BATCH=<?php echo $getbatch;?>" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Positive Contact's" ><i class="fa fa-arrow-left" ></i>Back</a>

     <!--  <a  href="contactadd.php?id=<?php echo $get_id;?>&week=<?php echo $weeks;?>" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Positive Contact's" ><i class="fa fa-users" ></i>Contact Profile </a>
  
    <a  href="monitoringcont.php?id=<?php echo $get_id;?>&week=<?php echo $weeks;?>" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Baptized Contact's" ><i class="fa fa-desktop" ></i>Monitored Contact</a>
    <a  href="baptismrecord.php?id=<?php echo $get_id;?>&week=<?php echo $weeks;?>" class="btn btn-link  btn-smll" data-toggle="tooltip" title="List All Baptized Contact's" ><i class="fa fa-users" ></i>Baptized Ones </a> -->

<!-- Activation Accounts -->
</ul>
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

                          //  $ids = $row['c_team_id'];
                          // $loc = $row['LOCALITY'];
                          // $user = $row['USER_LEVEL'];
													?>
</div>


<div class="col-xl-12 col-lg-7">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-info">LIST OF BAPTIZED ONES <?php echo $rows['MONTH'];?> <?php echo $rows['YR'];?> <?php echo $rows['BATCH'];?> <?php echo $rows['LEVEL'];?></h6>
    
    <div class="card-body">
    
    <a  href="#addme" class="btn btn-primary  btn-smll"  data-toggle="modal" data-target="#addme"><i class="fa fa-plus" data-toggle="tooltip" title="Delete"></i> </a>
<!--     <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i> </a>
 -->
    <?php include 'functions/modaldelbaptize.php'?>
    <?php include 'functions/modalplusbaptize.php' ?>
    </div>
   

  <div class="card-body">
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">	



                  <thead>
                    <tr>
                            <th>Edit</th>
                                       <th>View</th>
                                          <th>Delete</th>
                    <th>Full Name :</th>
         <!--            <th></th>
                    <th></th> -->
                         
                    <!-- <th></th> -->
                      <th>Saints Gender :</th>
                     <th>Contact Number :</th>
                      <th>Address :</th>
                      <th>Baptism :</th>
                      <th>Status :</th>
                      <th>Shepherding Materials :</th>
                      <th>Propagation Period :</th>
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                              <th>Edit</th>
                                       <th>View</th>
                                          <th>Delete</th>
                    <th>Full Name :</th>
          <!--           <th></th>
                    <th></th> -->
                    
                    <!-- <th></th> -->
                    <th>Saints Gender :</th>
                     <th>Contact Number :</th>
                      <th>Address :</th>
                      <th>Baptism :</th>
                      <th>Status :</th>
                      <th>Shepherding Materials :</th>
                      <th>Propagation Period :</th>
        
                    </tr>
                  </tfoot>

                  <tbody>
                      <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
                  <?php
													$user_query = mysql_query("SELECT * from baptism_rpt
                                   RIGHT join stat_saints on baptism_rpt.gender=stat_saints.stat_id
                           RIGHT JOIN contactstatus ON baptism_rpt.contactstatus_id=contactstatus.ID
                           RIGHT join historyfeedback on historyfeedback.id=baptism_rpt.curteam_id 
                           RIGHT join month on month.id=historyfeedback.Month
                           RIGHT join year on year.id=historyfeedback.Year 
                           RIGHT join batch on batch.id=historyfeedback.Batch
                           RIGHT join userlevel on userlevel.id=historyfeedback.acc_id
                           RIGHT join accounts on baptism_rpt.acc_id=accounts.id
                           RIGHT join locality on locality.ID=accounts.LOCALITY
      
                           where baptism_rpt.acc_id='$session_id' and baptism_rpt.curteam_id='$get_id'

                          ORDER BY baptism_id ASC")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){

                            
echo
                           // $contacid = $row['baptism_id'];
                          // $loc = $row['LOCALITY'];
                          // $user = $row['USER_LEVEL'];
            // <td>
            //           <a   class='btn btn-danger btn-circle btn-sm viewdable' data-toggle='modal' data-target='#delete'></a> </td>

//href='#edit_".$row['baptism_id']."'

                            "

                               <td width='10' ><a  href='#edit_".$row['baptism_id']."'  class='btn btn-success btn-circle btn-sm viewdable' data-toggle='modal' ><i class='fa fa-edit text-white'></i></a> </td>
          
                  
                    <td width='10' ><a  href='#show_".$row['baptism_id']."'  class='btn btn-primary btn-circle btn-sm viewdable' data-toggle='modal' ><i class='fa fa-eye text-white'></i></a> </td>
          
                            <td width='10' ><a  href='#delete_".$row['baptism_id']."'  class='btn btn-danger btn-circle btn-sm viewdable' data-toggle='modal' ><i class='fa fa-trash text-white'></i></a> </td>

                         <td width='10' >".$row['FullName']."</ td>


                                <td width='10' >".$row['Gender']."</td>
                                <td width='10' >".$row['ContactNumber']."</td>
                                <td width='10' >".$row['address']."</td>
                                <td width='10' >".$row['date_baptize']."</td>
                                <td width='10' >".$row['saints_legend']."</td>
                                <td width='10' >".$row['shepmaterial']."</td>
                                <td width='10' >".$row['MONTH']." ".$row['YR']." ".$row['BATCH']."</td>
                <tr>";
        
                //   <td>
                //    <a  href="#edit_"$row['ids']"  class="btn btn-danger btn-circle btn-sm viewdable" data-toggle="modal" data-target="#delete"></a>
                //     <a href='#delete_".$row['id']."' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
                //   </td>
                // </tr>";

                include 'functions/modaldelbaptize.php';
                include 'functions/viewbaprec.php';
                include 'functions/modaleditbaptism.php';
      
              }

					
        
         
                 
                   ?>
                  
                  </tbody>
                  
                </table>
                </form>
                <?php // include 'delete_account.php'?>
              </div>
            </div>
            </div>

            </div>
                          <?php }?>