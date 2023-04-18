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
  
  if(count($errors)){
    Message::set($errors, 'danger');
    OldInputs::set($_POST);
    redirect('contacts');
  }
  
  mail('kudriashova.ag@gmail.com', 'Mail from site', "Name: $name <br> Email: $email <br> Message: $message");
  Message::set('Thank');

  redirect('contacts');
}




function sendFile(){
  //dump($_FILES['filename']);
  extract($_FILES['filename']);

  if($error === 4){
    Message::set('File is required', 'danger');
    redirect('gallery');
  }
  if($error !== 0){
    Message::set('File is not upload', 'danger');
    redirect('gallery');
  }

  $allowedExtensions = ['image/jpeg', 'image/gif', 'image/png', 'image/webp'];
  if(!in_array($type, $allowedExtensions)){
    Message::set('File is not image', 'danger');
    redirect('gallery');
  }



  $fileNameArr = explode(".", $name); // ['ffsfsdf', '5', 'jpg']
  $fileExtension = end($fileNameArr);   // 'jpg'
  array_pop($fileNameArr);
  $fileName = implode('.', $fileNameArr);

  //$fName = $fileName . '_' . time() . '.' .  $fileExtension; // 5test.asd.jpg
  $fName = md5(time() . $name) . '.' .  $fileExtension;

  if(!file_exists('uploads'))
    mkdir('uploads');

  if(!move_uploaded_file($tmp_name, 'uploads/' . $fName)){
    Message::set('File is not uploaded', 'danger');
    redirect('gallery');
  }

  resizeImage('uploads/' . $fName, 300, true);

  //$phone = $_POST['phone']; // отримаємо масив
  //dump($phone);
  Message::set('File is uploaded!');
  redirect('gallery');
}


function sendFiles(){
  dump($_FILES['filename']);
}


function resizeImage($filePath, $size, $crop){
  $dest = imagecreatetruecolor($size, $size);

  imagejpeg($dest, 'uploads/1.jpg');
}