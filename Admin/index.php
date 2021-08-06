<?php include 'functions/db.php'?>
<?php include 'functions/session.php'?>
<?php include('includes/header.php');?>
<?php include('includes/sidenav.php');
include('includes/dashboardsearch.php');

?>

<?php include('page.php');?>
<!-- <button id="save" class="btn btn-danger  btn-smll">save</button> -->
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

    <script src="js/demo/datatables-demo.js"></script>
  <script src="js/bootstrap-select.min.js"></script>
  <script src="js/bootstrap-select.js"></script>
  
  <script src="vendor/chart.js/Chart.min.js"></script>
   <script src="js/countUp.js"></script>
    <script src="js/countUp.min.js"></script>
   <script src="js/countUp.withPolyfill.min.js"></script>
    <!--   <script src="js/chart.js"></script> -->
            <script src="js/FileSaver.min.js"></script>
            <script src="js/FileSaver.min.js"></script>
            <script src="js/FileSaver.min.js.map"></script>
            <script src="js/canvas-toBlob.js"></script>


<script type="text/javascript">
  




var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Baptism', 'Lords Table Meeting', 'Recovered Saints', 'Recovered Locality', 'Recovered District', 'Prospect Trainees','Establish District'],
        datasets: [{
            label: 'Total Population',

      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(231, 15, 12, 1)",
      pointBorderColor: "rgba(231, 15, 12, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(21, 196, 117, 1)",
      pointHoverBorderColor: "rgba(21, 196, 117, 1)",
      pointHitRadius: 1,
      pointBorderWidth: 4,


<?php
          $qwery= mysql_query("select SUM(BROBAPTISM+SISBAPTISM) as bap from weekspropagation")or die(mysql_error());
          $rowz = mysql_fetch_array($qwery);

            $ltm= mysql_query("select ROUND(AVG(LTM)) as ltm from weekspropagation")or die(mysql_error());
          $LTM = mysql_fetch_array($ltm);
        

            $recoversaints= mysql_query("select COUNT(*) as c from recoversaints")or die(mysql_error());
          $rec = mysql_fetch_array($recoversaints);

             $recloc= mysql_query("select COUNT(*) as loc from recoverlocal")or die(mysql_error());
          $loc = mysql_fetch_array($recloc);

              $recdis= mysql_query("select COUNT(*) as dist from rec_district")or die(mysql_error());
          $dis = mysql_fetch_array($recdis);

            $pro= mysql_query("select COUNT(*) as train from prospect_train")or die(mysql_error());
          $trainee = mysql_fetch_array($pro);

             $estdistrict= mysql_query("select COUNT(*) as estdist from establish_dist")or die(mysql_error());
          $es = mysql_fetch_array($estdistrict);


 ?>


     data: [<?php echo $rowz['bap'];?>,<?php echo $LTM['ltm'];?>,<?php echo $rec['c'];?>,<?php echo $loc['loc'];?>,<?php echo $dis['dist'];?>,<?php echo $trainee['train'];?>,<?php echo $es['estdist'];?>],






            // backgroundColor: [
            //     'rgba(255, 99, 132, 0.2)',
            //     'rgba(54, 162, 235, 0.2)',
            //     'rgba(255, 206, 86, 0.2)',
            //     'rgba(75, 192, 192, 0.2)',
            //     'rgba(153, 102, 255, 0.2)',
            //     'rgba(255, 159, 64, 0.2)',
            //     'rgba(72, 188, 64, 0.2)'
            // ],
            // borderColor: [
            //     'rgba(255, 99, 132, 1)',
            //     'rgba(54, 162, 235, 1)',
            //     'rgba(255, 206, 86, 1)',
            //     'rgba(75, 192, 192, 1)',
            //     'rgba(153, 102, 255, 1)',
            //     'rgba(255, 159, 64, 1)',
            //      'rgba(72, 188, 4, 3)'
            // ],
            borderWidth: 5
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>


          

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

  <!-- Page level custom scripts -->
  <!-- <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script> -->

</body>

</html>
