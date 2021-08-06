<?php include 'functions/db.php'?>
<?php include 'functions/session.php'?>
        <?php include('includes/header.php');?>
        <?php include('includes/sidenav.php');
        include('includes/searcheditlongprop.php');
        ?>

        <body>
          <div class='container'>
            <ul class="breadcrumb">
            <?php
            $term = $_POST['batch'];
                        // $month = $_POST['month'];
                        // $year = $_POST['year'];
                    $level = $_POST['level'];
                        
            $termquery = mysql_query("SELECT * FROM batch,year,month,userlevel
                        where batch.BATCH='$term'  and LEVEL='$level'
                      
                        ")or die(mysql_error());
            $propagation = mysql_fetch_array($termquery);

            ?>
              <li><a href="#"><b>Report Propagation</b></a><span class="divider">/</span></li>
              <li><a href="#"><?php echo $propagation['BATCH']; ?> 
                            term 
                             <?php echo $propagation['LEVEL']; ?></a></li>
            </ul>
</div>
       
   <?php include 'Editreportprop.php'?>


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
   <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>





	  <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.bootstrap4.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
    <script src="js/buttons.colVis.min.js"></script>
    <script src="js/dataTables.responsive.min.js"></script>
    <script src="js/script.js"></script>
     <!--datepicker-->
 
<script src="mdb/js/datepicker.min.js"></script>
<script src="mdb/js/datepicker.js"></script>
  <script src="js/cheackerone.js"></script>

    <script>
    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: false,
        zIndex: 2048,
      });
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
$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});
</script>
</body>
                    