
        <!-- Begin Page Content -->
        <div class="container"
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
                 <h1 class="h3 mb-0 text-gray-800"></h1>
            <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->

 


              <?php
            $term = $_POST['batch'];

                        // $month = $_POST['month'];    
             $qwery= mysql_query("select PLACES,USER_LEVEL from accounts AS accnt INNER JOIN locality AS lc ON lc.ID = accnt.locality WHERE accnt.id ='$session_id'")or die(mysql_error());
  $rowz = mysql_fetch_array($qwery);
                        // $year = $_POST['year'];
                        // $level = $_POST['level'];
                        
            $termquery = mysql_query("SELECT * FROM batch,year,month,userlevel
                        where batch.BATCH='$term' and LEVEL='LONG PROPAGATION'
                      
                        ")or die(mysql_error());
            $propagation = mysql_fetch_array($termquery);




            ?>

        <a id="btnGenerateReport" href="#"  onclick="window.open('rptlongprop.php?SessionId=<?php echo $session_id; ?>&TermNumber=<?php echo $term ?>&locality=<?php echo $rowz['PLACES'];?>', 'newwindow', 'width=900, height=600'); return false;" class="d-show d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>


            
            
            </div>


        
          
         <ul class="breadcrumb">





              <li><a href="#"><b>My Propagation Report</b></a><span class="divider">/</span></li>
              <li><a href="#"><?php echo $propagation['BATCH']; ?> term    <?php echo $rowz['PLACES']; ?>  <?php echo $propagation['LEVEL']; ?> 

      
                          
                           </a></li>
            </ul>
          <!-- Content Row -->
          <div class="row">
          <?php 

             // $query = mysql_query("SELECT * from baptism_rpt
             //                    -- inner join accounts on weekspropagation.accounts_id=accounts.id 
             //                    -- inner join locality on locality.id=accounts.LOCALITY
             //                    inner join historyfeedback on baptism_rpt.curteam_id=historyfeedback.id 
             //                    inner join month on month.id=historyfeedback.MONTH
             //                    inner join year on year.id=historyfeedback.YEAR 
             //                    inner join batch on batch.id=historyfeedback.BATCH 
             //                    inner join week on week.id=historyfeedback.WEEK
             //                    inner join userlevel on userlevel.id=historyfeedback.acc_id 
             //                    inner join status on status.id=historyfeedback.status_id 
             //                      where  baptism_rpt.acc_id='$session_id' and batch.BATCH='$term' and userlevel.LEVEL='LONG PROPAGATION' and baptism_rpt.gender='1'
               
             //                    ")or die(mysql_error());
             //                    $brother = mysql_num_rows($query);
                                $query = mysql_query("SELECT SUM(BROBAPTISM) AS BROBAPTISM from weekspropagation
                                -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                -- inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC
                                ")or die(mysql_error());
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

                        // $query = mysql_query("SELECT * from baptism_rpt
                        //         -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                        //         -- inner join locality on locality.id=accounts.LOCALITY
                        //         inner join historyfeedback on baptism_rpt.curteam_id=historyfeedback.id 
                        //         inner join month on month.id=historyfeedback.MONTH
                        //         inner join year on year.id=historyfeedback.YEAR 
                        //         inner join batch on batch.id=historyfeedback.BATCH 
                        //         inner join week on week.id=historyfeedback.WEEK
                        //         inner join userlevel on userlevel.id=historyfeedback.acc_id 
                        //         inner join status on status.id=historyfeedback.status_id 
                        //           where  baptism_rpt.acc_id='$session_id' and batch.BATCH='$term' and userlevel.LEVEL='LONG PROPAGATION' and baptism_rpt.gender='2'
               
                        //         ")or die(mysql_error());
                        //         $sister = mysql_num_rows($query);


                                $query = mysql_query("SELECT SUM(SISBAPTISM) AS SISBAPTISM from weekspropagation
                                --  inner join accounts on weekspropagation.accounts_id=accounts.id 
                                --  inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                            where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC
                                
                                ")or die(mysql_error());
                while($row=mysql_fetch_array($query)){
                ?>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-danger shadow h-100 py-2">
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




                   // $query = mysql_query("SELECT * from baptism_rpt
                   //              -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                   //              -- inner join locality on locality.id=accounts.LOCALITY
                   //              inner join historyfeedback on baptism_rpt.curteam_id=historyfeedback.id 
                   //              inner join month on month.id=historyfeedback.MONTH
                   //              inner join year on year.id=historyfeedback.YEAR 
                   //              inner join batch on batch.id=historyfeedback.BATCH 
                   //              inner join week on week.id=historyfeedback.WEEK
                   //              inner join userlevel on userlevel.id=historyfeedback.acc_id 
                   //              inner join status on status.id=historyfeedback.status_id 
                   //                where  baptism_rpt.acc_id='$session_id' and batch.BATCH='$term' and userlevel.LEVEL='LONG PROPAGATION'
               
                   //              ")or die(mysql_error());
                   //              $ss = mysql_num_rows($query);

                                $query = mysql_query("SELECT SUM(BROBAPTISM+SISBAPTISM) AS overall from weekspropagation
                                -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                -- inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                         where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC
                                ")or die(mysql_error());
                while($row=mysql_fetch_array($query)){
                ?>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Baptism</div>
                                                  <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo   $row['overall'];?>">0</div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-users fa-4x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                  <?php } ?>

                
                  <?php 
                                $query = mysql_query("SELECT SUM(HOMESKNOCK) AS HOMESKNOCK from weekspropagation
                                -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                --  inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                         where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC
                                ")or die(mysql_error());
                while($row=mysql_fetch_array($query)){
                ?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Homes Knock </div>
                                       <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['HOMESKNOCK'];?>"></div>
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
                                $query = mysql_query("SELECT SUM(HOMESPREACH) AS HOMESPREACH from weekspropagation
                                -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                -- inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                         where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC
                                ")or die(mysql_error());
                while($row=mysql_fetch_array($query)){
                ?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Homes Preach </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['HOMESPREACH'];?>"></div>
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
                                $query = mysql_query("SELECT SUM(PCONTACTED) AS PCONTACTED from weekspropagation
                                -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                -- inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                         where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC
                                ")or die(mysql_error());
                while($row=mysql_fetch_array($query)){
                ?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Person Contacted</div>
                                   <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['PCONTACTED'];?>"></div>
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
                                $query = mysql_query("SELECT SUM(RECEIVEDGOSPEL) AS RECEIVEDGOSPEL from weekspropagation
                            --      inner join accounts on weekspropagation.accounts_id=accounts.id 
                            --    inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                         where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC
                                ")or die(mysql_error());
                while($row=mysql_fetch_array($query)){
                ?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Person   received the gospel/called</div>
                                                          <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['RECEIVEDGOSPEL'];?>"></div>
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
                                $query = mysql_query("SELECT ROUND(AVG(LTM)) as ltm  from weekspropagation
                                -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                --  inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                         where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC
                                ")or die(mysql_error());
                while($row=mysql_fetch_array($query)){
                ?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-dark shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Average LTM</div>
                                      <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['ltm'];?>"></div>
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
                                $query = mysql_query("SELECT SUM(LOCALSAINTSJOINPROP) AS LOCALSAINTSJOINPROP from weekspropagation
                                --  inner join accounts on weekspropagation.accounts_id=accounts.id 
                                -- inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                      where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC
                                ")or die(mysql_error());
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
                                $query = mysql_query("SELECT SUM(NEWHOMESMTG) AS  NEWHOMESMTG from weekspropagation
                                -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                --  inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                       where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC
                                ")or die(mysql_error());
                while($row=mysql_fetch_array($query)){
                ?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">New Home Meeting</div>
                                                             <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['NEWHOMESMTG'];?>"></div>
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
                $query = mysql_query("SELECT SUM(NSMALLGMTG) AS   NSMALLGMTG from weekspropagation 
                                --     inner join accounts on weekspropagation.accounts_id=accounts.id 
                                --  inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC")or die(mysql_error());
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
                                  <i class="fas fa-users fa-4x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>


                                   <?php 
                $query = mysql_query("SELECT SUM(SMALLGMTGHELD) AS   SMALLGMTGHELD from weekspropagation 
                                --     inner join accounts on weekspropagation.accounts_id=accounts.id 
                                --  inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC")or die(mysql_error());
                while($row=mysql_fetch_array($query)){
                ?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Small Group Meeting Held</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['SMALLGMTGHELD'];?>"></div>
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
                $query = mysql_query("SELECT SUM(LOCALATTSMLMTG) AS   LOCALATTSMLMTG from weekspropagation 
                                --     inner join accounts on weekspropagation.accounts_id=accounts.id 
                                --  inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC")or die(mysql_error());
                while($row=mysql_fetch_array($query)){
                ?>
                                   <!-- Earnings (Monthly) Card Example -->
                                   <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-dark shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Local Saints Attending Small Group Meeting</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $row['LOCALATTSMLMTG'];?>"></div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-home fa-4x text-dark-300"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php }?>

                        <?php 
                                $query = mysql_query("SELECT ROUND(AVG(TEAMHOURS)) AS TEAMHOURS from weekspropagation
                                --  inner join accounts on weekspropagation.accounts_id=accounts.id 
                                -- inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                               where  accounts_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                                ORDER BY weekspropagation.id_weekprop DESC
                                
                                ")or die(mysql_error());
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
                                $query = mysql_query("SELECT * from recoversaints  
                                --   inner join accounts on weekspropagation.accounts_id=accounts.id 
                                -- inner join locality on locality.id=accounts.LOCALITY
                     inner join historyfeedback on historyfeedback.id=recoversaints.historyfeedback
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                 where  recoversaints.acc_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                             ")or die(mysql_error());
                $count_recover = mysql_num_rows($query);
                ?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-dark shadow h-100 py-2">
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
                $query = mysql_query("SELECT * from prospect_train 
                                -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                -- inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on prospect_train.historyfeedback=historyfeedback.id 
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                   where  prospect_train.acc_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                               ")or die(mysql_error());
                $count_prospect = mysql_num_rows($query);
                ?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-dark shadow h-100 py-2">
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
                                $query = mysql_query("SELECT * from establish_local
                                -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                -- inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on establish_local.historyfeedback=historyfeedback.id 
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                 where  establish_local.acc_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                            
                                ")or die(mysql_error());
                $count_establishlocal = mysql_num_rows($query);
                ?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-darger shadow h-100 py-2">
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
                                $query = mysql_query("SELECT * from recoverlocal
                                -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                -- inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on recoverlocal.historyfeedback=historyfeedback.id 
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                  where  recoverlocal.acc_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                  
                                ")or die(mysql_error());
                $count_recoverloc = mysql_num_rows($query);
                ?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-dark shadow h-100 py-2">
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
                                $query = mysql_query("SELECT * from establish_dist
                                -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                -- inner join locality on locality.id=accounts.LOCALITY
                               inner join historyfeedback on establish_dist.historyfeedback=historyfeedback.id 
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                  where  establish_dist.acc_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
                
                                ")or die(mysql_error());
                $count_establishdist = mysql_num_rows($query);
                ?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-warning shadow h-100 py-2">
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
                                $query = mysql_query("SELECT * from rec_district
                                -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                -- inner join locality on locality.id=accounts.LOCALITY
                                inner join historyfeedback on rec_district.historyfeedback=historyfeedback.id 
                                inner join month on month.id=historyfeedback.MONTH
                                inner join year on year.id=historyfeedback.YEAR 
                                inner join batch on batch.id=historyfeedback.BATCH 
                                inner join week on week.id=historyfeedback.WEEK
                                inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                inner join status on status.id=historyfeedback.status_id 
                                  where  rec_district.acc_id='$session_id' and batch.BATCH='$term'  and userlevel.LEVEL='LONG PROPAGATION'
               
                                ")or die(mysql_error());
                                $count_recdistrict = mysql_num_rows($query);
                ?>

                              <!-- Earnings (Monthly) Card Example -->
                              <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-secondary shadow h-100 py-2">
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



             <?php 
                                // $query = mysql_query("SELECT * from baptism_rpt
                                // -- inner join accounts on weekspropagation.accounts_id=accounts.id 
                                // -- inner join locality on locality.id=accounts.LOCALITY
                                // inner join historyfeedback on baptism_rpt.curteam_id=historyfeedback.id 
                                // inner join month on month.id=historyfeedback.MONTH
                                // inner join year on year.id=historyfeedback.YEAR 
                                // inner join batch on batch.id=historyfeedback.BATCH 
                                // inner join week on week.id=historyfeedback.WEEK
                                // inner join userlevel on userlevel.id=historyfeedback.acc_id 
                                // inner join status on status.id=historyfeedback.status_id 
                                //   where  baptism_rpt.acc_id='$session_id' and batch.BATCH='$term' and userlevel.LEVEL='LONG PROPAGATION'
               
                                // ")or die(mysql_error());
                                // $ss = mysql_num_rows($query);
                ?>

                              <!-- Earnings (Monthly) Card Example -->
      <!--                         <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Baptize Contact's</div>
                                                          <div class="h5 mb-0 font-weight-bold text-gray-800 counter" data-count="<?php echo $ss;?>">0</div>
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


          