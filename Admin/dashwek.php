
<?php include('includes/header.php');?>
<?php include 'functions/db.php'?>
<?php include 'functions/session.php' ?>
<?php include('includes/sidenav.php');
include('includes/weekenddashsearch.php');
?>
<?php include('weekenddash.php');?>
<?php //include('maincontent.php');?>
<?php include('includes/footer.php');?>
<?php include('includes/logoutmodal.php');?>





  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/pms.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  
    <script src="js/demo/datatables-demo.js"></script>
  <script src="js/bootstrap-select.min.js"></script>
  <script src="js/bootstrap-select.js"></script>

 <script src="js/countUp.js"></script>
    <script src="js/countUp.min.js"></script>
   <script src="js/countUp.withPolyfill.min.js"></script>
  <script>
$(function () {
    $('selectpicker').selectpicker();
});
</script>

<script type="text/javascript">
  $('.counter').each(function() {
  var $this = $(this),
      countTo = $this.attr('data-count');
  
  $({ countNum: $this.text()}).animate({
    countNum: countTo
  },

  {

    duration: 600,
    easing:'linear',
    step: function() {
      $this.text(Math.floor(this.countNum));
    },
    complete: function() {
      $this.text(this.countNum);
      //alert('finished');
    }

  });  


});

</script>
</body>

</html>
