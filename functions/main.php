<?php
function dump($arr)
{
  echo '<pre>' . print_r($arr, true) . '</pre>';
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

  // send mail

  echo "Thank, $name";
}
