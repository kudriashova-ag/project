<?php
require_once './functions/Message.php';
require_once './functions/OldInputs.php';

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
