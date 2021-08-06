<?PHP     $locality=$_GET['locality_id'];
          $userlevel=$_GET['userlevel'];
            $currentteamid=$_GET['currentteamid']; ?>
        <form  method="post">
<div class="container">
        <div class="row">

<!-- Activation Accounts -->
<?php
$user_query = mysql_query("SELECT * from teammate
                            INNER JOIN trainee_info on teammate.trainee_id=trainee_info.trainee_id
                            INNER JOIN current_teamdata on teammate.currentteam_id	= current_teamdata.c_team_id
                            INNER JOIN month on current_teamdata.Month_id=month.ID
                             INNER JOIN year on current_teamdata.Year_id=year.ID
                            INNER JOIN batch on current_teamdata.batch_id=batch.ID 
      
                            INNER JOIN userlevel on current_teamdata.userlevel_id=userlevel.ID 
                            INNER JOIN locality on teammate.locality_id=locality.ID 
                            where locality.ID='$locality'  and userlevel.ID ='$userlevel'
                            order by teammate.teammate_id
                                                    

                                                    ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){

                                                        ?>


<div class="col-xl-9 col-lg-6">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-primary">Welcome to Locality of <?php echo $row['PLACES']?> <?php echo $row['LEVEL']?>  TEAM-UP </h6>
    
    <div class="card-body">
    <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i> </a>
    <?php include 'functions/allmodal.php'?>

    </div>
    <div class="float-right">
    <ul class="nav nav-pills">
<!-- 
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
                    <th>Profile Image</th>
                      <th>Full-Timers Name</th>
                      <th>Propagation Batch</th>
                      <th>Schedule of Propagation</th>
              
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                      <th></th>
                          <th></th>

                      <th>Profile Image</th>
                      <th>Full-Timers Name</th>
                      <th>Propagation Batch</th>
                      <th>Schedule of Propagation</th>
        
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

                                         where locality.ID='$locality' and userlevel.ID ='$userlevel'
                                                    ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
                                                    $teammate_id=$row['teammate_id'];
                                                    $locality=$_GET['locality_id'];
                                                    $userlevel=$_GET['userlevel'];
                                                               $traineeid=$row['trainee_id'];
													?>
                                                    
                        <!--END OF CODE ---->
           
                    <tr>


      
                    <td width="40px">		<input id="optionsCheckbox" class="switch" name="selector[]" type="checkbox" value="<?php echo $teammate_id; ?>" data-toggle="tooltip" title="Check List"></td>

                    <td width="40">
                    <a   href="transferteam.php?id_trainee=<?php echo $traineeid; ?>&currentteamid=<?php echo $currentteamid; ?>&locality_id=<?php echo  $locality;?>&userlevel=<?php echo      $userlevel;?>&teammateid=<?php echo $teammate_id;?> "   class="btn btn-primary"><i class="fa fa-exchange-alt text-white" data-toggle="tooltip" title="switch"></i></a>
                        </td>
                    <td>    <img class="rounded-circle"  src="../Admin/img/<?php echo $row['profile_img'];?>" width="120" height="120" alt=""></td>
                      <td class="m-3 font-weight-bold"> <?php echo $row['First_Name'];?> <?php echo $row['Middle_Name'];?> <?php echo $row['Last_Name'];?>  <?php echo $row['FT'];?></td>
                      <td class="m-3 font-weight-bold" ><?php echo $row['BATCH'];?></td>
                      <td class="m-3 font-weight-bold text-primary"><?php echo $row['MONTH'];?> <?php echo $row['YR'];?> <?php echo $row['BATCH'];?> <?php echo $row['LEVEL'];?></td>
    
    
                    </tr>
                    <?php } ?>
                  
                  </tbody>
                  
                </table>
            
                </form>
       
              </div>
            </div>
            </div>
             <?php //include 'functions/switchteam.php' ?>

            </div>
                        
 
                          
                                                    <?php }?>     
                                                    
   <?php include 'addteam.php' ?>


   <?php //include 'teamdelete.php'?>

   <?php
include('functions/db.php');
if (isset($_POST['delete_user'])){

  if(empty($_POST['selector'])){
    echo '<script> swal({title: "Oh Lord Jesus!",text: "Please Check the checkbox before to proceed!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("addmanage.php","_self")});</script>';
    exit();
  }else
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROM teammate where teammate_id='$id[$i]'");
}
echo '<script> swal({title: "OH LORD JESUS!",text: "This Accounts already Deleted!", customClass: "swal-wide",
  confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("traineeteam.php?currentteamid='.$historyfeedback.'&locality_id='.$locality.'&userlevel='.$userlevel.'","_self")});</script>';
  exit();
}
?>