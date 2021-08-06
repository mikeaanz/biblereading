<?php include 'functions/db.php'?>
<?php $get_id = $_GET['id']; ?>
<?php include 'functions/session.php'?>
        <?php include('includes/header.php');?>
        <?php include('includes/sidenav.php');?>
        
    <?php include('includes/topheader.php');
        ?>


        <body>
             
       
        <!-- Month -->
          <?php include 'monthcard.php'?>
          <?php include 'monthedit.php'?>

  
      <?php //include 'yearitems.php'?>
      <?php// include 'yearcard.php'?>
    
    
    <?php// include 'batchitems.php'?>
    <?php //include 'batchcard.php'?>

    <?php//include 'weekitems.php'?>
  <?php //include 'weekcard.php' ?>



  <?php// include 'modalmonth.php' ?>
  

  



  </div>
  </div>
  </div>
  </div>
      </div>

      <script>
$(function () {
$('[data-toggle="popover"]').popover()
})
</script>
      
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





</body>
                    