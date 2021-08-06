
  
<div class="row">
<!-- Collapsable Card Example -->
<div class="col-lg-12">
<div class="card shadow mb-4">
	  <!-- Card Header - Accordion -->
	  <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"  aria-expanded="true" aria-controls="collapseCardExample">
		<h6 class="m-0 font-weight-bold text-primary text-center">View Record's Table</h6>
	  </a>
	  <!-- Card Content - Collapse -->
	  <div class="collapse show" id="collapseCardExample">
		<div class="card-body">
		  
<div class="row">

<div class="col-lg-12">

  <!-- Default Card Example -->
  <div class="card mb-4">
	<div class="card-header">

    <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">



				<thead>
				<tr>
					   <tr>
			  <th></th>
			  <th></th>
			  <th>Propagation Date :</th>
				  <th>Time Submitted :</th>
					<th>Homes Knock :</th>
					<th>Homes Preach :</th>
					<th>Person Contacted :</th>
					<th>Person Who received the gospel called(out of Persons Contacted) :</th>
					<th>Gospel Friends open for follow-up :</th>
					<th>Brother Baptism :</th>
					<th>Sister Baptism :</th>
					<th>New Home Meetings Started :</th>
					<th>Total Home Meeting Held :</th>
					<th>Total Persons Home Met :</th>
					<th>Person Visited But Not Home Met :</th>
					<th>New Small Group Meetings established :</th>
					<th>Total Small Group Meeting Held :</th>
					<th>Total Local Saints Attending Small Group meetings :</th>
					<th>Local Saints Joining Propagation :</th>
					<th>Total Man-Hours of Local saints joining Propagation :</th>
					<th>LTM Attendance :</th>
					<th>Total Trainee Team-Hours (In Hours) :</th>
  
  
	  
	   

			
				  </tr>
				</thead>

				<tfoot>
				  <tr>
			  
				  <tr>
				  <th></th>
				  <th></th>
				  <th>Propagation Date :</th>
				  <th>Time Submitted :</th>
					<th>Homes Knock :</th>
					<th>Homes Preach :</th>
					<th>Person Contacted :</th>
					<th>Person Who received the gospel called(out of Persons Contacted) :</th>
					<th>Gospel Friends open for follow-up :</th>
					<th>Brother Baptism :</th>
					<th>Sister Baptism :</th>
					<th>New Home Meetings Started :</th>
					<th>Total Home Meeting Held :</th>
					<th>Total Persons Home Met :</th>
					<th>Person Visited But Not Home Met :</th>
					<th>New Small Group Meetings established :</th>
					<th>Total Small Group Meeting Held :</th>
					<th>Total Local Saints Attending Small Group meetings :</th>
					<th>Local Saints Joining Propagation :</th>
					<th>Total Man-Hours of Local saints joining Propagation :</th>
					<th>LTM Attendance :</th>
					<th>Total Trainee Team-Hours (In Hours) :</th>
  
  
	  
				  </tr>
				  <tr>
				</tfoot>

				<tbody>
					<!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->
				<?php

							$user_query = mysql_query("SELECT * FROM `weekspropagation`
							inner join accounts on weekspropagation.accounts_id=accounts.id 
							inner join locality on locality.id=accounts.LOCALITY
							inner join historyfeedback on weekspropagation.historyfeedback_id=historyfeedback.id 
							inner join month on month.id=historyfeedback.MONTH
							inner join year on year.id=historyfeedback.YEAR 
							inner join batch on batch.id=historyfeedback.BATCH 
							inner join week on week.id=historyfeedback.WEEK
							inner join userlevel on userlevel.id=historyfeedback.acc_id 
							inner join status on status.id=historyfeedback.status_id where weekspropagation.accounts_id='$session_id'
							ORDER BY weekspropagation.id_weekprop DESC
							")or die(mysql_error());
							while($row = mysql_fetch_array($user_query)){
							$id=$row['id_weekprop'];

				   
												  ?>
					  <!--END OF CODE ---->
		 
				  <tr>
				  <td width="40">
                        <a    class="btn btn-primary btn-circle viewdable"><i class="fa fa-eye text-white"></i></a>
												</td>
				  <td width="40">
                        <button  onclick="window.location.href='entryedit.php?locate_idpost=<?php echo $id; ?>'"   class="btn btn-success" <?php echo $row['manipulate_but'];?>><i class="fa fa-edit"></i></button>
												</td>
			
				  <td  class="m-3 font-weight-bold text-primary"><?php echo $row['MONTH'];?>, <?php echo $row['YR'];?>, <?php echo $row['week'];?>, <?php echo $row['BATCH'];?>  <?php echo $row['PLACES'];?></td>
				
				   <td><?php echo $row['Time_Submitted'];?></td>
					<td><?php echo $row['HOMESKNOCK'];?></td>
					<td><?php echo $row['HOMESPREACH'];?></td>
					<td><?php echo $row['PCONTACTED'];?></td>
					<td><?php echo $row['RECEIVEDGOSPEL'];?></td>
					<td><?php echo $row['GOPENFOLLOW'];?></td>
					<td><?php echo $row['BROBAPTISM'];?></td>
					<td><?php echo $row['SISBAPTISM'];?></td>
					<td><?php echo $row['NEWHOMESMTG'];?></td>
					<td><?php echo $row['TOTALHOMESMTG'];?></td>
					<td><?php echo $row['TOTALPERSONHMTG'];?></td>
					<td><?php echo $row['PVISITEDNOTHMEET'];?></td>
					<td><?php echo $row['NSMALLGMTG'];?></td>
					<td><?php echo $row['SMALLGMTGHELD'];?></td>
					<td><?php echo $row['LOCALATTSMLMTG'];?></td>
					<td><?php echo $row['LOCALSAINTSJOINPROP'];?></td>
					<td><?php echo $row['MANHOURS'];?></td>
					<td><?php echo $row['LTM'];?></td>
					<td><?php echo $row['TEAMHOURS'];?></td>
					</tr>
				  <?php } ?>
				
				</tbody>
    
			  </table>
	 
			  <?php include 'modalviewrecord.php'?>	
			</div>





	</div>
  
</div>
