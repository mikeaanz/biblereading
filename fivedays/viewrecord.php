<?php require_once 'functions/db.php';

if(isset($_GET['page'])){

    $page=$_GET['page'];
}
else{
    $page=1;
}


$num_per_page=05;
$start_from=($page-1)*05;

?>






        
        </nav>
        <!-- Begin Page Content -->


        <body>

        <?php // include 'viewtable.php' ?>
<div class="container">
        <!-- <ul class="breadcrumb">
						<?php
						$term = $_POST['batch'];
                        $month = $_POST['month'];
                        $year = $_POST['year'];
              
                        
						$termquery = mysql_query("SELECT * FROM batch,year,month,userlevel
                        where batch.BATCH='$term' and month.MONTH='$month' and year.YR='$year'
                      
                        ")or die(mysql_error());
						$propagation = mysql_fetch_array($termquery);

						?>
	<li><a href="#"><b>Propagation tracks</b></a><span class="divider">/</span></li>
							<li><a href="#"><?php echo $propagation['BATCH']; ?> 
                            term <?php echo $propagation['MONTH']; ?> <?php echo $propagation['YR']; ?> 
        
						</ul>

                        </div> -->
        <form action="delete_historypost.php" method="post">    
<!-- <div class="container"> -->

        <div class="row">







    <div class="card-body">
    <!-- <img class="card-img-top" src="img/fttma.jpg" alt="Card image cap"> -->
  <!--  <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> </a>-->

    </div>
    <div class="float-right">
    <ul class="nav nav-pills">
    
    <!-- <a href="traineepro" class="btn btn-link "><i class="fa fa-arrow-left"></i>Back</a> -->

        <!--  <li class="active">
			<a  href="accountactivation.php" class="btn btn-primary  btn-circle" ><i class="fa fa-info"></i><i class="fa fa-users"></i> </a>
				</li>
                &nbsp;
				<li class="active">
			<a  href="activate.php" class="btn btn-success  btn-circle" ><i class="fa fa-check"></i><i class="fa fa-user"></i> </a>
				</li>
                &nbsp;
                -->
	<li class="">
         	<!--<a  href="longprop.php" class="btn btn-success btn-circle .btn-lg"><i class="fa fa-arrow-left" aria-hidden="true"></i> </a>-->
				</li> 
				</li>
	
				</ul>
	</div>
  </div>



  <?php







                                               $user_query = mysql_query("SELECT * from current_teamdata
                                                    inner join month on month.id=current_teamdata.Month_id
                                                  inner join year on year.id=current_teamdata.Year_id
                                                  inner join batch on batch.id=current_teamdata.Batch_id
                                                  inner join userlevel on userlevel.id=current_teamdata.userlevel_id
                                                   inner join control_rec on control_rec.control_rec_id=current_teamdata.control_data
                                                 WHERE current_teamdata.userlevel_id='4'
                                                --    where batch.BATCH='$term' and month.MONTH='$month' and year.YR='$year'
                                                    ORDER BY current_teamdata.c_team_id asc
                                                  limit $start_from,$num_per_page  ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){

                                                        $id=$row['c_team_id'];
                                     

                 
                 
                                                        ?> 
                                                      
<div class="container">

<div class="col-lg-12">
    

<!-- Dropdown Card Example -->
<div class="card shadow mb-1">
  <!-- Card Header - Dropdown -->
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
   

        
    </h6>


    


</label>
    
    <div class="dropdown no-arrow">
      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
      </a>
      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
        <div class="dropdown-header">Transaction:</div>
        <a class="dropdown-item" href="#">RePost</a>
        <a class="dropdown-item"  data-toggle="modal" data-target="#delete" name="selector" value="<?php echo $id; ?>" href="#delete" > <?php echo $id; ?> Delete</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">1 John 1:8</a>
      </div>
    </div>
  </div>
  <!-- Card Body -->

  <div class="card-body">
                              <h5 class="text-success text-right week">    <?php echo $row['LEVEL'];?></h5>
                    <!-- Card content -->
                    <div class="card" >

                   <!-- Title -->
                        <!-- <b><h4 class="text-center" ><a><?php echo $row['LEVEL'];?></a></h4>  <b>
                            <p class="text-center">2 Timothy 2:7</p>
                        <h5 class="text-center" style="font-style:italic;"><?php echo $row['MONTH'];?> <?php echo $row['YR'];?> <?php echo $row['BATCH'];?> </h5> -->
                        <!-- Text -->
                        <h5 class="font-weight-bold text-dark  text-center week" style="font-style:italic;"><?php echo $row['MONTH'];?> <?php echo $row['YR'];?> <?php echo $row['BATCH'];?> </h5>
                        <h5 class="text-justify ">
                        <h5 class="card-text text-center bg-gradient-success   " style="font-style:italic;"><a class="m-3 font-weight-bold" style='color:#BFEEF9' >Rev. 22:12 Behold, I come quickly, and My reward is with Me to render to each one as his work is.</a><span style='color:#F8FAFB' ></span></h5>
                     
                        <!-- <p class="card-text text-center">Month of Propagation : <?php echo $row['MONTH'];?>
                   ,<?php echo $row['YR'];?>
                      during  <?php echo $row['BATCH'];?> batch -->
                  
                        <!-- Button -->
                            
<br>
                                          
                    <div class="col text-center">	
                          <button onclick="window.location.href='addcontact.php?id=<?php echo $id; ?>'"  class="btn btn-info bg-gradient-primary  sidebar-dark" <?php echo $row['list'];?>><i class="fa fa-plus" ></i> Contact Record</button>
                        <hr>
                    </div>
         
                    </div>
                    </div>
                    </div>
      
                    </div>
                    </div>
                                                    </form>
           
                    <?php }?>
                  <hr>
            
                  
                  <div class="col text-center">	
                  <nav>
                  <nav>
                    <nav>
                    <div class="col text-center">	
                                                    </div>
                                                    
                                              
                    <?php   $pr_query="Select * from current_teamdata ";
                            $pr_result=mysql_query($pr_query);
                            $total_record=mysql_num_rows($pr_result);
                         

                            $total_page=ceil($total_record/$num_per_page);
                            if($page>1){
                                echo "
     
              
                    
                        
                     
                           <a href='mycontact.php?page=".($page-1)."'class='btn btn-danger'>            <i class='fa fa-arrow-left'></i> Previous</a>
                   
                           
                  
                           ";
                        
                            }
                  
                            for($i=1;$i<$total_page;$i++) 
                             { 
                            
                               //     echo "
                               
                                   // <a href='historypost.php?page=".$i."'class='btn btn-info text-center'>$i</a>&nbsp";
                        
                            }
                            
                            if($i>$page){
                                echo "
                                
         
                   
                           
                                <a href='mycontact.php?page=".($page+1)."'class='btn btn-primary'>Next   <i class='fa fa-arrow-right'></i></a>";
                        
                            }
                          
                    ?>
                

                 



</body>
                    