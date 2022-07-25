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
