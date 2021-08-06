

<!-- Delete Modal Accounts -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-danger">
        <h5 class="modal-title" style='color:#F8FAFB'   id="exampleModalLabel">Warning!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
      <i class="fas fa-times fa-4x mb-4 text-danger" aria-hidden="true"></i>
      <div class="form-group">
			<label class="control-label" >Month :</label>
                  <Select class="browser-default custom-select" name="month" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from month order by ID ASC")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['MONTH']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>

                  
    <div class="form-group">
			<label class="control-label" >Year :</label>
                  <Select class="browser-default custom-select" name="year" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from year order by ID ASC")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['YR']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>

                                    
    <div class="form-group">
			<label class="control-label" >Batch :</label>
                  <Select class="browser-default custom-select" name="batch" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from batch order by ID ASC")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['BATCH']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>



            <div class="form-group">
			<label class="control-label" >Mode Status :</label>
                  <Select class="browser-default custom-select" name="stat" id="userlevel" required>

                     <option  disabled>Select Mode Status</option>
                              <?php
                                  $query = mysql_query("select * from userlevel where ID='2' or ID='3' or ID='4'")or die(mysql_error());
                                  while($row = mysql_fetch_array($query)){
                                  ?>
                                 <option value="<?php  echo $row['ID']; ?>"><?php echo $row['LEVEL']; ?></option>
                                 <?php
                    }
                                 ?>
                              
                  </select>

      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="delete_user" class="btn btn-danger"><i class="icon-check icon-large"></i> Yes</button>
      </div>
    </div>
  </div>
</div>
<!--End of Modal Delete---->


