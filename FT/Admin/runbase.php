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
<?php include 'functions/session.php'

?>
        <?php include('includes/header.php');?>
        <?php include('includes/sidenav.php');
        include('includes/topheader.php');
        ?>




        
        </nav>
        <!-- Begin Page Content -->


        <body>




   
        <form  method="post">    


        <?php

$user_query = mysql_query("SELECT * from teammate
INNER JOIN trainee_info on teammate.trainee_id=trainee_info.trainee_id
INNER JOIN class on class.ID=trainee_info.Term
 INNER JOIN historyfeedback on teammate.historyfeedback_id= historyfeedback.id   
 INNER JOIN month on historyfeedback.MONTH=month.ID
  INNER JOIN year on historyfeedback.YEAR=year.ID
   INNER JOIN batch on historyfeedback.BATCH=batch.ID 
   INNER JOIN week on historyfeedback.WEEK=week.ID 
   INNER JOIN userlevel on historyfeedback.acc_id=userlevel.ID 
   INNER JOIN locality on teammate.locality_id=locality.ID ORDER BY teammate.teammate_id DESC
   limit $start_from,$num_per_page  ")or die(mysql_error());
while($row = mysql_fetch_array($user_query)){

         $id=$row['id'];


         ?> 

         

  <!-- Begin Page Content -->
  <div class="container">
    






  <div class="row">
 

    

    <!-- Earnings (Monthly) Card Example
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
              <h5 class="namedesign"><?php echo $row['First_Name']?> <?php echo $row['Middle_Name']?> <?php echo $row['Last_Name']?> <?php echo $row['FT']?></h5>
              <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div> -->

  <div class="col-xl-12 col-md-6 mb-4">
   <div class="card border-center-success shadow h-100 py-2">
  <div class="card-body">
  <div class="row no-gutters align-items-center">
  <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="img/logo.png" alt="Card image cap">
  <div class="card-body">
  <div class="text-center">
  <h5 class="namedesign"><?php echo $row['First_Name']?> <?php echo $row['Middle_Name']?> <?php echo $row['Last_Name']?> <?php echo $row['FT']?></h5>
    <p>1 Timothy 1:15-16 – Here is a trustworthy saying that deserves full 
        acceptance: Christ Jesus came into the world to save sinners—of whom I
         am the worst. But for that very reason I was shown mercy so that in me,
          the worst of sinners, Christ Jesus might display his immense patience as
           an example for those who would believe in him and receive eternal life.</p>
           <a  href="#delete" class="btn btn-primary  btn-lg"  data-toggle="modal" data-target="#delete"><i class="fa fa-users"></i> </a>
  </div>
  
</div> 
</div> 
</div> 
</div> 
</div> 
</div> 
</div> 
</div> 


<?php }?>

         

</form>


      
<div class="col text-center">	
                  <nav>
                  <nav>
                    <nav>
                    <div class="col text-center">	
                                                    </div>
                                                    
                                              
                    <?php   $pr_query="Select * from teammate ";
                            $pr_result=mysql_query($pr_query);
                            $total_record=mysql_num_rows($pr_result);
                         

                            $total_page=ceil($total_record/$num_per_page);
                            if($page>1){
                                echo "
     
              
                    
                        
                     
                           <a href='myteam.php?page=".($page-1)."'class='btn btn-danger'>            <i class='fa fa-arrow-left'></i> Previous</a>
                   
                           
                  
                           ";
                        
                            }
                  
                            for($i=1;$i<$total_page;$i++) 
                             { 
                            
                               //     echo "
                               
                                   // <a href='historypost.php?page=".$i."'class='btn btn-info text-center'>$i</a>&nbsp";
                        
                            }
                            
                            if($i>$page){
                                echo "
                                
         
                   
                           
                                <a href='myteam.php?page=".($page+1)."'class='btn btn-primary'>Next   <i class='fa fa-arrow-right'></i></a>";
                        
                            }
                          
                    ?>

                <?php include 'functions/allmodal.php'?>

                <?php include('includes/footer.php');?>
  <?php include('includes/logoutmodal.php');?>
      <!-- End of Main Content -->
      



  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/pms.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <script type="text/javascript">
$(document).ready(function(){
  $('.viewdable').click(function(){
      $('#fluidmodalInfo').modal('show');
         $tr =$(this).closest('tr');

            var data=$tr.children("td").map(function(){
              return $(this).text();  
              }).get();
              console.log(data);
              $('#propagationdate').val(data[2]);
              $('#time').val(data[3]);
              $('#brobap').val(data[4]);
              $('#sisbap').val(data[5]);
              $('#recbro').val(data[6]);
              $('#recsis').val(data[7]);
              $('#newmtg').val(data[8]);
              $('#smalmtg').val(data[9]);
              $('#avLTM').val(data[10]);
              $('#locjoin').val(data[11]);
              $('#estloc').val(data[12]);
              $('#recloc').val(data[13]);
              $('#estdist').val(data[14]);
              $('#recdist').val(data[15]);
              $('#prostrainbro').val(data[16]);
              $('#prostrainsis').val(data[17]);
			  $('#join').val(data[18]);
			  $('#manhrs').val(data[19]);
			  $('#ltm').val(data[20]);
			  $('#teamhrs').val(data[21]);
		
  });
});

</script>
		<script>
								function chooseFile() {
								$("#fileInput").click();
								
								
								document.getElementById("fileInput").onchange = function () {
								var filename = $('#fileInput').val().replace(/.*(\/|\\)/, '');
    document.getElementById("d1").value = filename;
	
	
		var oFReader = new FileReader();         
oFReader.readAsDataURL(document.getElementById("fileInput").files[0]);         
oFReader.onload = function (oFREvent) {            
 document.getElementById("imagePreview").src = oFREvent.target.result;       
 };

};
								
								
									}
									
									
								</script>

<script>

</script>


</body>
