<?php include 'functions/db.php'?>
<?php include 'functions/session.php'?>
        <?php include('includes/header.php');?>
        <?php include('includes/sidenav.php');
        include('includes/feednewssearch.php');
        ?>

        <body>
       
 
   
   <?php //include 'addteamtrainee.php'?>


   <?php include 'viewaddcurrtrainee.php'?>

   <?php include 'addtypeteam.php' ?>


 
</div>
</div>
</div>
</div>
</div>
     

     
      <?php  include('includes/footer.php');?>
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

  <script src="js/bootstrap-datepicker.js"></script>



     <!--datepicker-->


<script src="mdb/js/datepicker.min.js"></script>
<script src="mdb/js/datepicker.js"></script>
  <script src="js/cheackerone.js"></script>

    <script>
    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
      });
    });
  </script>

<script>
tail.select('select1'),{
    search: true;
});
</script>



<script>

$(document).ready(function() {
    var table = $('#example').DataTable( {
        
        lengthChange: true,
        
        
        buttons: ['excel', 'colvis' ]
    } );

    
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>


  <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>


				
 

</body>
                    