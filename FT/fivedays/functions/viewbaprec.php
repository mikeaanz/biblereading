
    

<!-- 
<?php    

 $query = mysql_query("SELECT * from baptism_rpt where baptism_id='' ")or die(mysql_error());
                             // $data=mysql_fetch_assoc($query);

                         

                 $data = mysql_fetch_array($query);

                  ?>

<input type="text" name="" value='<?php echo $data['gender']; ?>'>


  
 -->
    
<!-- 
          <input type="hidden" name="id" value="<?php echo $get_id;?>">
          <input type="text" name="brother" value="<?php echo $row_week['BROBAPTISM'];?>">
          <input type="text" name="sister" value="<?php echo $row_week['SISBAPTISM'];?>">

 -->

      <form  method="post" enctype="multipart/form-data">
<!-- Delete Modal Accounts -->
<div class="modal fade" id="show_<?php echo $row['baptism_id']; ?>"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="exampleModalLabel">View Baptism Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-eye fa-4x mb-4 text-primary" aria-hidden="true"></i>

      <input type="hidden" name="gender" value="<?php echo $row['gender'];?>">
          <input type="hidden" name="ids" value="<?php echo $row['baptism_id'];?>">

        <div class="form-group">
    <label for="exampleInputEmail1">Full Name</label>
    <input type="text" name="address" class="form-control" id="exampleInputEmail1" value='<?php echo $row['FullName'];?>'  placeholder="Ex.Navotas City, District 4" disabled>

  </div>
       <div class="form-group">
    <label for="exampleInputEmail1">Saint Gender</label>
    <input type="text" name="address" class="form-control" id="exampleInputEmail1" value='<?php echo $row['Gender'];?>'  placeholder="Ex.Navotas City, District 4" disabled>

  </div>

     <div class="form-group">
    <label for="exampleInputEmail1">Contact Number</label>
    <input type="text" name="address" class="form-control" id="exampleInputEmail1" value='<?php echo $row['ContactNumber'];?>'  placeholder="Ex.Navotas City, District 4" disabled>

  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" name="address" class="form-control" id="exampleInputEmail1" value='<?php echo $row['address'];?>' placeholder="Ex.Navotas City, District 4" disabled>

  </div>

      <div class="form-group">
    <label for="exampleInputEmail1">Baptism</label>
    <input type="text" name="address" class="form-control" id="exampleInputEmail1" value='<?php echo $row['date_baptize'];?>'  placeholder="Ex.Navotas City, District 4" disabled>

  </div>

      <div class="form-group">
    <label for="exampleInputEmail1">Status</label>
    <input type="text" name="address" class="form-control" id="exampleInputEmail1" value='<?php echo $row['saints_legend'];?>'  placeholder="Ex.Navotas City, District 4" disabled>

  </div>

        <div class="form-group">
    <label for="exampleInputEmail1">Shepherding Material</label>
    <input type="text" name="address" class="form-control" id="exampleInputEmail1" value='<?php echo $row['shepmaterial'];?>'  placeholder="Ex.Navotas City, District 4" disabled>

  </div>

         <div class="form-group">
    <label for="exampleInputEmail1">Propagation Period</label>
    <input type="text" name="address" class="form-control" id="exampleInputEmail1" value='<?php echo $row['MONTH'];?> <?php echo $row['YR']; ?> <?php echo  $row['BATCH'];?>'  placeholder="Ex.Navotas City, District 4" disabled>

  </div>

        </div>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-eye-slash"> Close</i></button>
    

        <?php 
  $query_weekss = mysql_query("SELECT * FROM weekspropagation WHERE  historyfeedback_id='$get_id'")or die(mysql_error());
     $num_row_weeksss = mysql_num_rows($query_weekss);
        $row_week = mysql_fetch_array($query_weekss);
?> 

  <input type="hidden" name="id" value="<?php echo $get_id;?>">
    <input type="hidden" name="brother" value="<?php echo $row_week['BROBAPTISM'];?>">
       <input type="hidden" name="sister" value="<?php echo $row_week['SISBAPTISM'];?>">
      </div>
    </div>
  </div>
</div>
<!--End of Modal Delete---->
</form>
