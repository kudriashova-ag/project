<h1>Upload</h1>

<?php Message::get() ?>

<form action="index.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="uploadedFile">
  <button class="btn btn-primary" name="action" value="uploadImage">Upload</button>
</form>