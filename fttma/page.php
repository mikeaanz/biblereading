
        <!-- Begin Page Content -->
        <div class="container"
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
<!-- 
     <a id="btnGenerateReport" href="#"  onclick="window.open('allpdf.php?SessionId=<?php echo $session_id; ?>', 'newwindow', 'width=900, height=600'); return false;" class="d-show d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>  -->
            

            
            </div>


          <!-- Content Row -->
          <div class="row">
          <?php 
								$query = mysql_query("select SUM(BROBAPTISM) AS BROBAPTISM from weekspropagation where accounts_id='$session_id' ")or die(mysql_error());
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
								$query = mysql_query("select SUM(SISBAPTISM) AS SISBAPTISM from weekspropagation  where accounts_id='$session_id'  ")or die(mysql_error());
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
								$query = mysql_query("select SUM(BROBAPTISM+SISBAPTISM) AS overall from weekspropagation  where accounts_id='$session_id'  ")or die(mysql_error());
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
								$query = mysql_query("select SUM(HOMESKNOCK) AS HOMESKNOCK from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Homes Knocked </div>
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
								$query = mysql_query("select SUM(HOMESPREACH) AS HOMESPREACH from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Homes Preached </div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['HOMESPREACH'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-microphone fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php }?>


          <?php 
								$query = mysql_query("select SUM(PCONTACTED) AS PCONTACTED from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
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
                                  <i class="fas fa-phone fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php }?>

          <?php 
								$query = mysql_query("select SUM(RECEIVEDGOSPEL) AS RECEIVEDGOSPEL from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Person received the gospel/called</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['RECEIVEDGOSPEL'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fa fa-assistive-listening-systems fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php }?>

          <?php 
								$query = mysql_query("select SUM(GOPENFOLLOW) AS GOPENFOLLOW from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Gospel Friend Open for Follow-up</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['GOPENFOLLOW'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-handshake fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php }?>


     

                        

     

                        
   

                        <?php 
								$query = mysql_query("select SUM(NEWHOMESMTG) AS 	NEWHOMESMTG from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">New Home Meeting Started</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['NEWHOMESMTG'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-store fa-4x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>


                        <?php 
								$query = mysql_query("select SUM(TOTALHOMESMTG) AS 	TOTALHOMESMTG from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Home Meeting held</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['TOTALHOMESMTG'];?>">0</div>
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
								$query = mysql_query("select SUM(TOTALHOMESMTG) AS 	TOTALHOMESMTG from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Person Home Meeting</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['TOTALHOMESMTG'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-user-plus fa-4x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>

                        <?php 
								$query = mysql_query("select SUM(PVISITEDNOTHMEET) AS 	PVISITEDNOTHMEET from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Person Visited but Not Home Meeting</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['PVISITEDNOTHMEET'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="  fas fa-user-secret fa-4x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>

                        <?php 
								$query = mysql_query("select SUM(NSMALLGMTG) AS 	NSMALLGMTG from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">New Small Group Meeting Established</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['NSMALLGMTG'];?>"></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-university fa-4x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>

                        <?php 
								$query = mysql_query("select SUM(SMALLGMTGHELD) AS 	SMALLGMTGHELD from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Small Group Meeting Held</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['SMALLGMTGHELD'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-universal-access fa-4x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>

                        <?php 
								$query = mysql_query("select SUM(LOCALATTSMLMTG) AS 	LOCALATTSMLMTG from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Local Saint Attending Small Group Meetings</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['LOCALATTSMLMTG'];?>">0</div>
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
								$query = mysql_query("select SUM(LOCALSAINTSJOINPROP) AS LOCALSAINTSJOINPROP from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
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
                                  <i class="fas fa-user-circle fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>


                        <?php 
								$query = mysql_query("SELECT SUM(MANHOURS) AS manhours from weekspropagation where accounts_id='$session_id'")or die(mysql_error());
								while($row=mysql_fetch_array($query)){
								?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Man Hours of Local Saints Joining Propagation</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['manhours'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class=" 	fas fa-street-view fa-4x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>

                        <?php 
                        $sett='SET @rowindex := -1';
								$query = mysql_query(
                 "select ROUND(AVG(LTM)) as ltm  from weekspropagation
                        inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                        inner join month on month.id=historyfeedback.MONTH
                        inner join year on year.id=historyfeedback.YEAR 
                        inner join batch on batch.id=historyfeedback.BATCH 
                        inner join week on week.id=historyfeedback.WEEK
                        inner join userlevel on userlevel.id=historyfeedback.acc_id 
                        inner join status on status.id=historyfeedback.status_id
                     where accounts_id='$session_id'")or die(mysql_error());
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
								$query = mysql_query("select SUM(TEAMHOURS) AS TEAMHOURS from weekspropagation where accounts_id='$session_id'   ")or die(mysql_error());
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
                                  <i class="fas fa-address-card fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          <?php }?>

<!-- summary result -->

<?php 
								$query = mysql_query("Select * from recoversaints where acc_id='$session_id'   ")or die(mysql_error());
                $count_recover = mysql_num_rows($query);
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <!-- <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Recovered Saints</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo  $count_recover;?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->
          <?php ?>



          <?php 
								$query = mysql_query("select * from prospect_train where acc_id='$session_id'   ")or die(mysql_error());
                $count_prospect = mysql_num_rows($query);
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <!-- <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Prospect Trainees</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_prospect;?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->
          <?php ?>
          <?php 
								$query = mysql_query("select * from establish_local where acc_id='$session_id'   ")or die(mysql_error());
                $count_establishlocal = mysql_num_rows($query);
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <!-- <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Establish Locality</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_establishlocal;?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->
          <?php ?>

          <?php 
								$query = mysql_query("select * from recoverlocal where acc_id='$session_id'   ")or die(mysql_error());
                $count_recoverloc = mysql_num_rows($query);
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <!-- <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Recovered Locality</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_recoverloc;?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->
          <?php ?>

          <?php 
								$query = mysql_query("select * from establish_dist where acc_id='$session_id'   ")or die(mysql_error());
                $count_establishdist = mysql_num_rows($query);
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <!-- <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Establish District</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_establishdist;?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->
          <?php ?>

          <?php 
								$query = mysql_query("select * from rec_district where acc_id='$session_id'   ")or die(mysql_error());
                $count_recdistrict = mysql_num_rows($query);
								?>

                              <!-- Earnings (Monthly) Card Example -->
                              <!-- <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Recovered District</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_recdistrict;?></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-3x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->
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


          