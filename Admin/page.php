
        <!-- Begin Page Content -->
        <div class="container"
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Dashboard - Long Propagation Over All</h1>
         
 <!--         <a href="allpdf.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            
          </div>

          <!-- Content Row -->
          <div class="row">
          <?php 
								$query = mysql_query("select SUM(BROBAPTISM) AS BROBAPTISM from weekspropagation")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>
								

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Brothers Baptism</div>
                   <div class="h5 mb-0 font-weight-bold text-gray-800 counter"  data-count="<?php echo $row['BROBAPTISM'];?>">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-male fa-4x text-dark-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                <?php }?>

                <?php 
								$query = mysql_query("select SUM(SISBAPTISM) AS SISBAPTISM from weekspropagation")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sister's Baptism</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['SISBAPTISM'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-female fa-4x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                  <?php }?>


      

                  <?php 
								$query = mysql_query("select SUM(BROBAPTISM+SISBAPTISM) AS overall from weekspropagation")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Baptism</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['overall'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-4x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                  <?php }?>

                
                  <?php 
								$query = mysql_query("select SUM(HOMESKNOCK) AS HOMESKNOCK from weekspropagation")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Homes Knock </div>
                                       <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['HOMESKNOCK'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-home fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php }?>



          <?php 
								$query = mysql_query("select SUM(HOMESPREACH) AS HOMESPREACH from weekspropagation")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Homes Preach </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['HOMESPREACH'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-home fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php }?>


          <?php 
								$query = mysql_query("select SUM(PCONTACTED) AS PCONTACTED from weekspropagation")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Person Contacted</div>
                       <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['PCONTACTED'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php }?>

          <?php 
								$query = mysql_query("select SUM(RECEIVEDGOSPEL) AS RECEIVEDGOSPEL from weekspropagation")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Person   received the gospel/called</div>
                                              <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['RECEIVEDGOSPEL'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php }?>


                        <?php 
								$query = mysql_query("select ROUND(AVG(LTM)) as ltm  from weekspropagation")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-dark shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Average LTM</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['ltm'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-percent fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>

                        

                        <?php 
								$query = mysql_query("select SUM(LOCALSAINTSJOINPROP) AS LOCALSAINTSJOINPROP from weekspropagation")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Local Saints Joining Propagation</div>
                                     <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['LOCALSAINTSJOINPROP'];?>"></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>

                        
   

                        <?php 
								$query = mysql_query("select SUM(NEWHOMESMTG) AS 	NEWHOMESMTG from weekspropagation")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">New Home Meeting</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['NEWHOMESMTG'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-store-alt fa-4x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>

                        <?php 
								$query = mysql_query("select SUM(NSMALLGMTG) AS 	NSMALLGMTG from weekspropagation ")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">New Small Group Meeting</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['NSMALLGMTG'];?>"></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-store-alt fa-4x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>

                        <?php 
								$query = mysql_query("select SUM(TEAMHOURS) AS TEAMHOURS from weekspropagation")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Trainee Team Hours</div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['TEAMHOURS'];?>"></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php }?>

<!-- summary result -->

<?php 
								$query = mysql_query("Select * from recoversaints")or die(mysql_error());
                $count_recover = mysql_num_rows($query);
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Recovered Saints</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo  $count_recover;?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php ?>



          <?php 
								$query = mysql_query("select * from prospect_train")or die(mysql_error());
                $count_prospect = mysql_num_rows($query);
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Prospect Trainees</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $count_prospect;?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php ?>
          <?php 
								$query = mysql_query("select * from establish_local")or die(mysql_error());
                $count_establishlocal = mysql_num_rows($query);
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Establish Locality</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $count_establishlocal;?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php ?>

          <?php 
								$query = mysql_query("select * from recoverlocal")or die(mysql_error());
                $count_recoverloc = mysql_num_rows($query);
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Recovered Locality</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $count_recoverloc;?>"></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php ?>

          <?php 
								$query = mysql_query("select * from establish_dist")or die(mysql_error());
                $count_establishdist = mysql_num_rows($query);
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Establish District</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $count_establishdist;?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php ?>

          <?php 
								$query = mysql_query("select * from rec_district")or die(mysql_error());
                $count_recdistrict = mysql_num_rows($query);
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Recovered District</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $count_recdistrict;?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php ?>


             

          
              
    
<break>
         


            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
        
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
            
                    </div>
                    <div class="col-auto">
                   
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<div class="container">

  <canvas  class="chartjs-render-monitor" id="myChart" width="400" height="140"></canvas>
