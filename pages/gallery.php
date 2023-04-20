<h1>Gallery</h1>

<?php Message::get() ?>

<form action="index.php" method="post" enctype="multipart/form-data">
  <input type="file" name="filename"><br>
  <button name="action" value="sendFile">Send</button>
</form>


<?php

// $files = scandir('uploads');
// foreach ($files as $file) {
//   if ($file !== '.' && $file !== '..' && !is_dir('uploads/'.$file)) {
//     echo "<img src='uploads/$file'>";
//   }
// }

// $files = glob('uploads/*.{jpg,png,webp,gif,jpeg}', GLOB_BRACE);
// dump($files);

$files = [];
$handle = opendir('uploads');
while( $f = readdir($handle) ){
  $files[] = $f;
}
closedir($handle);

$files = array_diff($files, ['.', '..']);
dump($files);


$files = array_diff(scandir('uploads'), ['.', '..']);
dump($files);

?>





<form action="index.php" method="post" enctype="multipart/form-data">
  <input type="file" name="filename[]" multiple><br>
  <button name="action" value="sendFiles">Send</button>
</form>