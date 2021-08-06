    
        <form  method="post">
<div class="container">
        <div class="row">

<!-- Activation Accounts -->


<div class="col-xl-9 col-lg-6">
  <div class="card shadow mb-1">
    <h6 class="m-3 font-weight-bold text-primary">All Informations Accounts</h6>
    
    <div class="card-body">
       <!--  <a  href="#delete" class="btn btn-light  btn-smll"  data-toggle="modal" data-target="#deactivate"><i class="text-danger fa-2x fa fa-times-circle" data-toggle="tooltip" title="Deactivated!"></i> </a>

           <a  href="#delete" class="btn btn-light  btn-smll"  data-toggle="modal" data-target="#Activate"><i class="text-success fa-2x fa fa-check-circle" data-toggle="tooltip" title="Activated!"></i> </a>
 -->
    <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i> </a>
    <?php include 'functions/accountdelmodal.php'?>


    </div>
    <div class="float-right">
    <ul class="nav nav-pills">

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
             
                      <th>Username</th>
                      <th>Password</th>
                      <th>User Level</th>
                      <th>Status</th>
                      <th>Locality</th>
                      <th>Date Created</th>
 
              
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                            <th></th>
                      <th></th>
               
                      <th>Username</th>
                      <th>Password</th>
                      <th>User Level</th>
                      <th>Status</th>
                      <th>Locality</th>
                      <th>Date Created</th>
              
        
                    </tr>
                  </tfoot>

                  <tbody>
                      <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
                  <?php
													$user_query = mysql_query("SELECT * from accounts
                           INNER join userlevel on accounts.USER_LEVEL = userlevel.ID 
                           INNER join locality on accounts.LOCALITY = locality.ID
                           INNER join status on accounts.STATUS = status.ID order by accounts.id DESC ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
                          $id = $row['id'];
                          $loc = $row['LOCALITY'];
                          $user = $row['USER_LEVEL'];
													?>
                        <!--END OF CODE ---->
           
                    <tr>


  <!--       <td width="40px">  

<label class="switch">
      <input id="optionsCheckbox"   name="toogle[]" type="checkbox"   data-toggle="tooltip" title="Note! This is for Disabled or Activated!" value="<?php echo $id; ?>">
  <span class="slider round"></span>
</label>

   </td> -->
                    <td width="40px">		<input id="optionsCheckbox" class="switch cbox" name="selector[]" type="checkbox" value="<?php echo $id; ?>" data-toggle="tooltip" title="Check List"></td>
                    <td width="40">
												<a  href="accactivated.php?id=<?php echo $id; ?>&loc=<?php echo $loc; ?>&userlvl=<?php echo $user; ?>"   class="btn btn-success"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
												</td>
                      <td><?php echo $row['USERNAME'];?></td>
                      <td><?php echo $row['PASSWORD'];?></td>
                      <td><?php echo $row['LEVEL'];?></td>
                      <td class="<?php echo $row['ACTION'];?>" style="font-style:italic;"><?php echo $row['ACTION'];?></td>
                      <td><?php echo $row['PLACES'];?></td>
                      <td><?php echo $row['DATE_CREATED'];?></td>
    
                    </tr>
                    <?php } ?>
                  
                  </tbody>
                  
                </table>
                </form>
                <?php include 'delete_account.php'?>
                        <?php //include 'functions/cheackeractivatemodal.php'?>
                             <?php include 'functions/cheackeraccountsmodal.php'?>
             
              </div>
            </div>
            </div>
   </div>
            </div>


            <?php
include('functions/db.php');
if (isset($_POST['delete_user'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROM accounts where id='$id[$i]'");
}
echo '<script> swal({title: "Lord Jesus!",text: "This Accounts already Deleted!", customClass: "swal-wide",
	confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("accountactivation.php","_self")});</script>';
  exit();
}
?>



