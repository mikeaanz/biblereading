<?php include 'functions/db.php'?>
<?php include 'functions/session.php'?>
        <?php include('includes/header.php');?>
        <?php include('includes/sidenav.php');
        include('includes/topheader.php');
        ?>

        <body>
       
   <?php include 'accountlocation.php'?>
   
   <?php include 'accinformation.php' ?>
     
<!-- activation of information -->

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
    <script src="js/cheackerone.js"></script>
      <script src="js/bootstrap-select.min.js"></script>
  <script src="js/bootstrap-select.js"></script>

<script>
$(document).ready(function(e){
  $(".selectpicker").selectpicker({
            size: '10'
        });

        }
    });
</script>
  <script>
                  $("#checkAllss").click(function () {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                  });
                  </script> 



  <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

</body>
                    