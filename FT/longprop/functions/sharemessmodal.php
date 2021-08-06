
      <form  method="post" enctype="multipart/form-data">
<!-- Delete Modal Accounts -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-primary">
        <h5 class="modal-title" style='color:#F8FAFB'   id="exampleModalLabel"> <i class="fa fa-envelop"></i>Share your Spiritual encouragement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">

     

  <div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="13" placeholder="What's Your Anointing?"></textarea>
  </div>



      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button name="save_profile" class="btn btn-primary"><i class="fas fa-thumbs-up icon-check icon-large"></i> Post</button>
      </div>
    </div>
  </div>
</div>
<!--End of Modal Delete---->
</form>
<?php
  include('functions/db.php');
    if (isset($_POST['save_profile'])) {
                               

        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $image_name = addslashes($_FILES['image']['name']);
        $image_size = getimagesize($_FILES['image']['tmp_name']);

        move_uploaded_file($_FILES["image"]["tmp_name"], "../fttma/img/" . $_FILES["image"]["name"]);
        $location = "img/" . $_FILES["image"]["name"];

mysql_query("INSERT INTO teammate(PRO_FILE) values('$image')")or die(mysql_error());

?>

     <?php     }  ?>

     <script>
function triggerClick(e) {
  document.querySelector('#profileImage').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
</script> 