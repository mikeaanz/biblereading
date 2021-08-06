



<div class="col-xl-3 col-lg-5">
  <div class="card shadow mb-4">
   <center> <h6 class="m-3 font-weight-bold text-primary">Create Account</h6></center>  

   <!--Here yours Manipulation Data for Tables inner join call three table at the same time  ---->

                        <!--END OF CODE ---->

<form method="POST">

    <!-- Card Body -->

    <div class="card-body">




    <label class="control-label" for="cost" >Usermame :</label>
			<input class="form-control form-control-sm" name="username" id="cost" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="10"   required/>



		    <label class="control-label" for="price">Password :</label>
			<input class="form-control form-control-sm"  name="password" id="price" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="10"   required/>
&nbsp; 

		
                <div class="form-group ">
                  <Select class="selectpicker" data-live-search="true" data-size="6" data-width="99%" name="userlevel" id="selectpicker" required>
                              <option  disabled>Select Your User Level</option>
                              <?php
                                  $query = mysql_query("select * from userlevel where LEVEL='WEEKEND' or LEVEL='LONG PROPAGATION' or LEVEL='5 DAYS PROPAGATION' ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['LEVEL']; ?></option>
                               <?php
                    }
                                 ?>
                              
                  </select>
                </div>

                       <Select class="form-control selectpicker text-center" data-live-search="true" data-size="6" data-width="99%" name="locality" id="selectpicker"  required>
                              <option class="text-center"  disabled>Select Your Locality</option>
                              <?php
                                  $query = mysql_query("select * from locality order by ID DESC ")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>" class="text-center"><?php echo $row['PLACES']; ?> </option>
                               <?php
                    }
                                 ?>
                              
                  </select>

                 <div class="form-group">
                  <input name="datecreated" id="datecreated" class="form-control form-control-user"  type="HIDDEN" value="<?php echo date('m/d/Y h:i:s a', time());  ?>" />
                   </div>

<!-- 
			<label class="control-label" >Date Created :</label>
      <input class="form-control form-control-sm" name="recsis" id="price" type="text" onfocus="this.value=''" onkeypress="return isNumberKey(event)" maxlength="3" value='<?php echo $row['DATE_CREATED']; ?>'  required/>
      
			<label class="control-label" >Date Activated :</label>
			<input class="form-control form-control-sm" name="recsis" id="price" type="text" onfocus="this.value=''" onkeypress="return isNumberKey(event)" maxlength="3" value='<?php echo $row['DATE_ACTIVATED']; ?>'  required/> -->



            <div class="form-group">
			<label class="control-label" >Mode Status :</label>
                  <Select class="browser-default custom-select" name="stat" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from Status")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['ACTION']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>


                  <br>

      <br>
      <div class="col text-center">	
      <a  href="#success"  class="btn btn-primary  btn-smll"  data-toggle="modal"  data-target="#success" ><i class="fa fa-user"></i> Create</a>
      </div>
      
      </div>
      </div>
      </div>
      </div>
                                                    <?php ?>


                                                    

<!-- Submit Modal Accounts -->
<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="samplemodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="samplemodal">Create Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-user fa-4x mb-4 text-primary" aria-hidden="true"></i>
       <h5 > Are you sure you want to Create this account? </h5>
       &nbsp; 
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="success_user" class="btn btn-primary"><i class="icon-check icon-large"></i> Yes</button>
      </div>
    </div>
  </div>
</div>
</form>

<?php 


if(isset($_POST['success_user'])){



  $username = $_POST['username'];
  $password = $_POST['password'];
  $userlevel = $_POST['userlevel'];
  $locality = $_POST['locality'];
    $stat = $_POST['stat'];
  $datecreated=$_POST['datecreated'];
  
  
  /*this is to cheack if your username already exist*/
  $query = mysql_query("select * from accounts where USERNAME='$username'")or die(mysql_error());
  $row = mysql_fetch_array($query);
  $id = $row['ID'];
  $count = mysql_num_rows($query);
  
  
  
  /* insert data 
  $insert = mysql_query("INSERT INTO `accounts`(`USERNAME`, `PASSWORD`, `USER_LEVEL`, `LOCALITY`, `DATE_CREATED`, `STATUS`) 
  VALUES ('$username','$password','$userlevel','$locality','$datecreated','1')")or die(mysql_error());
  $insertrow = mysql_fetch_array($query);
  $idrows = $insertrow['ID'];
  $countrow = mysql_num_rows($insert);
  */
  
  if ($count > 0){
    echo 'True';
    echo '<script>  swal({title: "Notice!",text: "Username Already Existed!.",customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "error"},function(){window.open("accountactivation.php","_self")});</script>';
    exit();
  
               
      }else{
        mysql_query("INSERT INTO `accounts`(`USERNAME`, `PASSWORD`, `USER_LEVEL`,`LOCALITY`,`DATE_CREATED`, `STATUS`) 
        VALUES ('$username','$password','$userlevel','$locality','$datecreated','$stat')")or die(mysql_error());
  

    echo '<script> swal({title: "Praise the Lord!",text: "Registered Successfully!", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("accountactivation.php","_self")});</script>';
  
  
  
      exit();
    }
  }
  
  ?>
<!--End of Modal Delete---->