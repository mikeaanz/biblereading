<?php include('includes/header.php');?>
<?php include('includes/sidenav.php');?>
        
        <div class="control-group">
	    	<label class="control-label" for="Prop_code">Propapagation Area:</label>&nbsp;
			<input name="Prop_code" id="Prop_code" type="text" disabled value="<?= $result['place'] ?>" />
			<br><br>


			<label class="control-label" for="Prop_code">Propagation type:</label>&nbsp;
			<input name="Prop_type" id="Prop_code" type="text" disabled value="<?= $result['Prop_type'] ?>" />
			<br><br>



			<label class="control-label" for="cost" >No. of Baptisms (Brothers):</label>&nbsp;
			<input name="bapbro" id="cost" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3" value="<?php echo $result['bapbro'] ?>" />


			<br><br><br>

		    <label class="control-label" for="price">No. of Baptisms (Sisters):</label>&nbsp;
			<input name="bapsis" id="price" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3" value="<?php echo $result['bapsis'] ?>" />
			<br><br>

			<label class="control-label" >No. of Recovered Saints (Brothers):</label>&nbsp;
			<input name="recbro" id="price" type="text" onfocus="this.value=''" onkeypress="return isNumberKey(event)" maxlength="3" value="<?php echo $result['recbro'] ?>" /><br><br><br>


			<label class="control-label" >No. of Recovered Saints (Sisters):</label>&nbsp;
			<input name="recsis" id="price" type="text" onfocus="this.value=''" onkeypress="return isNumberKey(event)" maxlength="3" value="<?php echo $result['recsis'] ?>" /><br><br><br>

			<label class="control-label" >Total New Home Meetings Established:</label>&nbsp;
			<input name="newhome" id="price" type="text" onfocus="this.value=''" onkeypress="return isNumberKey(event)" maxlength="3" value="<?php echo $result['newhome'] ?>" /><br><br><br>
		
							
			<label class="control-label" for="price">Total New Small Group Meetings Established:</label>&nbsp;
			<input name="newsmall" id="price" type="text" onfocus="this.value=''"  maxlength="3" 
			value="<?php echo $result['newsmall'] ?>" /><br><br><br>


					<label class="control-label" for="price">Average LTM Attendance:</label>&nbsp;
			<input name="ltm" id="price" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3" value="<?php echo $result['ltm'] ?>" /><br><br><br>

			
			<label class="control-label" for="price"> Local Saints joining propagation:</label>&nbsp;
			<input name="saint" id="price" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3" value="<?php echo $result['saint'] ?>" /><br><br><br>

			
			<label class="control-label" for="price">Establish Locality:</label>&nbsp;
			<input name="estlocal" id="price" type="text" value="<?php echo $result['estlocal'] ?>" /><br><br>


			<label class="control-label" for="price">Recovered Locality:</label>&nbsp;
			<input name="reclocal" id="price" type="text"  value="<?php echo $result['reclocal'] ?>" /><br><br>


			<label class="control-label" for="price">Established District:</label>&nbsp;
			<input name="estdis" id="price" type="text"  value="<?php echo $result['estdis'] ?>" /><br><br>

			<label class="control-label" for="price">Recovered District:</label>&nbsp;
			<input name="recdis" id="price" type="text"  maxlength="3" value="<?php echo $result['recdis'] ?>" /><br><br>

			<label class="control-label" for="price">Prospect Trainees for Incoming Term (Brothers):</label>&nbsp;
			<input name="probro" id="price" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3" value="<?php echo $result['probro'] ?>" /><br><br><br><br>


			<label class="control-label" for="price">Prospect Trainees for Incoming Term (Sisters):</label>&nbsp;
			<input name="prosis" id="price" type="text" onfocus="this.value=''"  onkeypress="return isNumberKey(event)" maxlength="3" value="<?php echo $result['prosis'] ?>" /><br><br><br>

		

			<input name="Time" id="price" type="hidden" value="<?php echo date('m/d/Y h:i:s a', time());  ?>" />


			<input name="id" type="hidden" value="<?= $id ?>" />
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
	<input class="btn btn-success bg-gradient-success  sidebar-dark" id="button"  type="submit" name="btn_update" value="update" onclick="alert('Praise the Lord!\nYour Data is now already submitted\nPlease check it to see all updates')"/>
</form>
</div>
