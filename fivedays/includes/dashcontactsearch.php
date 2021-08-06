
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">


      

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
     


  
          <!-- Topbar Search -->
     <form method="POST" action="contactdash.php" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
            <label for="" class="m-1 font-weight-bold text-primary"></label>
            <select name="batch" class="browser-default custom-select" required> 
   
         <option value="">Select Term</option>
		 <?php 
		 $result = mysql_query("SELECT * FROM batch order by id asc
		 ")or die(mysql_error());


         while($rows = mysql_fetch_array($result))
         {
          ?>
          <option><?php echo $rows['BATCH']; ?></option>
          <?php } ?>
                                </select>


                                &nbsp;
 <select name="month" class="browser-default custom-select" required> 
   
   <option value="">Select Month</option>
   <?php 
   $result = mysql_query("SELECT * FROM month order by id asc
   ")or die(mysql_error());


   while($rows = mysql_fetch_array($result))
   {
    ?>
    <option><?php echo $rows['MONTH']; ?></option>
    <?php } ?>
                          </select>      
                          &nbsp;
 <select name="year" class="browser-default custom-select" required> 
   
   <option value="">Select Year</option>
   <?php 
   $result = mysql_query("SELECT * FROM YEAR order by id asc
   ")or die(mysql_error());


   while($rows = mysql_fetch_array($result))
   {
    ?>
    <option><?php echo $rows['YR']; ?></option>
    <?php } ?>
                          </select>
                          &nbsp;
                          <div class="input-group-append">
              <button class="btn btn-primary" type="submit"> 
                <i class="fas fa-search fa-sm"></i> 
                </button>
        </form>
          
              </div>
            </div> 



          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form method="POST" action="contactdash.php" class="form-inline mr-auto w-100 navbar-search">

            <div class="input-group">
            <label for="" class="m-1 font-weight-bold text-primary"></label>
            <select name="batch" class="browser-default custom-select" required> 
   
         <option value="">Select Term</option>
		 <?php 
		 $result = mysql_query("SELECT * FROM batch order by id asc
		 ")or die(mysql_error());


         while($rows = mysql_fetch_array($result))
         {
          ?>
          <option><?php echo $rows['BATCH']; ?></option>
          <?php } ?>
                                </select>


                                &nbsp;
 <select name="month" class="browser-default custom-select" required> 
   
   <option value="">Select Month</option>
   <?php 
   $result = mysql_query("SELECT * FROM month order by id asc
   ")or die(mysql_error());


   while($rows = mysql_fetch_array($result))
   {
    ?>
    <option><?php echo $rows['MONTH']; ?></option>
    <?php } ?>
                          </select>      
                          &nbsp;
 <select name="year" class="browser-default custom-select" required> 
   
   <option value="">Select Year</option>
   <?php 
   $result = mysql_query("SELECT * FROM YEAR order by id asc
   ")or die(mysql_error());


   while($rows = mysql_fetch_array($result))
   {
    ?>
    <option><?php echo $rows['YR']; ?></option>
    <?php } ?>
                          </select>
                
                
                  <!-- <div class="input-group"> -->
                    <!-- <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"> -->
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <?php
			$req_query = mysql_query("select * from requestdata where receiver_id = '$session_id' and request_status != '1'")or die(mysql_error());

        $count_req = mysql_num_rows($req_query);
      $rows = mysql_fetch_array($req_query);

			?>

            <li class="nav-item dropdown no-arrow mx-1">
              <!-- <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i> -->
                <!-- Counter - Alerts -->
   
      <?php if($count_req =='0'){

      }else{?>
                <span class="badge badge-danger badge-counter"><?php echo $count_req; ?></span>
              </a>
      <?php }?>
             
             
 
  
    <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
               
                <h6 class="dropdown-header">
                  Request Center Notification                  
                    <?php
                          $limit=5;
                          $content = mysql_query("select * from requestdata where receiver_id = '$session_id' ORDER BY  request_id DESC limit $limit ")or die(mysql_error());
                          while($show = mysql_fetch_array($content)){
                            
                    ?> 
                </h6>
      
                <a class="dropdown-item d-flex align-items-center" href="#"   >
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-plane text-white"></i>
                    </div>

                  </div>
                  <div>          
                    <div class="small text-gray-500"><?php echo $show['date_requested'];?></div>
                    <span class="font-weight-bold"><?php echo $show['content'];?></span>
                  </div>
                </a>
                <?php }?>
<!--              
             <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>  -->




                <a class="dropdown-item text-center small text-gray-500" href="requestingnotif.php">Show All Alerts</a>
              </div>
            </li>

    

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <!-- <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i> -->
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter"></span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php
              /* Check accounts if is in the database */
                  $query= mysql_query("select * from accounts where id = '$session_id'")or die(mysql_error());
                  $row = mysql_fetch_array($query);
                  $check= $row['LOCALITY'];//connect to querys
                  $userlevel=$row['USER_LEVEL'];// connect to userlevel
        
                /*check locality */
                  $querys= mysql_query("select * from Locality where ID = '$check'")or die(mysql_error());
                  $locality = mysql_fetch_array($querys);

                /*check userlevel*/
                $userlevel= mysql_query("select * from userlevel where ID = '$userlevel'")or die(mysql_error());
                $user = mysql_fetch_array($userlevel);
          
							?>
                
                
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                Team : <?php echo $locality ['PLACES']; ?> <?php  echo $user['LEVEL'];?> 
                
                
                </span>
                <img class="img-profile rounded-circle " src="img/fttma.jpg">
                
              </a>
                       <!-- Dropdown - User Information -->
                       <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a> -->
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalCenter">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Change Password
                </a>
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

<?php include 'includes/modalpassword.php'; ?>
 