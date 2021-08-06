<?php include('includes/header.php');?>
<?php include('includes/sidenav.php');?>


<div>
<center><h1>Propagation Data</h1><center>
</div>
<br>
<div class="container">
<div class="form-group">
	    	<label class="control-label" for="Prop_code">Propapagation Area:</label>
			<input  class="form-control form-control-lg" name="Prop_code" id="Prop_code" type="text" disabled />
	
			<label class="control-label" for="Prop_code">Propagation type:</label>
            <input class="form-control form-control-lg" name="Prop_type" id="Prop_code" type="text" disabled  />
            
			<label class="control-label" for="cost" >No. of Baptisms (Brothers):</label>
			<input class="form-control form-control-lg" name="bapbro" id="cost" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3"  />



		    <label class="control-label" for="price">No. of Baptisms (Sisters):</label>
			<input class="form-control form-control-lg"  name="bapsis" id="price" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" >No. of Recovered Saints (Brothers):</label>
			<input class="form-control form-control-lg" name="recbro" id="price" type="text" onfocus="this.value=''" onkeypress="return isNumberKey(event)" maxlength="3"  />


			<label class="control-label" >No. of Recovered Saints (Sisters):</label>
			<input class="form-control form-control-lg" name="recsis" id="price" type="text" onfocus="this.value=''" onkeypress="return isNumberKey(event)" maxlength="3"  />

			<label class="control-label" >Total New Home Meetings Established:</label>
			<input class="form-control form-control-lg" name="newhome" id="price" type="text" onfocus="this.value=''" onkeypress="return isNumberKey(event)" maxlength="3"  />
		
							
			<label class="control-label" for="price">Total New Small Group Meetings Established:</label>
			<input class="form-control form-control-lg" name="newsmall" id="price" type="text" onfocus="this.value=''"  maxlength="3"  />


					<label class="control-label" for="price">Average LTM Attendance:</label>
			<input class="form-control form-control-lg" name="ltm" id="price" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3"  />

			
			<label class="control-label" for="price"> Local Saints joining propagation:</label>
			<input class="form-control form-control-lg" name="saint" id="price" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3"  />

			
			<label class="control-label" for="price">Establish Locality:</label>
			<input class="form-control form-control-lg" name="estlocal" id="price" type="text"  />


			<label class="control-label" for="price">Recovered Locality:</label>
			<input class="form-control form-control-lg" name="reclocal" id="price" type="text"  />


			<label class="control-label" for="price">Established District:</label>
			<input class="form-control form-control-lg" name="estdis" id="price" type="text"  />

			<label class="control-label" for="price">Recovered District:</label>
			<input class="form-control form-control-lg" name="recdis" id="price" type="text"  maxlength="3"  />

			<label class="control-label" for="price">Prospect Trainees for Incoming Term (Brothers):</label>
			<input class="form-control form-control-lg"  name="probro" id="price" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3" />


			<label class="control-label" for="price">Prospect Trainees for Incoming Term (Sisters):</label>
			<input class="form-control form-control-lg" name="prosis" id="price" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3"  />

		

			<input class="form-control form-control-lg" name="Time" id="price" type="hidden" value="<?php echo date('m/d/Y h:i:s a', time());  ?>" />


			<input class="form-control form-control-lg" name="id" type="hidden" value="<?= $id ?>" />
		    </div>
	</div>
	
<script type="application/javascript">

  function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
      }
</script>			
    <div class="col text-center">		
    <button type="button" class="btn btn-primary btn-lg" ><i class="fa fa-plus"></i>ADD</button>
</form>
</div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>


  <?php include('includes/footer.php');?>
  <?php include('includes/logoutmodal.php');?>