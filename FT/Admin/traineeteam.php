<?php include 'functions/db.php'?>
<?php include 'functions/session.php'?>
<?php $locality=$_GET['locality_id'];
      $historyfeedback=$_GET['currentteamid'];
      $level=$_GET['userlevel'];
?>
        <?php include('includes/header.php');?>
        
        <?php include('includes/sidenav.php');
        include('includes/topheader.php');
        
        ?>

        <body>
          <div class="container">
         <a  href="addteamup.php?id=<?php echo $historyfeedback;?>&userlevel=<?php echo $level;?>" class="btn btn-link  btn-sm"  ><i class="fa fa-arrow-left" data-toggle="tooltip" title="Delete"></i>Back </a>
   <?php include 'trainee_teamadd.php'?>
   <?php //include 'addteam.php' ?>
     
<!-- activation of information -->
</div>
</div>
       </div>
      </div>
       </div>
      </div>
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
  <script src="js/bootstrap-select.min.js"></script>
  <script src="js/bootstrap-select.js"></script>

<script>
$(function () {
    $('selectpicker').selectpicker();
});
</script>

  <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>



</body>
                    