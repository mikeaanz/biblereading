<form method="POST">
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
 <label class="control-label" >Switch to Area :</label>
                                         
                <select  class="selectpicker" data-live-search="true" name="locality" data-width="99%"  required>
                        
                                              <option></option>
                      <?php
                      $query = mysql_query("select * from locality");
                      while($row = mysql_fetch_array($query)){
                      
                      ?>
                      <option value="<?php echo $row['ID']; ?>">  <?php echo $row['PLACES']; ?> </option>
                      <?php } ?>
                                            </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="transfer" class="btn btn-primary"><i class="fa fa-exchange-alt"> Amen</i></button>

      </div>
    </div>
  </div>
</div>

</form>

<?php 
include('functions/db.php');

if (isset($_POST['transfer'])){
        $locality=$_POST['locality'];
   
        $act = "SELECT * FROM `teammate` WHERE teammate_id='$teammate_id'";
        $result = mysql_query($act)or die(mysql_error());
        $rows = mysql_fetch_array($result);
        $activated = mysql_num_rows($result);


   if($activated > 0){
           mysql_query("UPDATE `teammate` SET 
              locality_id='$locality' WHERE c_team_id='$teammate_id'")or die(mysql_error());

    echo '<script> swal({title: "Approve!",text: "Trainee Successfully Transfer to another locality!.", customClass: "swal-wide",
      confirmButtonColor: "#0BA9F9",type: "success"},function(){window.open("historypost.php","_self")});</script>';
    exit();
      }

    }
?>

