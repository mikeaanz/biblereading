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
    <div class="container">
        <ul class="breadcrumb">
						<?php
						$term = $_POST['batch'];
                        // $month = $_POST['month'];
                        // $year = $_POST['year'];
                   
                        
						$termquery = mysql_query("SELECT * FROM batch,year,month
                        where batch.BATCH='$term' 
                      
                        ")or die(mysql_error());
						$propagation = mysql_fetch_array($termquery);

						?>
							<li><a href="#"><b>My Propagation</b></a><span class="divider">/</span></li>
							<li><a href="#"><?php echo $propagation['BATCH']; ?> 
                            term 
                           </a></li>
						</ul>

            </div>
        <?php //include 'viewtable.php' ?>


   
<!--         <form action="delete_historypost.php" method="post">    --> 
<div class="container">

        <div class="row">







    <div class="card-body">
    <!-- <img class="card-img-top" src="img/fttma.jpg" alt="Card image cap"> -->
  <!--  <a  href="#delete" class="btn btn-danger  btn-smll"  data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> </a>-->

    </div>
    <div class="float-right">
    <ul class="nav nav-pills">

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







                                               $user_query = mysql_query("SELECT * from historyfeedback
                                                  LEFT JOIN month on historyfeedback.MONTH=month.ID
                                               LEFT JOIN year on historyfeedback.YEAR=year.ID
                                                  LEFT JOIN batch on historyfeedback.BATCH=batch.ID
                                                  LEFT JOIN week on historyfeedback.WEEK=week.ID
                                                   LEFT JOIN userlevel on historyfeedback.acc_id=userlevel.ID
                                                   LEFT JOIN control_rec on historyfeedback.status_id=control_rec.control_rec_id
                                                   where historyfeedback.acc_id='2'
                                            
                                                   AND batch.BATCH='$term' 
                                                   
                                                    ORDER BY historyfeedback.id DESC
                                                  limit $start_from,$num_per_page  ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){

                                                         $id=$row['id'];
                                                        $week=$row['week'];
                                                        $batch=$row['BATCH'];
                 
                 
                 
                                                        ?> 
                                                      
<div class="container">

<div class="col-lg-14">
    

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
                              <h1 class="m-3 font-weight-bold text-info   sidebar-dark  text-right week" style='color: #11a255 '>     <?php echo $row['week'];?></h1>
                    <!-- Card content -->
                    <div class="card" >

                   <!-- Title -->
                        <b><h4 class="m-3 font-weight-bold text-info  text-center " ><a><?php echo $row['LEVEL'];?></a></h4>  <b>
                            <p class="text-center">2 Timothy 2:7</p>
                        <h5 class="text-center" style="font-style:italic;">Consider what I say, for the Lord will give you understanding in all things.</h5>
                        <!-- Text -->
                        <p class="text-justify ">
                        <p class="card-text text-center bg-gradient-info  sidebar-dark" style="font-style:italic;"><a style='color:#F8FAFB' > Post Started on </a><span style='color:#F8FAFB' ><?php echo $row['date_started'];?></span></p>
                     
                        <p class="card-text text-center">Month of Propagation : <?php echo $row['MONTH'];?>
                   ,<?php echo $row['YR'];?>
                      during  <?php echo $row['BATCH'];?> batch
                  
                        <!-- Button -->
                            

                                          
                    <div class="col text-center">	


                         <button  onclick="window.location.href='myentry.php?locate_idpost=<?php echo $id; ?>&BATCH=<?php echo $batch;?>'"   class="btn btn-info" data-toggle="tooltip" title="Service Contact" <?php echo $row['list'];?>><i class="fa fa-plus-circle"></i></button>

               <!--          <a href="myentry.php?locate_idpost=<?php echo $id; ?>" class="btn btn-success bg-gradient-primary  sidebar-dark" ><i class="fa fa-plus"></i>ADD DATA</a> -->
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
                                                    
                                              
                    <?php   $pr_query="Select * from historyfeedback  WHERE acc_id='2' AND status_id='1'";
                            $pr_result=mysql_query($pr_query);
                            $total_record=mysql_num_rows($pr_result);
                         

                            $total_page=ceil($total_record/$num_per_page);
                            if($page>1){
                                echo "
     
              
                    
                        
                     
                           <a href='newsfeedback.php?page=".($page-1)."'class='btn btn-danger'>            <i class='fa fa-arrow-left'></i> Previous</a>
                   
                           
                  
                           ";
                        
                            }
                  
                            for($i=1;$i<$total_page;$i++) 
                             { 
                            
                               //     echo "
                               
                                   // <a href='historypost.php?page=".$i."'class='btn btn-info text-center'>$i</a>&nbsp";
                        
                            }
                            
                            if($i>$page){
                                echo "
                                
         
                   
                           
                                <a href='newsfeedback.php?page=".($page+1)."'class='btn btn-primary'>Next   <i class='fa fa-arrow-right'></i></a>";
                        
                            }
                          
                    ?>
                

                 

  


</body>
                    