<h1>Upload</h1>

<?php Message::get() ?>

<form action="index.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="uploadedFile">
  <button class="btn btn-primary" name="action" value="uploadImage">Upload</button>
</form>

<?php
// $files = scandir('./uploads');
// dump($files);
// var_dump( is_dir('./uploads/'. $files[3]) );
// foreach ($files as $file) :
//   if ($file != '.' && $file != '..') :
//     echo "<img src='uploads/$file'>";
//   endif;
// endforeach;

// $files = glob('./uploads/*.{jpg,txt}', GLOB_BRACE);
// $files = glob('./uploads/*', GLOB_ONLYDIR);
// dump($files);

// $dir = opendir('./uploads');
// while($file = readdir($dir)){
//   echo $file . '<br>';
// }
// closedir($dir);


?>