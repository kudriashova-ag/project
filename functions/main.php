<?php
require_once './functions/Message.php';
require_once './functions/helpers.php';
session_start();

$action = $_POST['action'] ?? null;
if (!empty($action) && function_exists($action)) {
  $action();
}


function sendMail()
{
  $email = clear($_POST['email'] ?? null);
  $subject = clear($_POST['subject'] ?? null);
  $message = clear($_POST['message'] ?? null);

  $errors = [];
  if (empty($email)) {
    $errors['email'] = 'Email is required';
  }
  if (empty($subject)) {
    $errors['subject'] = 'Subject is required';
  }
  if (empty($message)) {
    $errors['message'] = 'Message is required';
  }

  if (count($errors) > 0) {
    Message::set($errors, 'danger');
  } else {
    Message::set('Thank!');
  }

  redirect('contacts');
}



function uploadImage()
{
  $file = $_FILES['uploadedFile'] ?? null;
  extract($file);

  if ($error != 0) {
    Message::set('Error', 'danger');
    redirect('upload-image');
  }

  $allowedFiles = ['image/jpeg', 'image/png', 'image/webp'];
  if(!in_array($type, $allowedFiles)){
    Message::set('File is not image', 'danger');
    redirect('upload-image');
  }

  $name = translit($name);
  
  move_uploaded_file($tmp_name, $name);
}
