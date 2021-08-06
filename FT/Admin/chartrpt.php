<?php include 'functions/db.php'?>
<?php include 'functions/session.php'?>
        <?php include('includes/refreshheader.php');?>
        <?php include('includes/sidenav.php');
        include('includes/searcheditlongprop.php');
        ?>

        <body>



   <?php include 'linechart.php'?>

<!--source code jabez for chart you can use this if you need it*/
<!--    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
          ['2004/05',  165,      938,         522,             998,           450,      614.6],
          ['2005/06',  135,      1120,        599,             1268,          288,      682],
          ['2006/07',  157,      1167,        587,             807,           397,      623],
          ['2007/08',  139,      1110,        615,             968,           215,      609.4],
          ['2008/09',  136,      691,         629,             1026,          366,      569.6]
        ]);

        var options = {
          title : 'Propagation Report per Term',
          vAxis: {title: 'Cups'},
          hAxis: {title: 'Month'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script> -->
  </head>
  <body>
    <!--calling method for this chart-->
  <!--   <div id="chart_div" style="width: 900px; height: 500px;"></div> -->
  </body>
<!-- activation of information -->
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
  <script src="vendor/chart.js/Chart.min.js"></script>
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


<script type="text/javascript">
  




var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Baptism', 'Lords Table Meeting', 'Recovered Saints', 'Recovered Locality', 'Recovered District', 'Prospect Trainees','Establish District','Small Group Meeting','New Home Meeting','Saints Joining Propagation'],
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


                 $small= mysql_query("select SUM(NSMALLGMTG) as small from weekspropagation")or die(mysql_error());
          $sm = mysql_fetch_array($small);



                 $nmall= mysql_query("select SUM(NEWHOMESMTG) AS  NEWHOMESMTG from weekspropagation")or die(mysql_error());
          $nsmall = mysql_fetch_array($nmall);


                 $locsaints= mysql_query("select SUM(LOCALSAINTSJOINPROP) AS LOCALSAINTSJOINPROP from weekspropagation")or die(mysql_error());
          $locs = mysql_fetch_array($locsaints);



 ?>


     data: [<?php echo $rowz['bap'];?>,<?php echo $LTM['ltm'];?>,<?php echo $rec['c'];?>,<?php echo $loc['loc'];?>,<?php echo $dis['dist'];?>,<?php echo $trainee['train'];?>,<?php echo $es['estdist'];?>,<?php echo $sm['small'];?>,<?php echo $nsmall['NEWHOMESMTG']; ?>,<?php echo $locs['LOCALSAINTSJOINPROP']?>],






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


<script type="text/javascript">
  

var ctx = document.getElementById('pie');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
            labels: ['Baptism', 'Lords Table Meeting', 'Recovered Saints', 'Recovered Locality', 'Recovered District', 'Prospect Trainees','Establish District','Small Group Meeting','New Home Meeting','Saints Joining Propagation'],
        datasets: [{
            label: 'Total Population',

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


                 $small= mysql_query("select SUM(NSMALLGMTG) as small from weekspropagation")or die(mysql_error());
          $sm = mysql_fetch_array($small);



                 $nmall= mysql_query("select SUM(NEWHOMESMTG) AS  NEWHOMESMTG from weekspropagation")or die(mysql_error());
          $nsmall = mysql_fetch_array($nmall);


                 $locsaints= mysql_query("select SUM(LOCALSAINTSJOINPROP) AS LOCALSAINTSJOINPROP from weekspropagation")or die(mysql_error());
          $locs = mysql_fetch_array($locsaints);



 ?>


     data: [<?php echo $rowz['bap'];?>,<?php echo $LTM['ltm'];?>,<?php echo $rec['c'];?>,<?php echo $loc['loc'];?>,<?php echo $dis['dist'];?>,<?php echo $trainee['train'];?>,<?php echo $es['estdist'];?>,<?php echo $sm['small'];?>,<?php echo $nsmall['NEWHOMESMTG']; ?>,<?php echo $locs['LOCALSAINTSJOINPROP']?>],


            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(11, 335, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255,1)',
                'rgba(255, 33, 64, 1)',
                'rgba(123, 1, 33, 1)',
                 'rgba(31, 3, 193,1)',
                  'rgba(47, 178, 211,1)',
                  'rgba(214, 227, 2,1)'
              
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(209, 218, 89, 1)',
                'rgba(230, 99, 19,4)',
                'rgba(19, 230, 230,4)',
                'rgba(19, 112, 116,4)',
                'rgba(125, 193, 31,4)'
            ],
            borderWidth: 1
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


<script type="text/javascript">
  

var ctx = document.getElementById('barchart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
         labels: ['Baptism', 'Lords Table Meeting', 'Recovered Saints', 'Recovered Locality', 'Recovered District', 'Prospect Trainees','Establish District','Small Group Meeting','New Home Meeting','Saints Joining Propagation'],
        datasets: [{
            label: 'Total Population',

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


                 $small= mysql_query("select SUM(NSMALLGMTG) as small from weekspropagation")or die(mysql_error());
          $sm = mysql_fetch_array($small);



                 $nmall= mysql_query("select SUM(NEWHOMESMTG) AS  NEWHOMESMTG from weekspropagation")or die(mysql_error());
          $nsmall = mysql_fetch_array($nmall);


                 $locsaints= mysql_query("select SUM(LOCALSAINTSJOINPROP) AS LOCALSAINTSJOINPROP from weekspropagation")or die(mysql_error());
          $locs = mysql_fetch_array($locsaints);



 ?>


     data: [<?php echo $rowz['bap'];?>,<?php echo $LTM['ltm'];?>,<?php echo $rec['c'];?>,<?php echo $loc['loc'];?>,<?php echo $dis['dist'];?>,<?php echo $trainee['train'];?>,<?php echo $es['estdist'];?>,<?php echo $sm['small'];?>,<?php echo $nsmall['NEWHOMESMTG']; ?>,<?php echo $locs['LOCALSAINTSJOINPROP']?>],


            backgroundColor: [
                'rgba(255, 99, 132, 0.1)',
                'rgba(54, 162, 235, 0.1)',
                'rgba(11, 335, 86, 0.1)',
                'rgba(75, 192, 192, 0.1)',
                'rgba(153, 102, 255,0.1)',
                'rgba(255, 33, 64, 0.1)',
                'rgba(123, 1, 33, 0.1)',
                 'rgba(31, 3, 193,0.1)',
                  'rgba(47, 178, 211,0.1)',
                  'rgba(214, 227, 2,0.1)'
            ],
            borderColor: [
               'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(209, 218, 89, 1)',
                'rgba(230, 99, 19,4)',
                'rgba(19, 230, 230,4)',
                'rgba(19, 112, 116,4)',
                'rgba(125, 193, 31,4)'
            ],
            borderWidth: 1
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


<script type="text/javascript">

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


                 $small= mysql_query("select SUM(NSMALLGMTG) as small from weekspropagation")or die(mysql_error());
          $sm = mysql_fetch_array($small);



                 $nmall= mysql_query("select SUM(NEWHOMESMTG) AS  NEWHOMESMTG from weekspropagation")or die(mysql_error());
          $nsmall = mysql_fetch_array($nmall);


                 $locsaints= mysql_query("select SUM(LOCALSAINTSJOINPROP) AS LOCALSAINTSJOINPROP from weekspropagation")or die(mysql_error());
          $locs = mysql_fetch_array($locsaints);


                 $estlocality= mysql_query("select COUNT(*) AS establish_local from establish_local")or die(mysql_error());
          $estloc = mysql_fetch_array($estlocality);



 ?>



  
new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: ['Baptism', 'Lords Table Meeting', 'Recovered Saints', 'Recovered Locality', 'Recovered District', 'Prospect Trainees','Establish District','New Small Group Meeting','New Home Meeting','Saints Joining Propagation','Established Locality'],
    datasets: [{ 
        data: [2200,32,194,1,0,88,0,165,1166,2478,2],
        label: "65th term",
        borderColor: "#3e95cd",
        fill: false
      }, { 
     data: [2013,40,80,2,0,19,0,163,1273,1140,0],

        label: "66th term",
        borderColor: "#8e5ea2",
        fill: false
      }]
  },
  options: {
    title: {
      display: true,
      text: 'Propagation Population Record Data'
    }
  }
});



</script>






     <!--datepicker-->
 



</body>
                    