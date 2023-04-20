<?php
require_once './functions/Message.php';
require_once './functions/OldInputs.php';

ini_set('max_file_uploads', '10');


session_start();

function dump($arr)
{
  echo '<pre>' . print_r($arr, true) . '</pre>';
}

function redirect($page)
{
  header('Location: index.php?page=' . $page);
  exit;
}


$action = $_POST['action'] ?? null; // 'sendMail'
if ($action) {
  $action();
}


function sendMail()
{
  // $name = strip_tags( $_POST['name'] ?? '' );
  $name = trim(htmlentities($_POST['name'] ?? ''));
  $email = $_POST['email'] ?? null;
  $message = $_POST['message'] ?? null;

  $errors = [];

  if (empty($name)) {
    $errors[] = 'Name is required';
  }
  if (empty($email)) {
    $errors[] = 'Email is required';
  }
  if (empty($message)) {
    $errors[] = 'Message is required';
  }

  if (count($errors)) {
    Message::set($errors, 'danger');
    OldInputs::set($_POST);
    redirect('contacts');
  }

  mail('kudriashova.ag@gmail.com', 'Mail from site', "Name: $name <br> Email: $email <br> Message: $message");
  Message::set('Thank');

  redirect('contacts');
}




function sendFile()
{
  //dump($_FILES['filename']);
  extract($_FILES['filename']);

  if ($error === 4) {
    Message::set('File is required', 'danger');
    redirect('gallery');
  }
  if ($error !== 0) {
    Message::set('File is not upload', 'danger');
    redirect('gallery');
  }

  $allowedExtensions = ['image/jpeg', 'image/gif', 'image/png', 'image/webp'];
  if (!in_array($type, $allowedExtensions)) {
    Message::set('File is not image', 'danger');
    redirect('gallery');
  }



  $fileNameArr = explode(".", $name); // ['ffsfsdf', '5', 'jpg']
  $fileExtension = end($fileNameArr);   // 'jpg'
  array_pop($fileNameArr);
  $fileName = implode('.', $fileNameArr);

  //$fName = $fileName . '_' . time() . '.' .  $fileExtension; // 5test.asd.jpg
  $fName = md5(time() . $name) . '.' .  $fileExtension;

  if (!file_exists('uploads'))
    mkdir('uploads');

  if (!move_uploaded_file($tmp_name, 'uploads/' . $fName)) {
    Message::set('File is not uploaded', 'danger');
    redirect('gallery');
  }

  resizeImage('uploads/' . $fName, 300, true);
  resizeImage('uploads/' . $fName, 300, false);

  //$phone = $_POST['phone']; // отримаємо масив
  //dump($phone);
  Message::set('File is uploaded!');
  redirect('gallery');
}


function sendFiles()
{
  dump($_FILES['filename']);
}


function resizeImage($filePath, $size, $crop)
{
  extract(pathinfo($filePath));
  $extension = strtolower($extension) === 'jpg' ? 'jpeg' : $extension;
  $functionCreate = 'imagecreatefrom' . $extension;

  $src = $functionCreate($filePath);

  list($src_width, $src_height) = getimagesize($filePath);
  

  if ($crop) {
    $dest = imagecreatetruecolor($size, $size);
    if ($src_width > $src_height) {
      imagecopyresized($dest, $src, 0, 0, $src_width / 2 - $src_height / 2, 0, $size, $size, $src_height, $src_height);
    } else {
      imagecopyresized($dest, $src, 0, 0, 0, $src_height / 2 - $src_width / 2, $size, $size, $src_width, $src_width);
    }
    $filename .= '_' . $size . 'x' . $size;
  } else {
    $dest_width = $size;
    $dest_height = round($size / ($src_width / $src_height));
    $dest = imagecreatetruecolor($dest_width, $dest_height);
    imagecopyresized($dest, $src, 0, 0, 0, 0, $dest_width, $dest_height, $src_width, $src_height);
    $filename .= '_' . $dest_width . 'x' . $dest_height;
  }

  $functionSave = 'image' . $extension;
  $functionSave($dest, "$dirname/$filename.$extension");
}




function sendReview(){
  $fName = 'reviews.txt';

  $name = $_POST['name'];
  $review = $_POST['review'];
  $time = time();

  $reviews = [];
  if(file_exists($fName)){
    $reviews = json_decode( file_get_contents($fName) );
  }

  $reviews[] = compact('name', 'review', 'time');

  $f = fopen($fName, 'w');
  fwrite($f, json_encode($reviews));  // fputs()
  fclose($f);
  redirect('reviews');
}
